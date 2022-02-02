<?php
session_start();
// include database.php
require_once 'inc/database.php';
//include 'inc/check_login.php';
include_once 'inc/config.php';
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Klantgegevens</title>
        <!-- hier komen de css-bestanden -->
        <link rel="stylesheet" type="text/css" href="css/nav.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
    <!-- voor de opmaak straks zetten we alles in een container… -->
    <div class="container">
<?php
// include menu
include('inc/menu.php');

