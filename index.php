<?php
include 'autoloader.php';
//require __DIR__ . "/lib/Liste.php";
//require __DIR__ . ";


//$notiz1 = new Notiz;

//$notiz1->setNotizInhalt('Meeting wurde auf über morgen verschoben');
//$notiz1->setListe(Liste::loadById(24));
//$notiz1->save();
//var_dump($notiz1->getId());

//$listeee = new Liste;
//try {
//  $listeee->setName('Ausblidung');
//} catch (Exception $e) {
//  echo 'Exception abgefangen: ', $e->getMessage(), "\n";
//}

//$listeee->setZulaessigeBeitraegeZahl(6);
//$listeee->save();


$notiz = Notiz::loadById(47);
var_dump($notiz);
//$notiz->delete();
//var_dump($notiz);
$notiz->delete();
/**
 * $liste = Liste::loadById(70);
 * $liste->delete();
 * var_dump($liste);
 *
 */