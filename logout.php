<?php
session_start();
include ("app/include/path.php");

unset($_SESSION['id']);
unset($_SESSION['admin']);
unset($_SESSION['username']);

header('location: ' . BASE_URL);
