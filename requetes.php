<?php
require_once 'pdo.php';

function requete_lire_table_users(){
    $db = connexion_BD();
    $sql = "SELECT * FROM users";
    $req = $db->prepare($sql);
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
}

function requete_findUser(string $pseudo){
    $db = connexion_BD();
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
    $req = $db->prepare($sql);
    $req->execute(['pseudo' => $pseudo]);
    $data2 = $req->fetch(PDO::FETCH_OBJ);
    if($data2 !== false){
        return $data2;
    }else{
        $_SESSION['error'] = 'L\'utilisateur n\'existe pas';
    }
}

function demarreSession($id, $username){
    $_SESSION['user'] = [
        'id' => $id,
        'username' => $username
    ];
}

function connexion(string $username, string $password ){
    $db = connexion_BD();
    $sql = "SELECT * FROM users WHERE pseudo = :username";
    $req = $db->prepare($sql);
    $req->execute(['username' => $username]);
    $response = $req->fetch(PDO::FETCH_OBJ);
    if($response && $password === $response->password){
        demarreSession($response->id, $response->pseudo);
        $_SESSION['success'] = 'Vous êtes connecté, bienvenue !';
        return true;
    }else{
        $_SESSION['error'] = 'Le pseudo et/ou le mot de passe est incorrect';
        return false;
    }
}

function deconnexion(){
    unset($_SESSION['user']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
