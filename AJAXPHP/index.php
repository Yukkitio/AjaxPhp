<?php
session_start();

if (isset($_SESSION['username'])) {
    echo "Bienvenue, " . $_SESSION['username'];
} else {
    header("Location: login.html");
    exit;
}
?>