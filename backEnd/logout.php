<?php
// Avvia la sessione
session_start();

// Cancella tutte le variabili di sessione
$_SESSION = array();

// Distruggi la sessione
session_destroy();

// Cancella il cookie di sessione
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Reindirizza l'utente alla pagina di login o a un'altra pagina desiderata
header("Location: ../index.php");
exit;
?>