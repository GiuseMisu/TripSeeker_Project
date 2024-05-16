# TripSeeker
This repository contains the code for my bachelor's degree project, which was developed as part of the "Languages and Technologies for the Web" exam within the Computer Science & Control Engineering course at Sapienza University.
The project was a collaborative effort with my colleague [Giovanni Zara](https://github.com/Giovanni-Zara).

## Technologies Used

The project is built using the following technologies:

- **HTML**: Used for creating the structure and content of web pages.

- **CSS**: Used for styling the web pages and ensuring a visually appealing user interface.

- **JavaScript**: Utilized for implementing client-side functionality and enhancing user interactivity.

- **PHP**: Used for server-side scripting and interacting with databases.

- **Bootstrap**: A popular front-end framework for designing responsive and mobile-first web pages.

- **AJAX**: Implemented for making asynchronous requests to the server and dynamically updating the content without page refresh.

- **SQL (PostgreSQL)**: Utilized to create and manage the database for storing application data.

## This repository contains the following files and folders:

  - database.sql: This file contains the code for creating the database tables.

  - index.html: The main page accessible to users who have not logged in. It includes a carousel, search bar, owl carousel, about us section, and footer.

  - index.php: The main page of the site, accessible only to logged-in users. It includes the same elements as index.html, plus a popup for creating trips (using JavaScript and AJAX) and a button to access the user's profile.

  - login.php: This page contains the code for user login to the site.

  - logout.php: This page contains the code for user logout from the site.

- **CONTACT US Folder**:

  - contact.html: Contains a form for submitting questions.
  - contact.js: JavaScript + AJAX for asynchronous form submission.
  - send-email.php: Saves the content of the submitted question in the database.
    
- **CREA_VIAGGIO Folder**:

  - nuovo_viaggio.php: Inserts a new trip into the database.
    
- **FAQ Folder**:

  - faq.php: Contains frequently asked questions.
  - faq.js: JavaScript for expanding and collapsing frequently asked questions.
  - faq.css: Style for FAQ boxes.
  
- **FOTO PROFILO Folder**: Contains profile pictures uploaded by users (not functional without the database).

- **I_TUOI_VIAGGI Folder**:

  - dismiss.php: Deletes a user's participation in a specific trip from the database.
  - tuoi_viaggi.css: Style for the "I tuoi viaggi" (Your trips) page and trip div elements.
  - user_trip.php: Displays trips added by the user and trips they are participating in.
    
- **IMG Folder**: Contains images used throughout the site (carousels, logo, background, etc.).

- **LISTA_VIAGGI Folder**:

  - dismiss.php: Deletes a trip from the database for a specific user.
  - index.php: The main page that displays all available trips with filtering buttons, participation, cancellations, contacts, etc.
  - join.php: Manages a user's request to participate in a trip, including the related participation entry in the database.
  - lista_viaggi.css: Style for the "Lista viaggi" (List of trips) page and trip div elements.
  - login_from_lista_viaggi.php: Handles user login from the "Lista viaggi" page if using the modal form popup.
  - trending_trip.php: Implements trending trips, where the click count on a trip div increases and allows sorting by this value.
    

- **PHPMAILER Folder**: PHP library for managing a mail server for sending email tokens for password reset.
  
  - password_dimendicata.php: Form for entering an email to receive a password reset token.
  - crea_token.php: Creates a password reset token and sends it to the provided email.
  - inserimento_token.php: Form for entering the received token.
  - cambio_password.php: Form for entering a new password, with token verification.
  - salva_pasword_db.php: Saves the new password in the database if all checks are successful.
  - template_pagine.php: Contains the template for the pages in this folder.
    
- **Other_User Folder**:

  - Altro_Utente.php: Page containing the template for other users' profiles, including profile pictures, personal information/interests, the last two trips with TripSeeker, and received reviews (using JavaScript and AJAX).
  - Altro_Utente.css: Stylesheet for Altro_Utente.php.
  - recensioni.php: Page containing code for inserting reviews into the database.
  - login_from_altro_utente.css: PHP file allowing login for users to leave reviews on the Altro_Utente.php page.
    
- **Sign up Folder**:

  - index.php: Page containing the registration form for the site.
  - signup.css: Stylesheet for index.php.
  - signup.js: JavaScript code that validates the form fields.
    
- **Termini e Condizioni Folder**:

  - termini_condizioni.php: Page containing the terms and conditions to be followed for the site.
  - termini_condizioni.css: Stylesheet for termini_condizioni.php.
    
- **User Folder**:

  - delete_interessi.php: Allows deleting user interests by connecting to the database.
  - index.php: The main user page that contains the template of the page and code for submitting personal information, profile picture, etc.
  - insert_interessi.php: Allows inserting interests by connecting to the database.
  - remove_pro_pic.php: Code that connects to the database and removes the profile picture.
  - index.css: Stylesheet for index.php.
