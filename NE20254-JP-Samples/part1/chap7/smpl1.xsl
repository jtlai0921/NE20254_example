<?xml version="1.0" encoding="EUC-JP" ?>
<xsl:stylesheet version="1.0" 
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes" encoding="Shift_JIS"/>
 <xsl:template match="/">
  <html lang="ja">
  <body>
  <table border="1">
   <tr><th>��̾</th><th>��°</th></tr>
    <xsl:for-each select="���Ȱ�/���С�">
    <tr><td><xsl:value-of select="��̾"/></td>
    <td><xsl:value-of select="��°"/></td></tr>
    </xsl:for-each>
   </table>
  </body></html>
 </xsl:template>
</xsl:stylesheet>
