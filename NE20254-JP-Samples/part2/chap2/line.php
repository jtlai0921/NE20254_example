<?php // �ޤ�������դ���
require_once("jpgraph.php");
require_once("jpgraph_line.php");

mb_http_output('pass'); // ʸ���������Ѵ�̵�� 

// �ץ�å��ѥǡ���
$labels = array('2000','2001','2002','2003','2004','2005');
$domains = array(1.2e6,5.1e6,7.5e6,10e6, 15e6, 18e6); 
$ipadrs = array(  0.35e6, 0.8e6, 1.1e6, 1.1e6, 1.2e6, 1.3e6); 

$graph = new Graph(300,250,"auto"); // 300*250�ԥ����������
$graph->SetScale("textlin"); // X��:�ƥ�����, Y��:����

$graph->img->SetMargin(60,40,40,60); // �ޡ���������

$graph->img->SetAntiAliasing(); // ����������ꥢ������ͭ��
$graph->SetShadow(); // �ȤαƤ��դ���

// �����ȥ�
$graph->title->Set("PHP�桼�����ο��"); 
$graph->title->SetFont(FF_GOTHIC,FS_NORMAL,14); // �����å�/14�ݥ����
// X����٥�
$graph->xaxis->SetTickLabels($labels); // X����٥�����
$graph->xaxis->SetFont(FF_TIMES,FS_NORMAL,11); // Times/11�ݥ����
$graph->xaxis->SetLabelAngle(45); // 45�ٷ�����

// ��1������
$line1 = new LinePlot($domains);
$line1->mark->SetType(MARK_FILLEDCIRCLE); // �ޡ���:��
$line1->mark->SetFillColor("green"); // �Ф��ɤ�Ĥ֤���
$line1->mark->SetWidth(3); // �ޡ������礭�������
$line1->SetColor("blue"); // ���ο�����
$line1->SetCenter();
$line1->SetLegend("Domains"); // ���������

// ��2������
$line2 = new LinePlot($ipadrs);
$line2->mark->SetType(MARK_UTRIANGLE); // �ޡ����Ϣ�
$line2->mark->SetFillColor("green"); // �Ф��ɤ�Ĥ֤���
$line2->mark->SetWidth(3); // �ޡ������礭�������
$line2->SetColor("red"); // ���ο�����
$line2->SetCenter();
$line2->SetLegend("IP");// ���������

$graph->legend->SetLayout(LEGEND_VERT);  // ������ľ������
$graph->legend->Pos(0.8,0.5,"center","center"); // ����ΰ��֤����
$graph->Add($line1); // ����դ���1���ɲ�
$graph->Add($line2); // ����դ���2���ɲ�
$graph->Stroke();  // ����դ����
?>
