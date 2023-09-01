<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lg ="pl">
<head>
    <meta charset="utf-8"/>
    <meta name ="description" content = "Aplikacja która ma za zadanie pomóc w zapamiętniu zakupów potrzebnych do koszyka"/>
    <meta name = "keywords" content="zakupy, koszyk zakupowy, sklep, sklepy, spożywczak, spożywczy, lista zakupów, lista, zakupy"/>
    <title>Lista zakupow - zaloguj sie</title>
    <link rel="stylesheet" href ="Zaloguj.css"/>
    <link rel="stylesheet" href ="fontello/css/fontello.css"/>
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
                        <h2>Zaloguj się</h2>
                        <form action="Zaloguj_PHP.php" method="post">

                                <div class = "input">
                                    <i class="icon-mail-alt"></i>
                                <label> <input type = "text" placeholder="Podaj email" name="email"></label>
                                </div>

                                <div class = "input">
                                    <i class="icon-lock"></i>
                                    <label> <input type = "password" placeholder="Podaj hasło" name="haslo"></label>
                                </div>
                                    
                                          <?php  
                                          if(isset($_SESSION['blad'])) 
                                          {
                                          echo '<div id = "blad">'.$_SESSION['blad'].'</div>'; 
                                          unset($_SESSION['blad']);
                                          }
                                          ?>                                     

                                <input type="submit" value="zaloguj sie"> </br></br></br></br></br></br></br>
                                <span style = "color: white;"> Nie masz jeszcze konta?</span> <a href = "rejestracja.php"> <span style = "color: blue;">Zarejestruj sie!</span></a>
                        </form>

                   </div>

        </div>
    </div>

</body>
</html>