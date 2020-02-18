<?php
require('mbfpdf.php');

class MyPDF extends MBfpdf {
  function __construct() {
    parent::__construct();
    $this->AddMBFont(BIG5,'BIG5');
  }

  function chapterTitle($num, $title) { // ��X���`���D
    $this->SetFont(BIG5,'B',12);
    $this->SetFillColor(200,220,255);
    $this->Cell(0,6, "�� $num �� $title",0,1,'L',1);
    $this->Ln(4);
  }

  function chapterBody($file) { // ��X���`����
    $content = implode('',file($file)); // Ū��
    $this->SetFont(BIG5,'',11);
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
$pdf->printChapter(1,'PHP5 ���s����','ch1.txt');
$pdf->printChapter(2,'PHP ������','ch2.txt');

$pdf->Output("pdfsample.pdf","I"); // �Hinline�榡��XPDF��
?>
