<?php
require('mbfpdf.php');

class MyPDF extends MBfpdf {
  function __construct() {
    parent::__construct();
    $this->AddMBFont(GOTHIC,'SJIS');
    $this->AddMBFont(MINCHO,'SJIS');
    $GLOBALS['EUC2SJIS'] = true; // EUC-JP -> Shift_JIS 自動変換有効
  }

  function chapterTitle($num, $title) { // 章タイトル出力
    $this->SetFont(GOTHIC,'B',12);
    $this->SetFillColor(200,220,255);
    $this->Cell(0,6, "第 $num 章 $title",0,1,'L',1);
    $this->Ln(4);
  }

  function chapterBody($file) { // 章ボディ部出力
    $content = implode('',file($file)); // ファイル読み込み
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
$pdf->printChapter(1,'PHP5の新機能','ch1.txt');
$pdf->printChapter(2,'PHPの今後','ch2.txt');

$pdf->Output("pdfsample.pdf","I"); // インライン形式でPDFファイルを出力
?>
