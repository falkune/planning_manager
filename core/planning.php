<?php
function createPlanning($url){
  // verification du nombre de paramettres
  if(count($url) != 6){
    return $error = json_encode([
      'status' => 'failed',
      'message' => "nombre d'argument incorect..."
    ]);
  }
  else{
    // verification de la range
    $range = planning_range($url[2], $url[3]);

    return setPlanning($url[1],$range,$url[4],$url[5]);

  }
}

// cette fonction verifie si le l'heure de debut de l'heure de fin du planning est corect
function planning_range($deb, $fin){
  if($deb == "1" && $fin == "2")
    $error = "plage1";
  elseif($deb == "2" && $fin == "3")
    $error = "plage2";
  elseif($deb == "3" && $fin == "4")
    $error = "plage3";
  elseif($deb == "4" && $fin == "5")
    $error = "plage4";
  elseif($deb == "5" && $fin == "6")
    $error = "plage5";
  elseif($deb == "6" && $fin == "7")
    $error = "plage6";
  elseif($deb == "7" && $fin == "8")
    $error = "plage7";
  elseif($deb == "8" && $fin == "9")
    $error = "plage8";
  elseif($deb == "9" && $fin == "10")
    $error = "plage9";
  elseif($deb == "10" && $fin == "11")
    $error = "plage10";
  elseif($deb == "11" && $fin == "12")
    $error = "plage11";
  elseif($deb == "12" && $fin == "13")
    $error = "plage12";
  elseif($deb == "13" && $fin == "14")
    $error = "plage13";
  elseif($deb == "14" && $fin == "15")
    $error = "plage14";
  elseif($deb == "15" && $fin == "16")
    $error = "plage15";
  elseif($deb == "16" && $fin == "17")
    $error = "plage16";
  elseif($deb == "17" && $fin == "18")
    $error = "plage17";
  elseif($deb == "18" && $fin == "19")
    $error = "plage18";
  elseif($deb == "19" && $fin == "20")
    $error = "plage19";
  elseif($deb == "20" && $fin == "21")
    $error = "plage20";
  elseif($deb == "21" && $fin == "22")
    $error = "plage21";
  elseif($deb == "22" && $fin == "23")
    $error = "plage22";
  elseif($deb == "23" && $fin == "24")
    $error = "plage23";
  elseif($deb == "24" && $fin == "25")
    $error = "plage24";
  elseif($deb == "25" && $fin == "26")
    $error = "plage25";
  else{
    $deb = intval($deb);
    $fin = intval($fin);

    $plages = array();

    for($i = $deb; $i < $fin; $i++){
      $plage = "plage".$i;
      array_push($plages, $plage);
    }
    $error = $plages;
  }
    
  return $error;
}

// cette fonction permet de creer le planning d'un employe
function setPlanning($jour, $range, $employe, $boutique){
  $infoshop = explode(':', $boutique);
  $shop_id = $infoshop[0];
  $shop_name = $infoshop[1];
  // si la plage est un tableau
  if(is_array($range)){
    // initialisation de la connexion à la base de données
    $connexion = connexion();

    // verifier si l'employé est totalement diponible à cette date
    $request = $connexion->prepare("SELECT * FROM plannings WHERE date_planning = ? AND id_employe = ?");
    $request->execute(array($jour, $employe));
    $available = $request->fetch();

    if($available == false){
      foreach($range as $value){
        // prmière iterationpas de probleme par contre les autres iteration il n'est plus dispo toute la journé
        // donc Update avec les plages restantes
        $request = $connexion->prepare("SELECT * FROM plannings WHERE date_planning = ? AND id_employe = ?");
        $request->execute(array($jour, $employe));
        $available = $request->fetch();
        if($available == false){
          $request = $connexion->prepare("INSERT INTO plannings (date_planning,shop,$value,id_employe) VALUES (?, ?, ?, ?)");
          $request->execute(array($jour, $shop_id, $shop_name, $employe));
        }
        else{
          $request = $connexion->prepare("UPDATE plannings  SET $value = ? WHERE date_planning = ? AND id_employe = ?");
          $request->execute(array($shop_name, $jour, $employe));
        }
        
      }
      return $error = json_encode([
        'status' => "ok",
        'message' => "plannings ajoutés"
      ]);
    }
    else{
      // dans le cas ou l'employe n'est pas dispo toute la journée on doit verifier ses disponiblité pour chaque plage
      $dispo;
      foreach($range as $value){
        $request = $connexion->prepare("SELECT * FROM plannings WHERE date_planning = ? AND $value != 'disponible' AND id_employe = ?");
        $request->execute(array($jour, $employe));
        $available = $request->fetch();
        if($available !== false){
          $dispo = false;
          break;  
        }
        $dispo = true;
      }
      if($dispo == true){
        foreach($range as $value){
          $request = $connexion->prepare("SELECT * FROM plannings WHERE date_planning = ? AND id_employe = ?");
          $request->execute(array($jour, $employe));
          $available = $request->fetch();
          if($available == false){
            $request = $connexion->prepare("INSERT INTO plannings (date_planning,$value,id_employe) VALUES (?, ?, ?)");
            $request->execute(array($jour, $shop_name, $employe));
          }
          else{
            $request = $connexion->prepare("UPDATE plannings  SET $value = ? WHERE date_planning = ? AND id_employe = ?");
            $request->execute(array($shop_name, $jour, $employe));
          }
          
        }
        return $error = json_encode([
          'status' => "ok",
          'message' => "plannings ajoutés"
        ]);
      }
      else{
        return $error = json_encode([
          'status' => "failed",
          'message' => "veuillez revoir vos plages..."
        ]);
      }
    }
  }
  // si la plage n'est pas un tableau
  else{
    // initialisation de la connexion à la base de données
    $connexion = connexion();

    // verifier si l'employé est totalement diponible à cette date
    $request = $connexion->prepare("SELECT * FROM plannings WHERE date_planning = ? AND id_employe = ?");
    $request->execute(array($jour, $employe));
    $available = $request->fetch();

    // si il est totalement disponible pour cette date, on insere le planning pour la plage specifier
    if($available == false){
      $request = $connexion->prepare("INSERT INTO plannings (date_planning,shop,$range,id_employe) VALUES (?, ?, ?, ?)");
      $request->execute(array($jour,$shop_id, $shop_name, $employe));

      return $error = json_encode([
        'status' => "ok",
        'message' => "planning ajouté...!"
      ]);
    }
    else{
      // s'il n'est pas totalement dispo pour cette date on verifie si il l'est pour les horaires specifiés
      $request = $connexion->prepare("SELECT * FROM plannings WHERE date_planning = ? AND $range = 'disponible' AND id_employe = ?");
      $request->execute(array($jour, $employe));
      $available = $request->fetch();

      // si disponible pour ces horaires on creer le planning
      if($available !== false){
        $request = $connexion->prepare("UPDATE plannings  SET $range = ? WHERE date_planning = ? AND id_employe = ?");
        $request->execute(array($shop_name, $jour, $employe));

        return $error = json_encode([
          'status' => "ok",
          'message' => "planning ajouté...!"
        ]);
      }
      else{
        return $error = json_encode([
          'status' => "failed",
          'message' => "pas disponible pour ces horaires...!"
        ]);
      }
    }
  }
}

function validatePlanning($url){
  // fonction permettant de valider les plannings
  // verification du nombre de paramettres
  if(count($url) != 5){
    return $error = json_encode([
      'status' => 'failed',
      'message' => "nombre d'argument incorect..."
    ]);
  }
  else{
    // verification de la range il ne doit pas depasser 30 minutes
    $range = planning_range($url[2], $url[3]);

    return validPlanning($url[1],$range,$url[4]);
   
  }
}

function validPlanning($jour, $range, $employe){
  // initialisation de la connexion à la base de données
  if(is_array($range)){
    $connexion = connexion();

    // verifier si l'employé a été plannifier pour cette date
    $request = $connexion->prepare("SELECT * FROM plannings WHERE date_planning = ? AND id_employe = ?");
    $request->execute(array($jour, $employe));
    $available = $request->fetch();

    if($available == false){
      // ça signifi qu'il n'a pas été plannifier
      return $error = json_encode([
        'status' => 'failled',
        'message' => "l'employé n'a pa été plannifier pour cette date"
      ]);
    }
    else{
      foreach($range as $value){
        $hop = $available[$value];
        $request = $connexion->prepare("UPDATE plannings  SET $value = ? WHERE date_planning = ? AND id_employe = ?");
        $request->execute(array("✔️ ".$hop, $jour, $employe));
      }
      return $error = json_encode([
        'status' => "ok",
        'message' => "planning valider..."
      ]);
    }
  }
  else{
    $connexion = connexion();

    // verifier si l'employé a été plannifier pour cette date
    $request = $connexion->prepare("SELECT * FROM plannings WHERE date_planning = ? AND id_employe = ?");
    $request->execute(array($jour, $employe));
    $available = $request->fetch();

    if($available == false){
      // ça signifi qu'il n'a pas été plannifier
      return $error = json_encode([
        'status' => 'failled',
        'message' => "l'employé n'a pa été plannifier pour cette date"
      ]);
    }
    else{
      $shop = $available[$range];
      $request = $connexion->prepare("UPDATE plannings  SET $range = ? WHERE date_planning = ? AND id_employe = ?");
      $request->execute(array("✔️ ".$shop, $jour, $employe));

      return $error = json_encode([
        'status' => "ok",
        'message' => "planning valider..."
      ]);
    }
  }
}