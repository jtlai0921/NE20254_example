<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
                   
  <meta http-equiv="content-type" content="text/html; charset=EUC-JP">
  <title>mozilla.tpl</title>
    
</head>
<body>
<h1>{$PageTitle}</h1>
<br>
<table cellpadding="2" cellspacing="2" border="1" width="100%">
  <tbody>
    <tr>
      <th valign="Top" width="120" bgcolor="#ccffff">日付<br>
      </th>
      <td valign="Top" bgcolor="#ccffff">
      <div align="Center">題名<br>
      </div>
      </td>
      <td valign="Top" bgcolor="#ccffff">
      <div align="Center">内容<br>
      </div>
      </td>
    </tr>
<!--
    {section name=phpnews loop=$title}
--><tr>
      <td valign="Top"><a href="{$link[phpnews]}">{$title[phpnews]}</a><br>
      </td>
      <td valign="Top">{$wdate[phpnews]}<br>
      </td>
      <td valign="Top">{$content[phpnews]}<br>
      </td>
    </tr>
<!--
    {/section}
-->
  </tbody>
</table>
</body>
</html>
