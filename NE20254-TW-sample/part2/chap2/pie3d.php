<?php // �����ιϪ��d��
require_once("jpgraph.php");
require_once("jpgraph_pie.php");
require_once("jpgraph_pie3d.php");

mb_http_output('pass');
$labels = array("-2000","2000",'2001','2002','2003','2004'); // �Ϩ�
$inc = array(1.2e6,3.9e6,2.4e6,2.5e6,5e6,3e6); // ���

$graph = new PieGraph(400,200,"auto"); // �� 400*200 ����ø�s
$graph->SetShadow(); // �]�w�~�س��v

// ���D: ���� (�s�ө���) 15 ���r
$graph->title->Set("PHP �ϥΪ̤H�ƼW�[");
$graph->title->SetFont(FF_BIG5,FS_NORMAL,15);

$pie = new PiePlot3d($inc); // �����ι�
$pie->SetTheme("sand"); // ��Ρu��z�v�t��D�D
$pie->SetCenter(0.4);
$pie->SetAngle(30); // �N��ι϶ɱ� 30 ��

$pie->value->SetFont(FF_ARIAL,FS_NORMAL,12); // �r���]�� Arial 12 ���r
$pie->SetLegends(array_reverse($labels)); // �l�[�Ϩ�
$graph->Add($pie); // �l�[��ι�
$graph->Stroke(); // ��X�Ϫ�
?>

