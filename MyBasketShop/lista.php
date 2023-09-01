<?php
session_start();
require_once"connect.php";
$polaczenie = new mysqli($host, $db_user,$db_haslo,$db_name);
if($polaczenie->connect_errno!=0)
{
    echo 'Error:'.$polaczenie->connect_errno;
}
$id_uzytkownika = $_SESSION['id_uzytkownika'];
$sql = "SELECT produkt,ilosc,cena,kategoria,id_produktu FROM produkty WHERE id_uzytkownika = $id_uzytkownika";
$rezultat = $polaczenie->query($sql);
?>
<!DOCTYPE html>
<html lg ="pl">
<head>
    <meta charset="utf-8"/>
    <meta name ="description" content = "Aplikacja która ma za zadanie pomóc w zapamiętniu zakupów potrzebnych do koszyka"/>
    <meta name = "keywords" content="zakupy, koszyk zakupowy, sklep, sklepy, spożywczak, spożywczy, lista zakupów, lista, zakupy"/>
    <title>Lista zakupow</title>
    <link rel="stylesheet" href ="lista.css"/>
    <link rel="stylesheet" href ="fontello/css/fontello.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>

</head>

<body>

<div id = "container">
        
     <div id = "logo">
        <span style = "color: red;">My</span><span style = "color: white;">Basket</span><span style = "color: green;">Shop</span>
    </div>

    <div id = "tlo"> 
        <div id = "Menu">
            <h2>Twoja lista zakupów</h2>
            <div id = "historia_tabeli">
                <div class = "Produkt">
                    Produkt
                </div>

                <div class = "Produkt">
                    ilosc
                </div>

                <div class = "Produkt">
                    cena
                </div>

                <div class = "Produkt">
                    kategoria
                </div>      
                
                <div class = "Produkt">
                    Edycja
                </div>   
            </div>

            <div id = "lista">
                <?php
                    if($rezultat->num_rows > 0)
                    {
                        while( $kolumna = $rezultat->fetch_assoc())
                        {
                            echo '<div id = "rzad">';
                                echo '<div class = "wyswietl">'.$kolumna["produkt"].'</div>';
                                echo '<div class = "wyswietl">'.$kolumna["ilosc"].'</div>';
                                echo '<div class = "wyswietl">'.$kolumna["cena"].'zł</div>';
                                echo '<div class = "wyswietl">'.$kolumna["kategoria"].'</div>';
                                echo '<div class="wyswietl">';                           
                                echo '<a href="modyfikuj.php?id=' . $kolumna['id_produktu'] . '"><i class="icon-pencil"></i></a>';                          
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                    $polaczenie->close();
                ?>
            </div>
        </div>
    </div>