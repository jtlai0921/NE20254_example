<?php
require('mbfpdf.php');

class MyPDF extends MBfpdf {
  function __construct() {
    parent::__construct();
    $this->AddMBFont(GOTHIC,'SJIS');
    $this->AddMBFont(MINCHO,'SJIS');
    $GLOBALS['EUC2SJIS'] = true; // EUC-JP -> Shift_JIS ��ư�Ѵ�ͭ��
  }

  function chapterTitle($num, $title) { // �ϥ����ȥ����
    $this->SetFont(GOTHIC,'B',12);
    $this->SetFillColor(200,220,255);
    $this->Cell(0,6, "�� $num �� $title",0,1,'L',1);
    $this->Ln(4);
  }

  function chapterBody($file) { // �ϥܥǥ�������
    $content = implode('',file($file)); // �ե������ɤ߹���
    $this->SetFont(MINCHO,'',11);
    $this->MultiCell(0,5, $content);
    $this->Ln();
  }

  function printChapter($num, $title, $file) {
    $this->chapterTitle($num, $title);
    $this->chapterBody($file);
  }
}

$pdf= new MyPDF();
$pdf->AddPage();
$pdf->printChapter(1,'PHP5�ο���ǽ','ch1.txt');
$pdf->printChapter(2,'PHP�κ���','ch2.txt');

$pdf->Output("pdfsample.pdf","I"); // ����饤�������PDF�ե���������
?>
