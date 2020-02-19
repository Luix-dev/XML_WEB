<?xml version="1.0" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/activities">
        <html>
            <head>
                <link rel="stylesheet" href="scss/style.css" />
                <title>Wassersport!</title>
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
            <h2><xsl:value-of select="Title" /></h2>
            <p><i><xsl:value-of select="Beschreibung" /></i></p>
            <p>Schwierigkeit: <xsl:value-of select="Schwierigkeit" /> </p>
            <xsl:variable name="link" select="Title"/>
            <xsl:variable name="alt" select="Beschreibung"/>
            <img src="bilder/{$link}.jpg"
                alt="{$alt}"/>

        </div>
        <!-- Bilder -->
    </xsl:template>

    <!-- Just a test template to lead picture name with current sporttitle-->
    <xsl:template match="images/single_image">
        <xsl:value-of select="single_image"></xsl:value-of>
    </xsl:template>
</xsl:stylesheet>
