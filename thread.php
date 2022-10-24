<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    #Ques {
        min-height=433px;
    }
    </style>
    <title>welcome-iDiscuss-- coding forums</title>
</head>
<body>

    <?php include 'partial/dbconn.php';?>    
    <?php include 'partial/header.php';?>
    

    <!--slider-->

    <div class="container">
        <?php
    $id=$_GET['thread_id'];
    $sql="SELECT * FROM `threads` WHERE thread_id = '$id'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
    $title= $row['thread_title'];
    $desc=$row['thread_desc'];
    $thread_user_id=$row['thread_user_id'];
    //Query the users table to find out the name of op
    $sql2="SELECT `user_email` FROM `users` WHERE sno= '$thread_user_id'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    $posted_by=$row2['user_email'];
   
    }
    ?>
       <?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    //echo $method;
    if($method=='POST'){
        //Insert into thread db
        $comment=$_POST['comment'];
        $comment=str_replace("<", "&lt;",$comment,);
        $comment=str_replace(">", "&gt;",$comment,);
        
        $sno=$_POST['sno'];
        $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '  $comment', '$id', '$sno', CURRENT_TIMESTAMP)";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>Your Comment added
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>';
        }
        }
    ?>

        <div class="jumbotron my-3  " style="background-color:lightgray">
            <h1 class="display-4"> <?php echo $title; ?> forum</h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum is for sharing knowledge with each other.
                Self-promote in the forums not allowed.
                Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross
                post questions. Do not PM users asking for help. Remain respectful of other members at all times.
            </p>
            <p class="lead">
                <p>Posted by: <b><?php echo $posted_by; ?> </b> </p>
            </p>
        </div>
    </div>
    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '
    <div class="container">
    <h1 class="py-2">Post a comment</h1>
    <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Type of Comment</label>
    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
  </div>
  <button type="submit" class="btn btn-success mr-5 my-4 ">Post comment</button>
</form>
    </div>';
    }
    else {
     echo '<div class="container">
     <h1 class="py-2">Post a Comment</h1>
     <p class="led" >You are Not loggedin. Please login to be post Comment</p>
 </div>';
    }
    ?>
    
    <div class="container" id="Ques">
        <h1 class="py-2" >Discussion</h1>
      <?php
    $id=$_GET['thread_id'];
    $sql="SELECT * FROM `comments` WHERE thread_id =$id";
    $result=mysqli_query($conn,$sql);
    $noResult=true;
    while ($row=mysqli_fetch_assoc($result)) {
        $noResult=false;
    $id=$row['comment_id'];
    $content=$row['comment_content'];
    $comment_time=$row['comment_time'];
    $thread_user_id=$row['comment_by'];
    $sql2="SELECT `user_email` FROM `users` WHERE sno= '$thread_user_id'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
   
echo 
        '<div class="media my-3">
            <img class="mr-3 " src="img/userdefault.png" width=50px alt="Generic placeholder image">
            <div class="media-body">
            <p class="font-weight-bold my-0"><b>'.$row2['user_email'].' at '.  $comment_time. '</b></p>
            ' .$content. '
            </div>
        </div>';
    }
    
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid text-center">
                <div class="container ">
                    <h1 class="display-4">No Comment found</h1>
    <p class="lead">Be the first Person to Comment</p>
  </div>
</div>';
    }
        ?>

        <?php include 'partial/footer.php';?>
        <!-- Optional JavaScript; choose one of the two! -->
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>
</html>