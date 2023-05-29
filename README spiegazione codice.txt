database.sql: file che contiene il codice per la creazione delle tabelle del database
index.html: pagina principale a cui accede utente che non ha effettuato login, contiene carosello, barra di ricerca, owl carousel, about us e footer
index.php: pagina principale del sito a cui può accedere solo chi ha effettuato il login, contiene stessi elementi della pagina index.html. In più popup per creare viaggi(js + ajax) e tasto per accedere al profilo
login.php: pagina che contiene il codice per effettuare il login al sito
logout.php: pagina che contiene il codice per effettuare il logout dal sito


CARTELLA CONTACT US:
	-contact.html: contiene form per invio domande.
	-contact.js: javascript + ajax per invio form asincrono.
	-send-email.php: salva nel db il contenuto della domanda

CARTELLA CREA_VIAGGIO:
	-nuovo_viaggio.php: inserisce nel db un nuovo viaggio.

CARTELLA FAQ:
	-faq.php: contiene domande frequenti.
	-faq.js: javascript per apertura e chiusura domande frequenti.
	-faq.css: stile dei box domande.

CARTELLA FOTO PROFILO:
	contiene le foto profilo inserite dagli utenti (inutile senza db).

CARTELLA I_TUOI_VIAGGI:
	-dismiss.php: elimina una relazione di partecipazione al viaggio di un dato utente dal db.
	-tuoi_viaggi.css: stile per la pagina i tuoi viaggi e per i div viaggi.
	-user_trip.php: contiene i viaggi inseriti dall'utente e i viaggi ai quali partecipa.

CARTELLA IMG:
	-contiene le immagini del sito(caroselli, logo, sfondo, ecc).

CARTELLA LISTA_VIAGGI:
	-dismiss.php: elimina un viaggio dal db per un determinato utente.
	-index.php: pagina principale dove vengono mostrati tutti i viaggi disponibili, con bottoni di filtraggio, partecipazioni, rinunce, contatti ecc.
	-join.php: gestisce un utente che vuole partecipare ad un viaggio con la relativa partecipazione nella tabella ad hoc.
	-lista_viaggi.css: stile per la pagina lista viaggi e per i div viaggi.
	-login_from_lista_viaggi.php: gestisce il login da lista viaggi se si accede usando il popup modal form di quella pagina.
	-trending_trip.php: gestisce l'implentazione del trending trip, a seconda di quanti click vengono effettuati su un div c'è un incremento del valore di contatore trending; si può poi ordinare i viaggi secondo questo valore.

CARTELLA PHPMAILER:
	-CARTELLA PHPMAILER: libreria di php che gestisce un mail server per l'invio di email per il token di reset
	-password_dimendicata.php: form per inserimento di una mail alla quale inviare il token di reset.
	-crea_token.php: crea un token di reset e lo invia alla mail inserita nel form.
	-inserimento_token.php: form per l'inserimento del token ricevuto
	-cambio_password.php: form per l'inserimento della nuova password dove controllo se il token inserito è corretto.
	-salva_pasword_db.php: salva la nuova password nel db se i controlli sono andati a buon fine
	-template_pagine.php: contiene il template per le pagine di questa cartella

Other_User:
    - Altro_Utente.php: pagina che contiene il template della pagina, con fotoprofilo, informazioni personali/interessi, ultimi due viaggi effettuati con TripSeeker e recensioni ricevute(js + ajax)
    - Altro_Utente.css: foglio di stile per la pagina Altro_Utente.php
    - recensioni.php. pagina che contiene codice per inserimento della recensione nel database
    - login_from_altro_utente.css: file php che permette il login affinche un utente possa accedere per lasciare recensioni nella pagina Altro_Utente.php

Sign up:
    - index.php: pagina che contiene il form per la registrazione al sito 
    - signup.css: foglio di stile per la pagina index.php
    - signup.js:  codice javascript che verifica validità dei campi del form

Termini e Condizioni:
    - termini_condizioni.php: pagina che contiene i termini e le condizioni da rispettare per il sito
    - termini_condizioni.css: foglio di stile per la pagina termini_condizioni.php

CARTELLA User:
    - delete_interessi.php: permette di eliminare interessi utente connettendosi al database
    - index.php : pagina principale dell'utente, contiene templeate della pagina e codice per l' invio del form delle informazioni personali, immagine profilo, 
    - insert_interessi.php: permette di inserire gli interessi connettendosi al database
    - remove_pro_pic.php: codice che si connette al db e rimuove l'immagine profilo dal database
    -index.css: foglio di stile per la pagina index.php
