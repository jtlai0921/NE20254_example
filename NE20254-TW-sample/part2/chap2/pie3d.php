<?php // 立體圓形圖的範例
require_once("jpgraph.php");
require_once("jpgraph_pie.php");
require_once("jpgraph_pie3d.php");

mb_http_output('pass');
$labels = array("-2000","2000",'2001','2002','2003','2004'); // 圖例
$inc = array(1.2e6,3.9e6,2.4e6,2.5e6,5e6,3e6); // 資料

$graph = new PieGraph(400,200,"auto"); // 用 400*200 像素繪製
$graph->SetShadow(); // 設定外框陰影

// 標題: 中文 (新細明體) 15 號字
$graph->title->Set("PHP 使用者人數增加");
$graph->title->SetFont(FF_BIG5,FS_NORMAL,15);

$pie = new PiePlot3d($inc); // 立體圓形圖
$pie->SetTheme("sand"); // 選用「砂漠」配色主題
$pie->SetCenter(0.4);
$pie->SetAngle(30); // 將圓形圖傾斜 30 度

$pie->value->SetFont(FF_ARIAL,FS_NORMAL,12); // 字型設為 Arial 12 號字
$pie->SetLegends(array_reverse($labels)); // 追加圖例
$graph->Add($pie); // 追加圓形圖
$graph->Stroke(); // 輸出圖表
?>

