<?php
$rooms = simplexml_load_file("./reservation.xml") or die("Fehler: Datei nicht gefunden");
$roomid = htmlspecialchars($_POST["room"]);
$vorname = htmlspecialchars($_POST["vorname"]);
$nachname = htmlspecialchars($_POST["nachname"]);
$ort = htmlspecialchars($_POST["ort"]);
$plz = htmlspecialchars($_POST["plz"]);
$adresse = htmlspecialchars($_POST["adresse"]);
$telefon = htmlspecialchars($_POST["telefon"]);
$email = htmlspecialchars($_POST["email"]);
$gender = htmlspecialchars($_POST["gender"]);
$sport = htmlspecialchars($_POST["sport"]);
$from = htmlspecialchars($_POST["from"]);
$to = htmlspecialchars($_POST["to"]);
$date = date('c');
$xsd = 'xsd/reservations.xsd';

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
$child->addChild("reservationFrom", $from);
$child->addChild("reservationTo", $to);
$child->addChild("reservationDate", $date);

$testData = $rooms->asXML();
$xml = new DOMDocument();
$xml->loadXML($testData);
libxml_use_internal_errors(true);

if($xml->schemaValidate($xsd)) {
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

    header('Content-type: application/pdf');
    header('Content-Disposition: attachment; filename=reservation.pdf');
    header('Content-Transfer-Encoding: binary');
    $file = 'reservation.pdf';
    readfile($file);

    header('Location: reservation.xml');
}
else {
    echo "Mit Ihren eingegeben Daten stimmt etwas nicht!";
}
?>