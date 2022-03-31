<?php
function connexion_BD()
{
    try 
    {
        $db = new PDO("mysql:host=localhost;port=3307;dbname=tp_pdo;charset=utf8", "root", "");
        return $db;
    } 
    catch (Exception $e) 
    {
        die($e->getMessage());
    }
}