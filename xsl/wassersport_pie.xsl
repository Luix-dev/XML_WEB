<?xml version="1.0"?>
<xsl:stylesheet version="1.0" 
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
                xmlns:svg="http://www.w3.org/2000/svg">
    
    <xsl:include href="maths.xsl" />

      
<xsl:template match="activities">

	<svg:svg>
		<svg:text font-size="24" fill="blue" x="50" y="50">
			Abstimmung Events:
		</svg:text>
		
		<xsl:apply-templates />

 	</svg:svg>
 </xsl:template>

<!-- Intermediate template -->
 
 <xsl:template match="activity">
    <xsl:call-template name="pie">
        
 	<xsl:with-param name="color">
            <xsl:call-template name="color-chooser">
                  <xsl:with-param name="pos" select="position()" />
            </xsl:call-template>
        </xsl:with-param>
            			
        <xsl:with-param name="eventTotal">
            <xsl:value-of select="sum(preceding-sibling::activity/Vote)" />
        </xsl:with-param>
            			
        <xsl:with-param name="totalVotes">
            <xsl:value-of select="sum(//activity/Vote)" />
        </xsl:with-param>
            			
        <xsl:with-param name="explode">
            <xsl:value-of select="position()=1" />
        </xsl:with-param>        			
            			
        <xsl:with-param name="index">
            <xsl:value-of select="position()" />
        </xsl:with-param>
        
    </xsl:call-template>
 </xsl:template>
 
 <!-- Template to draw pie diagram -->
 
 <xsl:template name="pie">

    <xsl:param name="color" />
    <xsl:param name="eventTotal" />
    <xsl:param name="totalVotes" />
    <xsl:param name="explode" />
    <xsl:param name="index" />
    
    <xsl:variable name="currentAngle" select="($pi div 180) * (Vote div $totalVotes) * 360.0"/>
    
    <xsl:variable name="icos">
        <xsl:call-template name="cos">
            <xsl:with-param name="x">
                <xsl:value-of select="$currentAngle" />
            </xsl:with-param>
        </xsl:call-template>
    </xsl:variable>
    
    <xsl:variable name="isin">
        <xsl:call-template name="sin">
            <xsl:with-param name="x">
                <xsl:value-of select="$currentAngle" />
            </xsl:with-param>
        </xsl:call-template>
    </xsl:variable>
    
    <xsl:variable name="size" select="150" />
    <xsl:variable name="y-legend-offset" select="110" />
    <xsl:variable name="x-legend-offset" select="600" />

    <svg:path style="fill:{$color}; stroke:black; stroke-width:2; fillrule:evenodd; stroke-linejoin:bevel;">

		<xsl:attribute name="transform">
			<xsl:text>translate(300,300) </xsl:text>
			<xsl:text> rotate(</xsl:text>
			<xsl:value-of select="-1 * (($eventTotal div $totalVotes) * 360.0)" />
			<xsl:text>)</xsl:text>
		</xsl:attribute>

   		<xsl:attribute name="d">
        		<xsl:text>M </xsl:text>
        		<xsl:value-of select="$size" />
        		<xsl:text> 0 A </xsl:text>
        		<xsl:value-of select="$size" />
        		<xsl:text> </xsl:text>
        		<xsl:value-of select="$size" />
        		<xsl:text> 0 </xsl:text>
			<xsl:choose>
				<xsl:when test="$currentAngle &lt; 3.14">
					<xsl:text>0 </xsl:text>
				</xsl:when>
				<xsl:otherwise>
					<xsl:text>1 </xsl:text>
				</xsl:otherwise>
			</xsl:choose>
			<xsl:text>0 </xsl:text>
        		<xsl:value-of select="$icos * $size"/>
        		<xsl:text> </xsl:text>
                        <xsl:value-of select="$isin * -$size"/>
        		<xsl:text> L 0 0 Z </xsl:text>
      	</xsl:attribute>
      	
  </svg:path>

	<svg:path style="stroke:black; stroke-width:2; fill:{$color};">
		<xsl:attribute name="d">
		
			<xsl:text>M  </xsl:text>
			<xsl:value-of select="$x-legend-offset" />
			<xsl:text> </xsl:text>
			<xsl:value-of select="$y-legend-offset + $index * 20 " />
			
			<xsl:text> L  </xsl:text>
			<xsl:value-of select="$x-legend-offset + 10" />
			<xsl:text> </xsl:text>
			<xsl:value-of select="$y-legend-offset + $index * 20 " />
			
			
			<xsl:text> L </xsl:text>
			<xsl:value-of select="$x-legend-offset + 10" />
			<xsl:text> </xsl:text>
			<xsl:value-of select="$y-legend-offset + $index * 20 - 10" />

			<xsl:text> L </xsl:text>
			<xsl:value-of select="$x-legend-offset" />
			<xsl:text> </xsl:text>
			<xsl:value-of select="$y-legend-offset + $index * 20 - 10 " />
			
			<xsl:text> Z </xsl:text>
			
		</xsl:attribute>
	</svg:path>
	
	<svg:text font-size="12" style="text-anchor:start">
		<xsl:attribute name="x">
			<xsl:value-of select="$x-legend-offset + 20" />
		</xsl:attribute>
		<xsl:attribute name="y">
			<xsl:value-of select="$y-legend-offset + $index * 20" />
		</xsl:attribute>		
		<xsl:value-of select="Title" />
		<xsl:text> : </xsl:text>
		<xsl:value-of select="Vote" />	
	</svg:text>

 </xsl:template>
 
    <xsl:template name="color-chooser"> 
        <xsl:param name="pos" />
        <xsl:variable name="count">21</xsl:variable>
        <xsl:choose>
            <xsl:when test="$pos mod $count = 0">
                <xsl:text>#990000</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 1">
                <xsl:text>#999900</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 2">
                <xsl:text>#4C9900</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 3">
                <xsl:text>#009999</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 4">
                <xsl:text>#004C99</xsl:text>
            </xsl:when>
             <xsl:when test="$pos mod $count = 5">
                 <xsl:text>#4C0099</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 6">
                <xsl:text>#990099</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 7">
                <xsl:text>#99004C</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 8">
                <xsl:text>#99FF99</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 9">
                <xsl:text>#99FFFF</xsl:text>
            </xsl:when>     
            <xsl:when test="$pos mod $count = 10">
                <xsl:text>#FFFF00</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 11">
                <xsl:text>#FF8000</xsl:text>
            </xsl:when> 
            <xsl:when test="$pos mod $count = 12">
                <xsl:text>#FF0000</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 13">
                <xsl:text>#CCCCFF</xsl:text>
            </xsl:when>
            <xsl:when test="$pos mod $count = 14">
                <xsl:text>#FFCCE5</xsl:text>
            </xsl:when> 
            <xsl:when test="$pos mod $count = 15">
                <xsl:text>#FFE5CC</xsl:text>
            </xsl:when> 
            <xsl:when test="$pos mod $count = 16">
                <xsl:text>#FFFFCC</xsl:text>
            </xsl:when> 
            <xsl:when test="$pos mod $count = 17">
                <xsl:text>#FFFFFF</xsl:text>
            </xsl:when>  
            <xsl:when test="$pos mod $count = 18">
                <xsl:text>#330000</xsl:text>
            </xsl:when>  
            <xsl:when test="$pos mod $count = 19">
                <xsl:text>#A0A0A0</xsl:text>
            </xsl:when>  
            <xsl:when test="$pos mod $count = 20">
                <xsl:text>#330066</xsl:text>
            </xsl:when>           
        </xsl:choose>
    </xsl:template>
 
 
 
 
</xsl:stylesheet>


