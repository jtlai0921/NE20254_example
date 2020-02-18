<?php // ��u�Ͻd��
require_once("jpgraph.php");
require_once("jpgraph_line.php");

mb_http_output('pass'); // �����r���ഫ

// �Ϫ�θ��
$labels = array('2000','2001','2002','2003','2004','2005');
$domains = array(1.2e6,5.1e6,7.5e6,10e6, 15e6, 18e6); 
$ipadrs = array(  0.35e6, 0.8e6, 1.1e6, 1.1e6, 1.2e6, 1.3e6); 

$graph = new Graph(300,250,"auto"); // �� 300*250 ����ø�s�Ϫ�
$graph->SetScale("textlin"); // X�b�G��r  Y�b�G�u��

$graph->img->SetMargin(60,40,40,60); // �]�w���

$graph->img->SetAntiAliasing(); // �]�w�Ͽ����Ҧ�
$graph->SetShadow(); // �]�w�~�س��v

// ���D
$graph->title->Set("PHP �ϥΪ̤H�ƹw����"); 
$graph->title->SetFont(FF_BIG5,FS_NORMAL,15); // �s�ө��� / 15 ���r
// X �b����
$graph->xaxis->SetTickLabels($labels); // ���w X �b����
$graph->xaxis->SetFont(FF_TIMES,FS_NORMAL,11); // Times / 11 ���r
$graph->xaxis->SetLabelAngle(45); // �ɱ� 45 ��

// �yø�u 1
$line1 = new LinePlot($domains);
$line1->mark->SetType(MARK_FILLEDCIRCLE); // �O������
$line1->mark->SetFillColor("green"); // �κ���
$line1->mark->SetWidth(3); // ���w�O�����j�p
$line1->SetColor("blue"); // �u���Ŧ�
$line1->SetCenter();
$line1->SetLegend("Domains"); // �]�w�Ϩ�

// �yø�u 2
$line2 = new LinePlot($ipadrs);
$line2->mark->SetType(MARK_UTRIANGLE); // �O������
$line2->mark->SetFillColor("green"); // �κ���
$line2->mark->SetWidth(3); // ���w�O�����j�p
$line2->SetColor("red"); // �u������
$line2->SetCenter();
$line2->SetLegend("IP");// �]�w�Ϩ�

$graph->legend->SetLayout(LEGEND_VERT);  // �������J�Ϩ�
$graph->legend->Pos(0.8,0.5,"center","center"); // ���w�ϨҦ�m
$graph->Add($line1); // �N�u 1 �l�[��Ϫ�
$graph->Add($line2); // �N�u 2 �l�[��Ϫ�
$graph->Stroke();  // ��X�Ϫ�
?>
