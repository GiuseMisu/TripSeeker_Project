
document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault();
  
    var xhr = new XMLHttpRequest(); // Creiamo un nuovo oggetto di XMLHttpRequest
    xhr.open('POST', 'send-email.php', true);   // Configuriamo una richiesta POST per l'URL send-email.php
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) { 
          var response = JSON.parse(this.responseText);
          if (response.success) {
            document.getElementById('contact-form').reset();
            var successMessage = document.createElement('h3');
            successMessage.innerText = 'Messaggio inviato con successo!';
            document.getElementById('contact-form').appendChild(successMessage);
          } else {
            var errorMessage = document.createElement('h2');
            errorMessage.innerText = 'Errore nell\'invio del messaggio.';
            document.getElementById('contact-form').appendChild(errorMessage);
          }
        }
      };
  
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var subject = document.getElementById('subject').value;
    var message = document.getElementById('message').value;
  
    var data = 'name=' + encodeURIComponent(name) +
               '&email=' + encodeURIComponent(email) +
               '&subject=' + encodeURIComponent(subject) +
               '&message=' + encodeURIComponent(message);
  
    xhr.send(data);
  });

  /**
Il codice JavaScript utilizza la libreria jQuery e la tecnologia AJAX per inviare i dati del form al server senza ricaricare la pagina. In particolare, quando l'utente preme il pulsante di invio del form, il codice jQuery intercetta l'evento di submit e invia i dati tramite il metodo $.ajax(). In questo modo, il server PHP riceve i dati, li elabora e restituisce il risultato, che viene gestito dalla funzione success() o error() di jQuery. */