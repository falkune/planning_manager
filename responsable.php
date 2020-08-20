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
            <a href="liste_employe.php" style="color: #ffffff; text-decoration: none;"><i class="fas fa-users"> Liste employes</i></a>
          </li>
          <li>
            <a href="liste_boutique.php" style="color: #ffffff; text-decoration: none;"><i class="fas fa-store-alt"> Liste boutiques</i></a>
          </li>
          <li id="valid_planning">
            <i class="fas fa-check"> Validation</i>
          </li>
          <li id="edit_planning">
            <i class="fas fa-edit">Supprimer un planning</i>
          </li>
          <li id="new_shop">
            <i class="fas fa-plus"> Boutique</i>
          </li>
          <li id="new_user">
            <i class="fas fa-plus"> Employe</i>
          </li>
          <li id="new_planning">
            <i class="fas fa-plus"> Planning</i>
          </li>
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
        <div id="plannings">
          <!-- Emplacement des palnnings -->
        </div>

        <!-- modal de creation d'une boutique -->
        <div class="modal" id="shop_modal" style="visibility: hidden;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Nouvelle Boutique</h3>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right; color: red; font-size: large;" id="close_shop_modal"><i class="fas fa-times"></i></button>
              </div>
              <br>
              <div class="modal-body">
                <p>
                  <form id="shop_form">
                    <div>
                      <input type="text" name="name" placeholder="taper le nom de la boutique" id="shop_name" required/>
                    </div>
                    <div id="vdp">
                      <input type="submit" class="submitdepname" value="enregistrer" required/>
                    </div>
                  </form>
                </p>
              </div>
              <div id="shop_ok_error"> <!--  --> </div>
              <div id="shop_failed_error"> <!--  --> </div>
            </div>
          </div>
        </div>
        
        <!-- modal d'enregistrement d'un nouvel employe -->
        <div class="modal" id="user_modal" style="visibility: hidden;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Nouvel Employe</h3>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right; color: red; font-size: large;" id="close_user_modal"><i class="fas fa-times"></i></button>
              </div>
              <div class="modal-body">
                <p>
                  <form id="user_form">
                    <div>
                      <input type="text" id="user_name" placeholder="nom de l'employe" class="user_input" required/>
                    </div>
                    <div>
                      <input type="text" id="user_prenom" placeholder="prenom de l'employe" class="user_input" required/>
                    </div>
                    <div>
                      <input type="text" id="user_address" placeholder="adresse de l'employe" class="user_input" required/>
                    </div>
                    <div>
                      <input type="email" id="user_email" placeholder="ustilisateur@mail.truc" class="user_input" required/>
                    </div>
                    <div>
                      <input type="tel" name="user_tel" placeholder="telephone" id="tel" required/>
                    </div>
                    <div id="user_ok_error"> <!--  --> </div>
                    <div id="user_failed_error"> <!--  --> </div>
                    <div id="vdp">
                      <input type="submit" class="submitdepname" value="enregistrer" required/>
                    </div>
                  </form>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- modal d'nregistrement d'un nouveau planning -->
        <div class="modal" id="planning_modal" style="visibility: hidden; height: 450px">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Nouveau Planning</h3>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right; color: red; font-size: large;" id="close_planning_modal"><i class="fas fa-times"></i></button>
              </div>
              <div class="modal-body">
                <p>
                  <form id="planning_form" method="get">
                    <div>
                      <input type="date" id="date_planning" require>
                    </div>
                    <div id="user_select">
                      <select id="plan_user_id" class="planning_select">
                        <?php
                          foreach($employes as $value){
                            echo '<option value="'.$value['id_employe'].'">'.$value['premom_employe'].' '.$value['nom_employe'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div id="user_select">
                      <select id="plan_shop_id" class="planning_select">
                        <?php
                          foreach($shops as $value){
                            echo '<option value="'.$value['id_boutique'].':'.$value['nom_boutique'].'">'.$value['nom_boutique'].' '.$value['nom_employe'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div>
                      <select id="heure_debut" class="planning_select">
                        <option value="aucune">heure debut</option>
                        <option value="1">8H:00</option>
                        <option value="2">8H:30</option>
                        <option value="3">9H:00</option>
                        <option value="4">9H:30</option>
                        <option value="5">10H:00</option>
                        <option value="6">10H:30</option>
                        <option value="7">11H:00</option>
                        <option value="8">11H:30</option>
                        <option value="9">12H:00</option>
                        <option value="10">12H:30</option>
                        <option value="11">13H:00</option>
                        <option value="12">13H:30</option>
                        <option value="13">14H:00</option>
                        <option value="14">14H:30</option>
                        <option value="15">15H:00</option>
                        <option value="16">15H:30</option>
                        <option value="17">16H:00</option>
                        <option value="18">16H:30</option>
                        <option value="19">17H:00</option>
                        <option value="20">17H:30</option>
                        <option value="21">18H:00</option>
                        <option value="22">18H:30</option>
                        <option value="23">19H:00</option>
                        <option value="24">19H:30</option>
                        <option value="25">20H:00</option>
                        <option value="26">20H:30</option>
                      </select>
                      <select id="heure_fin" class="planning_select">
                        <option value="aucune">heure fin</option>
                        <option value="2">8H:30</option>
                        <option value="3">9H:00</option>
                        <option value="4">9H:30</option>
                        <option value="5">10H:00</option>
                        <option value="6">10H:30</option>
                        <option value="7">11H:00</option>
                        <option value="8">11H:30</option>
                        <option value="9">12H:00</option>
                        <option value="10">12H:30</option>
                        <option value="11">13H:00</option>
                        <option value="12">13H:30</option>
                        <option value="13">14H:00</option>
                        <option value="14">14H:30</option>
                        <option value="15">15H:00</option>
                        <option value="16">15H:30</option>
                        <option value="17">16H:00</option>
                        <option value="18">16H:30</option>
                        <option value="19">17H:00</option>
                        <option value="20">17H:30</option>
                        <option value="21">18H:00</option>
                        <option value="22">18H:30</option>
                        <option value="23">19H:00</option>
                        <option value="24">19H:30</option>
                        <option value="25">20H:00</option>
                        <option value="26">20H:30</option>
                      </select>
                    </div>
                    <div id="plan_ok_error"> <!--  --> </div>
                    <div id="plan_failed_error"> <!--  --> </div>
                    <div id="vdp">
                      <input type="submit" class="submitdepname" value="enregistrer"/>
                    </div>
                  </form>
                </p>
              </div>
              <div class="modal-footer" style="margin-top: 70px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="nb_emp">Voir le nombre d'employe dans la boutique</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal de suppression d'un planning -->
        <div class="modal" id="edit_planning_modal" style="visibility: hidden;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Suprimmer le planning</h3>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right; color: red; font-size: large;" id="close_editP_modal"><i class="fas fa-times"></i></button>
              </div>
              <div class="modal-body">
                <p>
                  <form id="edit_planning_form">
                    <div>
                      <input type="date" id="edit_date_planning" require>
                    </div>
                    <div id="edit_user_select">
                      <select id="planning_id_user_edit" class="planning_select">
                        <option value="aucun">choix employé</option>
                        <?php
                          foreach($employes as $value){
                            echo '<option value="'.$value['id_employe'].'">'.$value['premom_employe'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div id="vdp">
                      <input type="submit" class="submitdepname" value="enregistrer" required/>
                    </div>
                  </form>
                </p>
              </div>
            </div>
          </div>
        </div>


        <!-- modal de validation des plannings -->
        <div class="modal" id="valid_planning_modal" style="visibility: hidden; height: 450px">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Valider Planning</h3>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right; color: red; font-size: large;" id="valid_close_planning_modal"><i class="fas fa-times"></i></button>
              </div>
              <div class="modal-body">
                <p>
                  <form id="valid_planning_form" method="get">
                    <div>
                      <input type="date" id="valid_date_planning" require>
                    </div>
                    <div id="user_select">
                      <select id="valid_plan_user_id" class="planning_select">
                        <?php
                          foreach($employes as $value){
                            echo '<option value="'.$value['id_employe'].'">'.$value['premom_employe'].' '.$value['nom_employe'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div>
                      <select id="valid_heure_debut" class="planning_select">
                        <option value="aucune">heure debut</option>
                        <option value="1">8H:00</option>
                        <option value="2">8H:30</option>
                        <option value="3">9H:00</option>
                        <option value="4">9H:30</option>
                        <option value="5">10H:00</option>
                        <option value="6">10H:30</option>
                        <option value="7">11H:00</option>
                        <option value="8">11H:30</option>
                        <option value="9">12H:00</option>
                        <option value="10">12H:30</option>
                        <option value="11">13H:00</option>
                        <option value="12">13H:30</option>
                        <option value="13">14H:00</option>
                        <option value="14">14H:30</option>
                        <option value="15">15H:00</option>
                        <option value="16">15H:30</option>
                        <option value="17">16H:00</option>
                        <option value="18">16H:30</option>
                        <option value="19">17H:00</option>
                        <option value="20">17H:30</option>
                        <option value="21">18H:00</option>
                        <option value="22">18H:30</option>
                        <option value="23">19H:00</option>
                        <option value="24">19H:30</option>
                        <option value="25">20H:00</option>
                        <option value="26">20H:30</option>
                      </select>
                      <select id="valid_heure_fin" class="planning_select">
                        <option value="aucune">heure fin</option>
                        <option value="2">8H:30</option>
                        <option value="3">9H:00</option>
                        <option value="4">9H:30</option>
                        <option value="5">10H:00</option>
                        <option value="6">10H:30</option>
                        <option value="7">11H:00</option>
                        <option value="8">11H:30</option>
                        <option value="9">12H:00</option>
                        <option value="10">12H:30</option>
                        <option value="11">13H:00</option>
                        <option value="12">13H:30</option>
                        <option value="13">14H:00</option>
                        <option value="14">14H:30</option>
                        <option value="15">15H:00</option>
                        <option value="16">15H:30</option>
                        <option value="17">16H:00</option>
                        <option value="18">16H:30</option>
                        <option value="19">17H:00</option>
                        <option value="20">17H:30</option>
                        <option value="21">18H:00</option>
                        <option value="22">18H:30</option>
                        <option value="23">19H:00</option>
                        <option value="24">19H:30</option>
                        <option value="25">20H:00</option>
                        <option value="26">20H:30</option>
                      </select>
                    </div>
                    <div id="valid_plan_ok_error"> <!--  --> </div>
                    <div id="valid_plan_failed_error"> <!--  --> </div>
                    <div id="vdp">
                      <input type="submit" class="submitdepname" value="enregistrer"/>
                    </div>
                  </form>
                </p>
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

    <!-- inclusion du javascript -->
    <script src="js/responsable.js"></script>
  </body>
</html>