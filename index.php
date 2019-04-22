<?php
ini_set('display_errors',1); error_reporting(E_ALL);

require_once ('vendor/autoload.php');

use \NoahBuscher\Macaw\Macaw;

Macaw::get('/', 'Controller\HomeController@homepage');
Macaw::post('/shorter', 'Controller\LinkController@shortener');
Macaw::get('/redirect', 'Controller\LinkController@redirect');
Macaw::get('/(:any)', function ($shortLink){
    header("Location: /redirect?shortLink=" . $shortLink);
});

Macaw::dispatch();
