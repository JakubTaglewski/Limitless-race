<?php

// Dostep do bazy
define('DB_HOST', 'localhost');
define('DB_NAME', 'limitless_race');
define('DB_USER', 'limitless_root');
define('DB_PASS', 'Jtag0407');

try {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_NAME);
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    exit('Błąd połączenia z bazą danych: ' . $e->getMessage());
}
