<?php // 3次元円グラフの例
require_once("jpgraph.php");
require_once("jpgraph_pie.php");
require_once("jpgraph_pie3d.php");

mb_http_output('pass');
$labels = array("-2000","2000",'2001','2002','2003','2004'); // 凡例
$inc = array(1.2e6,3.9e6,2.4e6,2.5e6,5e6,3e6); // データ

$graph = new PieGraph(400,200,"auto"); // 400*200ピクセルで描画
$graph->SetShadow(); // 枠に影を付ける

// タイトル:ゴシック/14ポイント
$graph->title->Set("PHPユーザ数の増加");
$graph->title->SetFont(FF_GOTHIC,FS_NORMAL,11);

$pie = new PiePlot3d($inc); // 3次元円グラフ
$pie->SetTheme("sand"); // 色テーマを「砂漠」に設定
$pie->SetCenter(0.4);
$pie->SetAngle(30); // 円グラフの傾斜を30度に

$pie->value->SetFont(FF_ARIAL,FS_NORMAL,12); // フォントをArial,12ポイントに
$pie->SetLegends(array_reverse($labels)); // 凡例を追加
$graph->Add($pie); // 円グラフを追加
$graph->Stroke(); // グラフを出力
?>

