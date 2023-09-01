<?php
session_start();
if(isset($_POST['nazwa_produktu']) and  isset($_POST['kategoria']))
{
    $produkt = $_POST['nazwa_produktu'];
    $kategoria = $_POST['kategoria'];

    require_once"connect.php";
    $polaczenie = @new mysqli($host, $db_user,$db_haslo,$db_name);
    if($polaczenie->connect_errno!=0)
    {
        echo 'Error:'.$polaczenie->connect_errno;
    }
    else
    {
        $usun = true;
        $klucz_obcy = intval($_SESSION['id_uzytkownika']);

        if(strlen($produkt) < 1 and strlen($kategoria) < 1)
        {
            $usun = false;
            $_SESSION['informacja'] = 'Musisz wpisac nazwe produktu i kategorii';
        }
        else
        {

            $sql = "SELECT * FROM produkty WHERE produkt = '$produkt' and kategoria = '$kategoria' and id_uzytkownika ='$klucz_obcy'";
            $rezultat = $polaczenie->query($sql);
            if ($rezultat->num_rows > 0) 
            {
                $rezultat = $polaczenie->query("DELETE FROM produkty WHERE  produkt = '$produkt' and kategoria = '$kategoria' and id_uzytkownika ='$klucz_obcy'");
                $_SESSION['informacja'] =  "Produkt usunieto.";
            } else 
            {
                $_SESSION['informacja'] = "Na liscie nie ma podanych danych";
            }
        }
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
    <link rel="stylesheet" href ="usun.css"/>
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
                    <h2>Wpisz nazwe produktu i katetogie ktora chcesz usunac</h2>
                </div> 

                <form action = "#" method = "post">

                <div class = "dodaj_produkt">
                        <input type = "text" placeholder = "Produkt" name = "nazwa_produktu"></br>
                        <input type = "text" placeholder = "Kategoria" name = "kategoria"></br>
                </div>  
                <div id = "zatwierdz">
                    <input type = "submit" value = "zatwierdz">
                </div>
                    <?php
                        if(isset($_SESSION['informacja']))
                        {
                            echo '<div id = "informacja">'.$_SESSION['informacja'].'</div>';
                            unset($_SESSION['informacja']);
                        }
                    ?>
                </form>
        </div>
    </div>
</body>