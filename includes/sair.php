<?php

include 'seguranca.php';

session_unset($_SESSION['usuarioID']);

session_destroy();

header("Location: ../auth/");

?>