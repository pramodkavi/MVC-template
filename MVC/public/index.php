<?php
session_start();

//before excute anything , we require all core files using init.php
require '../app/core/init.php';

//split the url and choose the suitable controller from the contollers folder
$app = new App;
$app->loadController();