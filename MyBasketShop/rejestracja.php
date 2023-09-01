<?php
session_start();

if(isset($_POST['email']))
{
    $udana_rejestracja = true;

    $nick = $_POST['nick'];
    if(strlen($nick) < 3 || strlen($nick) > 20)
    {
        $udana_rejestracja = false;
        $_SESSION['e_nick'] = "Nick musi zawierac od 3 do 20 znakow";
    }

    if(ctype_alnum($nick)==false)
    {
        $udana_rejestracja = false;
        $_SESSION['e_nick'] = "Nick musi składać sie tylko z liter i cyfr";
    }

    $email=$_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    if(filter_var($emailB,FILTER_VALIDATE_EMAIL)==FALSE || $emailB != $email)
    {
        $udana_rejestracja = false;
        $_SESSION['e_email'] = "Podaj poprawny adres email";
    }

    $haslo = $_POST['haslo'];
    $haslo2 = $_POST['haslo2'];

    if(strlen($haslo)<8)
    {
        $udana_rejestracja=false;
        $_SESSION['e_haslo']= "Hasło musi zawierac minimum 8 znaków";
    }

    if($haslo!=$haslo2)
    {
        $udana_rejestracja=false;
        $_SESSION['e_haslo']= "Podane hasla nie sa identyczne";
    }

    if(!isset($_POST['regulamin']))
    {
        $udana_rejestracja=false;
        $_SESSION['e_regulamin']= "Nie zaakceptowano regulaminu";
    }

    require_once "connect.php";
    try
    {
        $polaczenie = new mysqli($host, $db_user,$db_haslo,$db_name);
        if($polaczenie->connect_errno!=0)
        {
            throw new  Exception(mysqli_connect_errno());
        }
        else
        {
            $rezultat = $polaczenie->query("SELECT id_uzytkownika from uzytkownicy WHERE email = '$email'");
            if(!$rezultat)
            {
                throw new Exception($polaczenie->error);
            }

            $ile_maili = $rezultat->num_rows;
            if($ile_maili>0)
            {
                $udana_rejestracja = false;
                $_SESSION['e_email'] = "Istnieje juz konto o podanym adresie email";
            }
     
            if($udana_rejestracja==true)
            {
                if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL,'$nick','$haslo','$email')"))
                {
                    $_SESSION['udana_rejestracja'] = '<span style = "color: white;"<h3><b>Udana rejestracja</br>Prosze sie zalogować</b></h3></span>';
                    header('Location: Menu.php');
                }
            }

            $polaczenie->close();
        }
    }
    catch(Exception $e)
    {
        echo '<span style = "color: red;">Bład serwera przepraszamy za niedogodnosci. Prosiny o rejestracje w innym terminie</span>';
        echo '</br> Informacje o bledzie '.$e;
    }
}
?>
<!DOCTYPE html>
<html lg ="pl">
<head>
    <meta charset="utf-8"/>
    <meta name ="description" content = "Aplikacja która ma za zadanie pomóc w zapamiętniu zakupów potrzebnych do koszyka"/>
    <meta name = "keywords" content="zakupy, koszyk zakupowy, sklep, sklepy, spożywczak, spożywczy, lista zakupów, lista, zakupy"/>
    <title>Lista zakupow - rejestracja</title>
    <link rel="stylesheet" href ="rejestracja.css"/>
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
                        <h2>Rejestracja</h2>
                        <form action="#" method="post">

                                <div class = "input">
                                   <input type = "text" placeholder="Podaj email" name="email">
                                   <i class="icon-mail-alt"></i>
                                </div>
                            <?php
                                if(isset($_SESSION['e_email']))
                                    {
                                        echo '<div id = "blad_email">'.$_SESSION['e_email'].'</div>';    
                                        unset($_SESSION['e_email']);                                  
                                    } 
                            ?>
                                <div class="input">
                                    <input type = "text" placeholder="podaj nickname" name = "nick">
                                    <i class="icon-user"></i>
                                </div>

                                <?php
                                    if(isset($_SESSION['e_nick']))
                                    {
                                        echo '<div id = "blad_nick">'.$_SESSION['e_nick'].'</div>';    
                                        unset($_SESSION['e_nick']);                                  
                                    }                                
                                ?>

                                <div class="input">
                                    <input type = "password" placeholder="podaj haslo" name = "haslo">
                                    <i class="icon-lock"></i>
                                </div>
                            <?php
                                if(isset($_SESSION['e_haslo']))
                                    {
                                        echo '<div id = "blad_haslo">'.$_SESSION['e_haslo'].'</div>';    
                                        unset($_SESSION['e_haslo']);                                  
                                    } 
                            ?>
                                <div class="input">
                                    <input type = "password" placeholder="powtorz haslo" name = "haslo2">
                                </div>

                                <label><input type = "checkbox" name = "regulamin"> <span style = "color: white;"> Akceptuje regulamin</span></label>
                                <?php
                                if(isset($_SESSION['e_regulamin']))
                                    {
                                        echo '<div id = "blad_regulamin">'.$_SESSION['e_regulamin'].'</div>';    
                                        unset($_SESSION['e_regulamin']);                                  
                                    } 
                            ?>
                                </br></br>
                                <input type="submit" value="Zarejestruj sie">
                                </br></br>
                                <span style = "color: white;"> Masz już konto?</span> <a href = "Zaloguj.php"><span style = "color: blue;">Zaloguj sie!</span></a>
                        </form>

                   </div>

        </div>
    </div>

</body>
</html>