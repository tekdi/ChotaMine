<?php
require_once 'lib/functions.php';
session_destroy();
header('Location: login.php');
