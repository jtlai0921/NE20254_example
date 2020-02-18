<?php // PDF 樣版檔使用範例
require_once('MBfpdi.php');

$tplfile = "quotation.pdf"; // 樣版檔
$product = array('橘子','柳橙','蘋果');
$price = array(100,200,150); // 價格清單

$pdf= new MBfpdi();
$pagecount = $pdf->setSourceFile($tplfile);
$tplidx = $pdf->ImportPage(1); // 匯入樣版

$pdf->SetLeftMargin(24); // 左邊界設為 24mm
$pdf->addPage(); // 追加頁面
$pdf->useTemplate($tplidx); // 使用樣版

// 登錄多位元組字型
$pdf->AddMBFont(BIG5,'BIG5');

// 設定文件資料
$pdf->SetCreator('FPDF');
$pdf->SetAuthor('PHP Trading Ltd.');
$pdf->SetTitle('PDF generation Demo.');

$pdf->SetFont(BIG5,'',12); // 設定成宋體 12 號字
$pdf->SetXY(160, 40);
$pdf->Write(12,date("Y年m月d日")); // 輸出日期
$pdf->SetXY(40, 48);
$pdf->Write(12,$_POST['name'].' 先生/小姐'); // 輸出收件人

$pdf->SetFont(BIG5,'',11); // 設定成宋體 12 號字
$sum = 0;
$pdf->SetXY(24,77);
for ($i=0; $i<count($product); $i++) {
  $num[$i] = intval($_POST['num'][$i]);         // 取得個數
  $subtotal = $price[$i]*$num[$i];              // 小計
  $sum += $subtotal;                            // 總計
  $pdf->Cell(120,7.3, $product[$i]);            // 輸出商品名稱
  $pdf->Cell(30,7.3,sprintf("%4d", $num[$i]));  // 輸出個數
  $pdf->Cell(30,7.3,"$".$subtotal);             // 輸出小計
  $pdf->Ln();                                   // 換行
}

$pdf->SetXY(174,109); 
$pdf->Write(12,"$".$sum); // 輸出總計

$pdf->Output($tplfile,"I"); // 以 inline 格式輸出 PDF 檔
?>
