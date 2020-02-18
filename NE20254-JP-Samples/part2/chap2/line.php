<?php // 折れ線グラフの例
require_once("jpgraph.php");
require_once("jpgraph_line.php");

mb_http_output('pass'); // 文字コード変換無効 

// プロット用データ
$labels = array('2000','2001','2002','2003','2004','2005');
$domains = array(1.2e6,5.1e6,7.5e6,10e6, 15e6, 18e6); 
$ipadrs = array(  0.35e6, 0.8e6, 1.1e6, 1.1e6, 1.2e6, 1.3e6); 

$graph = new Graph(300,250,"auto"); // 300*250ピクセルで描画
$graph->SetScale("textlin"); // X軸:テキスト, Y軸:線形

$graph->img->SetMargin(60,40,40,60); // マージン設定

$graph->img->SetAntiAliasing(); // アンチエイリアス処理有効
$graph->SetShadow(); // 枠の影を付ける

// タイトル
$graph->title->Set("PHPユーザ数の推移"); 
$graph->title->SetFont(FF_GOTHIC,FS_NORMAL,14); // ゴシック/14ポイント
// X軸ラベル
$graph->xaxis->SetTickLabels($labels); // X軸ラベルを指定
$graph->xaxis->SetFont(FF_TIMES,FS_NORMAL,11); // Times/11ポイント
$graph->xaxis->SetLabelAngle(45); // 45度傾ける

// 線1を描画
$line1 = new LinePlot($domains);
$line1->mark->SetType(MARK_FILLEDCIRCLE); // マーカ:●
$line1->mark->SetFillColor("green"); // 緑で塗りつぶしす
$line1->mark->SetWidth(3); // マーカの大きさを指定
$line1->SetColor("blue"); // 線の色は青
$line1->SetCenter();
$line1->SetLegend("Domains"); // 凡例を設定

// 線2を描画
$line2 = new LinePlot($ipadrs);
$line2->mark->SetType(MARK_UTRIANGLE); // マーカは▲
$line2->mark->SetFillColor("green"); // 緑で塗りつぶしす
$line2->mark->SetWidth(3); // マーカの大きさを指定
$line2->SetColor("red"); // 線の色は赤
$line2->SetCenter();
$line2->SetLegend("IP");// 凡例を設定

$graph->legend->SetLayout(LEGEND_VERT);  // 凡例を垂直に描画
$graph->legend->Pos(0.8,0.5,"center","center"); // 凡例の位置を指定
$graph->Add($line1); // グラフに線1を追加
$graph->Add($line2); // グラフに線2を追加
$graph->Stroke();  // グラフを出力
?>
