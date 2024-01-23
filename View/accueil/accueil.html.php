          <!-- accueil.html.php -->
<?php 
// when the user is logged in, show welcome message
if(isset($_SESSION['username'])){
  echo "<h1>Bienvenue: </h1>" . "<h1 class='text-light'>" . htmlspecialchars($_SESSION['username']) . "</h1>";
} else {
  echo "<h1>Vous n'êtes pas connecté</h1>";
}

// if(isset($_SESSION['user']){

// }