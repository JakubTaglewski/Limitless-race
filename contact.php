<?php

?><!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LIMITLESS - Kontakt</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="main_style.css">
  <link rel="stylesheet" href="form_style.css">
  <link rel="stylesheet" href="responsive.css">
  <link rel="stylesheet" href="notification_style.css">
  <link rel="stylesheet" href="contact_style.css">
</head>
<body>

  <header>
    <div class="logo">LIMITLESS</div>
    <nav>
      <ul>
        <li><a href="index.html">Strona główna</a></li>
        <li><a href="contact.php" class="active">Kontakt</a></li>
      </ul>
    </nav>
  </header>

  <section class="main" id="home">
    <div class="main-content">
      <h1 class="limitless-main-text">LIMITLESS</h1>
      <p class="subtitle-first">Bieg charytatywny bez granic.</p>
      <p class="subtitle-second">Przekraczaj własne limity!</p><br>
      <p class="date-city-km">• 1 lipca 2025 • Warszawa / Łódź • 5km / 10km</p>
    </div>
  </section>

  <section class="info-section contact-section">
    <h2>Skontaktuj się z nami</h2>
    <div class="form-container">
      <form id="contactForm"
            action="https://formspree.io/f/xkgbvkkb"
            method="POST"
            novalidate>
        <div class="form-group">
          <label for="name">Twoje imię</label>
          <input type="text" id="name" name="name" placeholder="Jan" required>
        </div>
        <div class="form-group">
          <label for="email">Twój e-mail</label>
          <input type="email" id="email" name="email" placeholder="jan@example.com" required>
        </div>
        <div class="form-group">
          <label for="subject">Temat</label>
          <input type="text" id="subject" name="subject" placeholder="Temat wiadomości" required>
        </div>
        <div class="form-group">
          <label for="message">Wiadomość</label>
          <textarea id="message" name="message" rows="5" placeholder="Napisz swoją wiadomość tutaj..." required></textarea>
        </div>
        <button type="submit" class="submit-btn">Wyślij</button>
      </form>
      <div id="formFeedback"></div>
    </div>
  </section>

  <div id="toast"></div>

  <footer>
    <p>LIMITLESS &copy; 2025. Wszystkie prawa zastrzeżone.</p>
  </footer>

  <script src="script.js" defer></script>
  <script src="notification_script.js" defer></script>
  <script defer>
    document.addEventListener('DOMContentLoaded', () => {
      const form     = document.getElementById('contactForm');
      const feedback = document.getElementById('formFeedback');

      form.addEventListener('submit', e => {
        e.preventDefault();
        feedback.innerHTML = '';

        const data = new FormData(form);

        fetch(form.action, {
          method: form.method,
          body: data,
          headers: { 'Accept': 'application/json' }
        })
        .then(res => {
          if (!res.ok) throw res;
          return res.json();
        })
        .then(json => {
          feedback.innerHTML =
            `<p class="success">Dziękujemy! Twoja wiadomość została wysłana.</p>`;
          form.reset();
        })
        .catch(err => {
          console.error('Formspree error', err);
          feedback.innerHTML =
            `<p class="error">Ups! Coś poszło nie tak. Spróbuj ponownie.</p>`;
        });
      });
    });
  </script>
</body>
</html>
