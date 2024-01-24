          <!-- accueil.html.php -->
          <?php
          // when the user is logged in, show welcome message
          if (isset($_SESSION['username'])) {
            echo "<h1 class='text-center'>Bienvenue: </h1>" . "<h1 class='text-light text-center'>" . htmlspecialchars($_SESSION['username']) . "<i class='fa fa-user'></i>" . "</h1>"
              . "<div>

              <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
              <ol class='carousel-indicators'>
                <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
                <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
                <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
              </ol>
              <div class='carousel-inner p-5'>
                <div class='carousel-item active'>
                  <img class='d-block w-100 img-fluid' src='Public/img/car1.jpg' alt='First slide'>
                </div>
                <div class='carousel-item'>
                  <img class='d-block w-100 img-fluid' src='Public/img/car2.jpg' alt='Second slide'>
                </div>
                <div class='carousel-item'>
                  <img class='d-block w-100 img-fluid' src='Public/img/car2.jpg' alt='Third slide'>
                </div>
              </div>
              <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='sr-only'>Previous</span>
              </a>
              <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='sr-only'>Next</span>
              </a>
            </div>
            
            </div>";
          } else {
            echo "<h1>Vous n'êtes pas connecté</h1>";
          }

// if(isset($_SESSION['user']){

// }