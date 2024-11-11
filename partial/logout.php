<?php
session_start();
echo "logging you out. Please Wait....";

session_destroy();
header("location: /php projects/forum");
?>