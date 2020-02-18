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
