<?php

/**
 * Simple user cabinet
 */
session_start();

require '../header.tpl';

if (isset($_GET['do']) && $_GET['do'] == 'logout') {
    unset($_SESSION['is_logged_in']);
}

if (!isset($_SESSION['is_logged_in'])) {
    header('Location: index.php');
}

require 'logout.tpl';

require '../footer.tpl';