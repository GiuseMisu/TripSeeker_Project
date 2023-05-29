-- Creazione tabella Utenti
CREATE TABLE Utente (
    nome varchar(40),
    cognome varchar(40),
    cittan varchar(20),
    nazionalita varchar(40),
    datan DATE,
    sesso varchar(6),
    telefono varchar(40),
    email varchar(40), 
    username varchar(40), 
    pswrd varchar(40) not null,
    confpswrd varchar(40),
    biografia varchar(150),
    profile_pic TEXT,
    primary key (email)
);

-- Creazione tabella Viaggi
CREATE TABLE Viaggio (
    ID_Viaggio SERIAL PRIMARY KEY,
    Email_Utente_Organizzatore varchar(40),
    Titolo VARCHAR(50),
    Descrizione VARCHAR(255),
    Data_Partenza DATE,
    Data_Ritorno DATE,
    Budget INT,
    Destinazione VARCHAR(30),
    Num_Max_Partecipanti INT,
    Posti_disponibili INT,
    trending_index INT DEFAULT 0, -- valore predefinito di trending_index è 0 al momento della creazione del viaggio
    FOREIGN KEY (Email_Utente_Organizzatore) REFERENCES Utente(email)
);


CREATE TABLE Partecipazioni ( 
	ID_Viaggio INT, 
    Email_Utente_Partecipante varchar(40), 
	FOREIGN KEY (ID_Viaggio) REFERENCES Viaggio(ID_Viaggio), 
	FOREIGN KEY (Email_Utente_Partecipante) REFERENCES Utente(email) 
);
--tabella per ricevere messaggi dagli utenti
CREATE TABLE contattaci (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    oggetto VARCHAR(100) NOT NULL,
    messaggio TEXT NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--tabella per storare interessi di utente
CREATE TABLE InteressiUtente (
    id serial primary key,
    email varchar(40),
    paesi_visitati text,
    Lingue_parlate text,
    attivita_preferite text,
    mezzi_trasporto text,
    stile_viaggio varchar(40),
    budget varchar(40),
    professione varchar(40),
    titolo_studio varchar(40),
    stato_civile varchar(40),
    gusto_musicale text,
    gusto_cinematografico text,
    gusto_sportivo text, 
    Restrizioni_alimentari text,
    tipo_patente text,
   
    foreign key (email) references Utente(email)
);


CREATE TABLE Recensioni (
    ID_Recensione SERIAL PRIMARY KEY,
    Email_Utente_Recensito VARCHAR(40) REFERENCES Utente(email),
    Email_Utente_Recensore VARCHAR(40) REFERENCES Utente(email),
    username_recensore VARCHAR(40),
    titolo text,
	Voto INTEGER CHECK (Voto >= 1 AND Voto <= 5),
    Descrizione_Recensione TEXT
);

CREATE TABLE Reset_password (
    ID SERIAL PRIMARY KEY,
    email_utente VARCHAR(40),
    token VARCHAR(40),
    scadenza TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (email_utente) REFERENCES Utente(email)

);