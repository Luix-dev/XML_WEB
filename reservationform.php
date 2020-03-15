<?php
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
        
                    <div class="section">
                        <form action="./savereservation.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Vorname:</label>
                                    <input type="text" id="vorname" class="form-control" name="vorname" required="required" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nachname:</label>
                                    <input type="text" id="nachname" class="form-control" name="nachname" required="required" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Adresse:</label>
                                    <input type="text" id="adresse" class="form-control" name="adresse" required="required" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Ort:</label>
                                    <input type="text" id="ort" class="form-control" name="ort" required="required" />
                                </div>
                                <div class="form-group col-md-2">
                                    <label>PLZ:</label>
                                    <input type="text" id="plz" class="form-control" name="plz" required="required" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Telefon:</label>
                                    <input type="text" id="telefon" class="form-control" name="telefon" placeholder="0780000000" required="required" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>E-Mail:</label>
                                    <input id="email" name="email" class="form-control" type="email" placeholder="example@company.ch"  required="required" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="male" class="form-check-input" name="gender" value="male" />
                                    <label for="male" class="form-check-label">Herr</label>
                                </div> 
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="female" class="form-check-input" name="gender" value="female" />
                                    <label for="female" class="form-check-label">Frau</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="other" class="form-check-input" name="gender" value="other" checked="checked" />
                                    <label for="other" class="form-check-label">Other</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Von:</label>
                                    <input type="date" id="from" class="form-control" name="from" min="<?php echo date('Y-m-d');?>" required="required" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Bis:</label>
                                    <input type="date" id="to" class="form-control" name="to" min="<?php echo date('Y-m-d');?>" required="required" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Zimmer:</label>
                                    <select id="room" class="form-control" name="room">
                                        <?php foreach($rooms->children() as $room) {
                                            if($room->reservationStatus == "Verfügbar") {
                                                if($roomid==$room['number']) {
                                                    echo '<option selected="selected" value="'.$room['number'].'">Zimmer '.$room['number'].'</option>';
                                                }
                                                else {
                                                    echo '<option value="'.$room['number'].'">Zimmer '.$room['number'].'</option>';
                                                }
                                            }
                                        }?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sportart:</label>
                                    <select id="sport" class="form-control" name="sport">
                                        <?php foreach($sportarten->children() as $sportart) {
                                            echo '<option value="'.$sportart->Title.'">'.$sportart->Title.'</option>';
                                        }?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Resevieren</button>
                            <a href="./reservation.xml" class="btn">Zurück</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>