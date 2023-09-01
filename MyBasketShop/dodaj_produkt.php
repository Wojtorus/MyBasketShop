<?php
session_start();
if(isset($_POST['nazwa_produktu']) and isset($_POST['ilosc']) and isset($_POST['cena']) and  isset($_POST['nazwa_kategorii']))
{
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
            $klucz_obcy = intval($_SESSION['id_uzytkownika']);
            if($polaczenie->query("INSERT INTO produkty VALUES (NULL,'$produkt',$ilosc,$cena,'$kategoria',$klucz_obcy)"))
            {
                $_SESSION['informacja_zwrotna'] = '<span style = "color: white;"><h3><b>Dodano produkt do listy<b><h3></span>';
            }
        }

        $polaczenie->close();
    }
}
?>

<!DOCTYPE html>
<html lg ="pl">
<head>
    <meta charset="utf-8"/>
    <meta name ="description" content = "Aplikacja która ma za zadanie pomóc w zapamiętniu zakupów potrzebnych do koszyka"/>
    <meta name = "keywords" content="zakupy, koszyk zakupowy, sklep, sklepy, spożywczak, spożywczy, lista zakupów, lista, zakupy"/>
    <title>Lista zakupow</title>
    <link rel="stylesheet" href ="dodaj_produkt.css"/>
    <link rel="stylesheet" href ="fontello/css/fontello.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>

</head>

<body>
    <div id = "container">
        
        <div id = "logo">
           <span style = "color: red;">My</span><span style = "color: white;">Basket</span><span style = "color: green;">Shop</span>
       </div>

       <div id = "tlo">
                <div id = "tresc">
                    <h2>Podaj w kolejnosci: nazwa produktu, ilosc, cena oraz kategorie produktu</h2>
                </div> 

                <form action = "#" method = "post">

                <div class = "dodaj_produkt">
                        <input type = "text" placeholder = "produkt" name = "nazwa_produktu"></br>
                        <input type = "text" placeholder = "ilosc" name = "ilosc"></br>
                        <input type = "text" placeholder = "cena" name = "cena"></br>
                        <input type = "text" placeholder = "kategoria" name = "nazwa_kategorii"></br>
                </div>
                <div id = "zatwierdz">
                    <input type = "submit" value = "zatwierdz">
                </div>
                </form>
                <?php
                    if(isset($_SESSION['informacja_zwrotna']))
                    {
                        echo '<div id = "informacja_zwrotna">'.$_SESSION['informacja_zwrotna'].'</div>';
                        unset($_SESSION['informacja_zwrotna']);
                    }
                ?>
    </div>
</body>