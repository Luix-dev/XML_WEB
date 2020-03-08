<?php
$rooms = simplexml_load_file("./reservation.xml") or die("Fehler: Datei nicht gefunden");
$roomid = $_POST["room"];
$vorname = $_POST["vorname"];
$nachname = $_POST["nachname"];
$ort = $_POST["ort"];
$plz = $_POST["plz"];
$adresse = $_POST["adresse"];
$telefon = $_POST["telefon"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$sport = $_POST["sport"];
$date = date('c');

$roomid = ltrim($roomid, "0")-1;
unset($rooms->room[$roomid]->reservationStatus);
unset($rooms->room[$roomid]->reservation);
$child = $rooms->room[$roomid]->addChild("reservationStatus", "Belegt");
$child = $rooms->room[$roomid]->addChild("reservation");
$child->addChild("name", $vorname);
$child->addChild("surname", $nachname);
$child->addChild("gender", $gender);
$child->addChild("ort", $ort);
$child->addChild("plz", $plz);
$child->addChild("address", $adresse);
$child->addChild("tel", $telefon);
$child->addChild("email", $email);
$child->addChild("sport", $sport);
$child->addChild("reservationDate", $date);
$rooms->asXML("./reservation.xml");
?>