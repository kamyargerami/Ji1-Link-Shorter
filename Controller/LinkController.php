<?php

namespace Controller;
use Controller\Config;
use PDO;

class LinkController
{
    public $connection;

    public function __construct()
    {
        $this->connection = $this->makeConnection();
    }

    public function shorter()
    {
        $getLongLink = htmlspecialchars($_POST['linkLong']);
        $flagWrite = true;
        $today = date("Y-m-d");
        $upperExpire = date('Y-m-d', strtotime("+20 days"));
        if ($this->isValidUrl($getLongLink)) {
            try {
                $shortLink = $this->isAllready_exist_link($getLongLink);
                if (!$shortLink) {
                    $shortLink = $this->random_string(Config::$randomCharNumber);
                    $sqlWriteLinkQuery = $this->connection->prepare(
                        "INSERT INTO `links` (`id`, `long`, `short`, `expire`)
                                VALUES (NULL, :longLink, :shortLink, :expireDate);");

                    //connect binds to variable
                    $sqlWriteLinkQuery->bindParam(':longLink', $getLongLink);
                    $sqlWriteLinkQuery->bindParam(':shortLink', $shortLink);
                    $sqlWriteLinkQuery->bindParam(':expireDate', $upperExpire);
                    //execute write to database
                    $sqlWriteLinkQuery->execute();
                }
                echo Config::getUrl() . $shortLink;

                //delete items expire
                $expireDate = date('Y-m-d', strtotime("+100 days"));

                $sqlDeleteCol = $this->connection->prepare("DELETE FROM `links`
                      WHERE `links`.`expire` = :expire AND `links`.`click` < 50");
                $sqlDeleteCol->bindParam(':expire', $today);
                $sqlDeleteCol->execute();

                //add days for 50 clicks and upper
                $sqlChangeExpire = $this->connection->prepare("UPDATE `links` SET `expire` = :newExpire
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

        $this->connection = null;
    }

    public function redirect()
    {
        $requestShortLink = htmlspecialchars($_GET['shortLink']);
        $flagFind = false;
        try {
            //ready query for execute
            $sqlReadLinkQuery = "select * from links where short='$requestShortLink'"; //query to find long link

            //execute write to database
            $getDataFromDatabase = $this->connection->query($sqlReadLinkQuery); //run query
            $getDataFromDatabase->setFetchMode(PDO::FETCH_ASSOC);
            while ($dataBaseColLineData = $getDataFromDatabase->fetch()) { //get col by col database
                $flagFind = true;
                $click = $dataBaseColLineData['click'] + 1;  //var that show current row click number
                $currentColid = $dataBaseColLineData['id']; //var that show current row id

                $sqlWriteClickQuery = $this->connection->prepare(
                    "UPDATE `links` SET `click` = :click WHERE `links`.`id` = :id;");

                $sqlWriteClickQuery->bindParam(':click', $click);
                $sqlWriteClickQuery->bindParam(':id', $currentColid);
                $sqlWriteClickQuery->execute(); //click successfully write

                Header("HTTP/1.1 301 Moved Permanently");
                Header("Location: " . $dataBaseColLineData['long']);
            }
            if (!$flagFind) {
                echo "لینک نا معتبر است ، پس از گذشت ۳ ثانیه به صفحه اصلی منتقل می شوید";
                header('Refresh: 3;url=/');
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $databaseConnection = null;
    }

    public function isValidUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        } else {
            return false;
        }
    }

    public function random_string($length)
    {
        $flagWrite = false;
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        do {
            $sqlReadLinkQuery = $this->connection->prepare("SELECT * FROM links WHERE short= :short");
            $sqlReadLinkQuery->bindParam('short', $key);
            $sqlReadLinkQuery->execute();
            $row = $sqlReadLinkQuery->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                $flagWrite = true;
            }
        } while ($flagWrite == false);


        if ($flagWrite) {
            return $key;
        }
        return $key;
    }

    function delete_expire_links()
    {
        $sqlDeleteCol = $this->connection->prepare("DELETE FROM `links`
                      WHERE `links`.`expire` = :expire AND `links`.`click` < :minClick");
        $sqlDeleteCol->bindParam(':expire', $today);
        $sqlDeleteCol->bindParam(':minClick', Config::$min_click_toDelete);
        $sqlDeleteCol->execute();
    }

    function add_expire_date()
    {
        $sqlChangeExpire = $this->connection->prepare("UPDATE `links` SET `expire` = :newExpire
                      WHERE `links`.`expire` = :expire AND `links`.`click` > :minClick;");
        $sqlChangeExpire->bindParam(':expire', $today);
        $sqlChangeExpire->bindParam(':newExpire', $upperExpire);
        $sqlChangeExpire->bindParam(':minClick', Config::$min_click_toDelete);
        $sqlChangeExpire->execute();
    }

    function isAllready_exist_link($long)
    {
        $sqlCheckExistLong = $this->connection->prepare("SELECT * FROM `links` WHERE `long` LIKE :long");
        $sqlCheckExistLong->bindParam(':long', $long);
        $sqlCheckExistLong->execute();
        $row = $sqlCheckExistLong->fetchAll();
        if ($row) {
            return $row[0]['short'];
        } else {
            return false;
        }
    }

    public function makeConnection()
    {
        $DB = new PDO('mysql:host=' . Config::$mysqlHost . ';dbname=' . Config::$databaseName, Config::$databaseUser, Config::$databasePassword);
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $DB;
    }
}