<?xml version="1.0" ?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:fo="http://www.w3.org/1999/XSL/Format">
    <xsl:template match="/">
        <fo:root>
            <fo:layout-master-set>
                <fo:simple-page-master master-name="room"
                                       page-height="29.7cm" page-width="21cm"
                                       margin-top="1cm" margin-bottom="2cm"
                                       margin-left="2.5cm" margin-right="2.5cm">
                    <fo:region-body margin-top="1cm"/>
                    <fo:region-before extent="2cm"/>
                    <fo:region-after extent="3cm"/>
                </fo:simple-page-master>
            </fo:layout-master-set>
            <fo:page-sequence master-reference="room">
                <fo:static-content flow-name="xsl-region-before">
                    <fo:block text-align="center" font-size="8pt">
                        Reservation
                    </fo:block>
                </fo:static-content>
                <fo:flow flow-name="xsl-region-body">
                    <fo:block font-size="19pt"
                              font-family="sans-serif"
                              line-height="24pt"
                              space-after.optimum="20pt"
                              text-align="center"
                              padding-top="5pt"
                              padding-bottom="5pt">
                        Ihre Reservierung
                    </fo:block>
                    <xsl:apply-templates />
                </fo:flow>
            </fo:page-sequence>
        </fo:root>
    </xsl:template>
    <xsl:template match="room">
        <fo:table space-after.optimum="20pt" font-size="11pt">
            <fo:table-body>
                <fo:table-row height="5cm">
                    <fo:table-cell>
                        <fo:block font-size="16pt" color="black" font-weight="900" text-align="left">
                            Zimmer: <xsl:value-of select="@number"/>
                        </fo:block>
                        <fo:block>
                            Von <xsl:value-of select="reservation/reservationFrom"/> bis <xsl:value-of select="reservation/reservationTo"/>
                        </fo:block>
                        <fo:block>
                            Name: <xsl:value-of select="reservation/name"/>
                        </fo:block>
                        <fo:block>
                            Vorname: <xsl:value-of select="reservation/surname"/>
                        </fo:block>
                        <fo:block>
                            Adresse:
                            <xsl:value-of select="reservation/address"/>
                        </fo:block>
                        <fo:block>
                            <xsl:value-of select="reservation/ort"/>
                            (<xsl:value-of select="reservation/plz"/>)
                        </fo:block>
                        <fo:block>
                            Sport: <xsl:value-of select="reservation/sport"/>
                        </fo:block>
                    </fo:table-cell>
                </fo:table-row>
            </fo:table-body>
        </fo:table>
    </xsl:template>
</xsl:stylesheet>