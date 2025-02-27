<?php

if (!isset($_SESSION)) {
    session_start();
}


if (empty($_SESSION['user'])) {
    header("Location: ./login.php");
    exit();
}