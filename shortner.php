<?php
include_once ('functions.php');
include_once ('panel/config.php');
$getLongLink = htmlspecialchars($_POST['linkLong']);

if(isValidUrl($getLongLink)){
    try{
        //connect to database
        $databaseConnection = new PDO("mysql:host=$mysqlHost;dbname=$databaseName",$databaseUser,$databasePassword);
        $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $flagWrite = true;
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


            //ready query for execute
            $sqlWriteLinkQuery = $databaseConnection->prepare(
                "INSERT INTO `links` (`id`, `long`, `short`, `userCreated`, `click`)
                                VALUES (NULL, :longLink, :shortLink, DEFAULT , DEFAULT);");



            //connect binds to variable
            $sqlWriteLinkQuery->bindParam(':longLink', $getLongLink);
            $sqlWriteLinkQuery->bindParam(':shortLink', $shortLink);
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