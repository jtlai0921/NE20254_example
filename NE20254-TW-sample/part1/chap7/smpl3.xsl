<?xml version="1.0" encoding="big5" ?>
<xsl:stylesheet version="1.0" 
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:php="http://php.net/xsl"
        xsl:extension-element-prefixes="php">
<xsl:output method="text"/>
 <xsl:template match="/foo/date">
  <xsl:value-of select="php:function('show',@time)" />
 </xsl:template>
</xsl:stylesheet>
