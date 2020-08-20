<?php

function saveUser($url){
  if(count($url) != 7){
    return $error = json_encode([
      'status' => 'failed',
      'message' => "nombre d'argument incorect..."
    ]);
  }
  else{
    $connexion = connexion();
    $request = $connexion->prepare("INSERT INTO employes (nom_employe, premom_employe, adresse_employe, email_employe, tel_employe, id_departement) VALUES (?, ?, ?, ?, ?, ?)");
    $request->execute(array($url[1],$url[2],$url[3],$url[4],$url[5],$url[6]));

    return $error = json_encode([
      'status' => 'ok',
      'message' => 'employée enregistré...'
    ]);
  }

}