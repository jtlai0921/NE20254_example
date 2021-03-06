<?xml version="1.0" encoding="utf-8" ?>
<xsl:stylesheet version="1.0" 
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
        xmlns:rss="http://purl.org/rss/1.0/"
        xmlns:dc="http://purl.org/dc/elements/1.1/">
<xsl:output method="html" encoding="Shift_JIS" />
<xsl:template match="/rdf:RDF">
<html>
<xsl:apply-templates select="rss:channel"/>
<body>
<table border="1">
<xsl:apply-templates select="rss:item"/>
</table>
</body></html>
</xsl:template>
<xsl:template match="rss:channel">
<head><title><xsl:value-of select="rss:title"/></title></head>
</xsl:template>
<xsl:template match="rss:item">
<tr><td><xsl:value-of select="dc:date"/></td>
<td><a href="{rss:link}"><xsl:value-of select="rss:title"/></a></td></tr>
</xsl:template>
</xsl:stylesheet>
