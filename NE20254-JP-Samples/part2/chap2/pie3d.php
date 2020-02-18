<?php // 3�����ߥ���դ���
require_once("jpgraph.php");
require_once("jpgraph_pie.php");
require_once("jpgraph_pie3d.php");

mb_http_output('pass');
$labels = array("-2000","2000",'2001','2002','2003','2004'); // ����
$inc = array(1.2e6,3.9e6,2.4e6,2.5e6,5e6,3e6); // �ǡ���

$graph = new PieGraph(400,200,"auto"); // 400*200�ԥ����������
$graph->SetShadow(); // �Ȥ˱Ƥ��դ���

// �����ȥ�:�����å�/14�ݥ����
$graph->title->Set("PHP�桼����������");
$graph->title->SetFont(FF_GOTHIC,FS_NORMAL,11);

$pie = new PiePlot3d($inc); // 3�����ߥ����
$pie->SetTheme("sand"); // ���ơ��ޤ�ֺ����פ�����
$pie->SetCenter(0.4);
$pie->SetAngle(30); // �ߥ���դη��Ф�30�٤�

$pie->value->SetFont(FF_ARIAL,FS_NORMAL,12); // �ե���Ȥ�Arial,12�ݥ���Ȥ�
$pie->SetLegends(array_reverse($labels)); // ������ɲ�
$graph->Add($pie); // �ߥ���դ��ɲ�
$graph->Stroke(); // ����դ����
?>

