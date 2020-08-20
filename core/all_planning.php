<?php
function getAllPlannings(){
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

    // on recupere tous les employes de la base
    $employes = getAllusers();

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
      'datecourante' => $monday,
      'message' => $planningOfAllemploye
    ]);
  }else{
    // si on est lundi
    $dayMontYear = dayMonthYearOfDate($today); 

    // on cree une chaine de caractere a partir du tableau $dayMontYear
    $dayMontYearString = $dayMontYear['day'].' '.$dayMontYear['month'].' '.$dayMontYear['year'];

    // on recupere tous les jours de la semaine dans un tableau grace à la fonction currentWeek
    $theWeek = currentWeek($dayMontYearString);

    // on recupere tous les employes de la base
    $employes = getAllusers();

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
      'datecourante' => $today,
      'message' => $planningOfAllemploye
    ]);
  }
  
}
