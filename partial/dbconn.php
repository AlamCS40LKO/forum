<?php
$servername="localhost:3306";
$username="root";
$password="";
$database="idiscuss";

$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
        die( "Not Connect ".mysqli_connect_error($conn));
}
else {
   // echo "Connect";
}
?>