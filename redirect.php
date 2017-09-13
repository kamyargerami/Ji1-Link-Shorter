<?php
include_once ('functions.php');
include_once ('panel/config.php');
$requestShortLink = htmlspecialchars($_GET['getShortLinkFromShorted']);

    try{
        //connect to database
        $databaseConnection = new PDO("mysql:host=$mysqlHost;dbname=$databaseName",$databaseUser,$databasePassword);
        $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //ready query for execute
        $sqlReadLinkQuery = "select * from links where short='$requestShortLink'";

        //execute write to database
        $getDataFromDatabase = $databaseConnection->query($sqlReadLinkQuery);
        $getDataFromDatabase -> setFetchMode(PDO::FETCH_ASSOC);
        while ($dataBaseColLineData = $getDataFromDatabase->fetch()){
            Header( "HTTP/1.1 301 Moved Permanently" );
            Header( "Location: " . $dataBaseColLineData['long']);
        }

    }catch(PDOException $e){
//error text info
        echo "Error: " . $e->getMessage();
    }

$databaseConnection = null;