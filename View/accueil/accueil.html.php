
<?php 

if($_SESSION['username']){
  echo "<h1>Welcome: </h1>"."<h1 class='text-light'>".htmlspecialchars($_SESSION['username']);
} else {
  echo "<h1>You are not connected </h1>";
}