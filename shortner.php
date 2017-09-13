<?php
include_once ('functions.php');
include_once ('panel/config.php');
$getLongLink = htmlspecialchars($_POST['linkLong']);
$flagWrite = true;
if(isValidUrl($getLongLink)){
    try{
        //connect to database
        $databaseConnection = new PDO("mysql:host=$mysqlHost;dbname=$databaseName",$databaseUser,$databasePassword);
        $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        do{
            $shortLink = random_string($randomCharNumber); //bulid short link whith site address and random number
            //ready query for execute
            $sqlReadLinkQuery = "select * from links where short='$shortLink'";
            //execute write to database
            $getDataFromDatabase = $databaseConnection->query($sqlReadLinkQuery);
            $getDataFromDatabase -> setFetchMode(PDO::FETCH_ASSOC);
            while ($dataBaseColLineData = $getDataFromDatabase->fetch()){
                $flagWrite = false;
            }
        }while(!$flagWrite);


        $expireDate = date('Y-m-d', strtotime("+100 days"));
            //ready query for execute
            $sqlWriteLinkQuery = $databaseConnection->prepare(
                "INSERT INTO `links` (`id`, `long`, `short`, `expire`)
                                VALUES (NULL, :longLink, :shortLink, :expireDate);");

            //connect binds to variable
            $sqlWriteLinkQuery->bindParam(':longLink', $getLongLink);
            $sqlWriteLinkQuery->bindParam(':shortLink', $shortLink);
            $sqlWriteLinkQuery->bindParam(':expireDate', $expireDate);
            //execute write to database
            $sqlWriteLinkQuery->execute();

            echo getUrl() . $shortLink;


    }catch(PDOException $e){
//error text info
        echo "Error: " . $e->getMessage();
    }
}else{
    echo "Invalid URL";
}


$databaseConnection = null;