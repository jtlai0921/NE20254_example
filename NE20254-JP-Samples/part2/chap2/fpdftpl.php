<?php // PDF�ƥ�ץ졼�ȥե����������
require_once('MBfpdi.php');
$GLOBALS['EUC2SJIS'] = true; // EUC-JP -> Shift_JIS ��ư�Ѵ�ͭ��

$tplfile = "quotation.pdf"; // �ƥ�ץ졼�ȥե�����
$product = array('�ߤ���','�����','���');
$price = array(100,200,150); // ���ʥꥹ��

$pdf= new MBfpdi();
$pagecount = $pdf->setSourceFile($tplfile);
$tplidx = $pdf->ImportPage(1); // �ƥ�ץ졼�Ȥ򥤥�ݡ���

$pdf->SetLeftMargin(24); // ���ޡ������24mm������
$pdf->addPage(); // �ڡ����ɲ�
$pdf->useTemplate($tplidx); // �ƥ�ץ졼�Ȥ����

// �ޥ���Х��ȥե������Ͽ
$pdf->AddMBFont(GOTHIC,'SJIS');
$pdf->AddMBFont(MINCHO,'SJIS');

// ʸ���������
$pdf->SetCreator('FPDF');
$pdf->SetAuthor('PHP Trading Ltd.');
$pdf->SetTitle('PDF generation Demo.');

$pdf->SetFont(MINCHO,'',12); // �����å�12�ݥ���Ȥ����
$pdf->SetXY(160, 40);
$pdf->Write(12,date("Yǯm��d��")); // ���դ����
$pdf->SetXY(40, 48);
$pdf->Write(12,$_POST['name'].' ��'); // ��������

$pdf->SetFont(GOTHIC,'',11); // �����å�11�ݥ���Ȥ����
$sum = 0;
$pdf->SetXY(24,77);
for ($i=0; $i<count($product); $i++) {
  $num[$i] = intval($_POST['num'][$i]);         // �Ŀ�����
  $subtotal = $price[$i]*$num[$i];              // ���׷׻�
  $sum += $subtotal;                            // ��׷׻�
  $pdf->Cell(120,7.3, $product[$i]);            // ����̾����
  $pdf->Cell(30,7.3,sprintf("%4d", $num[$i]));  // �Ŀ�����
  $pdf->Cell(30,7.3,"\\".$subtotal);            // ���׽���
  $pdf->Ln();                                   // ����
}

$pdf->SetXY(174,109); 
$pdf->Write(12,"\\".$sum); // ��פ����

$pdf->Output($tplfile,"I"); // ����饤�������PDF�ե���������
?>
