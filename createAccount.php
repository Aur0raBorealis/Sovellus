<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		TeHoChat
	</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/teHoChat.css" rel="stylesheet">
</head>
<body>
    <div id="header-wrapper">
        <div id="header" class="container">
            <div id="logo">
                <span class="icon icon-group"></span>
                <h1><a href="#">TeHoChat</a></h1>
            </div>
            <div id="triangle-up"></div>
            </div>
    </div>
    <?php 
        include("includes/iheader.php");
        include("includes/inavCreateAccount.php");
        include("forms/fcreateAccount.php");
        require_once("functions/functions.php");

        //Lomakkeen submit painettu?
        if(isset($_POST['submitUser'])){
            //Tarkistetaan syötteet myös palvelimella
            //if(!preg_match('/^\+358[0-9]{9}$ || /^\358[0-9]{9}$/', $_POST['givenPhoneNumber'])){

            if(!preg_match('/^\+358[0-9]{9}$/', $_POST['givenPhoneNumber'])){
                $_SESSION['swarningInput']="Laiton puh1";

            }else if(strlen($_POST['givenPassword']) < 8){
                $_SESSION['swarningInput']="Laiton salasana (min 8 merkkiä)";

            }else if($_POST['givenPassword'] != $_POST['givenPasswordVerify']){
                $_SESSION['swarningInput']="Annettu ja vahvistettu salasanat eivät ole samoja";
                    
            }else{
                unset($_SESSION['swarningInput']);
                //1. Tiedot sessioon
                $_SESSION['suserName']=$_POST['givenUsername'];
                $_SESSION['sloggedIn']="yes";
                $_SESSION['suserNumber']= $_POST['givenPhoneNumber'];
                //2. Tiedot kantaan - kesken
                //Testataan pääsivulle paluu
                //Palataan pääsivulle jos tallennus onnistui -kesken   

                $data['name'] = $_POST['givenUsername'];
                $data['phoneNumber'] = $_POST['givenPhoneNumber'];
                $added='#â‚¬%&&/'; //suolataan annettu salasana
                $data['password'] = password_hash($_POST['givenPassword'].$added, PASSWORD_BCRYPT);
                try {
                    //***Käyttäjätunnus ei saa olla käytetty aiemmin
                    $sql = "SELECT COUNT(*) FROM TeHoChat_user where userName  =  " . "'".$_POST['givenUsername']."'"  ;
                    //***Numero ei saa olla käytetty aiemmin
                    //$sql = "SELECT COUNT(*) FROM TeHoChat_user where userPhoneNumber  =  " . "'".$_POST['givenPhoneNumber']."'"  ;

                    $kysely=$DBH->prepare($sql);
                    $kysely->execute();				
                    $tulos=$kysely->fetch();
                    if($tulos[0] == 0){ //Puhelin ei ole käytössä
                        $STH = $DBH->prepare("INSERT INTO TeHoChat_user (userName, userPhoneNumber, userPassword) VALUES (:name, :phoneNumber, :password);");
                        $STH->execute($data);
                        header("Location: index.php"); //Palataan pääsivulle kirjautuneena
                    }else{
                        $_SESSION['swarningInput']="Phone is reserved";
                    }
                }catch(PDOException $e) {
                    file_put_contents('log/DBErrors.txt', 'signInUser.php: '.$e->getMessage()."\n", FILE_APPEND);            $_SESSION['swarningInput'] = 'Database problem';
                }  
            } 
        }      
    ?>
    <?php
        //Luovutetaanko ja palataan takaisin pääsivulle alkutilanteeseen
        if(isset($_POST['submitBack'])){
            session_unset();
            session_destroy();
            header("Location: index.php");
        }
    ?>
    <?php
        //Näytetäänkö lomakesyötteen aiheuttama varoitus?
        if(isset($_SESSION['swarningInput'])){
            echo("<p class=\"warning\">ILLEGAL INPUT: ". $_SESSION['swarningInput']."</p>");
        }
    ?>
    <?php
        include("includes/ifooter.php");
    ?>
</body>