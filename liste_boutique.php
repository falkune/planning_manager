<?php
  session_start();
  require_once('core/connexion.php');
  if(isset($_SESSION['admin'])){
    //on recupere tout les employés de la base
    $connexion = connexion();
    $request = $connexion->prepare("SELECT * FROM boutiques");
    $request->execute();

    $list_boutiques = $request->fetchAll(PDO::FETCH_ASSOC);
  }
  else{
    // on recupere tout les emplyes d'un departement particulier
    $connexion = connexion();
    $request = $connexion->prepare("SELECT * FROM boutiques WHERE id_departement = ?");
    $request->execute(array($_SESSION['id_departement']));

    $list_boutiques = $request->fetchAll(PDO::FETCH_ASSOC);
  }
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
    <table>
      <thead>
        <tr>
          <td>Nom Boutique</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($list_boutiques as $value){
            echo '<tr>';
              echo '<td>'.$value['nom_boutique'].'</td>';
              echo '<td> <a href="edit_shop.php?shop='.$value['id_boutique'].'" style="color:black; text-decoration: none;"><i class="fas fa-edit"></i> Modifier</a> <a href="delete_shop.php?shop='.$value['id_boutique'].'" style="color:black; text-decoration: none;"><i class="fas fa-trash-alt"></i> Suprimer</a></td>';
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
  <script>
    // correspond au boutton de deconnexion
    const deconnexion = $("#deconnexion")[0];
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
  </script>
</body>
</html>