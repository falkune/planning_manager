<?php

function saveShop($url){
  if(count($url) != 3){
    return $error = json_encode([
      'status' => 'failed',
      'message' => "nombre d'argument incorrect..."
    ]);
  }
  else{
    $connexion = connexion();

    $select_request = $connexion->prepare("SELECT * FROM boutiques WHERE nom_boutique = ?");
    $select_request->execute(array($url[1]));
    $result = $select_request->fetch();

    if($result == false){
      $request = $connexion->prepare("INSERT INTO boutiques (nom_boutique, id_departement) VALUES (?, ?)");
      $request->execute(array($url[1], $url[2]));

      return $error = json_encode([
        'status' => 'ok',
        'message' => 'boutique crée...'
      ]);
    }
    else{
      return $error = json_encode([
        'status' => 'failed',
        'message' => 'ce nom de boutique existe déja...'
      ]);
    }

  }
}