<?xml version="1.0" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
            <body>
                <h1>This is a plain list of James Bond movie titles</h1>
                <ul>
                    <xsl:apply-templates/>
                </ul>
            </body>
        </html>
    </xsl:template>

   <!--  <xsl:template match="movie[">
        <li>
            <xsl:value-of select="duration"/>
        </li>
    </xsl:template> -->
    
    <xsl:template match="movie">
        <li>
            <xsl:value-of select="title"/>
        </li>
        <li>
            <xsl:value-of select="duration"/>
        </li>
    </xsl:template>


    <!-- <xsl:template match="movie">
        <li>
            <xsl:value-of select="title"/>
        </li>
    </xsl:template> -->

    <!-- ><xsl:template match="movie">
        <li>
            <xsl:value-of select="duration"/>
        </li>
    </xsl:template> -->

    <!--<xsl:template match="movie">
            <xsl:if test="duration &gt; 130">
        <li style="color:red">
          <xsl:value-of select="title"/>    
        </li>	
      </xsl:if>
            <xsl:if test="duration &lt;= 130">
        <li>
          <xsl:value-of select="title"/>
        </li>	
      </xsl:if>
    </xsl:template>-->

    <!--<xsl:template match="movie">
            <xsl:choose>
            <xsl:when test="duration &gt; 140">
                <li style="color:red"><xsl:value-of select="title"/></li>	
            </xsl:when>
            <xsl:when test="duration &gt; 130">
                <li style="color:blue"><xsl:value-of select="title"/></li>	
            </xsl:when>	
      <xsl:when test="duration &gt; 120">
                <li style="color:orange"><xsl:value-of select="title"/></li>	
            </xsl:when>	
            <xsl:otherwise>
                <li style="color:green"><xsl:value-of select="title"/></li>	
            </xsl:otherwise>		
            </xsl:choose> 
    </xsl:template>-->

</xsl:stylesheet>
