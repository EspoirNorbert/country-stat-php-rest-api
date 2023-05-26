<?php

namespace Ressources;

use Models\Country;

class CountryRessource extends Ressource
{
    public function index(): void
    {
        try {
            parent::get();
            $this->response([
                "message" => "Welcome to Country Article Stat PHP REST API",
                "version" => 1.0,
                "docs" => "https://documenter.getpostman.com/view/13279411/2s93m6128o",
            ], 200);
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }

    /***
     * Get All country from databases
     */
    public function get(): void
    {
        try {
            parent::get();
            $countries = Country::findAll();
            $this->response($countries, 200);
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }

    /***
     * Get Total country
     */
    public function getTotalCountry(): void
    {
        try {
            parent::get();
            $total = Country::Count();
            $this->responseTotal($total);
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }

    /***
     * Get All country from databases
     */
    public function getCountryByArticle($article): void
    {
        try {
            parent::get();
            $countries = Country::findByArticle(ucfirst($article));
            if (empty($countries)) {
                $this->responseRessourceNotFound($article);
            }
            $this->response(["article" => $article, "countries" => $countries], 200);
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }

     /***
     * Get All country from databases
     */
    public function getCountryArticleIsNull(): void
    {
        try {
            parent::get();
            $countries = Country::findByArticleWithout();
            $this->response($countries, 200);
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }


    /***
     * Get Total count by article
     */
    public function getTotalCountryByArticle($article): void
    {
        try {
            parent::get();
            $total = Country::CountByArticle(ucfirst($article));
            if ($total == 0) {
                $this->responseRessourceNotFound($article);
            }
            $this->responseTotal($total);
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }

    /***
     * Get Country without article
     */
    public function getCountryWithoutArticle(): void
    {
        try {
            parent::get();
            $countries = Country::findByArticleWithout();
            $this->response($countries, 200);
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }

    /***
     * Get Total country without article
     */
    public function getTotalCountryWithoutArticle(): void
    {
        try {
            parent::get();
            $total = Country::CountLessArticle();
            $this->responseTotal($total);
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }

    /***
     * Get All country from databases
     */
    public function getCountryByContinent($continent): void
    {
        try {
            parent::get();
            
            /***
             * Exceptionel for "Amerique french and
             */
            
            $countries = Country::findByContinent(ucfirst($continent));
            if (empty($countries)){
                $message = "Continent '$continent' not found !";
                $this->responseRessourceNotFound(null, $message);
            } else{
                $this->response($countries, 200);
            }
        } catch (\Throwable $e) {
            $this->handle_error($e);
        }
    }

    private function responseTotal($total)
    {
        return $this->response(["total" => $total], 200);
    }

    private function responseRessourceNotFound($article,$message=null)
    {
        if ($message  == null){
            $message = "French Article '$article' not found !";
        }
        $this->response_error(404, $message);
        die();
    }
}
