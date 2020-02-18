<html>
<head>
<link href="d209.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>{$PageTitle}</h1>
<br>
[<a href="{$SCRIPT_NAME}?d=1">詳細表示</a>]
<br>
<!--
{section name=phpnews loop=$title}
-->
[{$title[phpnews]}]<br> {$content[phpnews]|mbtruncate:10}<br>
<!--
{/section}
-->
</body></html>

