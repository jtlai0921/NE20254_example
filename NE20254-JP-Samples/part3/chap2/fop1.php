<?php // FOP�ˤ��XML�ե����뤫��PDF�����
$src = dirname(__FILE__) . "/" . "sample.fo"; // ���ϥե�����
$dst = "/tmp/sample.pdf"; // ���ϥե�����
$conf = dirname(__FILE__) . "/" . "userconfig.xml"; // �桼������ե�����

try {
  // �ɥ饤������
  $driver = new Java("org.apache.fop.apps.Driver",
                     new Java("org.xml.sax.InputSource", $src),
                     new Java("java.io.FileOutputStream", $dst));
  $driver->setRenderer($driver->RENDER_PDF); // ������Ȥ���PDF�����
  $driver->run(); // ������󥰼¹�
} catch (Java_Exception $e) {
  echo "Exception: ".$e->toString();
}

mb_http_output("pass"); // mbstring�ν���ʸ���������Ѵ���̵���ˤ���
header("Content-type: application/pdf");
header("Content-Length: " . filesize($dst)); // �ե����륵��������
header("Content-Disposition:inline; filename=sample.pdf");
readfile($dst);
?>
