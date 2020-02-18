<?xml version="1.0" encoding="utf-8" ?>
<xsl:stylesheet version="1.0" 
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
        xmlns:rss="http://purl.org/rss/1.0/"
        xmlns:dc="http://purl.org/dc/elements/1.1/">
<xsl:output method="html" encoding="big5" />
<xsl:template match="/rdf:RDF">
<html>
<xsl:apply-templates select="rss:channel"/>
<body>
<ul><xsl:apply-templates select="rss:item"/></ul>
</body></html>
</xsl:template>
<xsl:template match="rss:channel">
<head><title><xsl:value-of select="rss:title"/></title></head>
</xsl:template>
<xsl:template match="rss:item">
<li><xsl:value-of select="dc:date"/>: <a href="{rss:link}">
    <xsl:value-of select="rss:title"/></a></li>
</xsl:template>
</xsl:stylesheet>
