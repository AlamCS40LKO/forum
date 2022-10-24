<?php
include 'dbconn.php';   
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
  
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>

      <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="about.php">About</a>
    </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

        $sql="SELECT category_name, category_id FROM `categories` LIMIT 3";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          echo
         '<a class="dropdown-item" href="/forum/threadlist.php?catid='.$row['category_id'].'">' .$row['category_name']. '</a>';
        }

        echo '</div>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="Contact.php">Contact</a>
      </li>
    </ul>
    <div class=" row mx-2">';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  echo '<form class="d-flex"  method="get" action="search.php">
  <input class="form-control me-2" name="search" type="search"  placeholder="Search" aria-label="Search">
    <button class="btn btn-success" type="submit">search</button>
    <a href="partial/logout.php" class="btn btn-outline-success ml-2" >Logout</a>
    <p class="text-dark my-0 mx-2">Welcome '.$_SESSION['useremail'].'</p> 
        </form>';
    
}
else {
    echo '<form class="d-flex">
    <input class="form-control me-2" type="search" name="search" placeholder="search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      </form> 
  </div>
        <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#LoginModal">Login</button>
        <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
}

    echo'</div>
</div>
</nav>';   

include 'loginModal.php';
include 'signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Signup Successfully!  </strong> You can login Now.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
 
?>