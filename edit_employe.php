<?php
  session_start();
  require_once('core/connexion.php');

  $connexion = connexion();
  $emp = $_GET['emp'];

  $request = $connexion->prepare("SELECT * FROM employes WHERE id_employe = ?");
  $request->execute(array($emp));

  $employe = $request->fetch(PDO::FETCH_ASSOC);


  $request_dep = $connexion->prepare("SELECT * FROM departements");
  $request_dep->execute();

  $departements = $request_dep->fetchAll(PDO::FETCH_ASSOC);

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
    <?php
      echo '<form id="formulaire">
      <input type="text" id="id_emp" value="'.$employe["id_employe"].'" hidden>
        <div><label> Prenom : <br>
          <input type="text" id="prenom" value="'.$employe["premom_employe"].'">
        </label></div>
        <div><label> Nom :<br>
          <input type="text" id="nom" value="'.$employe["nom_employe"].'">
        </label></div>
        <div><label> Adresse :<br>
          <input type="text" id="adresse" value="'.$employe["adresse_employe"].'">
        </label></div>
        <div><label> Email :<br>
          <input type="email" id="Email" value="'.$employe["email_employe"].'">
        </label></div>
        <div><label> Telephone :<br>
          <input type="tel" id="telephone" value="'.$employe["tel_employe"].'">
        </label></div>
        <div><label> Mot de passe :<br>
          <input type="text" id="mot_de_pass" value="'.$employe["pswd"].'">
        </label></div><br>
        <div><select id="dep">';
          foreach($departements as $value){
            echo '<option value="'.$value['id_departement'].'">'.$value['nom_departement'].'</option>';
          }
          echo '</select>
            <input id="responsable" type="number" max="1" min="0" value="'.$employe["responsable"].'" style="width: 10%; height: 13px;"/>
          </div><br>
          <div>
            <input type="submit" value="Modifier" />
          </div>
          <div style="color:green;" id="error"></div>
      </form>';
    ?>
  </div>
  <script>
    // correspond au boutton de deconnexion
    const deconnexion = $("#deconnexion")[0];
    const update_emp = $("#formulaire")[0];

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

    update_emp.addEventListener('submit', function(e){
      e.preventDefault();
      let id_emp = $("#id_emp").val();
      let prenom = $("#prenom").val();
      let nom = $("#nom").val();
      let adresse = $("#adresse").val();
      let Email = $("#Email").val();
      let telephone = $("#telephone").val();
      let mot_de_pass = $("#mot_de_pass").val();
      let dep = $("#dep").val();
      let responsable = $("#responsable").val();
      $.ajax({
        method: 'get',
        url: 'http://planning_manager.com/updateEmp/'+id_emp+'/'+nom+'/'+prenom+'/'+adresse+'/'+Email+'/'+telephone+'/'+mot_de_pass+'/'+dep+'/'+responsable,
        dataType: 'json',
        success: function(data){
          if(data.status == 'ok'){
            $("#error")[0].innerHTML = '';
            let message = document.createTextNode("modifications enregistrées");
            $("#error")[0].appendChild(message);
          }
        }
      })
    });
  </script>
</body>
</html>