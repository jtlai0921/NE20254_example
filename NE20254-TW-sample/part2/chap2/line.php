<?php // 折線圖範例
require_once("jpgraph.php");
require_once("jpgraph_line.php");

mb_http_output('pass'); // 關閉字集轉換

// 圖表用資料
$labels = array('2000','2001','2002','2003','2004','2005');
$domains = array(1.2e6,5.1e6,7.5e6,10e6, 15e6, 18e6); 
$ipadrs = array(  0.35e6, 0.8e6, 1.1e6, 1.1e6, 1.2e6, 1.3e6); 

$graph = new Graph(300,250,"auto"); // 用 300*250 像素繪製圖表
$graph->SetScale("textlin"); // X軸：文字  Y軸：線形

$graph->img->SetMargin(60,40,40,60); // 設定邊界

$graph->img->SetAntiAliasing(); // 設定反鋸齒模式
$graph->SetShadow(); // 設定外框陰影

// 標題
$graph->title->Set("PHP 使用者人數預測表"); 
$graph->title->SetFont(FF_BIG5,FS_NORMAL,15); // 新細明體 / 15 號字
// X 軸標籤
$graph->xaxis->SetTickLabels($labels); // 指定 X 軸標籤
$graph->xaxis->SetFont(FF_TIMES,FS_NORMAL,11); // Times / 11 號字
$graph->xaxis->SetLabelAngle(45); // 傾斜 45 度

// 描繪線 1
$line1 = new LinePlot($domains);
$line1->mark->SetType(MARK_FILLEDCIRCLE); // 記號為●
$line1->mark->SetFillColor("green"); // 用綠色填滿
$line1->mark->SetWidth(3); // 指定記號的大小
$line1->SetColor("blue"); // 線為藍色
$line1->SetCenter();
$line1->SetLegend("Domains"); // 設定圖例

// 描繪線 2
$line2 = new LinePlot($ipadrs);
$line2->mark->SetType(MARK_UTRIANGLE); // 記號為▲
$line2->mark->SetFillColor("green"); // 用綠色填滿
$line2->mark->SetWidth(3); // 指定記號的大小
$line2->SetColor("red"); // 線為紅色
$line2->SetCenter();
$line2->SetLegend("IP");// 設定圖例

$graph->legend->SetLayout(LEGEND_VERT);  // 垂直插入圖例
$graph->legend->Pos(0.8,0.5,"center","center"); // 指定圖例位置
$graph->Add($line1); // 將線 1 追加到圖表
$graph->Add($line2); // 將線 2 追加到圖表
$graph->Stroke();  // 輸出圖表
?>
