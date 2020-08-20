<?php
  session_start();
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
          <input id="user" type="text" value="<?php echo $_SESSION['employe']; ?>" hidden>
          <input id="user_name" type="text" value="<?php echo $_SESSION['emp_nom']; ?>" hidden>
        </li>
        <?php
        if($_SESSION['mdp'] == 'passer123'){
          echo '<li id="change_pswd">
            <i class="fas fa-edit"> Modifier Mot de Passe</i>
          </li>';
        }
        else{
          echo '<li id="change_pswd" hidden>
          <i class="fas fa-user">  '.$_SESSION['emp_nom'].'</i>
          </li>';
        }
        echo '<li id="username" >
          <i class="fas fa-user">  '.$_SESSION['emp_nom'].'</i>
          </li>';
        ?>
        <li id="deconnexion">
          <i class="fas fa-power-off"> Deconnexion</i>
        </li>
      </ul>
    </div>
  </header>

  <h1>Welcome</h1>

  <main>
    <section id="main_section">
      <div id="horaire">
        <div class="plage">HORAIRES</div>
        <div class="plage" id="sem"></div>
        <div class="plage">8H:00 - 8H:30</div>
        <div class="plage">8H:30 - 9H:00</div>
        <div class="plage">9H:00 - 9H:30</div>
        <div class="plage">9H:30 - 10H:00</div>
        <div class="plage">10H:00 - 10H:30</div>
        <div class="plage">10H:30 - 11H:00</div>
        <div class="plage">11H:00 - 11H:30</div>
        <div class="plage">11H:30 - 12H:00</div>
        <div class="plage">12H:00 - 12H:30</div>
        <div class="plage">12H:30 - 13H:00</div>
        <div class="plage">13H:00 - 13H:30</div>
        <div class="plage">13H:30 - 14H:00</div>
        <div class="plage">14H:00 - 14H:30</div>
        <div class="plage">14H:30 - 15H:00</div>
        <div class="plage">15H:00 - 15H:30</div>
        <div class="plage">15H:30 - 16H:00</div>
        <div class="plage">16H:00 - 16H:30</div>
        <div class="plage">16H:30 - 17H:00</div>
        <div class="plage">17H:00 - 17H:30</div>
        <div class="plage">17H:30 - 18H:00</div>
        <div class="plage">18H:00 - 18H:30</div>
        <div class="plage">18H:30 - 19H:00</div>
        <div class="plage">19H:00 - 19H:30</div>
        <div class="plage">19H:30 - 20:00</div>
        <div class="plage">20H:00 - 20H:30</div>
      </div>
      <div id="plannings_one">
        <!-- Emplacement des palnnings -->
      </div>

      <div id="change_password" style="visibility: hidden;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Changer de Mot de Passe</h3>
            </div>
            <div class="modal-body">
              <p>
                <form id="psw_form">
                  <div>
                    <input type="password" name="password" placeholder="Taper le mot de passe" id="pswrd" required/>
                  </div>
                  <br>
                  <div>
                    <input type="password" name="pasword_1" placeholder="Confirmer le mot de passe" id="rpswrd" required/>
                  </div>
                  <div id="vdp">
                    <input type="submit" class="submitdepname" value="enregistrer" required/>
                  </div>
                </form>
              </p>
            </div>
            <div class="modal-footer" style="margin-top: 70px;">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right;" id="close_psw_modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <div id="controle">
    <button id="precedent"><< Précèdent</button>
    <button id="suivant">Suivant >></button>
  </div>

  <script src="js/employe.js"></script>
</body>
</html>