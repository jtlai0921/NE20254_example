<?php
function ImageJScroll( $sc=1 )
{
  $y1=$sc;
  $y2=2*$sc;
  $y3=3*$sc;
  $y4=4*$sc;
  $y5=5*$sc;
  echo <<<__EOS__
<script language="JavaScript">
<!--
//
function scroll () {
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y2);
  window.scrollBy(0, $y2);
  window.scrollBy(0, $y2);
  window.scrollBy(0, $y2);
  window.scrollBy(0, $y3);
  window.scrollBy(0, $y3);
  window.scrollBy(0, $y3);
  window.scrollBy(0, $y3);
  window.scrollBy(0, $y4);
  window.scrollBy(0, $y4);
  window.scrollBy(0, $y4);
  window.scrollBy(0, $y4);
  window.scrollBy(0, $y5);
  window.scrollBy(0, $y5);
  window.scrollBy(0, $y5);
  window.scrollBy(0, $y5);
  window.scrollBy(0, $y5);
  window.scrollBy(0, $y5);
  window.scrollBy(0, $y5);
  window.scrollBy(0, $y4);
  window.scrollBy(0, $y4);
  window.scrollBy(0, $y4);
  window.scrollBy(0, $y3);
  window.scrollBy(0, $y3);
  window.scrollBy(0, $y3);
  window.scrollBy(0, $y2);
  window.scrollBy(0, $y2);
  window.scrollBy(0, $y2);
  window.scrollBy(0, $y2);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
  window.scrollBy(0, $y1);
}
//-->
</script>
__EOS__;
  echo "<body onLoad=\"scroll()\">\n"; 
}
?>
