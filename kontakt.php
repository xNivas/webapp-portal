<?php

    session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Konktakt</title>
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
        <link rel="stylesheet" href="main.css" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <form class"cotact-form" action="contactform.php" method="post">
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

		<div class="m-5 p-5 bg-coolors-5 text-black rounded">
			<center><h1>Strona w budowie</h1></center>
			<p>Formularz kontaktu nie zyskał jeszcze funkcji życiowych! Prosimy o bezpośredni kontakt i przepraszamy za niedogodności.</p>
		  </div>

		<div class="container">
			<div class="row">
					<center><h1>Kontakt</h1></center>
			</div>
			<div class="love">
					<h4 style="text-align:left">Skontaktuj się</h4>
			</div>
			<div class="row input-container">
					<div class="col-xs-12">
						<div class="styled-input wide">
							<input type="text" required />
							<label>Imie</label> 
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="styled-input">
							<input type="text" required />
							<label>Email</label> 
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="styled-input" style="float:right;">
							<input type="text" required />
							<label>Numer tel.</label> 
						</div>
					</div>
					<div class="col-xs-12">
						<div class="styled-input wide">
							<textarea required></textarea>
							<label>Wiadomość</label>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="btn-lrg submit-btn">Send Message</div>
					</div>
			</div>
		</div>


	</body>
</html>