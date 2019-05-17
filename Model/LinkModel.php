<?php


namespace Model;


class LinkModel extends Model
{
    public $table = 'links';


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

    public function addClick($linkId, $click)
    {
        $query = $this->connection->prepare(
            "UPDATE `links` SET `click` = :click WHERE `links`.`id` = :id;");

        $query->bindParam(':click', $click);
        $query->bindParam(':id', $linkId);
        $query->execute();
    }
}