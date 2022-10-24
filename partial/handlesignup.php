<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconn.php';
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signuppassword'];
    $cpass=$_POST['signupcpassword'];

    //check whether this email exists
    $exitSql="SELECT * FROM `users` WHERE user_email='$user_email'";
    $result=mysqli_query($conn,$exitSql);
    $numRow=mysqli_num_rows($result);
    if($numRow>0){
        $showError="Email already in use";
    }
    else {
        if($pass==$cpass){
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `timestamp`) VALUES ( '$user_email', '$hash', CURRENT_TIMESTAMP)";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert=true;
               header("location: /forum/index.php?signupsuccess=true");
               exit;
            }
        }
        else {
            $showError="Password do not Match";
        }
    }
    header("location: /forum/index.php?signupsuccess=false&error=$showError");
}
if($showError==true){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong>'.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>