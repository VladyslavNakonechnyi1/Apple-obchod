<?php
session_start();

// Zmazeme vsetky data zo session
session_unset();
session_destroy();

// Hodime ho spat na prihlasenie
header("Location: login.php");
exit();
?>