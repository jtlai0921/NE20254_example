<?php
include ("jpgraph.php");
include ("jpgraph_gantt.php");

$data = array(
  array(0,ACTYPE_NORMAL,'執筆','2005-1-21','2005-02-10',' [70%]'),
  array(1,ACTYPE_NORMAL,'編輯','2005-2-12','2005-02-28',''),
  array(2,ACTYPE_MILESTONE,'里程碑','2005-2-11','脫稿'));  // 資料
$constrains = array(array(0,1,CONSTRAIN_ENDSTART)); // 限制條件
$progress = array(array(0,0.7),array(1,0.0)); // 進度

$graph = new GanttGraph(0,0,'auto'); // 建立甘特圖
$graph->SetBox(); // 顯示外框
$graph->SetShadow(); // 顯示陰影

// 設定標題: 中文 (新細明體) 15 點字型
$graph->title->Set("執筆進度");
$graph->title->SetFont(FF_BIG5,FS_NORMAL,15);

$graph->SetDateRange('2005-1-20','2005-2-28'); // 固定日期顯示
$graph->ShowHeaders(GANTT_HDAY |GANTT_HWEEK | GANTT_HMONTH); // 在頁首顯示月、週、星期
$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR2); // 指定顯示格式
$graph->scale->month->SetBackgroundColor("lightblue"); // 指定頁首的背景色

$graph->SetSimpleFont(FF_BIG5, 9); // 繪製部分的字型設定為中文 (新細明體) 9 點
$graph->CreateSimple($data,$constrains,$progress); // 繪製甘特圖
$graph->Stroke(); // 輸出
?>
