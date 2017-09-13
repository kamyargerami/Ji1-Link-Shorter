<?php
require_once ('config.php');
try{
    //connect to database
    $databaseConnection = new PDO("mysql:host=$mysqlHost;dbname=$databaseName",$databaseUser,$databasePassword);
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //ready query for execute
    $sqlInstallQuery = $databaseConnection->prepare("
    CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `long` varchar(700) NOT NULL,
  `short` varchar(50) NOT NULL,
  `expire` DATE NOT NULL DEFAULT '2050/01/01',
  `click` INT NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

    ");


    $sqlInstallQuery->execute();

    echo "database successfully imported!";
    echo "please delete this file!";

}catch(PDOException $e){
//error text info
    echo "import failed! <br>";
    echo "Error: " . $e->getMessage();
}