<?php // 用FOP以XML建立PDF
$src = dirname(__FILE__) . "/" . "sample.fo"; // 輸入檔案
$dst = dirname(__FILE__) . "/" . "sample.pdf"; // 輸出檔案
$conf = dirname(__FILE__) . "/" . "userconfig.xml"; // 使用者設定檔

try {
  // 建立驅動程式
  $driver = new Java("org.apache.fop.apps.Driver",
                     new Java("org.xml.sax.InputSource", $src),
                     new Java("java.io.FileOutputStream", $dst));
  $conf = new Java("org.apache.fop.apps.Options", new Java("java.io.File", $conf));
  $driver->setRenderer($driver->RENDER_PDF); // 指定 PDF 為繪製器
  $driver->run(); // 執行繪製動作
} catch (Java_Exception $e) {
  echo "Exception: ".$e->toString();
}

mb_http_output("pass"); // 關閉mbstring的輸出文字碼變換功能
header("Content-type: application/pdf");
header("Content-Length: " . filesize($dst)); // 輸出檔案大小
header("Content-Disposition:inline; filename=sample.pdf");
readfile($dst);

?>
