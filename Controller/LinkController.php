<?php

namespace Controller;

use Model\LinkModel;

class LinkController
{
    public $model;

    public function __construct()
    {
        $this->model = new LinkModel();
    }

    public function shorter()
    {
        $longLink = htmlspecialchars($_POST['linkLong']);
        if ($this->isValidUrl($longLink)) {
            try {
                $shortLink = $this->isLinkExist($longLink);
                $upperExpire = date('Y-m-d', strtotime("+20 days"));

                if (!$shortLink) {
                    $shortLink = $this->random_string(Config::$randomCharNumber);
                    $this->model->insert([
                        'long' => $longLink,
                        'short' => $shortLink,
                        'expire' => $upperExpire,
                        'click' => 0
                    ]);
                }

                echo Config::getUrl() . $shortLink;

                $this->model->deleteExpired();
                $this->model->updatePopulars();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Invalid URL";
        }
    }

    public function redirect()
    {
        $shortLink = htmlspecialchars($_GET['shortLink']);
        try {
            $longLink = $this->fetchByShortLink($shortLink);
            if ($longLink) {
                $this->model->addClick($longLink['click'] + 1, $longLink['id']);

                Header("Location: " . $longLink['long']);
            } else {
                echo "لینک نا معتبر است ، پس از گذشت ۳ ثانیه به صفحه اصلی منتقل می شوید";
                header('Refresh: 3;url=/');
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
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
            $link = $this->fetchByShortLink($key);

            if (!$link) {
                $flagWrite = true;
            }
        } while ($flagWrite == false);

        return $key;
    }

    public function isLinkExist($long)
    {
        $row = $this->model->fetch(['long' => $long]);
        if ($row) {
            return $row[0]['short'];
        } else {
            return false;
        }
    }

    public function fetchByShortLink($short)
    {
        $row = $this->model->fetch(['short' => $short]);
        if ($row) {
            return $row[0];
        } else {
            return false;
        }
    }
}
