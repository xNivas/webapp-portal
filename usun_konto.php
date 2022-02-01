<?php

    session_start();
    
    $id_delete = $_SESSION['id'];

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $conn = new mysqli($host, $db_user, $db_password, $db_name);
        if ($conn->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            if (($conn->query("DELETE FROM wpis WHERE id= '$id_delete' ")) && ($conn->query("DELETE FROM uzytkownik WHERE id= '$id_delete' ")))
            {
                session_unset();
                header('Location: konto_usunieto.php');
            }
            else
            {
                throw new Exception($conn->error);
                echo 'nie dziala';
            }
            
            $conn->close();
        }
    }
    catch (Exception $ex)
    {
        echo '<span style="color:red;">Błąd serwera.</span>';
        echo '<br />Informacja developerska: '.$ex;
    }

?>
