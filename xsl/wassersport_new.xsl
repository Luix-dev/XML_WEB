<?xml version="1.0" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="/activities">
        <!--Sportarten -->
        <h2>Sportarten</h2>
        <article>
          <!-- Apply Template Sportarten-->
          <xsl:apply-templates select="activity[starts-with(Art/text(), 'Sport')]" />
        </article>

        <br />
        <br />


        <!--Events -->
        <h2>Events</h2>
        <article>
          <!-- Apply Template Events -->
          <xsl:apply-templates select="activity[starts-with(Art/text(), 'Event')]" />
        </article>
        <br />
        <br />
  </xsl:template>

  <xsl:template match="activity">
    <div class="sportelement">
        <h2><xsl:value-of select="Title" /></h2>
        <p><i><xsl:value-of select="Beschreibung" /></i></p>
        <p>Schwierigkeit: <xsl:value-of select="Schwierigkeit" /> </p>
        <xsl:variable name="link" select="Title"/>
        <xsl:variable name="alt" select="Beschreibung"/>
        <img src="bilder/{$link}.jpg"
            alt="{$alt}"
            class="img"/>
    </div>
  </xsl:template>

</xsl:stylesheet>