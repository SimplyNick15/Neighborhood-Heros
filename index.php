<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';
require 'factual-php-driver/Factual.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

$app->get('/support', function () use ($app) {
    $zipCode = '10036';
    $factual = new Factual("Jdlr6CLrDIViRwsBhMFGfFS6VNVSZSzLtnnyhGRD", "u821CA80iVAhWzUCv421bG9b8uTV372oYn7OkTNc");
    echo "<pre>";

    $url ="http://maps.googleapis.com/maps/api/geocode/xml?address=".$zipCode."&sensor=true";
    $result = simplexml_load_file($url);

    $lat = (float) $result->result->geometry->location->lat[0];
    $lng = (float) $result->result->geometry->location->lng[0];

    $query = new FactualQuery;
    $query->limit(50);
    //$query->search("pizza");
    $query->within(new FactualCircle($lat, $lng, 1600));
    $res = $factual->fetch("places", $query);
    
    $bus = $res->getData();

    $businessNames = [];

    foreach ($bus as $curB) {
        $id = $curB['factual_id'];
        $name = $curB['name'];

        if ($name == "Baskin-Robbins") continue;

        $businessNames[$id] = $name;
    }

    $app->render('support.php', ['businessNames' => $businessNames]);

});

$app->post('/support', function () use ($app) {

    $databaseFile = "database.txt";
    $Handle = fopen($databaseFile, 'a');
    fwrite($Handle, "1");
    fclose($Handle);
    $app->redirect('/leaderboard');
});

$app->get('/leaderboard', function () use ($app) {
    $contents = file_get_contents("database.txt");
    $points = strlen($contents);

    $app->render('leaderboard.php', ['points' => $points]);

});

$app->get('/', function () use ($app) {

    $app->render('home.php');
});

$app->run();
