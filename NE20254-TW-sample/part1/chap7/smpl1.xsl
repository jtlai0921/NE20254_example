<?xml version="1.0" encoding="Big5" ?>
<xsl:stylesheet version="1.0" 
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes" encoding="Big5"/>
 <xsl:template match="/">
  <html lang="zh-tw">
  <body>
  <table border="1">
   <tr><th>姓名</th><th>所屬</th></tr>
    <xsl:for-each select="雇員/成員">
    <tr><td><xsl:value-of select="姓名"/></td>
    <td><xsl:value-of select="所屬"/></td></tr>
    </xsl:for-each>
   </table>
  </body></html>
 </xsl:template>
</xsl:stylesheet>
