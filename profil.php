<?php

    session_start();

    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: konto.php');
        exit();
    }

    
    if (isset($_POST['tytul']))
    {
        $post_OK=true;

        $tytul = $_POST['tytul'];
        $tresc = $_POST['tresc'];
        $typ = $_POST['typ'];
        $id_konta = $_SESSION['id'];
        $id_podkategorii = $_POST['id_podkategorii'];

        if ( (strlen($tytul) < 3) || (strlen($tytul) > 30) )
        {
            $post_OK=false;
            $_SESSION['error_tytul']="Tytuł musi mieć od 3 do 30 znaków";
        }

        if ( (strlen($tresc) < 3) || (strlen($tresc) > 250) )
        {
            $post_OK=false;
            $_SESSION['error_tresc']="Treść musi mieć od 3 do 250 znaków";
        }


        //  //Zapamiętaj wprowadzone dane
		// $_SESSION['fr_tytul'] = $tytul;
		// $_SESSION['fr_tresc'] = $tresc;
		// $_SESSION['fr_typ'] = $typ;
		// $_SESSION['fr_id'] = $id;
		// if (isset($_POST['typ'])) $_SESSION['fr_typ'] = true;



        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                if ($post_OK==true) 
                {
                    //wszystkie warunki dodania posta sprawdzone pomyslnie
                    if ($polaczenie->query("INSERT INTO wpis VALUES (NULL, '$tytul', '$tresc', NULL, '$typ', '$id_konta', '$id_podkategorii')"))
                    {
                        $_SESSION['udanedodanie']=true;
                        header('Location: dodano_post.php');
                    }
                    else
                    {
                        throw new Exception($polaczenie->error);
                        echo 'no i nie dziala';
                    }
                }

                $polaczenie->close();
            }

        }
        catch (Exception $e) 
        {
            echo '<span style="color:red;">Błąd serwera.</span>';
            echo '<br />Informacja developerska: '.$e;
        }

    }

?>

    
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Portal do składania ofert oraz zleceń wykonania różnego typu prac.">
        <meta name="keywords" content="praca, oferta, zlecenie, portal">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Portal zleceniowy</title>

        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
        <link rel="stylesheet" href="main.css" type="text/css" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700&display=swap" rel="stylesheet" type='text/css'>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <style>
            .error {
                color: red;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            #textboxid
            {
                height:200px;
                font-size:14pt;
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

        <main>

            <br /><br /><br /><br />

            <div class="container mt-5">
                <div class="row">

                    <div class="col-sm-6">
                        <h1 class="display-4">Twoje dane konta</h1>
                        <div class="container p-5 my-5 bg-coolors-5 text-black">
                            <p>
                                
                                <?php

                                echo '<div class="mx-4">';
                                echo "<p>Witaj ".$_SESSION['login'].'!<br />[ <a href="logout.php">Wyloguj się!</a> ]</p>';

                                echo "<p><b>Imię</b>: ".$_SESSION['imie'];"";
                                echo " <br /> <b>Nazwisko</b>: ".$_SESSION['nazwisko'];"";
                                echo " <br /> <b>Mail</b>: ".$_SESSION['mail'];"";
                                echo " <br /> <b>ID</b>: ".$_SESSION['id']."</p>";
                                echo '</div>';
                                ?>

                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <h1 class="display-4">Tworzenie posta</h1>
                        <div class="container p-5 my-5 bg-coolors-5 text-black">
                            <p>
                                
                                <form method="post">
                                    Utwórz post: <br /><br />

                                    Tytuł: <br /> <input type="text" name="tytul" /><br />
                                    <?php
                                        if (isset($_SESSION['error_tytul']))
                                        {
                                            echo '<div class="error">'.$_SESSION['error_tytul'].'</div>';
                                            unset($_SESSION['error_tytul']);
                                        }
                                    ?>

                                    Treść: <br /> <input type="text" name="tresc" id="textboxid" /><br />
                                    <?php
                                        if (isset($_SESSION['error_tresc']))
                                        {
                                            echo '<div class="error">'.$_SESSION['error_tresc'].'</div>';
                                            unset($_SESSION['error_tresc']);
                                        }
                                    ?>

                                    <br />Typ postu: <br /> 
                                    <div>
                                        <input type="radio" id="oferta" name="typ" value="oferta" checked>
                                        <label for="oferta" class="text-black">Oferta</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="zlecenie" name="typ" value="zlecenie">
                                        <label for="zlecenie" class="text-black">Zlecenie</label>
                                    </div>
                                    
                                    <br /><br />Kategoria: <br /> 
                                    <div>
                                        <input type="radio" id="1" name="id_podkategorii" value="1" >
                                        <label for="1" class="text-black">Sesje fotograficzne</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="2" name="id_podkategorii" value="2" checked>
                                        <label for="2" class="text-black">Oprawa muzyczna uroczystości</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="12" name="id_podkategorii" value="12" checked>
                                        <label for="2" class="text-black">Wykonanie badań</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="14" name="id_podkategorii" value="14" checked>
                                        <label for="2" class="text-black">Opieka</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="23" name="id_podkategorii" value="23" checked>
                                        <label for="2" class="text-black">Ulotki</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="24" name="id_podkategorii" value="24" checked>
                                        <label for="2" class="text-black">Transport</label>
                                    </div>

                                    <br /><input type="submit" value="Dodaj post" />

                                </form>
                            
                            </p>
                        </div>
                    </div>

                </div>
            </div>


            <div class="container mt-5">
                <div class="row">

                    <div class="col-sm-6">
                        <h1 class="display-4">Sekcja w budowie</h1>
                        <div class="container p-5 my-5 bg-coolors-5 text-black">
                            <p>
                                "Nie od razu Rzym zbudowano."
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <h1 class="display-4">Usuwanie konta</h1>
                        <div class="container p-5 my-5 bg-coolors-5 text-black">
                            <?php
                                echo "<p>Aby usunąć konto " .$_SESSION['login']. ' kliknij przycisk. <br />[ <a href="usun_konto.php">Usuń konto!</a> ]</p>';
                                echo "<p>Uwaga, operacji nie będzie można cofnąć.</p>"
                            ?>
                        </div>
                    </div>

                </div>
            </div>

            




        </main>
    </body>
</html>