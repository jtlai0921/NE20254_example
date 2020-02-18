<?xml version="1.0" encoding="EUC-JP" ?>
<xsl:stylesheet version="1.0" 
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes" encoding="Shift_JIS"/>
 <xsl:template match="/">
  <html lang="ja">
  <body>
  <table border="1">
   <tr><th>氏名</th><th>所属</th></tr>
    <xsl:for-each select="従業員/メンバー">
    <tr><td><xsl:value-of select="氏名"/></td>
    <td><xsl:value-of select="所属"/></td></tr>
    </xsl:for-each>
   </table>
  </body></html>
 </xsl:template>
</xsl:stylesheet>
