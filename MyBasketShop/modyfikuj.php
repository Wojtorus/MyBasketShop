<?php
session_start();

if(isset($_GET['id']))
{
require_once"connect.php";
$polaczenie = new mysqli($host, $db_user,$db_haslo,$db_name);
if($polaczenie->connect_errno!=0)
{
    echo 'Error:'.$polaczenie->connect_errno;
}
else
{
    $id = $_GET['id'];
    $sql = "SELECT  produkt,ilosc,cena,kategoria FROM produkty where $id = id_produktu";
    if($rezultat = $polaczenie->query($sql))
    {
        $wiersz = $rezultat->fetch_assoc();
        $_SESSION['produkt'] = $wiersz['produkt'];
        $_SESSION['ilosc'] = $wiersz['ilosc'];
        $_SESSION['cena'] = $wiersz['cena'];
        $_SESSION['kategoria'] = $wiersz['kategoria'];
        $_SESSION['id'] = $id;
    }
}
$polaczenie->close();
}
?>

<!DOCTYPE html>
<html lg ="pl">
<head>
    <meta charset="utf-8"/>
    <meta name ="description" content = "Aplikacja która ma za zadanie pomóc w zapamiętniu zakupów potrzebnych do koszyka"/>
    <meta name = "keywords" content="zakupy, koszyk zakupowy, sklep, sklepy, spożywczak, spożywczy, lista zakupów, lista, zakupy"/>
    <title>Lista zakupow</title>
    <link rel="stylesheet" href ="modyfikuj.css"/>
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
            <h2>Edytuj wybrana rubryke</h2>
        </div>

        <div id = "menu">
            <div id = "historia_tabeli">
                    <div class = "wyswietl">
                        produkt
                    </div>

                    <div class = "wyswietl">
                        ilosc
                    </div>

                    <div class = "wyswietl">
                        cena
                    </div>

                    <div class = "wyswietl">
                        kategoria
                    </div>  
            </div>          
             <div id = "edycja">
                        <form action = "zmiana_prod.php" method = "post">
                            <div class = "produkt"><input type = "text" value = "<?php echo $_SESSION['produkt'] ?>" name = "nazwa_produktu"></div>
                            <div class = "produkt"><input type = "text" value =  "<?php echo $_SESSION['ilosc'] ?>" name = "ilosc"></div>
                            <div class = "produkt"><input type = "text" value = "<?php echo $_SESSION['cena'] ?>" name = "cena"></div>
                            <div class = "produkt"><input type = "text" value =  "<?php echo $_SESSION['kategoria'] ?>" name = "nazwa_kategorii"></div>
            </div> 
                            <div id = "zatwierdz">
                                <input type = "submit" value = "zatwierdz">
                            </div>
                        </from>
            </div> 
            <?php
                if(isset($_SESSION['informacja_zwrotna']))
                {
                    echo '<div id = "infprmacja">'.$_SESSION['informacja_zwrotna'].'</div>';
                    unset($_SESSION['informacja_zwrotna']);
                }
            ?>
    </div>
</div>
    </body>