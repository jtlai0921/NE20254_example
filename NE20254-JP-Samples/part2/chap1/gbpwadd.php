<?php
/*
 * ・イ・ケ・ネ・�А�DB、ホ・ム・ケ・��シ・ノウホヌァ。ソナミマソ
 *
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ・イ・ケ・ネ・�А�DB、ホツクコ゜ウホヌァ
if ( gbdbexists($fn) === false ) {
  // DBフオ、キ
  echo "<p>・イ・ケ・ネ・�А�DB($fn)、ャ、「、熙゛、サ、��ホ、ヌコ��熙゛、ケ。」</p>\n";
  // 、筅キ。「DB、ャツクコ゜、キ、ハ、ア、�Ε潺愁�、キ、ッコ���
  $dbh = gbdbopen($fn);
  if ($dbh === false) {
    echo "・イ・ケ・ネ・�А�DB($fn)、ャコ���Α�、サ、��」<br />";
  } else {
    if ( gbdbinit ($dbh) ) {
      gbdbclose($dbh);
      echo <<<EOF1
・イ・ケ・ネ・�А�DB、��キ、キ、ッコ��熙゛、キ、ソ。」エノヘ��ム、ホ・ム・ケ・��シ・ノ、����マ、キ、ニ、ッ、タ、オ、、。」
、ウ、ホ・ム・ケ・��シ・ノ、マ。「コ」ク螟ウ、ホ・イ・ケ・ネ・�А次▲曠┘離����献諭���ケ、�Ε宗≒Ε劵離礇悒蕁▲諭▲蓮♯Α�、ケ。」
<p><center>
<form action="{$_SERVER['PHP_SELF']}" method="post">
<input type="password" name="GUESTBOOKPASS">
<input type="submit" value=" ホサイ� ">
</form>
</center></p>
EOF1;
    } else {
      echo "・イ・ケ・ネ・�А次▲曠栢促隋▲劵轡灰魅筺▲�、゛、キ、ソ。」<br />";
    }
	}
  include "gbtrailer.php";
  exit;
} else {
  $dbh = gbdbopen($fn);
  if ($dbh === false) {
    echo "・イ・ケ・ネ・�А�DB($fn)、ヒス��ュケ��゜、ヌ、ュ、゛、サ、��」。」<br />";
    include("gbtrailer.php");
    exit;
  } else {
    $res = (int)gbdbtblexists($dbh, 'user_tbl');
    if (! $res ) {//"GUESTBOOKPASS"
	    // DB、ヒ・ム・ケ・��シ・ノ、ホナミマソ
	    $tuple = array( 'adm' => 1,
                      'name' => 'admin',
                      'pass' => $_POST['GUESTBOOKPASS']
                      );
	    
	    $ret = gbdbinsert($dbh, 'user_tbl', $tuple );
	    if ( empty($ret) ) {
        echo "・ム・ケ・��シ・ノ、��ミマソ、キ、゛、キ、ソ。ェ<br />";
	    } else {
        echo "ERROR: ・ム・ケ・��シ・ノ、ホナミマソ、ヒシコヌヤ、キ、゛、キ、ソ。ェ<br />";
	    }
    }
  }
  gbdbclose($dbh);
}
?>
