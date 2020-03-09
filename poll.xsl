<?xml version="1.0" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:svg="http://www.w3.org/2000/svg">
    <xhtml:script xmlns:xhtml="http://www.w3.org/1999/xhtml" src="file.js" type="application/javascript" />
    <xsl:template match="/">
        <html>
            <head>
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
            </head>
            <body>
                <div id="ajax_poll">
                    <h3>Umfrage</h3>
                    <form>
                        <h4><xsl:value-of select="(//Title)[1]"/></h4>
                        <input type="radio" name="res" value="0" onclick="get_votes(this.value)"></input>                      
                        <h4><xsl:value-of select="(//Title)[2]"/></h4>
                        <input type="radio" name="res" value="1" onclick="get_votes(this.value)"></input>
                        <h4><xsl:value-of select="(//Title)[3]"/></h4>
                        <input type="radio" name="res" value="2" onclick="get_votes(this.value)"></input>
                    </form>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>