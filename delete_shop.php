<?php
  session_start();
  require_once('core/connexion.php');
  $shop = $_GET['shop'];

  $connexion = connexion();

  $request = $connexion->prepare("SELECT * FROM boutiques WHERE id_boutique = ?");
  $request->execute(array($shop));
  $boutique = $request->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <div id="logo">
      <img src="img/logo.png" alt="le logo du site">
    </div>
    <div id="navigation">
      <ul>
        <li>
          <a href="index.php" style="color: #ffffff; text-decoration: none;">Accueil</a>
        </li>
        <li>
          <a href="liste_employe.php" style="color: #ffffff; text-decoration: none;">Liste employes</a>
        </li>
        <li>
          <a href="liste_boutique.php" style="color: #ffffff; text-decoration: none;">Liste boutiques</a>
        </li>
        <li id="deconnexion">
          <i class="fas fa-power-off"> Deconnexion</i>
        </li>
      </ul>
    </div>
  </header>
  <div id="container_body">
    <h2>Voullez vous suprimé l'employé?</h2>
    <form id="del">
      <input type="text" id="id_emp" value="<?php echo $boutique['id_boutique']; ?>" hidden>
      <label for=""><?php echo $boutique['nom_boutique']; ?></label> <br>
      <input type="submit" name="delete" value="Supprimer">
    </form>
  </div>
  <script>
    // correspond au boutton de deconnexion
    const deconnexion = $("#deconnexion")[0];
    const del = $("#del")[0];
    deconnexion.addEventListener('click', function(){
      $.ajax({
        method: 'get',
        url: 'http://planning_manager.com/deconnexion',
        dataType: 'json',
        success: function(data){
          if(data.status == 'ok'){
            document.location.href="http://planning_manager.com"; 
          }
        }
      })
    });

    del.addEventListener('submit', function(e){
      e.preventDefault();
      let id_emp = $("#id_emp").val();
      $.ajax({
        method: 'get',
        url: 'http://planning_manager.com/deleteShop/'+id_emp,
        dataType: 'json',
        success: function(data){
          if(data.status == 'ok'){
            location.href = "liste_boutique.php";
          }
        }
      })
    });
  </script>
</body>