<?php
define("SERVER_NAME", "localhost");
define("DB_NAME", "planning_manager");
define("DB_USER", "diokel");
define("DB_PASSWORD", "passer");

function connexion(){

  try{
    $error = new PDO('mysql:host='.SERVER_NAME.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, array(PDO::ATTR_ERRMODE	=>PDO::ERRMODE_EXCEPTION));
  }
  catch(PDOException $e){
    $error = ERROR_1;
  }

  return $error;

}