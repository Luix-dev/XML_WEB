<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
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
                <script xmlns="http://www.w3.org/1999/xhtml"><![CDATA[
                            function get_votes(int) {
                            if (window.XMLHttpRequest) {
                                // script for browser version above IE 7 and the other popular browsers (newer browsers)
                                xmlhttpreq = new XMLHttpRequest();
                            } else {  
                                // script for the IE 5 and 6 browsers (older versions)
                                xmlhttpreq = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            xmlhttpreq.onreadystatechange = function() {
                              //check if server response is ready  
                              if (this.readyState == 4 && this.status==200) {
                                document.getElementById("ajax_poll").innerHTML=this.responseText;
                              }
                            }
                            xmlhttpreq.open("GET","poll_votes.php?res="+int,true);
                            xmlhttpreq.send();
                          }
                ]]></script>
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
                                <li class="active">
                                    <a href="#">EVENTS</a>
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

                        <div class="col-sm-9">
                            <h4>
                            <small>Events</small>
                            </h4>
                            <hr />
                
                            <section>
                                <h2>Umfrage</h2>
                                <div id="ajax_poll">
                                    <form>
                                        <h4><xsl:value-of select="(//Title)[1]"/></h4>
                                        <input type="radio" name="res" value="0"></input>                      
                                        <h4><xsl:value-of select="(//Title)[2]"/></h4>
                                        <input type="radio" name="res" value="1"></input>
                                        <h4><xsl:value-of select="(//Title)[3]"/></h4>
                                        <input type="radio" name="res" value="2"></input>
                                        <br/>
                                        <input type="button" name="res" value="Bestätigen" onclick="get_votes(res.value)"></input>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>