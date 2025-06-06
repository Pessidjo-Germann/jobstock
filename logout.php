<?php
session_start();
unset($_SESSION['connect']);
session_destroy();
header("location:./signup.php");
