<?php
require_once('View/strings.php');
require_once('config.php');

function isValidUrl($url){  //function to verify url with boolian return
    if(filter_var($url, FILTER_VALIDATE_URL)){
        return true;
    }else{
        return false;
    }
}

function random_string($length) {
    global $databaseConnection;
    $flagWrite = false;
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    do{
        $sqlReadLinkQuery = $databaseConnection -> prepare("SELECT * FROM links WHERE short= :short");
        $sqlReadLinkQuery -> bindParam('short',$key);
        $sqlReadLinkQuery -> execute();
        $row = $sqlReadLinkQuery -> fetch(PDO::FETCH_ASSOC);

        if(!$row){
            $flagWrite = true;
        }
    }while($flagWrite == false);


    if($flagWrite){
        return $key;
    }
    return $key;
}

function delete_expire_links(){
    //delete items expire
    global $databaseConnection,$min_click_toDelete;
    $sqlDeleteCol = $databaseConnection->prepare("DELETE FROM `links`
                      WHERE `links`.`expire` = :expire AND `links`.`click` < :minClick");
    $sqlDeleteCol->bindParam(':expire', $today);
    $sqlDeleteCol->bindParam(':minClick', $min_click_toDelete);
    $sqlDeleteCol->execute();
}

function add_expire_date(){
    //add days for 50 clicks and upper
    global $databaseConnection,$min_click_toDelete;
    $sqlChangeExpire = $databaseConnection->prepare("UPDATE `links` SET `expire` = :newExpire
                      WHERE `links`.`expire` = :expire AND `links`.`click` > :minClick;");
    $sqlChangeExpire->bindParam(':expire', $today);
    $sqlChangeExpire->bindParam(':newExpire', $upperExpire);
    $sqlChangeExpire->bindParam(':minClick',$min_click_toDelete);
    $sqlChangeExpire->execute();
}

function isAllready_exist_link($long){
    global $databaseConnection;
    $sqlCheckExistLong = $databaseConnection -> prepare("SELECT * FROM `links` WHERE `long` LIKE :long");
    $sqlCheckExistLong -> bindParam(':long',$long);
    $sqlCheckExistLong -> execute();
    $row = $sqlCheckExistLong -> fetchAll();
    if($row){
        return $row[0]['short'];
    }else{
        return false;
    }
}
