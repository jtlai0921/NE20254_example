<?php // FOPによりXMLファイルからPDFを出力
$src = dirname(__FILE__) . "/" . "sample.fo"; // 入力ファイル
$dst = "/tmp/sample.pdf"; // 出力ファイル
$conf = dirname(__FILE__) . "/" . "userconfig.xml"; // ユーザ設定ファイル

try {
  // ドライバ生成
  $driver = new Java("org.apache.fop.apps.Driver",
                     new Java("org.xml.sax.InputSource", $src),
                     new Java("java.io.FileOutputStream", $dst));
  $driver->setRenderer($driver->RENDER_PDF); // レンダラとしてPDFを指定
  $driver->run(); // レンダリング実行
} catch (Java_Exception $e) {
  echo "Exception: ".$e->toString();
}

mb_http_output("pass"); // mbstringの出力文字コード変換を無効にする
header("Content-type: application/pdf");
header("Content-Length: " . filesize($dst)); // ファイルサイズ出力
header("Content-Disposition:inline; filename=sample.pdf");
readfile($dst);
?>
