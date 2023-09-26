<?php

//inclure function.php
require_once "function.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //vérifie si la requête est de type GET

    $url = $_SERVER['REQUEST_URI'];
    $url = trim($url, "\/");
    $url = explode("/",$url);
    $action = $url[1];
    if($action == "getuserlist"){
        getListUser();
    }

} else {
    //ce que l'utilisateur envoi via le formulaire, on le récupère
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data['action'] == "login") {
        //appel de la fonction login
        login($data['pseudo'], $data['password']);

    } else if ($data['action'] == "register") {
        // on fait appel à la fonction register pour enregistrer le user
        register($data['firstname'], $data['lastname'], $data['pseudo'], $data['password']);

    } else if ($data['action'] == "send message") {
        //appel de la fonction sendMessage
        sendMessage($data['expeditor'], $data['receiver'], $data['message']);

    } else {
        echo json_encode([
            "status" => 404,
            "message" => "password incorrect"
        ]);
    }



}