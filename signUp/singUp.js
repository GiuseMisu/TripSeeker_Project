
function controlla_campi(){
    //il nome non puo contenere numeri ne spazi
    var regex = /^[a-zA-Z]+$/;
    if(!regex.test(document.modulo_signup.nome.value)){
        alert("Il campo nome può contenere solo lettere");
        return false;
    }
    //nome massimo 40 caratteri sennò sfora in db
    if(document.modulo_signup.nome.value.length > 40){
        alert("Il campo nome può contenere massimo 40 caratteri");
        return false;
    }
    //nazio massimo 40 caratteri sennò sfora in db
    if(document.modulo_signup.nazio.value.length > 40){
        alert("Il campo nazione può contenere massimo 40 caratteri");
        return false;
    }
    //email massimo 40 caratteri sennò sfora in db
    if(document.modulo_signup.email.value.length > 40){
        alert("Il campo email può contenere massimo 40 caratteri");
        return false;
    }
    
    //username massimo 15caratteri
    if(document.modulo_signup.username.value.length > 15){
        alert("Il campo username può contenere massimo 15 caratteri");
        return false;
    }
    //cognome massimo 40 caratteri sennò sfora in db
    if(document.modulo_signup.cognome.value.length > 40){
        alert("Il campo cognome può contenere massimo 40 caratteri");
        return false;
    }
    if(!regex.test(document.modulo_signup.cognome.value)){
        alert("Il campo cognome può contenere solo lettere");
        return false;
    }            
    if( (document.modulo_signup.telefono.value == "") && (document.modulo_signup.email.value == "") ){
        alert("Inserisci il Telefono o l'Email");
        return false;
    }
    //lunghezza password di almeno 8 caratteri e contenga almeno un numero, una lettera maiuscola e un simbolo speciale
    var password = document.modulo_signup.password.value;
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm;
    if(!regex.test(password)){
        alert("La password deve contenere almeno 8 caratteri, una lettera maiuscola e un numero");
        return false;
    }         
    if(document.modulo_signup.password.value != document.modulo_signup.conferma_password.value){
        alert("Le password non coincidono");
        return false;
    }
    if(document.modulo_signup.telefono.value != ""){
        if(isNaN(document.modulo_signup.telefono.value)){
            alert("Il numero di telefono deve contenere solo numeri");
            return false;
        }
        if(document.modulo_signup.telefono.value.length > 10){
            alert("Il numero di telefono deve contenere massimo 10 numeri");
            return false;
        }
    }
    const input = document.querySelector('input[type="date"]');
    var today = new Date();
    var birthDate = new Date(input.value);
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    if(age < 18){
        alert("Devi essere maggiorenne per registrarti");
        return false;
    }

    //mancano check per vedere se nome cognome telefono o email sono gia presenti nel database
    return true;
}

function openPopup(){
    document.getElementById("loginPopUp").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}
function closePopup() {
    document.getElementById("loginPopUp").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}  

function validaForm () {
    if ( document . myForm . remember . checked ) {
    window . alert ( " Hai scelto di ricordarti per i prossimi accessi " );
    }
    else {
    window . alert ( " Hai scelto di non ricordarti per i prossimi accessi " );
    }
}

//se url contiene error=email-errore compare alert con errore
if (window.location.href.indexOf("error=email-nuova-errore") > -1) {
    alert("Email inserita non registrata, sei un nuovo utente? Registrati subito!");
}
//se url contiene error=email-gia-presente-error compare alert con errore
if (window.location.href.indexOf("error=email-gia-presente-errore") > -1) {
    alert("Utente già registrato con questa email!");
}
//se url contiene error=username-gia-presente-error compare alert con errore
if (window.location.href.indexOf("error=username-gia-presente-errore") > -1) {
    alert("Utente già registrato con questo username!");
}
