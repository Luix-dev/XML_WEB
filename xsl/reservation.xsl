<?xml version="1.0" ?>
<xsl:stylesheet 
    version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:nsm="https://stahlreck.internet-box.ch/xml/reservations">
    <xsl:template match="/nsm:rooms">
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
                                    <a href="#">RESERVATION</a>
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
                                <h2>Buchen Sie sich jetzt ihr bequemes Zimmer!</h2>
                                <xsl:apply-templates select="nsm:room" />
                                <h2>Sie können ebenfalls eine unserer Hallen nur für sich und ihre Gruppe reservieren!</h2>
                                <p>Platzhalter (optional): Reservation von Sporthallen wenn nötig?</p>
                            </section>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="nsm:room">
    <div class="room">
        <h2>Zimmer <xsl:value-of select="@number" /></h2>
        <div class="raumbeschreibung">
            <ul>
                <li>
                    <img class="icon" src="bilder/zimmericons/person.png" alt="Zimmerkategorie" />
                    <p><xsl:value-of select="nsm:category" /></p>
                </li>
                <li>
                    <img class="icon" src="bilder/zimmericons/size.png" alt="Zimmergrösse" />
                    <p><xsl:value-of select="nsm:size" /> m<sup>2</sup></p>
                </li>
                <li>
                    <xsl:if test="@accessibility = 'true'">
                        <img src="bilder/zimmericons/accessible.png" alt="Behindertengerecht" />
                    </xsl:if>
                    <xsl:if test="@accessibility = 'false'">
                    <img src="bilder/zimmericons/not-accessible.png" alt="Nicht behindertengerecht" />
                    </xsl:if>
                </li>
                <li>
                    <xsl:if test="nsm:reservationStatus = 'Verfügbar'">
                        <img class="icon" src="bilder/zimmericons/check.png" alt="Verfügbar" />
                    </xsl:if>
                    <xsl:if test="nsm:reservationStatus = 'Belegt'">
                        <img class="icon" src="bilder/zimmericons/kreuz.png" alt="Belegt" />
                    </xsl:if>
                    <p><xsl:value-of select="nsm:reservationStatus" /></p>
                </li>
            </ul>
        </div>
        <div class="raumaktionen">
            <xsl:variable name="roomID" select="@number" />
            <button type="button" onclick="window.location='reservationform.php?roomid={$roomID}'">Zimmer reservieren</button>
            <a data-fancybox="" data-src="#hidden-content" href="javascript:;">Mehr anzeigen...</a>
        </div>
        <div class="more-content">
            <div style="display: none;" id="hidden-content">
                <h2>Zimmer <xsl:value-of select="@number" /></h2>
                <div>
                    <p><xsl:value-of select="nsm:category" /></p>
                </div>
                <div>
                    <p><xsl:value-of select="nsm:size" /> m<sup>2</sup></p>
                </div>
                <div>
                    <xsl:if test="@accessibility = 'true'">
                        <img src="bilder/zimmericons/accessible.png" alt="Behindertengerecht" />
                    </xsl:if>
                    <xsl:if test="@accessibility = 'false'">
                        <img src="bilder/zimmericons/not-accessible.png" alt="Nicht behindertengerecht" />
                    </xsl:if>
                </div>
                <div>
                    <xsl:if test="nsm:reservationStatus = 'Verfügbar'">
                        <img class="icon" src="bilder/zimmericons/check.png" alt="Verfügbar" />
                    </xsl:if>
                    <xsl:if test="nsm:reservationStatus = 'Belegt'">
                        <img class="icon" src="bilder/zimmericons/kreuz.png" alt="Belegt" />
                    </xsl:if>
                    <p><xsl:value-of select="nsm:reservationStatus" /></p>
                </div>
                <div class="raumaktionen">
                    <xsl:variable name="roomID" select="@number" />
                    <button type="button" onclick="window.location='reservationform.php?roomid=$roomID'">Zimmer reservieren</button>
                </div>
            </div>
        </div>
    </div>
  </xsl:template>
</xsl:stylesheet>