<?php
session_start();
$produkt = $_POST['nazwa_produktu'];
$count = $_POST['ilosc'];
$price = $_POST['cena'];
$kategoria = $_POST['nazwa_kategorii'];

require_once"connect.php";
$polaczenie = @new mysqli($host, $db_user,$db_haslo,$db_name);
if($polaczenie->connect_errno!=0)
{
    echo 'Error:'.$polaczenie->connect_errno;
}
else
{   
    $udany_insert = true;

    if(strlen($produkt) > 50 || strlen($produkt) < 1)
    {
        $udany_insert = false;
        $_SESSION['informacja_zwrotna'] = "Nazwa produktu musi zawierac od 1 do 50 znakow";
    }

    if(!is_numeric($count) and !is_numeric($price))
    {
        $udany_insert = false;
        $_SESSION['informacja_zwrotna'] = 'Podaj tylko cyfry w "ilosc" i "cena"';
    }
    else
    {
        $ilosc = intval($count);
        $cena = floatval($price);
    }

    if(ctype_alnum($kategoria) == false)
    {
        $udany_insert = false;
        $_SESSION['informacja_zwrotna'] = 'Kategoria musi skladac sie tylko z liter i cyfr';

    }
    if(strlen($kategoria) > 50 || strlen($kategoria) < 1)
    {
        $udany_insert = false;
        $_SESSION['informacja_zwrotna'] = "Nazwa kategorii musi zawierac od 1 do 50 znakow";
    }
    
    if($udany_insert == true)
    {
        $klucz = intval($_SESSION['id']);
        if($polaczenie->query("UPDATE produkty SET produkt = '$produkt', ilosc = $ilosc, cena = $cena, kategoria = '$kategoria' WHERE id_produktu = $klucz;"))
        {
            $_SESSION['informacja_zwrotna'] = '<span style = "color: white;"><h3><b>Edycja produktu udana<b><h3></span>';
        }
    }
    header("Location:modyfikuj.php");
    $polaczenie->close();
}
?>