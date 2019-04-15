<?php
include_once('functions.php');
include_once('config.php');

$getLongLink = htmlspecialchars($_POST['linkLong']);
$flagWrite = true;
$today = date("Y-m-d");
$upperExpire = date('Y-m-d', strtotime("+20 days"));
if (isValidUrl($getLongLink)) {
    try {
        $databaseConnection = new PDO("mysql:host=$mysqlHost;dbname=$databaseName", $databaseUser, $databasePassword);
        $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $shortLink = isAllready_exist_link($getLongLink);
        if (!$shortLink) {
            $shortLink = random_string($randomCharNumber);
            $sqlWriteLinkQuery = $databaseConnection->prepare(
                "INSERT INTO `links` (`id`, `long`, `short`, `expire`)
                                VALUES (NULL, :longLink, :shortLink, :expireDate);");

            //connect binds to variable
            $sqlWriteLinkQuery->bindParam(':longLink', $getLongLink);
            $sqlWriteLinkQuery->bindParam(':shortLink', $shortLink);
            $sqlWriteLinkQuery->bindParam(':expireDate', $upperExpire);
            //execute write to database
            $sqlWriteLinkQuery->execute();
        }
        echo getUrl() . $shortLink;

        //delete items expire
        $expireDate = date('Y-m-d', strtotime("+100 days"));

        $sqlDeleteCol = $databaseConnection->prepare("DELETE FROM `links`
                      WHERE `links`.`expire` = :expire AND `links`.`click` < 50");
        $sqlDeleteCol->bindParam(':expire', $today);
        $sqlDeleteCol->execute();

        //add days for 50 clicks and upper
        $sqlChangeExpire = $databaseConnection->prepare("UPDATE `links` SET `expire` = :newExpire
                      WHERE `links`.`expire` = :expire AND `links`.`click` > 50;");
        $sqlChangeExpire->bindParam(':expire', $today);
        $sqlChangeExpire->bindParam(':newExpire', $upperExpire);
        $sqlChangeExpire->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid URL";
}


$databaseConnection = null;
