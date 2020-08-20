<?php
  session_start();
  require_once('core/connexion.php');
  if(isset($_POST['valide'])){
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['pswd'] = $_POST['pswd'];
  }

  $connexion = connexion();
  // on verifi si le couple login pswd existe dans la table admin
  $request = $connexion->prepare("SELECT * FROM Admins WHERE login = ? AND password = ?");
  $request->execute(array($_SESSION['login'], $_SESSION['pswd']));
  $resultat = $request->fetch(PDO::FETCH_ASSOC);
  if($resultat !== false){
    // si le couple login pswd existe l'utilisateur est un admin
    $_SESSION['admin'] = $resultat['login'];
    $request = $connexion->prepare("SELECT * FROM departements");
    $request->execute();

    $departements = $request->fetchAll(PDO::FETCH_ASSOC);
  }
  else{
    // si le couple login pswd n'existe pas dans la table employes
    $request = $connexion->prepare("SELECT * FROM employes WHERE email_employe = ? AND pswd = ?");
    $request->execute(array( $_SESSION['login'], $_SESSION['pswd']));
    $resultat = $request->fetch(PDO::FETCH_ASSOC);
    
    if($resultat !== false){
      // s'il existe on cree la variable responsable qui nous permettra de savoir si c'est un responsable ou pas
      $_SESSION['responsable'] = $resultat['responsable'];
      $_SESSION['id_departement'] = $resultat['id_departement'];
      $_SESSION['employe'] = $resultat['id_employe'];
      $_SESSION['emp_nom'] = $resultat['premom_employe'].' '.$resultat['nom_employe'];
      $_SESSION['mdp'] = $resultat['pswd'];

      $requestAllUsers = $connexion->prepare("SELECT * FROM employes WHERE id_departement = ?");
      $requestAllUsers->execute(array( $_SESSION['id_departement']));
      $employes = $requestAllUsers->fetchAll(PDO::FETCH_ASSOC);

      $requestAllShops = $connexion->prepare("SELECT * FROM boutiques WHERE id_departement = ?");
      $requestAllShops->execute(array( $_SESSION['id_departement']));
      $shops = $requestAllShops->fetchAll(PDO::FETCH_ASSOC);
    }
  }


  if(isset($_SESSION['admin'])){
    include 'admin.php';
  }
  elseif(isset($_SESSION['responsable'])){
    if( $_SESSION['responsable'] == 0){
      // l'tilisateur est un emplye ordinaire
     include 'accueil_employe.php';
    }
    else{
      // l'utilisateur est un responsable
      echo '<input type="text" id="my_dep" value="'. $_SESSION['id_departement'].'"/>';
      include 'responsable.php';
    }
  }
  else{
    echo "login ou mot de passe incorect";
  }

?>


