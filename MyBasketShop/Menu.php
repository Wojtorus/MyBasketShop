<?php
    session_start();

?>

<!DOCTYPE html>
<html lg ="pl">
<head>
    <meta charset="utf-8"/>
    <meta name ="description" content = "Aplikacja która ma za zadanie pomóc w zapamiętniu zakupów potrzebnych do koszyka"/>
    <meta name = "keywords" content="zakupy, koszyk zakupowy, sklep, sklepy, spożywczak, spożywczy, lista zakupów, lista, zakupy"/>
    <title>Lista zakupow</title>
    <link rel="stylesheet" href ="Menu.css"/>
    <link rel="stylesheet" href ="css/fontello.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>

</head>
<body>
    <div id = "container">
        
        <div id = "logo">
            <span style = "color: red;">My</span><span style = "color: white;">Basket</span><span style = "color: green;">Shop</span>
        </div>
        <nav id = "Informacje">
            <div id = "Aktualizacja">
              <a href="Aktualizacja.html" class = "titlelink" title="Zobacz najnowsze aktualizacje"> Aktualizacja </a> 
            </div>
            <div id = "Kontakt">
                <a href="Kontakt.html" class = "titlelink" title="Kontakt z biurem"> Kontakt </a>  
            </div>
            <ol>
               Aplikacja
                    <li> <a href="Tworca.html" class = "titlelink"> Twórca </a></li>
                    <li> <a href="Zalozenia.html" class = "titlelink"> Założenia </a></li>
            </ol>
            <div style = "clear: both;"></div>
            
            </nav>
        <div id = "tlo">
                   <div id = "Menu">
                        <a href="Zaloguj.php" >
                            <div class = "wybor">
                                <h2>Zaloguj się</h2>
                            </div>
                        </a>
                        <?php
                            if(isset($_SESSION['udana_rejestracja']))
                            {
                                echo '<div id = "rejestracja_udana">'.$_SESSION['udana_rejestracja'].'</div>';
                                unset($_SESSION['udana_rejestracja']);
                            }
                        ?>
                        <a href="rejestracja.php" >
                            <div class = "wybor">
                                <h2>Rejestracja</h2>
                            </div>
                        </a>

                   </div>
        </div>
    </div>
</body>
</html>