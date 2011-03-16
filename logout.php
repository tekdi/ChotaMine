<?php
require_once 'functions.php';
session_destroy();
header('Location: login.php');
