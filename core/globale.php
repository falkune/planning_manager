<?php
function getLastWeekDate($currentDate){
  // fonction permettant d'obtenir la date du lundi de la semaine passer a partir d'une date
  $prevMon = strtotime("last week", strtotime($currentDate['day'].' '.$currentDate['month'].' '.$currentDate['year']));

  return getdate($prevMon);
}

function getNextWeekDate($currentDate){
  // fonction permettant d'obtenir la date du lundi de la semaine suivante a partir d'une date
  $nextMon = strtotime("next week", strtotime($currentDate['day'].' '.$currentDate['month'].' '.$currentDate['year']));

  return getdate($nextMon);
}

function getAllusers(){
  // fonction permettant de recuperer tout les employe
  $connexion = connexion();

  $request = $connexion->prepare("SELECT * FROM employes");
  $request->execute();

  $result = $request->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}

function getAllUsersOfDepartement($depId){
  // fonction permettant d'obtenir la liste des employe d'un departement
  $connexion = connexion();

  $request = $connexion->prepare("SELECT * FROM employes WHERE id_departement = ?");
  $request->execute(array($depId));

  $result = $request->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}

function currentWeek($currentDate){
  // fonction permettant de retourner tous les jour de la semaine courante
  // paramettre le jour le moi et l'annee du lundi de la semaine en chaine de caractere
  $monday = strtotime($currentDate);
  $tuesday = strtotime("next Tuesday", strtotime($currentDate));
  $wednesday = strtotime("next Wednesday", strtotime($currentDate));
  $thursday = strtotime("next Thursday", strtotime($currentDate));
  $friday = strtotime("next Friday", strtotime($currentDate));
  $saturday = strtotime("next Saturday", strtotime($currentDate));
  $sunday = strtotime("next Sunday", strtotime($currentDate));

  $week = [$monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday];

  return $week;
}

function dayMonthYearOfDate($dateTostring){
  // fonction permettant de me retourner le jour le moi et l'annee du paramettre date sous forme de tableau
  $jour = $dateTostring['mday']; //jour de la date courante
  $mois = $dateTostring['month']; //mois de la date courante
  $annee = $dateTostring['year']; //annee de la date courante

  $dateOfDay = ['day' => $jour, 'month' => $mois, 'year' => $annee];

  return $dateOfDay;
}

function getHisPlanning($employe, $week){
  // fonction retournant le planning de l'employe pour tous les jours de la semaines courante
  $weekPlanning = array();
  $connexion = connexion();

  for($i = 0; $i < 7; $i++){
    $dateCurent = getdate($week[$i]);
    $day = $dateCurent['mday'];
    $month = $dateCurent['mon'];
    $year = $dateCurent['year'];
  
    $jour = $year.'-'.$month.'-'.$day;
    $request = $connexion->prepare("SELECT plage1, plage2, plage3, plage4, plage5, plage6, plage7, plage8, plage9, plage10, plage11, plage12, plage13, plage14, plage15, plage16, plage17, plage18, plage19, plage20, plage21, plage22, plage23, plage24, plage25 FROM plannings WHERE date_planning = ? AND id_employe = ?");
    $request->execute(array($jour, $employe));
    $result = $request->fetch(PDO::FETCH_ASSOC);

    array_push($weekPlanning, $result);
  }

  return $weekPlanning;
}


function getUserPlanning($url){
  
  // fonction qui va pemettre d'avoir le planning de l'utilisateur
  $today = getdate(); //recuperation de la date au moment de la requette

  if($today['weekday'] !== "Monday"){
    // si aujourd'hui n'est pas lundi
    $monday = getdate(strtotime("last Monday"));

    // on recupere le jour le mois et l'année dans un tableau
    $dayMontYear = dayMonthYearOfDate($monday); 

    // on cree une chaine de caractere a partir du tableau $dayMontYear
    $dayMontYearString = $dayMontYear['day'].' '.$dayMontYear['month'].' '.$dayMontYear['year'];

    // on recupere tous les jours de la semaine dans un tableau grace à la fonction currentWeek
    $theWeek = currentWeek($dayMontYearString);

    return $error = json_encode([
      'status' => 'ok',
      'datecourante' => $monday,
      'message' => getHisPlanning($url[1], $theWeek)
    ]);
  }
  else{
    // si on est lundi
    $dayMontYear = dayMonthYearOfDate($today); 

    // on cree une chaine de caractere a partir du tableau $dayMontYear
    $dayMontYearString = $dayMontYear['day'].' '.$dayMontYear['month'].' '.$dayMontYear['year'];

    // on recupere tous les jours de la semaine dans un tableau grace à la fonction currentWeek
    $theWeek = currentWeek($dayMontYearString);


    return $error = json_encode([
      'status' => 'ok',
      'datecourante' => $today,
      'message' => getHisPlanning($url[1], $theWeek)
    ]);

  }

}

function changePassword($url){
  $connexion = connexion();

  $request = $connexion->prepare("UPDATE employes SET pswd = ? WHERE id_employe = ?");
  $request->execute(array($url[2], $url[1]));

  return $error = json_encode([
    'status' => 'ok',
    'message' => 'mot de pass modifier'
  ]);
}

function updateEmp($url){
  // fonction permettant de mettre à jour les données d'un employe
  $connexion = connexion();

  $request = $connexion->prepare("UPDATE employes SET  nom_employe = ?, premom_employe = ?, adresse_employe = ?, email_employe = ?, tel_employe = ?, pswd = ?, responsable = ?, id_departement = ? WHERE id_employe = ?");
  $request->execute(array($url[2], $url[3], $url[4], $url[5], $url[6], $url[7], $url[9], $url[8], $url[1]));

  return $error = json_encode([
    'status' => "ok",
    'message' => 'vos modifications sont bien enregistrées...'
  ]);
}

function deleteEmploye($url){
  // fonction permettant de suprimer un employe
  $connexion = connexion();
  $request = $connexion->prepare("DELETE FROM employes WHERE id_employe = ?");
  $request->execute(array($url[1]));

  return $error = json_encode([
    'status' => 'ok',
    'message' => 'employé suprimé...'
  ]);
}

function updateShop($url){
  // fonction permettant de modifier les données d'une boutique
  $connexion = connexion();

  $request = $connexion->prepare("UPDATE boutiques SET nom_boutique = ?, id_departement = ? WHERE id_boutique = ?");
  $request->execute(array($url[2], $url[3], $url[1]));

  return $error = json_encode([
    'status' => "ok",
    'message' => 'vos modifications sont bien enregistrées...'
  ]);
}

function deletePlanning($url){
  // fonction permettant de supprimer un
  $connexion = connexion();

  $request = $connexion->prepare("DELETE FROM plannings WHERE date_planning = ? AND id_employe = ?");
  $request->execute(array($url[1], $url[2]));

  return $error = json_encode([
    'status' => 'ok',
    'message' => 'planning supprimé...'
  ]);
}

function deleteShop($url){
  // fonction permettant de suprimer un employe
  $connexion = connexion();
  $request = $connexion->prepare("DELETE FROM boutiques WHERE id_boutique = ?");
  $request->execute(array($url[1]));

  return $error = json_encode([
    'status' => 'ok',
    'message' => 'boutique suprimé...'
  ]);
}

function nombreEmploye($url){
  if(count($url) != 3){
    return $error = json_encode([
      'status' => 'failed',
      'message' => "nombre d'argument incorect..."
    ]);
  }
  else{
    $connexion = connexion();
    $request = $connexion->prepare("SELECT COUNT(DISTINCT id_employe) FROM plannings WHERE  date_planning = ? AND shop = ?");
    $request->execute(array($url[1], $url[2]));

    $result = $request->fetch();

    return $error = json_encode([
      'status' => 'ok',
      'message' => $result[0].' employes dans la boutique'
    ]);
  }
}