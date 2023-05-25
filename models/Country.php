<?php
namespace Models;


class Country  {
    
    public static function findAll(){
        $sql = "select * from countries";
        $query = SQLitePDO::getInstance()->query($sql);
        $resultat = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $resultat[] = $data;
        }
        return $resultat;
    }

    public static function findByContinent($continent){
        $sql = "select * from countries where continent= :continent";
        $query =  SQLitePDO::getInstance()->prepare($sql);
        $query->bindParam(':continent', $continent);
        // Exécution de la requête
        $query->execute();
        $resultat = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $resultat[] = $data;
        }
        return $resultat;
    }

    public static function findByArticle($article){
        $sql = "select * from countries where article= :article";
        $query =  SQLitePDO::getInstance()->prepare($sql);
        $query->bindParam(':article', $article);
        // Exécution de la requête
        $query->execute();
        $resultat = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $resultat[] = $data;
        }
        return $resultat;
    }

    public static function findByArticleWithout(){
        $sql = "select * from countries where article is null";
        $query = SQLitePDO::getInstance()->query($sql);
        $resultat = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $resultat[] = $data;
        }
        return $resultat;
    }

    public static function Count(){
        $sql = "select count(*) total from countries";
        $query = SQLitePDO::getInstance()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function CountByArticle($article){
        $sql = "select count(*) total from countries where article=:article";
        $query =  SQLitePDO::getInstance()->prepare($sql);
        $query->bindParam(':article', $article);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function CountLessArticle(){
        $sql = "select count(*) total from countries where article is null";
        $query = SQLitePDO::getInstance()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

}