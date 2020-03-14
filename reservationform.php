<?php
//ToDo: Datum (von/bis) für Zimmerreservation
// escapen von allem
$sportarten = simplexml_load_file("./wassersport.xml") or die("Fehler: Datei nicht gefunden");
$rooms = simplexml_load_file("./reservation.xml") or die("Fehler: Datei nicht gefunden");
(isset($_GET["roomid"])) ? $roomid = $_GET["roomid"] : $roomid=01;
?>
<?xml version="1.0" encoding="utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
            <!-- Header mit meta und Links-->
            <head>
                <title>Wassersport!</title>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
                <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
                <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>                 
                <link rel="stylesheet" href="scss/style.css" />
                <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
            </head>
            <body>
                <div class="container-fluid">
                    <div class="row content">
                        <div class="col-sm-3 sidenav navigation">
                            <h4>XML Blockwoche</h4>
                            <ul class="nav flex-column">
                                <li>
                                    <a href="./index.xhtml">HOME</a>
                                </li>
                                <li>
                                    <a href="./sports.php">ANGEBOT</a>
                                </li>
                                <li>
                                    <a href="./events.xml">EVENTS</a>
                                </li>
                                <li class="active">
                                    <a href="./reservation.xml">RESERVATION</a>
                                </li>
                                <li>
                                    <a href="./about.xhtml">ABOUT</a>
                                </li>
                            </ul>
                            <br />
                        </div>

                        <div class="col-sm-9">
                            <h4>
                            <small>Reservationen</small>
                            </h4>
                            <hr />
                
                            <section>
                                <form action="./savereservation.php" method="post">
                                    <label>Vorname:</label>
                                    <input type="text" id="vorname" name="vorname" required="required" /><br />
                                    <label>Nachname:</label>
                                    <input type="text" id="nachname" name="nachname" required="required" /><br />
                                    <label>Ort:</label>
                                    <input type="text" id="ort" name="ort" required="required" />
                                    <label>PLZ:</label>
                                    <input type="text" id="plz" name="plz" required="required" /><br />
                                    <label>Adresse:</label>
                                    <input type="text" id="adresse" name="adresse" required="required" /><br />
                                    <label>Telefon:</label>
                                    <input type="text" id="telefon" name="telefon" placeholder="0780000000" required="required" /><br />
                                    <label>E-Mail:</label>
                                    <input id="email" name="email" type="email" placeholder="example@company.ch"  required="required"><br />
                                    <input type="radio" id="male" name="gender" value="male">
                                    <label for="male">Herr</label><br>
                                    <input type="radio" id="female" name="gender" value="female">
                                    <label for="female">Frau</label><br>
                                    <input type="radio" id="other" name="gender" value="other">
                                    <label for="other">Other</label><br />
                                    <label>Zimmer:</label>
                                    <select id="room" name="room">
                                        <?php foreach($rooms->children() as $room) {
                                            if($room->reservationStatus == "Verfügbar") {
                                                if($roomid==$room['number']) {
                                                    echo '<option selected="selected" value='.$room['number'].'>Zimmer '.$room['number'].'</option>';
                                                }
                                                else {
                                                    echo '<option value='.$room['number'].'>Zimmer '.$room['number'].'</option>';
                                                }
                                            }
                                        }?>
                                    </select><br />
                                    <label>Sportart:</label>
                                    <select id="sport" name="sport">
                                        <?php foreach($sportarten->children() as $sportart) {
                                            echo '<option value='.$sportart->Title.'>'.$sportart->Title.'</option>';
                                        }?>
                                    </select><br />
                                    <input type="submit" value="Reservieren">
                                </form>
                                <a href="./reservation.xml">Zurück</a>
                            </section>
                        </div>
                    </div>
                </div>
            </body>
        </html>