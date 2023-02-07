<?php

class DbPDO
{
    private static string $server = 'localhost';
    private static string $username = 'root';
    private static string $password = '';
    private static string $database = 'test';
    private static ?PDO $db = null;

    public static function connect(): ?PDO {
        if (self::$db == null){
            try {
                self::$db = new PDO("mysql:host=".self::$server.";dbname=".self::$database, self::$username, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Erreur de la connexion à la dn : " . $e->getMessage();
                die();
            }
        }
        return self::$db;
    }

    public static function addStudent($nom, $prenom, $age) {
        $request = self::$db->prepare(" INSERT INTO eleves (nom, prenom, age)
        VALUES (:nom, :prenom, :age)");

        $request->bindParam(":nom", $nom);
        $request->bindParam(":prenom", $prenom);
        $request->bindParam(":age", $age);

        $request->execute();
        echo "Utilisateur ajouter";
    }

    public static function getAllStudents(): array {
        $request = self::$db->prepare("SELECT * FROM eleves ORDER BY id ASC");
        $request->execute();
        return $request->fetchAll();
    }


    public static function updateStudent($nom, $prenom, $age, $idEleve) {
        $request = self::$db->prepare("UPDATE eleves SET nom = :nom, prenom = :prenom, age = :age WHERE id = :idEleve");
        $request->bindParam(":nom", $nom);
        $request->bindParam(":prenom", $prenom);
        $request->bindParam(":age", $age);
        $request->bindParam(":idEleve", $idEleve);
        $request->execute();
    }

    public static function deleteStudent($idEleve){
        $request = self::$db->prepare("DELETE FROM eleves WHERE id = :idEleve");
        $request->bindParam(":idEleve", $idEleve);
        $request->execute();
        echo "L'élève a été supprimé avec succès";
    }
}
