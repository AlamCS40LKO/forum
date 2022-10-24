<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconn.php';
    $email=$_POST['loginemail'];
    $pass=$_POST['loginpass'];
    
    $sql="SELECT * FROM `users` WHERE user_email='$email'";
    echo $email ;
    $result=mysqli_query($conn,$sql);
    $numRow=mysqli_num_rows($result);
    if($numRow==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['sno']=$row['sno'];
            $_SESSION['useremail']=$email;
            echo "logged in".$email;
           header("location: /forum/index.php");
            
        }
            header("Location: /forum/index.php");
           
        }
    header("location: /forum/index.php");
}
    
?>