<?php
session_start();

require_once"connect.php";
$polaczenie = @new mysqli($host, $db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error:".$polaczenie->connect_errno;
}
else
{
    $email = $_POST['email'];
    $haslo = $_POST['haslo'];

    $zapytanie = "SELECT * FROM uzytkownicy WHERE email = '$email' and haslo = '$haslo'";
    if($rezultat = @$polaczenie->query($zapytanie)) // po co to jest
    {
        $ile_uzytkownikow = $rezultat->num_rows;
        if($ile_uzytkownikow > 0)
        {
            $_SESSION['zalogowany'] = true;
            $wiersz = $rezultat->fetch_assoc();
            $_SESSION['id_uzytkownika'] = $wiersz['id_uzytkownika'];
            $_SESSION['login'] = $wiersz['login'];
            $_SESSION['email'] = $wiersz['email'];

 
            $rezultat->close();
            header('Location: lista_zakupow.php');
        }
        else
        {
            $_SESSION['blad'] = '<span style = "color: white;">Nieprawidłowy email lub hasło.</span>';
            header('Location: Zaloguj.php');
        }
    }

    $polaczenie->close();
}



?>

