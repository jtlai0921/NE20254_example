<?php // PDFテンプレートファイル使用例
require_once('MBfpdi.php');
$GLOBALS['EUC2SJIS'] = true; // EUC-JP -> Shift_JIS 自動変換有効

$tplfile = "quotation.pdf"; // テンプレートファイル
$product = array('みかん','オレンジ','りんご');
$price = array(100,200,150); // 価格リスト

$pdf= new MBfpdi();
$pagecount = $pdf->setSourceFile($tplfile);
$tplidx = $pdf->ImportPage(1); // テンプレートをインポート

$pdf->SetLeftMargin(24); // 左マージンを24mmに設定
$pdf->addPage(); // ページ追加
$pdf->useTemplate($tplidx); // テンプレートを使用

// マルチバイトフォント登録
$pdf->AddMBFont(GOTHIC,'SJIS');
$pdf->AddMBFont(MINCHO,'SJIS');

// 文書情報設定
$pdf->SetCreator('FPDF');
$pdf->SetAuthor('PHP Trading Ltd.');
$pdf->SetTitle('PDF generation Demo.');

$pdf->SetFont(MINCHO,'',12); // ゴシック12ポイントを指定
$pdf->SetXY(160, 40);
$pdf->Write(12,date("Y年m月d日")); // 日付を出力
$pdf->SetXY(40, 48);
$pdf->Write(12,$_POST['name'].' 様'); // 宛先を出力

$pdf->SetFont(GOTHIC,'',11); // ゴシック11ポイントを指定
$sum = 0;
$pdf->SetXY(24,77);
for ($i=0; $i<count($product); $i++) {
  $num[$i] = intval($_POST['num'][$i]);         // 個数取得
  $subtotal = $price[$i]*$num[$i];              // 小計計算
  $sum += $subtotal;                            // 合計計算
  $pdf->Cell(120,7.3, $product[$i]);            // 商品名出力
  $pdf->Cell(30,7.3,sprintf("%4d", $num[$i]));  // 個数出力
  $pdf->Cell(30,7.3,"\\".$subtotal);            // 小計出力
  $pdf->Ln();                                   // 改行
}

$pdf->SetXY(174,109); 
$pdf->Write(12,"\\".$sum); // 合計を出力

$pdf->Output($tplfile,"I"); // インライン形式でPDFファイルを出力
?>
