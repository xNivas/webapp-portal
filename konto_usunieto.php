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

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700&display=swap" rel="stylesheet" type='text/css'>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
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

        <main>

            <br /><br /><br /><br />
            Pomyślnie usunięto konto.
            <br /><br />
            <a href="index.php">[ Przejdź do strony głównej ]</a>
            <br /><br />



        </main>
    </body>
</html>