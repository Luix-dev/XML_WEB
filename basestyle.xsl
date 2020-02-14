<?xml version="1.0" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
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
                    <article>
                        <h1>Sportarten</h1>
                        <!-- Apply Template Sportarten-->
                        <xsl:apply-templates select="activity[starts-with(Art/text(), 'Sport')]"/>
                    </article>

                    <article>
                        <h1>Events</h1>
                        <!-- Apply Template Events -->
                        <xsl:apply-templates select="activity[starts-with(Art/text(), 'Event')]"/>
                    </article>
                    
                </section>
               

            </body>
        </html>
    </xsl:template>

    <xsl:template match="activity">
        <xsl:value-of select="Titel" />
        <xsl:value-of select="Beschreibung" />
        <xsl:value-of select="Art"/>
        <xsl:value-of select="Schwierigkeit" />
        <!-- Bilder -->
    </xsl:template>
</xsl:stylesheet>
