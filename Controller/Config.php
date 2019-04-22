<?php

namespace Controller;

class Config
{
    public static $siteUrl = "http://ji1.test/";  //put your current path url
    public static $randomCharNumber = 3;

    public static $mysqlHost = "localhost"; //put your server host here
    public static $databaseName = "ji1"; //put your database name that you crated
    public static $databaseUser = "root"; //put your database username that you created
    public static $databasePassword = "";//put your database password that you crated
    public static $min_click_toDelete = 50;

    public static function getUrl()
    {
        return self::$siteUrl;
    }
}