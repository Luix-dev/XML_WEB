<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
    <head>
        <title>Wassersport!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="scss/style.css" />
        <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    </head>
    <body>
        <!-- NAV BAR -->
        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-3 sidenav navigation">
                    <h4>XML Blockwoche</h4>
                    <ul class="nav flex-column">
                        <li>
                            <a href="./index.xhtml">HOME</a>
                        </li>
                        <li class="active">
                            <a href="#">ANGEBOT</a>
                        </li>
                        <li>
                            <a href="./events.xml">EVENTS</a>
                        </li>
                        <li>
                            <a href="./reservation.xml">RESERVATION</a>
                        </li>
                        <li>
                            <a href="./about.xhtml">ABOUT</a>
                        </li>
                    </ul>
                    <br />
                </div>
                <!-- CONTENT -->
                <div class="col-sm-9">
                    <h4>
                        <small>Wassersport für Gehbehinderte</small>
                    </h4>
                    <hr />
                   <div class="section">
                      <?php
                        $proc=new XsltProcessor;
                        $proc->importStylesheet(DOMDocument::load("xsl/wassersport_new.xsl")); //load XSL script
                        echo $proc->transformToXML(DOMDocument::load("wassersport.xml")); //load XML file and echo
                       ?>

                        <?php require 'api_call.php'; ?>
                        <br/>
                        <!--
                        Email Senden:
                        <form action="sendMail.php" method="post">
                            E-mail: <input type="text" name="email"><br>
                            <input type="submit">
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
