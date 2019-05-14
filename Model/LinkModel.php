<?php


namespace Model;


class LinkModel extends Model
{
    public function insert($long,$short,$expire)
    {
        $query = $this->connection->prepare(
            "INSERT INTO `links` (`id`, `long`, `short`, `expire`)
                                VALUES (NULL, :longLink, :shortLink, :expireDate);");

        $query->bindParam(':longLink', $long);
        $query->bindParam(':shortLink', $short);
        $query->bindParam(':expireDate', $expire);
        return $query->execute();
    }

    public function isLinkExist($long)
    {
        $query = $this->connection->prepare("SELECT * FROM `links` WHERE `long` LIKE :long");
        $query->bindParam(':long', $long);
        $query->execute();
        $row = $query->fetchAll();
        if ($row) {
            return $row[0]['short'];
        } else {
            return false;
        }
    }

    public function deleteExpired()
    {
        $today = date("Y-m-d");
        $query = $this->connection->prepare("DELETE FROM `links`
                      WHERE `links`.`expire` = :expire AND `links`.`click` < 50");
        $query->bindParam(':expire', $today);
        return $query->execute();
    }

    public function updatePopulars()
    {
        $today = date("Y-m-d");
        $sqlChangeExpire = $this->connection->prepare("UPDATE `links` SET `expire` = :newExpire
                      WHERE `links`.`expire` = :expire AND `links`.`click` > 50;");
        $sqlChangeExpire->bindParam(':expire', $today);
        $sqlChangeExpire->bindParam(':newExpire', $upperExpire);
        $sqlChangeExpire->execute();
    }

    public function fetchByShortLink($short)
    {
        $query = $this->connection->prepare("SELECT * FROM `links` WHERE `short` LIKE :short");
        $query->bindParam(':short', $short);
        $query->execute();
        $row = $query->fetchAll();
        if ($row) {
            return $row[0];
        } else {
            return false;
        }
    }

    public function addClick($linkId,$click)
    {
        $sqlWriteClickQuery = $this->connection->prepare(
            "UPDATE `links` SET `click` = :click WHERE `links`.`id` = :id;");

        $sqlWriteClickQuery->bindParam(':click', $click);
        $sqlWriteClickQuery->bindParam(':id', $currentColid);
        $sqlWriteClickQuery->execute();
    }
}