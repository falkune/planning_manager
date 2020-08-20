<?php
session_start();

// inclusion des different fichiers 
require_once('connexion.php');
require_once('globale.php');
require_once('departement.php');
require_once('boutique.php');
require_once('employe.php');
require_once('planning.php');
require_once('all_planning.php');
require_once('departement_planning.php');
require_once('navigation.php');


function userShop($url){
  // fonction qui retourne la liste des employés et des boutiques du departement selectionné
  $connexion = connexion();

  $request_user = $connexion->prepare("SELECT * FROM employes WHERE id_departement = ?");
  $request_shop = $connexion->prepare("SELECT * FROM boutiques WHERE id_departement = ?");

  $request_user->execute(array($url[1]));
  $request_shop->execute(array($url[1]));

  $users = $request_user->fetchAll(PDO::FETCH_ASSOC);
  $shops = $request_shop->fetchAll(PDO::FETCH_ASSOC);

  return $error = json_encode([
    'status' => 'ok',
    'users' => $users,
    'shops' => $shops
  ]);
}

function getOut(){
  $deconnexion = session_destroy();
  if( $deconnexion == TRUE ){
    return $error = json_encode([
      'status' => 'ok',
      'message' => 'disconnected'
    ]);
  }
  else{
    return $error = json_encode([
      'status' => 'failed',
      'message' => 'not disconnected'
    ]);
  }
  
}