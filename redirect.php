<?php
include_once ('functions.php');
include_once ('panel/config.php');
$requestShortLink = htmlspecialchars($_GET['getShortLinkFromShorted']);
$flagFind = false;
    try{
        //connect to database
        $databaseConnection = new PDO("mysql:host=$mysqlHost;dbname=$databaseName",$databaseUser,$databasePassword);
        $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //ready query for execute
        $sqlReadLinkQuery = "select * from links where short='$requestShortLink'"; //query to find long link

        //execute write to database
        $getDataFromDatabase = $databaseConnection->query($sqlReadLinkQuery); //run query
        $getDataFromDatabase -> setFetchMode(PDO::FETCH_ASSOC);
        while ($dataBaseColLineData = $getDataFromDatabase->fetch()){ //get col by col database
            $flagFind = true;
            $click = $dataBaseColLineData['click'] + 1;  //var that show current row click number

            $currentColid = $dataBaseColLineData['id']; //var that show current row id

            $sqlWriteClickQuery = $databaseConnection->prepare(
                "UPDATE `links` SET `click` = :click WHERE `links`.`id` = :id;");

            $sqlWriteClickQuery->bindParam(':click', $click);
            $sqlWriteClickQuery->bindParam(':id', $currentColid);

            $sqlWriteClickQuery->execute(); //click successfully write


            if($dataBaseColLineData['expire'] ==  date("Y-m-d") ){
                if($click <= 50){ //if click < 20 delete row
                    $sqlDeleteCol = $databaseConnection->prepare("DELETE FROM `links` WHERE `links`.`id` = :id");
                    $sqlDeleteCol->bindParam(':id', $currentColid);
                    $sqlDeleteCol->execute();
                    echo "اعتبار این لینک دیگر معتبر نیست و بیش از ۱۰۰ روز از تولید آن میگذرد همچنین به مقدار کافی بازدید نداشته است";
                }else{ //add 20 day to expire day if click > 20
                    $expireDate = date('Y-m-d', strtotime("+20 days"));
                    $sqlPlusExpireDate = $databaseConnection->prepare(
                        "UPDATE `links` SET `expire` = :expire WHERE `links`.`id` = :id;");
                    $sqlPlusExpireDate->bindParam(':id', $currentColid);
                    $sqlPlusExpireDate->bindParam(':expire', $expireDate);
                }
            }else{
            Header( "HTTP/1.1 301 Moved Permanently" );
            Header( "Location: " . $dataBaseColLineData['long']);
            }
        }
        if(!$flagFind){
            echo "لینک نا معتبر است ، پس از گذشت ۳ ثانیه به صفحه اصلی منتقل می شوید";
            header('Refresh: 3;url=index.php');
        }

    }catch(PDOException $e){
//error text info
        echo "Error: " . $e->getMessage();
    }

$databaseConnection = null;