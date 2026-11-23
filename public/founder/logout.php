<?php
session_start();
session_destroy(); // Destroys the session cookie
header('Location: index.php'); // Send them back to login
exit;
