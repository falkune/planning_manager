$(function(){
  const weekdays = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
  let current_date;

  const user_name = $("#user_name").val();
  const user = $("#user").val();

  $.ajax({
    method: 'get',
    url: 'http://planning_manager.com/userPlanning/'+user,
    dataType: 'json',
    success: function(data){
      let seamine = document.createTextNode('semaine du '+data.datecourante.mday+'/'+data.datecourante.mon+'/'+data.datecourante.year);
      $("#sem")[0].appendChild(seamine);
      showplannings(data.datecourante, data.message);
    }
  })

  const change_password = $("#change_pswd")[0];
  const close_psw_modal = $("#close_psw_modal")[0];
  const psw_form = $("#psw_form")[0];

  // le bouton precedent
  const prec = $("#precedent")[0];
  // le bouton suivant 
  const suiv = $("#suivant")[0];
  // correspond au boutton de deconnexion
  const deconnexion = $("#deconnexion")[0];

  change_password.addEventListener('click', function(){
    $("#change_password")[0].style.visibility = "visible";
  })

  close_psw_modal.addEventListener('click', function(){
    $("#change_password")[0].style.visibility = "hidden";
  })

  psw_form.addEventListener('submit', function(e){
    e.preventDefault();
    let paswd1 = $("#pswrd").val();
    let paswd2 = $("#rpswrd").val();
    if(paswd2 == paswd1){
      $.ajax({
        method : 'get',
        url : 'http://planning_manager.com/changepassword/'+user+'/'+paswd1,
        dataType : 'json',
        success : function(data){
          alert("mot de passe modifié...");
          psw_form.reset();
          $("#change_password")[0].style.visibility = "hidden";
        }
      })
    }
    else{
      alert('les deux mot de passe ne sont pas identique');
      psw_form.reset();
    }
  })

  prec.addEventListener('click', function(){
    $.ajax({
      method: 'get',
      url: 'http://planning_manager.com/lastOne/'+user+'/'+current_date,
      dataType: 'json',
      success: function(data){
        $("#sem")[0].innerHTML = "";
        let seamine = document.createTextNode('semaine du '+data.datecourante.mday+'/'+data.datecourante.mon+'/'+data.datecourante.year);
        $("#sem")[0].appendChild(seamine);
        showplannings(data.datecourante, data.message);
      }
    })
  })

  suiv.addEventListener('click', function(){
    $.ajax({
      method: 'get',
      url: 'http://planning_manager.com/nextOne/'+user+'/'+current_date,
      dataType: 'json',
      success: function(data){
        $("#sem")[0].innerHTML = "";
        let seamine = document.createTextNode('semaine du '+data.datecourante.mday+'/'+data.datecourante.mon+'/'+data.datecourante.year);
        $("#sem")[0].appendChild(seamine);
        showplannings(data.datecourante, data.message);
      }
    })
  })

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

  function showplannings(datecourante, plannings){
    // remise à zero du Dom pour la div d'identifiant plannings
    $("#plannings_one")[0].innerHTML = '';

    // mise à jour de la variable current_date
    current_date = datecourante[0];

    // creation d'une div de class panning representant la seamaine de planning d'un emplye
    let planningsection = document.createElement("div");
    planningsection.className = "planning";

    // creation de la div qui va contenir le nom et le prenom de l'employe
    let empinfo = document.createElement("div");
    empinfo.className = "unique";

    // creation de la div qui va contenir les jours
    let days = document.createElement('div');
    days.className = "jours";
 
    // ajout des div contenant le nom et prenom de l'employe et de la div des jours de la semaine
    planningsection.appendChild(empinfo);
    planningsection.appendChild(days);
    $("#plannings_one")[0].appendChild(planningsection);


    weekdays.map(e => {
      let day = document.createElement("span");
      day.className = "jour_one";
      let dayText = document.createTextNode(e);
      day.appendChild(dayText);
      days.appendChild(day);
    })

    // creation d'un noeud text qui est le nom et le prenom de l'employe qui doit remplir la div de classe i=unique
    let empinfotext = document.createTextNode(user_name);
    empinfo.appendChild(empinfotext);

    // creation d'une section qui va recevoir les plage pour chaque jour
    let section = document.createElement("section");
    section.className = "callender_one";

    planningsection.appendChild(section);

    plannings.map(planning => {
      
      let colone = document.createElement("div");
      colone.className = "horaire_one";

      if(planning !== false){
        let plages = [planning.plage1, planning.plage2, planning.plage3, planning.plage4, planning.plage5, planning.plage6, planning.plage7, planning.plage8, planning.plage9, planning.plage10, planning.plage11, planning.plage12, planning.plage13, planning.plage14, planning.plage15, planning.plage16, planning.plage17, planning.plage18, planning.plage19, planning.plage20, planning.plage21, planning.plage22, planning.plage23, planning.plage24, planning.plage25];

        plages.map(plage => {
          if(plage !== "disponible"){
            let span = document.createElement("span");
            span.className = "dispo_one";
            let plageText = document.createTextNode(plage);
            span.appendChild(plageText);
            colone.appendChild(span);

            section.appendChild(colone);

          }
          else{
            let span = document.createElement("span");
            span.className = "pasdispo_one";
            let plageText = document.createTextNode("");
            span.appendChild(plageText);
            colone.appendChild(span);

            section.appendChild(colone);
    
          }
        })
      }
      if(planning == false){
        for(let j = 1; j <= 25; j++){
          let span = document.createElement("span");
          span.className = "pasdispo_one";
          let plageText = document.createTextNode("");
          span.appendChild(plageText);
          colone.appendChild(span);

          section.appendChild(colone);
  
        }
      }
      
    })

  }

})