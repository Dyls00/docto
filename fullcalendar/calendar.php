<?php
  session_start();

  if (!isset($_SESSION["connecte"])) {
      $_SESSION["connecte"] = false;
  }

  include("/wamp64/doctolib/shared/header.php");
  include("/wamp64/doctolib/shared/navBar.php");

  $doctor_id = isset($_GET['doctor_id']) ? $_GET['doctor_id'] : '';
  $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
  $etablissement_id = isset($_GET['etablissement_id']) ? $_GET['etablissement_id'] : '';  

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/css/styles.css">
      <title>Calendrier</title>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="/fullcalendar/JS/index.global.js"></script>
  </head>

  <body class="body-calendar">
    <div class="container container-full d-flex justify-content-center align-items-center flex-column h-100 text-bold">
      <h4>Sélectionnez une date</h4>
      <div id="calendar"></div>
      <div id="calendarEditPopup" style="display: none;">
      <form id="submitEventForm" action="eventSubmit.php" method="POST">
        <div class="form-group">
            <label for="rdv_start">Date et heure de début</label>
            <input type="datetime-local" id="rdv_start" name="rdv_start" class="form-control">
        </div>
        <div class="form-group">
            <label for="rdv_end">Date et heure de fin</label>
            <input type="datetime-local" id="rdv_end" name="rdv_end" class="form-control">
        </div>
        <div class="question" style="margin-bottom:25px">
          <p>Type de consultation ?</p>
          <label>
              <input type="text" name="rdv_type" placeholder="Téléconsultation ou cabinet?..." required>
          </label>
          <p>Motif du rendez vous ?</p>
          <label>
            <input type="text" name="rdv_motif" placeholder="Urgence, consultation générale..." required> 
          </label>
        </div>
        <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="etablissement_id" value="<?php echo $etablissement_id; ?>">
        <button type="submit" form="submitEventForm" class="btn btn-primary mt-1">Confirmer</button>
        <div id="messageErreur" style="display: none; color: red;">
          Cette date et heure ne sont pas disponibles.
      </div>
      </form>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          initialDate: '2023-09-01',
          navLinks: true, // can click day/week names to navigate views
          selectable: true,
          selectMirror: true,
          select: function (info) {
            // Lorsqu'une date est sélectionnée, affichez la fenêtre modale d'édition
            document.getElementById('calendarEditPopup').style.display = 'block';

            // Remplissez les champs de date avec la date sélectionnée
            document.getElementById('rdv_start').value = info.startStr;
            document.getElementById('rdv_end').value = info.endStr;
            document.getElementById('rdv_type').value = document.querySelector('input[name="rdv_type"]').value;
            document.getElementById('rdv_motif').value = document.querySelector('input[name="rdv_motif"]').value;
            if (title) {
              calendar.addEvent({
              title: title,
              start: arg.start,
              end: arg.end,
              allDay: arg.allDay
            })
          }
            calendar.unselect()
          },
          editable: true,
          dayMaxEvents: true,
            events: {
                url: 'display_event.php', // Le script PHP qui renvoie les événements au format JSON
                method: 'GET', // Méthode HTTP à utiliser (GET ou POST selon votre script PHP)
               // failure: function () {
                //    alert('Erreur lors du chargement des événements.');
              //  }
            }
        });

        calendar.render();
        })
        // Fonction pour masquer la fenêtre modale d'édition du calendrier
        function hideEditPopup() {
            document.getElementById('calendarEditPopup').style.display = 'none';
        }

        // Fonction pour traiter l'édition du calendrier
        function calendar_event_master() {
        // Récupérez les valeurs des champs du formulaire
        var rdv_start = document.getElementById('rdv_start').value;
        var rdv_end = document.getElementById('rdv_end').value;
        var rdv_type = document.getElementById('rdv_type').value;
        var rdv_motif = document.getElementById('rdv_motif').value;

        // Effectuez une requête Ajax pour envoyer les données au serveur et effectuer l'édition
        function submitEventForm() {
        // Récupérez les valeurs des champs du formulaire
        var rdv_start = $("#rdv_start").val();
        var rdv_end = $("#rdv_end").val();
        var rdv_type = $("#rdv_type").val();
        var rdv_motif = $("#rdv_motif").val();

        // Créez un objet contenant les données à envoyer
        var eventData = {
          rdv_start: rdv_start,
          rdv_end: rdv_end,
          rdv_type: rdv_type,
          rdv_motif: rdv_motif,
        };
        // Effectuez la requête Ajax
        $.ajax({
            url: "save_event.php",
            type: "POST",
            dataType: 'json',
            data: eventData,
            success: function (response) {
              $('#calendarEditPopup').modal('hide');
              if (response.status == true) {
                  alert(response.msg);
                  location.reload();
              } else {
                  alert(response.msg);
              }
            },
            error: function (xhr, status) {
                console.log('Erreur Ajax = ' + xhr.statusText);
                alert("Erreur Ajax: " + xhr.statusText);
            }
          });

            return false; // Empêche le formulaire de se soumettre normalement
        }

        // Une fois l'édition terminée avec succès, masquez la fenêtre modale
        hideEditPopup();
      }
    </script>
  </body>
</html>