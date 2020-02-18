<?php
include ("jpgraph.php");
include ("jpgraph_gantt.php");

$data = array(
  array(0,ACTYPE_NORMAL,'執筆','2005-1-21','2005-02-10',' [70%]'),
  array(1,ACTYPE_NORMAL,'編集','2005-2-12','2005-02-28',''),
  array(2,ACTYPE_MILESTONE,'マイルストーン','2005-2-11','脱稿'));  // データ
$constrains = array(array(0,1,CONSTRAIN_ENDSTART)); // 拘束条件
$progress = array(array(0,0.7),array(1,0.0)); // 進捗度

$graph = new GanttGraph(0,0,'auto'); // ガント図生成
$graph->SetBox(); // 外枠表示
$graph->SetShadow(); // 影を表示

// タイトル設定 : ゴシック, 11ポイント
$graph->title->Set("執筆進捗");
$graph->title->SetFont(FF_GOTHIC,FS_NORMAL,11);

$graph->SetDateRange('2005-1-20','2005-2-28'); // 日付表示を固定
$graph->ShowHeaders(GANTT_HDAY |GANTT_HWEEK | GANTT_HMONTH); // ヘッダに月,週,曜日を表示
$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR2); // 表示形式を指定
$graph->scale->month->SetBackgroundColor("lightblue"); // ヘッダの背景色を指定

$graph->iSimpleFont = FF_GOTHIC; // 描画部のフォントとしてゴシックを用いる
$graph->iSimpleFontSize = 10;    // 描画部のフォントのサイズ
$graph->CreateSimple($data,$constrains,$progress); // ガント図を描画
$graph->Stroke(); // 出力
?>
