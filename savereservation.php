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
$rooms->room[$roomid]->asXML("./singleReservation.xml");

#Generate PDF
    require_once 'fop_service_client.php';

    // load XML
    $data = file_get_contents('singleReservation.xml');
    $xml = new DOMDocument();
    $xml->loadXML($data);

    // load XSL
    $xsl = new DOMDocument();
    $xsl->load('xsl/reservation_fo.xsl');

    // transform
    $processor = new XSLTProcessor();
    $processor->importStylesheet($xsl);
    $newDom = $processor->transformToDoc($xml);

    $newDom->save("reservation.fo");

    // locate the source FO file.
    $foFile = 'reservation.fo';

    // create an instance of the FOP client and perform service request.
    $serviceClient = new FOPServiceClient();
    $pdfFile = $serviceClient->processFile($foFile);

#TODO: child + fo = PDF
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename=reservation.pdf');
header('Content-Transfer-Encoding: binary');
$file = 'reservation.pdf';
readfile($file);

header('Location: reservation.xml');
?>