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
                                <a href="./index.html">HOME</a>
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
                                <a href="./about.html">ABOUT</a>
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
                       <section>
                            <?php
                            $proc=new XsltProcessor;
                            $proc->importStylesheet(DOMDocument::load("xsl/wassersport_new.xsl")); //load XSL script
                            echo $proc->transformToXML(DOMDocument::load("wassersport.xml")); //load XML file and echo
                            ?>

                            <?php require 'api_call.php'; ?>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <footer class="container-fluid">
        <p>Footer Text</p>
        </footer>
    </body>
</html>
