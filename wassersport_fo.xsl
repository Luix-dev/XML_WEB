<?xml version="1.0" ?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:fo="http://www.w3.org/1999/XSL/Format">
    <xsl:template match="/">
        <fo:root>
            <fo:layout-master-set>
                <fo:simple-page-master master-name="wassersport_liste"
                                       page-height="29.7cm" page-width="21cm"
                                       margin-top="1cm" margin-bottom="2cm"
                                       margin-left="2.5cm" margin-right="2.5cm">
                    <fo:region-body margin-top="1cm"/>
                    <fo:region-before extent="2cm"/>
                    <fo:region-after extent="3cm"/>
                </fo:simple-page-master>
            </fo:layout-master-set>
            <fo:page-sequence master-reference="wassersport_liste">
                <fo:static-content flow-name="xsl-region-before">
                    <fo:block text-align="center" font-size="8pt">
                        Wassersportarten - Seite
                        <fo:page-number/>
                    </fo:block>
                </fo:static-content>
                <fo:flow flow-name="xsl-region-body">
                    <fo:block font-size="19pt"
                              font-family="sans-serif"
                              line-height="24pt"
                              space-after.optimum="20pt"
                              background-color="blue"
                              color="white"
                              text-align="center"
                              padding-top="5pt"
                              padding-bottom="5pt">
                        Liste aller Sportarten
                    </fo:block>
                    <xsl:apply-templates />
                </fo:flow>
            </fo:page-sequence>
        </fo:root>
    </xsl:template>
    <xsl:template match="activity">
        <fo:table space-after.optimum="20pt" width="13cm" font-size="11pt">
            <fo:table-column column-number="1"/>
            <fo:table-column column-number="2"/>
            <fo:table-column column-number="3"/>
            <fo:table-body>
                <fo:table-row height="5cm">
                    <fo:table-cell number-columns-spanned="3">
                        <fo:block font-size="16pt" color="blue" font-weight="900" text-align="left">
                            <xsl:value-of select="Title"/>
                        </fo:block>
                        <fo:block>
                            Beschreibung: <xsl:value-of select="Beschreibung"/>
                        </fo:block>
                        <fo:block>
                            Art: <xsl:value-of select="Art"/>
                        </fo:block>
                    </fo:table-cell>
                </fo:table-row>
                <fo:table-row>
                    <fo:table-cell padding-top="8pt" number-columns-spanned="2" padding-bottom="10pt">
                        <fo:block font-weight="bold">
                            Schwierigkeit: <xsl:value-of select="Schwierigkeit"/>
                        </fo:block>
                    </fo:table-cell>
                </fo:table-row>
            </fo:table-body>
        </fo:table>
    </xsl:template>
</xsl:stylesheet>