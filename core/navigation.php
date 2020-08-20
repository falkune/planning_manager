<?php
function nextWeekPlanning($url){
  // fonction premetant d'obtenir le planning de la semaine suivante a partir d'une date

  // date à partir de laquelle on doit partir
  $fromDate = getdate($url[1]);
  // on obtient un chaine de caractere du type jour moi année de cette date
  $fromDateString = dayMonthYearOfDate($fromDate);
  // on determine la semaine passer grace à la fonction getNextWeekDate
  $nextWeek = getNextWeekDate($fromDateString);
  // on obtient le tableau jour moi annee de la variable nextWeek
  $dayMontYear = dayMonthYearOfDate($nextWeek); 

  // on cree une chaine de caractere a partir du tableau $dayMontYear
  $dayMontYearString = $dayMontYear['day'].' '.$dayMontYear['month'].' '.$dayMontYear['year'];

  // on recupere tous les jours de la semaine dans un tableau grace à la fonction currentWeek
  $theWeek = currentWeek($dayMontYearString);

  // on recupere tous les employes de la base concerner
  $employes;
  
  if($url[2] === "Aucun"){
    $employes = getAllusers();
  }
  else{
    $employes = getAllUsersOfDepartement($url[2]);
  }

  // on cree le tableau qui va contenir les planning de tous les employees
  $planningOfAllemploye = array();

  // pour chaque employer on recupere son planning de la semaine
  foreach($employes as $employe){
    $idEmploye = $employe['id_employe'];
    $prenomEmploye = $employe['premom_employe'];
    $nomEmploye = $employe['nom_employe'];
    $keyvalue = $prenomEmploye.' '.$nomEmploye;
    $weekPlanning = getHisPlanning($idEmploye, $theWeek);
    array_push($planningOfAllemploye, array("nom_emp" => $keyvalue, "plan_emp" => $weekPlanning));
  }

  // on retourn le planning de la semaine de tout les employes 
  return $error = json_encode([
    'status' => 'ok',
    'datecourante' => $nextWeek,
    'message' => $planningOfAllemploye
  ]);

}


function lastWeekPlanning($url){
  // fonction premetant d'obtenir le planning de la semaine passée a partir d'une date

  // date à partir de laquelle on doit partir
  $fromDate = getdate($url[1]);
  // on obtient un chaine de caractere du type jour moi année de cette date
  $fromDateString = dayMonthYearOfDate($fromDate);
  // on determine la semaine passer grace à la fonction getLastWeekDate
  $lastWeek = getLastWeekDate($fromDateString);
  // on obtient le tableau jour moi annee de la variable lastWeek
  $dayMontYear = dayMonthYearOfDate($lastWeek); 

  // on cree une chaine de caractere a partir du tableau $dayMontYear
  $dayMontYearString = $dayMontYear['day'].' '.$dayMontYear['month'].' '.$dayMontYear['year'];

  // on recupere tous les jours de la semaine dans un tableau grace à la fonction currentWeek
  $theWeek = currentWeek($dayMontYearString);

  // on recupere tous les employes de la base concerner
  $employes;
  
  if($url[2] === "Aucun"){
    $employes = getAllusers();
  }
  else{
    $employes = getAllUsersOfDepartement($url[2]);
  }

  // on cree le tableau qui va contenir les planning de tous les employees
  $planningOfAllemploye = array();

  // pour chaque employer on recupere son planning de la semaine
  foreach($employes as $employe){
    $idEmploye = $employe['id_employe'];
    $prenomEmploye = $employe['premom_employe'];
    $nomEmploye = $employe['nom_employe'];
    $keyvalue = $prenomEmploye.' '.$nomEmploye;
    $weekPlanning = getHisPlanning($idEmploye, $theWeek);
    array_push($planningOfAllemploye, array("nom_emp" => $keyvalue, "plan_emp" => $weekPlanning));
  }

  // on retourn le planning de la semaine de tout les employes 
  return $error = json_encode([
    'status' => 'ok',
    'datecourante' => $lastWeek,
    'message' => $planningOfAllemploye
  ]);
}

function nextOneWeekPlanning($url){
  // fonction premet d'obtenir le planning de la semaine prochaine a partir d'une date pour l'employe ordinaire

  // date à partir de laquelle on doit partir
  $fromDate = getdate($url[2]);
  // on obtient un chaine de caractere du type jour moi année de cette date
  $fromDateString = dayMonthYearOfDate($fromDate);
  // on determine la semaine passer grace à la fonction getNextWeekDate
  $nextWeek = getNextWeekDate($fromDateString);
  // on obtient le tableau jour moi annee de la variable nextWeek
  $dayMontYear = dayMonthYearOfDate($nextWeek); 

  // on cree une chaine de caractere a partir du tableau $dayMontYear
  $dayMontYearString = $dayMontYear['day'].' '.$dayMontYear['month'].' '.$dayMontYear['year'];

  // on recupere tous les jours de la semaine dans un tableau grace à la fonction currentWeek
  $theWeek = currentWeek($dayMontYearString);

  return $error = json_encode([
    'status' => 'ok',
    'datecourante' => $nextWeek,
    'message' => getHisPlanning($url[1], $theWeek)
  ]);

}

function lastOneWeekPlanning($url){
  // fonction premetant d'obtenir le planning de la semaine passée a partir d'une date pour l'employe ordinaire

  // date à partir de laquelle on doit partir
  $fromDate = getdate($url[2]);
  // on obtient un chaine de caractere du type jour moi année de cette date
  $fromDateString = dayMonthYearOfDate($fromDate);
  // on determine la semaine passer grace à la fonction getLastWeekDate
  $lastWeek = getLastWeekDate($fromDateString);
  // on obtient le tableau jour moi annee de la variable lastWeek
  $dayMontYear = dayMonthYearOfDate($lastWeek);

  // on cree une chaine de caractere a partir du tableau $dayMontYear
  $dayMontYearString = $dayMontYear['day'].' '.$dayMontYear['month'].' '.$dayMontYear['year'];

  // on recupere tous les jours de la semaine dans un tableau grace à la fonction currentWeek
  $theWeek = currentWeek($dayMontYearString);

  return $error = json_encode([
    'status' => 'ok',
    'datecourante' => $lastWeek,
    'message' => getHisPlanning($url[1], $theWeek)
  ]);

}