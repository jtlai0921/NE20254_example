<?php
$str = '���ܸ�';
echo mb_ereg_match("\w+",$str) ? "����": "�԰���","\n"; // ����: ����
if (mb_ereg("��(.)",$str,$regs)){
  print_r($regs); // $regs[0]='����' $regs[1]='��'
}
echo mb_ereg_replace("��","��","���ܸ�"); // ����: ���ܿ�
$regs = mb_split("[��-��]+","���ܸ���񤷤�");
print_r($regs); // $regs[0]='���ܸ�',$regs[1]='��',$regs[2]=''
?>
