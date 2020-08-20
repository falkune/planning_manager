<?php
function saveDepartement($url){

  if(count($url) != 2){
    return $error = json_encode([
      'status' => 'failed',
      'message' => "nombre d'argument incorect!"
    ]);
  }
  else{
    $connexion = connexion();
    $select_request = $connexion->prepare("SELECT * FROM departements WHERE nom_departement = ?");
    $select_request->execute(array($url[1]));

    $result =  $select_request->fetch();

    if($result == false){
      $insert_request = $connexion->prepare("INSERT INTO departements (nom_departement)  VALUES (?)");
      $insert_request->execute(array($url[1]));
      return $error = json_encode([
        'status' => 'ok',
        'message' => 'département crée...'
      ]);
    }
    else{
      return $error = json_encode([
        'status' => 'failed',
        'message' => 'ce département existe déja...'
      ]);
    }
  }
}