<?xml version="1.0" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/activities">
        <html>
            <head>
                <link rel="stylesheet" href="scss/style.css" />
            </head>
            <body>
                <navigation class="navigation">
                    <a href="#">HOME</a>
                    <a href="#">EVENTS</a>
                    <a href="#">KONTAKT</a>
                </navigation>

                <section>
                    <h1>Sportarten</h1>
                    <article>
                        <!-- Apply Template Sportarten-->
                        <xsl:apply-templates select="activity[starts-with(Art/text(), 'Sport')]"/>
                    </article>

                    <h1>Events</h1>
                    <article>
                        <!-- Apply Template Events -->
                        <xsl:apply-templates select="activity[starts-with(Art/text(), 'Event')]"/>
                    </article>
                    
                </section>
               

            </body>
        </html>
    </xsl:template>

    <xsl:template match="activity">
        <div class="sportelement">
            <xsl:value-of select="Title" /> <br />
            <xsl:value-of select="Beschreibung" /> <br />
            <xsl:value-of select="Art"/> <br />
            <xsl:value-of select="Schwierigkeit" /> <br />
        </div>
        <!-- Bilder -->
    </xsl:template>
</xsl:stylesheet>
