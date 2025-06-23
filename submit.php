<?php

require_once 'config.php';


header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'errors' => ['Metoda niedozwolona']
    ]);
    exit;
}


$firstName = trim($_POST['firstName']  ?? '');
$lastName  = trim($_POST['lastName']   ?? '');
$email     = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$phone     = trim($_POST['phone']      ?? '');
$birthdate = $_POST['birthdate']       ?? '';
$distance  = $_POST['distance']        ?? '';
$terms     = isset($_POST['terms']) ? 1 : 0;


$errors = [];
if (!$firstName)  $errors[] = 'Brakuje imienia.';
if (!$lastName)   $errors[] = 'Brakuje nazwiska.';
if (!$email)      $errors[] = 'Nieprawidłowy e-mail.';
if (!$phone)      $errors[] = 'Brakuje numeru telefonu.';
if (!$birthdate)  $errors[] = 'Brakuje daty urodzenia.';
if (!in_array($distance, ['5km','10km'], true)) {
    $errors[] = 'Nieprawidłowy dystans.';
}
if (!$terms)      $errors[] = 'Musisz zaakceptować regulamin.';

if (!empty($errors)) {
    echo json_encode([
        'status' => 'error',
        'errors' => $errors
    ]);
    exit;
}


try {
    $sql = "INSERT INTO participants 
            (first_name, last_name, email, phone, birthdate, distance, terms_accepted) 
            VALUES 
            (:fn, :ln, :em, :ph, :bd, :dist, :terms)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fn'    => $firstName,
        ':ln'    => $lastName,
        ':em'    => $email,
        ':ph'    => $phone,
        ':bd'    => $birthdate,
        ':dist'  => $distance,
        ':terms' => $terms,
    ]);

    echo json_encode([
        'status'  => 'success',
        'message' => 'Dziękujemy za zgłoszenie! Do zobaczenia na starcie.'
    ]);
} catch (PDOException $e) {

    echo json_encode([
        'status' => 'error',
        //'errors' => ['Błąd bazy danych: '.$e->getMessage()]
    ]);
}
