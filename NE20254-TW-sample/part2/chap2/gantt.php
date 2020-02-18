<?php
include ("jpgraph.php");
include ("jpgraph_gantt.php");

$data = array(
  array(0,ACTYPE_NORMAL,'����','2005-1-21','2005-02-10',' [70%]'),
  array(1,ACTYPE_NORMAL,'�s��','2005-2-12','2005-02-28',''),
  array(2,ACTYPE_MILESTONE,'���{�O','2005-2-11','��Z'));  // ���
$constrains = array(array(0,1,CONSTRAIN_ENDSTART)); // �������
$progress = array(array(0,0.7),array(1,0.0)); // �i��

$graph = new GanttGraph(0,0,'auto'); // �إߥ̯S��
$graph->SetBox(); // ��ܥ~��
$graph->SetShadow(); // ��ܳ��v

// �]�w���D: ���� (�s�ө���) 15 �I�r��
$graph->title->Set("�����i��");
$graph->title->SetFont(FF_BIG5,FS_NORMAL,15);

$graph->SetDateRange('2005-1-20','2005-2-28'); // �T�w������
$graph->ShowHeaders(GANTT_HDAY |GANTT_HWEEK | GANTT_HMONTH); // �b������ܤ�B�g�B�P��
$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR2); // ���w��ܮ榡
$graph->scale->month->SetBackgroundColor("lightblue"); // ���w�������I����

$graph->SetSimpleFont(FF_BIG5, 9); // ø�s�������r���]�w������ (�s�ө���) 9 �I
$graph->CreateSimple($data,$constrains,$progress); // ø�s�̯S��
$graph->Stroke(); // ��X
?>
