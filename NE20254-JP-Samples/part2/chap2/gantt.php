<?php
include ("jpgraph.php");
include ("jpgraph_gantt.php");

$data = array(
  array(0,ACTYPE_NORMAL,'��ɮ','2005-1-21','2005-02-10',' [70%]'),
  array(1,ACTYPE_NORMAL,'�Խ�','2005-2-12','2005-02-28',''),
  array(2,ACTYPE_MILESTONE,'�ޥ��륹�ȡ���','2005-2-11','æ��'));  // �ǡ���
$constrains = array(array(0,1,CONSTRAIN_ENDSTART)); // ��«���
$progress = array(array(0,0.7),array(1,0.0)); // ��Ľ��

$graph = new GanttGraph(0,0,'auto'); // ����ȿ�����
$graph->SetBox(); // ����ɽ��
$graph->SetShadow(); // �Ƥ�ɽ��

// �����ȥ����� : �����å�, 11�ݥ����
$graph->title->Set("��ɮ��Ľ");
$graph->title->SetFont(FF_GOTHIC,FS_NORMAL,11);

$graph->SetDateRange('2005-1-20','2005-2-28'); // ����ɽ�������
$graph->ShowHeaders(GANTT_HDAY |GANTT_HWEEK | GANTT_HMONTH); // �إå��˷�,��,������ɽ��
$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR2); // ɽ�����������
$graph->scale->month->SetBackgroundColor("lightblue"); // �إå����طʿ������

$graph->iSimpleFont = FF_GOTHIC; // �������Υե���ȤȤ��ƥ����å����Ѥ���
$graph->iSimpleFontSize = 10;    // �������Υե���ȤΥ�����
$graph->CreateSimple($data,$constrains,$progress); // ����ȿޤ�����
$graph->Stroke(); // ����
?>
