<?php
$sportarten = simplexml_load_file("./wassersport.xml") or die("Fehler: Datei nicht gefunden");
$rooms = simplexml_load_file("./reservation.xml") or die("Fehler: Datei nicht gefunden");
(isset($_GET["roomid"])) ? $roomid = $_GET["roomid"] : $roomid=01;
?>
<html lang="en">
            <!-- Header mit meta und Links-->
            <head>
                <title>Wassersport!</title>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
                        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
                        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
                        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
                <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>                 
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
                                    <a href="./index.html">HOME</a>
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
                                    <a href="./about.html">ABOUT</a>
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