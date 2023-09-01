<?php
session_start();

require_once"connect.php";
$polaczenie = @new mysqli($host, $db_user,$db_haslo,$db_name);
if($polaczenie->connect_errno!=0)
{
    echo 'Error:'.$polaczenie->connect_errno;
}
else
{  
    $produkt = $_POST['nazwa_produktu'];
    $count = $_POST['ilosc'];
    $price = $_POST['cena'];
    $kategria = $_POST['nazwa_kategorii'];
    $udany_insert = true;

    if(strlen($produkt) > 50 and strlen($produkt) < 1)
    {
        $udany_insert = false;
        $_SESSION['informacja_zwrtotna'] = "Nazwa produktu musi zawierac od 1 do 50 znakow";
    }

    if(!is_numeric($count))
    {
        $udany_insert = false;
        $_SESSION['informacja_zwrtotna'] = 'Podaj tylko cyfry w "ilosc" i "cena"';
    }
    else
    {
        $ilosc = intval($count);
    }

    if(!is_numeric($price))
    {
        $udany_insert = false;
        $_SESSION['informacja_zwrtotna'] = 'Podaj tylko cyfry w "ilosc" i "cena"';
    }
    else
    {
        $ilosc = intval($price);
    }

    if(ctype_alnum($kategria) == false)
    {
        $udany_insert = false;
        $_SESSION['informacja_zwrtotna'] = 'Kategoria mousi skladac sie tylko z liter i cyfr';
    }
    if($udany_insert == true)
    {
        if($polaczenie->query("INSERT INTO produkty VALUES (NULL,'$produkt',$ilosc,$cena,".$_SESSION['id_uzytkownika'].",'$kategria')"))
        {
                        $_SESSION['informacja_zwrtotna'] = '<span style = "color: white;"<h3><b>Dodano produkt do listy<b><h3></span>';                       
        }
    }
}
header("Location: dodaj_produkt.php");
?>



