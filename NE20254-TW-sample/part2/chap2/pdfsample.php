<?php
require('mbfpdf.php');

class MyPDF extends MBfpdf {
  function __construct() {
    parent::__construct();
    $this->AddMBFont(BIG5,'BIG5');
  }

  function chapterTitle($num, $title) { // 輸出章節標題
    $this->SetFont(BIG5,'B',12);
    $this->SetFillColor(200,220,255);
    $this->Cell(0,6, "第 $num 章 $title",0,1,'L',1);
    $this->Ln(4);
  }

  function chapterBody($file) { // 輸出章節本體
    $content = implode('',file($file)); // 讀檔
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
$pdf->printChapter(1,'PHP5 的新機能','ch1.txt');
$pdf->printChapter(2,'PHP 的今後','ch2.txt');

$pdf->Output("pdfsample.pdf","I"); // 以inline格式輸出PDF檔
?>
