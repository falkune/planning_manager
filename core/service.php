<?php
require_once ('fonction.php');

// parse de l'url transformer en tableau pour determiner l'action que l'utilisateur souhaite realiser
$url = explode('/', $_GET['url']);
$service = $url[0];

// en fonction de l'url on execute une action
switch($service){
  case "loadAllPlanning":
    echo getAllPlannings();
    break;
  case "loadPlanning":
    echo getPlannings($url);
    break;
	case "newDepartement":
		echo saveDepartement($url);
    break;
  case "newShop":
    echo saveShop($url);
    break;
  case "newUser":
    echo saveUser($url);
    break;
  case "getDepartement":
    echo userShop($url);
    break;
  case "newPlanning":
    echo createPlanning($url);
    break;
  case "next":
    echo nextWeekPlanning($url);
    break;
  case "last":
    echo lastWeekPlanning($url);
    break;
  case "userPlanning":
    echo getUserPlanning($url);
    break;
  case "nextOne":
    echo nextOneWeekPlanning($url);
    break;
  case "lastOne":
    echo lastOneWeekPlanning($url);
    break;
  case "changepassword":
    echo changePassword($url);
    break;
  case "updateEmp":
    echo updateEmp($url);
    break;
  case "deleteEmp":
    echo deleteEmploye($url);
    break;
  case "updateShop":
    echo updateShop($url);
    break;
  case "deleteShop":
    echo deleteShop($url);
    break;
  case "deletePlanning":
    echo deletePlanning($url);
    break;
  case "validatePlanning":
    echo validatePlanning($url);
    break;
  case "nombreEmploye":
    echo nombreEmploye($url);
    break;
  case "deconnexion":
    echo getOut();
    break;
	default:
		echo $error = json_encode([
      'status'  => 'failed',
      'message' => '404 not foud!'
    ]);
		break;
}
