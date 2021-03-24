<?php
$user = 'anatolru';
$pass = 'FN2000';
$host = 'mysql.metropolia.fi';
$dbname = 'anatolru';
$added = '#â‚¬%&&/'; 
$passwordAdded = $password.$added; 

//Tietokantayhteys sulkeutuu automaattisesti kun </htm> eli sivun scripti loppuu
//Normaali olion elinkaari
try { //Avataan viittaus tietokantaan
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // virheenkasittely: virheet aiheuttavat poikkeuksen
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	// merkistö utf8
	$DBH->exec("SET NAMES utf8;");
    //echo "Yhteys OK."; //Kommentoi pois validoitavassa versiossa
} catch(PDOException $e) {
	echo "Yhteysvirhe: " . $e->getMessage(); 
	file_put_contents('log/DBErrors.txt', 'Connection: '.$e->getMessage()."\n", FILE_APPEND);
}//HUOM hakemistopolku!
?>
