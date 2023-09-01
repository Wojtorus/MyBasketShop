<?php
    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
        header("Location: Osadnicy.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lg ="pl">
<head>
    <meta charset="utf-8"/>
    <meta name ="description" content = "Aplikacja która ma za zadanie pomóc w zapamiętniu zakupów potrzebnych do koszyka"/>
    <meta name = "keywords" content="zakupy, koszyk zakupowy, sklep, sklepy, spożywczak, spożywczy, lista zakupów, lista, zakupy"/>
    <title>Lista zakupow</title>
    <link rel="stylesheet" href ="lista_zakupow.css"/>
    <link rel="stylesheet" href ="fontello/css/fontello.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>

    <style>
    /* Ogólne style dla wszystkich rozmiarów ekranu */

    /* Style dla małych ekranów (mobilne) */
    @media (max-width: 767px) {
        #przywitanie_uzytkownika {
            font-size: 26px;
        }

        #nawigacja
        {
            dispaly:flex;
            flex-direction:column;
        }

        #nawigacja a
        {
            background-color: transparent;
            border:none;
        }

        #dodaj_produkt, #usun_produkt, #pokaz_liste {
            width: 100px;
            margin-bottom: 20px;
            height:100px;
            text-align:center;
        }

        #dodaj_produkt b, #usun_produkt b, #pokaz_liste b {
            font-size: 14px;
        }

        .icon-doc-text-inv ,.icon-trash ,.icon-cart-plus
        {
            font-size: 25px;
        }
    }

    /* Style dla średnich ekranów (tablety) */
    @media (min-width: 768px) and (max-width: 1023px) {
        #przywitanie_uzytkownika {
            font-size: 48px;
        }
        #nawigacja
        {
            margin-top:-10px;
        }

        #dodaj_produkt b, #usun_produkt b, #pokaz_liste b {
            font-size: 26px;
        }
    }

    /* Style dla dużych ekranów (komputery) */
    @media (min-width: 1024px) {

    }
</style>



</head>

<body>

<div id = "container">
        
     <div id = "logo">
        <span style = "color: red;">My</span><span style = "color: white;">Basket</span><span style = "color: green;">Shop</span>
    </div>

    <div id = "tlo">               
        <?php
            echo '<a href = "logout.php">Wyloguj sie</a>';
            echo '<div id = "przywitanie_uzytkownika"> <p>Witaj '.$_SESSION['login'].'!</div>';
        ?>
        <nav id = "nawigacja">
            <a href = "dodaj_produkt.php">
                <div id = "dodaj_produkt"> 
                    <i class="icon-cart-plus"></i>
                    </br><b>Dodaj produkt</b>
                </div>
            </a>

            <a href = "usun.php">
                <div id = "usun_produkt">
                <i class="icon-trash"></i>
                    </br><b>Usuń produkt</b>
                </div>
            </a>

            <a href = "lista.php">
                <div id = "pokaz_liste">
                    <i class="icon-doc-text-inv"></i>
                    </br><b>Lista</b>
                </div>
            </a>
        </nav>
    </div>

    
</div>

</body>