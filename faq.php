<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Portal do składania ofert oraz zleceń wykonania różnego typu prac.">
        <meta name="keywords" content="praca, oferta, zlecenie, portal">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Portal zleceniowy</title>

        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
        <link rel="stylesheet" href="main.css" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
        <style>
          .kontent
          {
              margin: 20px;
              padding: 20px;
          }
      </style>

    </head>

    <body>
        
    <header>

<nav class="navbar navbar-expand-lg navbar-light bg-coolors-5 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand title" href="index.php">
            <i class="demo-icon icon-briefcase"></i> PORTAL DO-THIS
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbar">
            <ul class="navbar-nav me-auto mx-auto">
                <li class="nav-item"><a class="nav-link"href="index.php"> Start </a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">Wpisy</a>
                    <ul class="dropdown-menu bg-coolors-5">
                        <li><a class="dropdown-item" href="oferty.php"> Oferty </a></li>
                        <li><a class="dropdown-item" href="zlecenia.php"> Zlecenia </a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="faq.php"> FAQ </a></li>
                <li class="nav-item"><a class="nav-link" href="konto.php"> Moje konto </a></li>
                <li class="nav-item"><a class="nav-link" href="rejestracja.php"> Rejestracja </a></li>
                <li class="nav-item"><a class="nav-link" href="kontakt.php"> Kontakt </a></li>
                <li class="nav-item"><a class="nav-link" href="poliprywat.php"> Polityka prywatności </a></li>
                <li class="nav-item"><a class="nav-link" href="uzytkownicy.php"> Społeczność </a></li>
            </ul>

            <?php
            if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
            {
                echo "Witaj ".$_SESSION['login'].'! ';
                echo '<a href="logout.php" class="btn bg-coolors-1 text-white mx-2">Wyloguj się</a><br />';
            }
            else
            {
                echo '<a href="konto.php" class="btn bg-coolors-1 text-white mx-2">Zaloguj się</a><br />';
            }
            ?>
        </div>
    </div>
</nav>
</header>

        <br /><br /><br />

        <div class="poli kontent bg-coolors-5">
          <h1 class="display-4 text-black">Najczęściej zadawane pytania</h1>
        </div>

        
        <div class="poli kontent bg-coolors-5">

          <div class="accordion accordion-flush bg-coolors-5" id="accordionFlushExample">
                <div class="accordion-item bg-coolors-5">
              <h2 class="accordion-header " id="flush-headingOne">
                <button class="accordion-button collapsed bg-coolors-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  Co tu robimy?
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body text-black bg-coolors-5">Nasza strona to coś więcej niż biznes to społeczność w której właśnie się znajdujesz za co dziękujemy. Strona służy do wymiany ofert i projektów graficznych. Komisyjnie możesz poprosić o wykonanie pewnej grafiki bądź "MEMA", a inni mogą się go podjąć.</div>
          </div>

            </div>
            <div class="accordion-item bg-coolors-5">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed bg-coolors-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  Czy ta strona jest bezpieczna?
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body text-black bg-coolors-5">I tak i nie. Nie stać nas na SSL więc w teorii twoje dane logowania mogą wyciec, ale głowa do góry bo nawet my nie jesteśmy w stanie rozszyfrować haseł zabezpieczonych w bazie danych.</div>
              </div>
            </div>

            <div class="accordion-item bg-coolors-5">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed bg-coolors-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  Czy jest możliwość kontaktu.
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body text-black bg-coolors-5">Oczywiście, poprzez zakładkę kontakt możesz wysłać do nas wiadomość. Pamiętaj, że ta strona to jedynie nasze dodatkowe zajęcie więc może zająć trochę czasu zanim odpowiemy</div>
              </div>
            </div>

          <div class="accordion-item bg-coolors-5">
              <h2 class="accordion-header" id="flush-headingFour">
                <button class="accordion-button collapsed bg-coolors-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                  Czy mogę dowiedzieć się o polityce prywatności.
                </button>
              </h2>
              <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body text-black bg-coolors-5">Tak zakładka polityka prywatności jest dostępna 24h/7 w przeciwieństwie do nas.</div>
              </div>
            </div>
          </div>

          
          </div>

        </div>
        




    </body>
</html>

