<?php
namespace Ressources;

use Throwable;

class Ressource {

    public function __construct() {}

    public function header(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }

    public function get(){
        $this->header();
        $this->notAllowedMethod("GET");
    }

    public function notAllowedMethod(string $method){
        if($_SERVER["REQUEST_METHOD"] != $method){
            $this->response([
                "code" => "405",
                "error" => [
                    "message" => "This method is not allowed"
                ]
            ],405);
        }
    }

    public function response(array $datas , int $httpCode){
        http_response_code($httpCode);
        echo json_encode($datas);
    }

    public function response_error(int $httpCode, string $message){
        http_response_code($httpCode);
        $this->response([
            "code" => $httpCode,
            "error" => [
                "message" => $message
            ]
        ],$httpCode);
    }

    public function handle_error(Throwable $message){
        http_response_code(500);
        $message = $message->getMessage();
        $this->response_error(500,$message);
    }

}