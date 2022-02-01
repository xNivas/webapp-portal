<?php

    session_start();

    if (isset($_POST['mail']))
    {
        $wszystko_OK=true;

        $login = $_POST['login'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $nr_tel = $_POST['nr_tel'];
        $adres = $_POST['adres'];

        //login check
        if ( (strlen($login) < 3) || (strlen($login) > 20) )
        {
            $wszystko_OK=false;
            $_SESSION['error_login']="Login musi posiadać od 3 do 20 znaków";
        }
        if (ctype_alnum($login)==false)
        {
            $wszystko_OK=false;
            $_SESSION['error_login']="Login może składać się tylko z liter i cyfr, bez polskich znaków";
        }

        //nr_tel check
        if ( (strlen($nr_tel) < 9) || (strlen($nr_tel) > 9) )
        {
            $wszystko_OK=false;
            $_SESSION['error_nr_tel']="Numer telefonu musi składać się z 9 znaków.";
        }
        if (is_numeric($nr_tel)==false)
        {
            $wszystko_OK=false;
            $_SESSION['error_nr_tel']="Numer telefonu może składać się tylko cyfr.";
        }

        //name check
        if (strlen($imie) > 30)
        {
            $wszystko_OK=false;
            $_SESSION['error_imie']="Imie nie może mieć więcej niż 30 znaków";
        }

        //surname check
        if (strlen($nazwisko) > 30)
        {
            $wszystko_OK=false;
            $_SESSION['error_nazwisko']="Nazwisko nie może mieć więcej niż 30 znaków";
        }       
        
        //name check
        if (strlen($adres) > 50)
        {
            $wszystko_OK=false;
            $_SESSION['error_adres']="Adres nie może mieć więcej niż 50 znaków";
        }



        $mail = $_POST['mail'];
        $mailB = filter_var($mail, FILTER_SANITIZE_EMAIL);
        
        if ((filter_var($mailB, FILTER_VALIDATE_EMAIL)==false) || ($mailB!=$mail))
        {
            $wszystko_OK=false;
            $_SESSION['error_mail']="Podaj poprawny adres e=mail.";
        }


        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];

        if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
        {
            $wszystko_OK=false;
            $_SESSION['error_haslo']="Hasło musi posiadać od 8 do 20 znaków";
        }

        if ($haslo1 != $haslo2)
        {
            $wszystko_OK=false;
            $_SESSION['error_haslo']="Podane hasła nie są takie same.";
        }

        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
        
        
        if (!isset($_POST['regulamin']))
        {
            $wszystko_OK=false;
            $_SESSION['error_regulamin']="Aby dokonać rejestracji należy zaakceptować regulamin.";
        }


        $sekret = "6Ldlh0AeAAAAAEXMFEQ042QJ8USQCCMoCrxsRtWd";

        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

        $odpowiedz = json_decode($sprawdz);

        if ($odpowiedz->success==false) 
        {
            $wszystko_OK=false;
            $_SESSION['error_bot']="Potwierdź, że nie jesteś botem.";
        }

		$_SESSION['fr_login'] = $login;
		$_SESSION['fr_mail'] = $mail;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		$_SESSION['fr_imie'] = $imie;
		$_SESSION['fr_nazwisko'] = $nazwisko;
        $_SESSION['fr_nr_tel'] = $nr_tel;
        $_SESSION['fr_adres'] = $adres;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try 
        {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                //mail already exists check
                $rezultat = $polaczenie->query("SELECT id FROM uzytkownik WHERE mail='$mail'");
                if (!$rezultat) throw new Exception($polaczenie->error);
                $ile_takich_maili = $rezultat->num_rows;
                if($ile_takich_maili>0) 
                {
                    $wszystko_OK=false;
                    $_SESSION['error_mail']="Istnieje już konto przypisane do tego adresu email";
                }

                //login already exists check
                $rezultat = $polaczenie->query("SELECT id FROM uzytkownik WHERE login='$login'");
                if (!$rezultat) throw new Exception($polaczenie->error);
                $ile_takich_loginow = $rezultat->num_rows;
                if($ile_takich_loginow>0) 
                {
                    $wszystko_OK=false;
                    $_SESSION['error_login']="Istnieje już konto o takim nicku.";
                }


                if ($wszystko_OK==true) 
                {
                    //wszystkie warunki rejestracji sprawdzone pomyslnie
                    if ($polaczenie->query("INSERT INTO uzytkownik VALUES (NULL, '$imie', '$nazwisko', $nr_tel, '$mail', '$adres', '$login', '$haslo_hash', NULL)"))
                    {
                        $_SESSION['udanarejestracja']=true;
                        header('Location: witamy.php');
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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Portal do składania ofert oraz zleceń wykonania różnego typu prac.">
        <meta name="keywords" content="praca, oferta, zlecenie, portal">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Portal zleceniowy</title>

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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

            <div class="m-4">
                <form method="post">
                    
                    Login: <br /> <input type="text" name="login" /><br />
                    <?php
                        if (isset($_SESSION['error_login']))
                        {
                            echo '<div class="error">'.$_SESSION['error_login'].'</div>';
                            unset($_SESSION['error_login']);
                        }
                    ?>

                    Mail: <br /> <input type="text" name="mail" /><br />
                    <?php
                        if (isset($_SESSION['error_mail']))
                        {
                            echo '<div class="error">'.$_SESSION['error_mail'].'</div>';
                            unset($_SESSION['error_mail']);
                        }
                    ?>

                    Hasło: <br /> <input type="password" name="haslo1" /><br />
                    <?php
                        if (isset($_SESSION['error_haslo']))
                        {
                            echo '<div class="error">'.$_SESSION['error_haslo'].'</div>';
                            unset($_SESSION['error_haslo']);
                        }
                    ?>

                    Powtórz hasło: <br /> <input type="password" name="haslo2" /><br />
                    Imię: <br /> <input type="text" name="imie" /><br />
                    <?php
                        if (isset($_SESSION['error_imie']))
                        {
                            echo '<div class="error">'.$_SESSION['error_imie'].'</div>';
                            unset($_SESSION['error_imie']);
                        }
                    ?>
                    Nazwisko: <br /> <input type="text" name="nazwisko" /><br />
                    <?php
                        if (isset($_SESSION['error_nazwisko']))
                        {
                            echo '<div class="error">'.$_SESSION['error_nazwisko'].'</div>';
                            unset($_SESSION['error_nazwisko']);
                        }
                    ?>
                    Numer telefonu (bez spacji): <br /> <input type="text" name="nr_tel" /><br />
                    <?php
                        if (isset($_SESSION['error_nr_tel']))
                        {
                            echo '<div class="error">'.$_SESSION['error_nr_tel'].'</div>';
                            unset($_SESSION['error_nr_tel']);
                        }
                    ?>
                    Adres: <br /> <input type="text" name="adres" /><br />
                    <?php
                        if (isset($_SESSION['error_adres']))
                        {
                            echo '<div class="error">'.$_SESSION['error_adres'].'</div>';
                            unset($_SESSION['error_adres']);
                        }
                    ?>
                    <label>
                        <input type="checkbox" name="regulamin" /> Zapoznałem się z <a href="poliprywat.php">polityką prywatności</a> strony i akceptuję ją.
                    </label>
                    <br />
                    <?php
                        if (isset($_SESSION['error_regulamin']))
                        {
                            echo '<div class="error">'.$_SESSION['error_regulamin'].'</div>';
                            unset($_SESSION['error_regulamin']);
                        }
                    ?>
                    <br />
                    <div class="g-recaptcha" data-sitekey="6Ldlh0AeAAAAAHcPfbbG05oZe0lBK9NufizWeiAf"></div><br />
                    <?php
                        if (isset($_SESSION['error_bot']))
                        {
                            echo '<div class="error">'.$_SESSION['error_bot'].'</div>';
                            unset($_SESSION['error_bot']);
                        }
                    ?>
                    
                    <input type="submit" value="Zarejestruj się" />

                </form>
            </div>

            <br /><br />
            
        </main>
    </body>
</html>