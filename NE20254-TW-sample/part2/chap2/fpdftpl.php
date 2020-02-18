<?php // PDF �˪��ɨϥνd��
require_once('MBfpdi.php');

$tplfile = "quotation.pdf"; // �˪���
$product = array('��l','�h��','ī�G');
$price = array(100,200,150); // ����M��

$pdf= new MBfpdi();
$pagecount = $pdf->setSourceFile($tplfile);
$tplidx = $pdf->ImportPage(1); // �פJ�˪�

$pdf->SetLeftMargin(24); // ����ɳ]�� 24mm
$pdf->addPage(); // �l�[����
$pdf->useTemplate($tplidx); // �ϥμ˪�

// �n���h�줸�զr��
$pdf->AddMBFont(BIG5,'BIG5');

// �]�w�����
$pdf->SetCreator('FPDF');
$pdf->SetAuthor('PHP Trading Ltd.');
$pdf->SetTitle('PDF generation Demo.');

$pdf->SetFont(BIG5,'',12); // �]�w������ 12 ���r
$pdf->SetXY(160, 40);
$pdf->Write(12,date("Y�~m��d��")); // ��X���
$pdf->SetXY(40, 48);
$pdf->Write(12,$_POST['name'].' ����/�p�j'); // ��X����H

$pdf->SetFont(BIG5,'',11); // �]�w������ 12 ���r
$sum = 0;
$pdf->SetXY(24,77);
for ($i=0; $i<count($product); $i++) {
  $num[$i] = intval($_POST['num'][$i]);         // ���o�Ӽ�
  $subtotal = $price[$i]*$num[$i];              // �p�p
  $sum += $subtotal;                            // �`�p
  $pdf->Cell(120,7.3, $product[$i]);            // ��X�ӫ~�W��
  $pdf->Cell(30,7.3,sprintf("%4d", $num[$i]));  // ��X�Ӽ�
  $pdf->Cell(30,7.3,"$".$subtotal);             // ��X�p�p
  $pdf->Ln();                                   // ����
}

$pdf->SetXY(174,109); 
$pdf->Write(12,"$".$sum); // ��X�`�p

$pdf->Output($tplfile,"I"); // �H inline �榡��X PDF ��
?>
