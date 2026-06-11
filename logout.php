<?php
session_start();

// Zmazeme vsetky data zo session (odstrihneme naramok)
session_unset();
session_destroy();

// Hodime ho spat na prihlasenie
header("Location: login.php");
exit();
?>