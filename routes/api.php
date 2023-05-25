<?php

use Ressources\CountryRessource;
use Ressources\ErrorRessource;
use Tests\TestController;

$route->get('/', function () {
    header("location: /api/country/stats");
});

$route->get('/test', function () {
    (new TestController)->index();
});

$route->mount("/api/country/stats", function () use ($route) {
    $route->get('/', function () {
        (new CountryRessource)->index();
    });

    $route->get('/countries', function () {
        (new CountryRessource)->get();
    });

    $route->get('/countries/count', function () {
        (new CountryRessource)->getTotalCountry();
    });
    $route->get('/countries/article/([a-zA-Z]+)', function ($article) {
        (new CountryRessource)->getCountryByArticle($article);
    });

    $route->get('/countries/article/([a-zA-Z]+)/count', function ($article) {
        (new CountryRessource)->getTotalCountryByArticle($article);
    });

    $route->get('/countries/articles', function () {
        (new CountryRessource)->getCountryWithoutArticle();
    });

    $route->get('/countries/articles/count', function () {
        (new CountryRessource)->getTotalCountryWithoutArticle();
    });

    $route->get('/countries/continents/([a-zA-Z]+)', function ($continent) {
        (new CountryRessource)->getCountryByContinent($continent);
    });
});

$route->set404(function(){
    (new ErrorRessource)->get404();
});