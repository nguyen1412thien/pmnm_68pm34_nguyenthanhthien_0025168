<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../app/core/Controller.php';
require_once '../app/core/DB.php';
require_once '../app/core/App.php';

new App();
