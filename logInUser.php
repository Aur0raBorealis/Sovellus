<?php 
    include("includes/iheader.php");
    include("includes/inavLogInUser.php"); 
    include("forms/flogInUser.php"); 
    include("includes/iheader.php");
?>
<?php
    //Lomakkeen submit painettu?
    if(isset($_POST['submitUser'])){
        unset($_SESSION['swarningInput']);  
        try {
            //Tiedot kannasta, hakuehto
            $data['name'] = $_POST['givenUsername'];
            $STH = $DBH->prepare("SELECT userPassword FROM TeHoChat_user WHERE userName = :name;");
            $STH->execute($data);
            $STH->setFetchMode(PDO::FETCH_OBJ);
            $tulosOlio=$STH->fetch();
            //lomakkeelle annettu salasana + suola
            $givenPasswordAdded = $_POST['givenPassword'].$added; //$added löytyy cconfig.php

            //Löytyikö tunus kannasta?   
            if($tulosOlio!=NULL){
                //Tunnus löytyi
                // var_dump($tulosOlio);
                if(password_verify($givenPasswordAdded,$tulosOlio->userPassword)){
                    $_SESSION['sloggedIn']="yes";
                    $_SESSION['suserName']=$tulosOlio->userName;
                    header("Location: index.php"); //Palataan pääsivulle kirjautuneena
                }else{
                    $_SESSION['swarningInput']="Wrong password";
                }
            }else{
                $_SESSION['swarningInput']="Wrong email";
            }
        } catch(PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'signInUser.php: '.$e->getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Database problem';
        }        
    }
?>
<?php
    //***Luovutetaanko ja palataan takaisin pääsivulle alkutilanteeseen
    //ilma  rekisteröintiä?
    if(isset($_POST['submitBack'])){
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
?>
<?php
    //***Näytetäänkö lomakesyötteen aiheuttama varoitus?
    if(isset($_SESSION['swarningInput'])){
        echo("<p class=\"warning\">ILLEGAL INPUT: ". $_SESSION['swarningInput']."</p>");
    }
?>
