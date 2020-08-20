$(function(){
  const weekdays = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
  let current_date;
  
  defaultLoad();
  
  function defaultLoad(){
    // fonction qui s'execute au chargement de la page 
    $.ajax({
      method: 'get',
      url: 'http://planning_manager.com/loadAllPlanning',
      dataType: 'json',
      success: function(data){
        $("#sem")[0].innerHTML = '';
        let seamine = document.createTextNode(data.datecourante.mday+'/'+data.datecourante.mon+'/'+data.datecourante.year);
        $("#sem")[0].appendChild(seamine);
        showplannings(data.datecourante, data.message);
      }
    })
  }

  // gestion du formulaire de creation d'un nouveau departement
  const new_departement = $("#new_dep")[0];
  const save_departement = $("#dep_form")[0];
  const close_dep_modal = $("#close_dep_modal")[0];

  // gestion du formulaire de cration d'une nouvelle boutique
  const new_shop = $("#new_shop")[0];
  const save_shop = $("#shop_form")[0];
  const close_shop_modal = $("#close_shop_modal")[0];

  // gestion de formulaire de creation d'un nouvel employe
  const new_employee = $("#new_user")[0];
  const save_user = $("#user_form")[0];
  const close_user_modal = $("#close_user_modal")[0];

  // gestion du formulaire de creation d'un nouveau planning
  const new_planning = $("#new_planning")[0];
  const save_planning = $("#planning_form")[0];
  const close_planning_modal = $("#close_planning_modal")[0];
  const nb_emp = $("#nb_emp")[0];

  // gestion du formulaire de suppression d'un planning
  const edit_planning = $("#edit_planning")[0];
  const edit_planning_form = $("#edit_planning_form")[0];
  const close_editP_modal = $("#close_editP_modal")[0];

  // correspond a la liste des departements dans le formulaire de creation d'un nouveau planning
  const planning_dep_id = $("#planning_dep_id")[0];
  // correspond a la liste des departements dans le formulaire de suppression d'un nouveau planning
  const planning_edit_id = $("#planning_edit_id")[0];

  // correspond a la liste des departements dans le header
  const select_depatement = $("#departement_list")[0];

  // correspond au boutton de deconnexion
  const deconnexion = $("#deconnexion")[0];

  // le bouton precedent
  const prec = $("#precedent")[0];

  // le bouton suivant 
  const suiv = $("#suivant")[0];

  new_departement.addEventListener('click', function(){
    // function pour afficher le formulaire d'ajout d'un nouveau departement
    $("#user_modal")[0].style.visibility = "hidden";
    $("#shop_modal")[0].style.visibility = "hidden";
    $("#planning_modal")[0].style.visibility = "hidden";
    $("#edit_planning_modal")[0].style.visibility = "hidden";
    $("#dep_modal")[0].style.visibility = "visible";
  })

  save_departement.addEventListener('submit', function(e){
    // function pour enregistrer un nouveau departement

    e.preventDefault();

    let depname = $('#depname').val();

    $.ajax({
      method: 'GET',
      url: 'http://planning_manager.com/newDepartement/' + depname,
      dataType: 'json',
      success: function(data){
        if(data.status === "ok"){
          $("#dep_ok_error")[0].innerHTML = '';
          $("#dep_failed_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#dep_ok_error")[0].appendChild(message);
        }
        else{
          $("#dep_failed_error")[0].innerHTML = '';
          $("#dep_ok_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#dep_failed_error")[0].appendChild(message);
        }
      }
    });
  })

  close_dep_modal.addEventListener('click', function(){
    // function pour fermer le formulaire de creation d'un nouveau departement
    $("#dep_modal")[0].style.visibility = "hidden";
  })

  new_shop.addEventListener('click', function(){
    // function affiche et cache le modale pour nouvelle boutique
    $("#dep_modal")[0].style.visibility = "hidden";
    $("#user_modal")[0].style.visibility = "hidden";
    $("#planning_modal")[0].style.visibility = "hidden";
    $("#edit_planning_modal")[0].style.visibility = "hidden";
    $("#shop_modal")[0].style.visibility = "visible";
  })

  save_shop.addEventListener('submit', function(e){
    // function pour enregistrer une nouvelle boutique en base de donnée
    e.preventDefault();

    let shopname = $('#shop_name').val();
    let shopdep = $("#dep_shop").val();

    $.ajax({
      method: 'GET',
      url: 'http://planning_manager.com/newShop/' + shopname +'/'+shopdep,
      dataType: 'json',
      success: function(data){
        if(data.status === "ok"){
          $("#shop_ok_error")[0].innerHTML = '';
          $("#shop_failed_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#shop_ok_error")[0].appendChild(message);
        }
        else{
          $("#shop_failed_error")[0].innerHTML = '';
          $("#shop_ok_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#shop_failed_error")[0].appendChild(message);
        }
      }
    });
  })

  close_shop_modal.addEventListener('click', function(){
    $("#shop_modal")[0].style.visibility = "hidden";
  })

  new_employee.addEventListener('click', function(){
    // funtion pour afficher modal user
    $("#shop_modal")[0].style.visibility = "hidden";
    $("#dep_modal")[0].style.visibility = "hidden";
    $("#planning_modal")[0].style.visibility = "hidden";
    $("#edit_planning_modal")[0].style.visibility = "hidden";
    $("#user_modal")[0].style.visibility = "visible";
  })

  save_user.addEventListener('submit', function(e){
    // function to save new employee
    e.preventDefault();

    let nom = $("#user_name").val();
    let prenom = $("#user_prenom").val();
    let adresse = $("#user_address").val();
    let email = $("#user_email").val();
    let tel = $("#tel").val();
    let userdep = $("#user_dep").val();

    $.ajax({
      method: 'GET',
      url: 'http://planning_manager.com/newUser/'+ nom +'/'+prenom+'/'+adresse+'/'+email+'/'+tel+'/'+userdep,
      dataType: 'json',
      success: function(data){
        if(data.status === "ok"){
          $("#user_ok_error")[0].innerHTML = '';
          $("#user_failed_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#user_ok_error")[0].appendChild(message);
        }
        else{
          $("#user_failed_error")[0].innerHTML = '';
          $("#user_ok_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#user_failed_error")[0].appendChild(message);
        }
      }
    });
  })

  close_user_modal.addEventListener('click', function(){
    // function pour fermer le modal enmploye
    $("#user_modal")[0].style.visibility = "hidden";
  })

  new_planning.addEventListener('click', function(){
    // fucntion pour afficher le modale de palnnification
    $("#dep_modal")[0].style.visibility = "hidden";
    $("#shop_modal")[0].style.visibility = "hidden";
    $("#user_modal")[0].style.visibility = "hidden";
    $("#edit_planning_modal")[0].style.visibility = "hidden";
    $("#planning_modal")[0].style.visibility = "visible";
  })
 
  planning_dep_id.addEventListener('change', function(){
    // s'execute a chaque fois qu'on selectionne un nouveau departement dans le modal de creation d'un palnning

    $("#user_select")[0].innerHTML = '';
    $("#shop_select")[0].innerHTML = '';

    const dep_id = $("#planning_dep_id").val();

    $.ajax({
      method: "GET",
      url: "http://planning_manager.com/getDepartement/"+dep_id,
      dataType: 'json',
      success: function(data){
        var listUser = document.createElement("select");
        var listShop = document.createElement("select");

        listUser.className = "planning_select";
        listShop.className = "planning_select";

        listUser.id = "planning_id_user";
        listShop.id = "planning_id_shop";
        
        data.users.map(e => {
          var option = document.createElement("option");
          option.value = e.id_employe;
          option.textContent = e.premom_employe+' '+e.nom_employe;
          listUser.appendChild(option);
        })

        data.shops.map(e =>{
          var option = document.createElement("option");
          option.value = e.id_boutique+':'+e.nom_boutique;
          option.textContent = e.nom_boutique;
          listShop.appendChild(option);
        })
        
        $("#user_select")[0].appendChild(listUser);
        $("#shop_select")[0].appendChild(listShop);
      }
    })
  })

  planning_edit_id.addEventListener('change', function(){
    // s'execute a chaque fois qu'on selectionne un nouveau departement dans le modal de supression de planning
    $("#edit_user_select")[0].innerHTML = '';

    const dep_id = $("#planning_edit_id").val();

    $.ajax({
      method: "GET",
      url: "http://planning_manager.com/getDepartement/"+dep_id,
      dataType: 'json',
      success: function(data){
        var listUser = document.createElement("select");

        listUser.className = "planning_select";

        listUser.id = "planning_id_user_edit";
        
        data.users.map(e => {
          var option = document.createElement("option");
          option.value = e.id_employe;
          option.textContent = e.premom_employe+' '+e.nom_employe;
          listUser.appendChild(option);
        })
        
        $("#edit_user_select")[0].appendChild(listUser);
      }
    })
  })
  
  save_planning.addEventListener('submit', function(e){
    // function pour enregistrer un nouveau planning
    e.preventDefault();

    let employe = $("#planning_id_user").val();
    let shop = $("#planning_id_shop").val();
    let date_plan = $("#date_planning").val();
    let heure_deb = $("#heure_debut").val();
    let heure_fin = $("#heure_fin").val();

    $.ajax({
      method: 'GET',
      url:'http://planning_manager.com/newPlanning/'+date_plan+'/'+heure_deb+'/'+heure_fin+'/'+employe+'/'+shop,
      dataType: 'json',
      success: function(data){
        if(data.status === "ok"){
          $("#plan_ok_error")[0].innerHTML = '';
          $("#plan_failed_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#plan_ok_error")[0].appendChild(message);
          defaultLoad();
        }
        else{
          $("#plan_failed_error").innerHTML = '';
          $("#plan_ok_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#plan_failed_error")[0].appendChild(message);
        }
      }
    })
  })

  nb_emp.addEventListener('click', function(){
    let shop = $("#planning_id_shop").val();
    let date_plan = $("#date_planning").val();

    $.ajax({
      method: 'GET',
      url: 'http://planning_manager.com/nombreEmploye/'+date_plan+'/'+shop,
      dataType: 'json',
      success: function(data){
        if(data.status == 'ok'){
          $("#plan_ok_error")[0].innerHTML = '';
          $("#plan_failed_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#plan_ok_error")[0].appendChild(message);
        }
        else{
          $("#plan_failed_error").innerHTML = '';
          $("#plan_ok_error")[0].innerHTML = '';
          let message = document.createTextNode(data.message);
          $("#plan_failed_error")[0].appendChild(message);
        }
      }
    })
  })
 
  close_planning_modal.addEventListener('click', function(){
    // function pour fermer le modal de ceration de planning
    $("#planning_modal")[0].style.visibility = "hidden";
  })

  select_depatement.addEventListener('change', function(){
    // fonction qui va permettre de remplir la section planning en fonction du departement selectionner
    let choosedepartement = $("#departement_list").val();
    $.ajax({
      method: 'GET',
      url:'http://planning_manager.com/loadPlanning/'+choosedepartement,
      dataType: 'json',
      success: function(data){
        showplannings(data.datecourante, data.message);
      }
    })
  })
  

  edit_planning.addEventListener('click', function(){
    // fonction qui affiche le modal de supression d'un planning
    $("#dep_modal")[0].style.visibility = "hidden";
    $("#shop_modal")[0].style.visibility = "hidden";
    $("#user_modal")[0].style.visibility = "hidden";
    $("#planning_modal")[0].style.visibility = "hidden";
    $("#edit_planning_modal")[0].style.visibility = "visible";
  })

  edit_planning_form.addEventListener('submit', function(e){
    // fonction permettant de supprimé un planning
    e.preventDefault();

    let jour = $("#edit_date_planning").val();
    let emp = $("#planning_id_user_edit").val();

    $.ajax({
      method: 'GET',
      url: 'http://planning_manager.com/deletePlanning/'+jour+'/'+emp,
      dataType: 'json',
      success: function(data){
        if(data.status == "ok"){
          alert(data.message);
          defaultLoad();
        }
      }
    })
  })


  close_editP_modal.addEventListener('click', function(){
    $("#edit_planning_modal")[0].style.visibility = "hidden";
  })

  prec.addEventListener('click', function(){
    // fonction qui va permettre d'obtenir le planning de la semaine precedente
    let choosedepartement = $("#departement_list").val();
    $.ajax({
      method: 'GET',
      url:'http://planning_manager.com/last/'+current_date+'/'+choosedepartement,
      dataType: 'json',
      success: function(data){
        $("#sem")[0].innerHTML = "";
        let seamine = document.createTextNode(data.datecourante.mday+'/'+data.datecourante.mon+'/'+data.datecourante.year);
        $("#sem")[0].appendChild(seamine);
        showplannings(data.datecourante, data.message);
      }
    })
  })

  suiv.addEventListener('click', function(){
    // fonction qui va permettre d'obtenir le planning de la semaine suivante
    let choosedepartement = $("#departement_list").val();
    $.ajax({
      method: 'GET',
      url:'http://planning_manager.com/next/'+current_date+'/'+choosedepartement,
      dataType: 'json',
      success: function(data){
        $("#sem")[0].innerHTML = "";
        let seamine = document.createTextNode(data.datecourante.mday+'/'+data.datecourante.mon+'/'+data.datecourante.year);
        $("#sem")[0].appendChild(seamine);
        showplannings(data.datecourante, data.message);
      }
    })
  })

  function showplannings(datecourante, plannings){
    // remise à zero du Dom pour la div d'identifiant plannings
    $("#plannings")[0].innerHTML = '';

    // mise à jour de la variable current_date
    current_date = datecourante[0];
    // console.log(current_date);

    plannings.map(planning => {
      // creation d'une div de class panning representant la seamaine de planning d'un emplye
      let planningsection = document.createElement("div");
      planningsection.className = "planning";
 
      // creation de la div qui va contenir le nom et le prenom de l'employe
      let empinfo = document.createElement("div");
      empinfo.className = "unique";

      // creation d'un noeud text qui est le nom et le prenom de l'employe qui doit remplir la div de classe i=unique
      let empinfotext = document.createTextNode(planning.nom_emp);
      empinfo.appendChild(empinfotext);

      // creation de la div qui va contenir les jours
      let days = document.createElement('div');
      days.className = "jours";
  
      weekdays.map(e => {
        let day = document.createElement("span");
        day.className = "jour";
        let dayText = document.createTextNode(e);
        day.appendChild(dayText);
        days.appendChild(day);
      })

      // ajout des div contenant le nom et prenom de l'employe et de la div des jours de la semaine
      planningsection.appendChild(empinfo);
      planningsection.appendChild(days);
      $("#plannings")[0].appendChild(planningsection);

      // creation d'une section qui va recevoir les plage pour chaque jour
      let section = document.createElement("section");
      section.className = "callender";


      planning.plan_emp.map(e => {
        let colone = document.createElement("div");
        colone.className = "horaire";
        if(e !== false){
          let plages = [e.plage1, e.plage2, e.plage3, e.plage4, e.plage5, e.plage6, e.plage7, e.plage8, e.plage9, e.plage10, e.plage11, e.plage12, e.plage13, e.plage14, e.plage15, e.plage16, e.plage17, e.plage18, e.plage19, e.plage20, e.plage21, e.plage22, e.plage23, e.plage24, e.plage25];

          plages.map(plage => {
            if(plage !== "disponible"){
              let words = plage.split(' ');
              if(words[0] !== '✔️'){
                let span = document.createElement("span");
                span.className = "dispo";
                let plageText = document.createTextNode(plage);
                span.appendChild(plageText);
                colone.appendChild(span);

                section.appendChild(colone);
                planningsection.appendChild(section);
              }
              else{
                let span = document.createElement("span");
                span.className = "valide";
                let plageText = document.createTextNode(plage);
                span.appendChild(plageText);
                colone.appendChild(span);

                section.appendChild(colone);
                planningsection.appendChild(section);
              }
            }
            else{
              let span = document.createElement("span");
              span.className = "pasdispo";
              let plageText = document.createTextNode("");
              span.appendChild(plageText);
              colone.appendChild(span);

              section.appendChild(colone);
              planningsection.appendChild(section);
            }
          })
        }
        if(e == false){
          for(let j = 1; j <= 25; j++){
            let span = document.createElement("span");
            span.className = "pasdispo";
            let plageText = document.createTextNode("");
            span.appendChild(plageText);
            colone.appendChild(span);

            section.appendChild(colone);
            planningsection.appendChild(section);
          }
        }
      })
    })

  }

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
  })

})
