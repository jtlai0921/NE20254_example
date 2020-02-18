<?xml version="1.0" encoding="Big5" ?>
<xsl:stylesheet version="1.0" 
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 <xsl:output method="html" indent="yes" encoding="Big5"/>
 <xsl:param name="title" />
 <xsl:template match="/">
  <html lang="zh-tw">
  <body>
  <h1><xsl:value-of select="$title" /></h1>
  <table border="1">
   <tr><th>�m�W</th><th>����</th></tr>
    <xsl:for-each select="����/����">
    <tr><td><xsl:value-of select="�m�W"/></td>
    <td><xsl:value-of select="����"/></td></tr>
    </xsl:for-each>
   </table>
  </body></html>
 </xsl:template>
</xsl:stylesheet>
