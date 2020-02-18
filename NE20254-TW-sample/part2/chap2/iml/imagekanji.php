<?php
//   Kanji Image Output Functions
//
//   Originaly created for Japanese version of PHP/FI compatibility
// by Jun Kuwamura <juk@yokohama.email.ne.jp>.
//
// (TTF available version of GD is required for PHP module.)
//
// 2002-03-04 JuK font path modified for RHL and Plamo Linux
// 2002-02-17 JuK modified for imagelist program
//

// The following fonts settings should be modified accordingly.
if ( is_dir("/usr/share/fonts/ja/TrueType") ) {
  $TTF_JA_FONTPATH="/usr/share/fonts/ja/TrueType";
} elseif ( is_dir("/usr/share/fonts/TrueType") ) {
  $TTF_JA_FONTPATH="/usr/share/fonts/TrueType";
} elseif ( is_dir("/usr/X11R6/lib/X11/fonts/TrueType") ) {
  $TTF_JA_FONTPATH="/usr/X11R6/lib/X11/fonts/TrueType";
}
if ( file_exists("$TTF_JA_FONTPATH/fs-mincho.ttf") ) {
  $mincho_font = "$TTF_JA_FONTPATH/fs-mincho.ttf";
} elseif ( file_exists("$TTF_JA_FONTPATH/mika.ttf") ) {
  $mincho_font = "$TTF_JA_FONTPATH/mika.ttf";
} elseif ( file_exists("$TTF_JA_FONTPATH/kochi-mincho.ttf") ) {
  $mincho_font = "$TTF_JA_FONTPATH/kochi-mincho.ttf";
} else {
  $mincho_font = "$TTF_JA_FONTPATH/watanabe-mincho.ttf";
}
if ( file_exists("$TTF_JA_FONTPATH/fs-gothic.ttf") ) {
  $gothic_font = "$TTF_JA_FONTPATH/fs-gothic.ttf";
} elseif ( file_exists("$TTF_JA_FONTPATH/kochi-gothic.ttf") ) {
  $gothic_font = "$TTF_JA_FONTPATH/kochi-gothic.ttf";
} else {
  $gothic_font = "$TTF_JA_FONTPATH/wadalab-gothic.ttf";
}

if ( is_dir('C:\\Windows\\Fonts') ) {
	$WIN_FONTPATH = 'C:\\Windows\\Fonts';
} elseif ( is_dir('C:\\WINNT\\Fonts') ) {
	$WIN_FONTPATH = 'C:\\WINNT\\Fonts';
}

if ( file_exists("$WIN_FONTPATH\\mingliu.ttc") ) {
	$mincho_font = "$WIN_FONTPATH\\mingliu.ttc";
} elseif ( file_exists("$WIN_FONTPATH\\msmincho.ttc") ) {
	$mincho_font = "$WIN_FONTPATH\\msmincho.ttc";
}

if ( file_exists("$WIN_FONTPATH\\kaiu.ttc") ) {
	$gothic_font = "$WIN_FONTPATH\\kaiu.ttc";
} elseif ( file_exists("$WIN_FONTPATH\\msgothic.ttc") ) {
	$gothic_font = "$WIN_FONTPATH\\msgothic.ttc";
}

$font_file = $mincho_font;

///////////////////////////////////////
// Check GD module and load it if not
///////////////////////////////////////
if(!extension_loaded('gd')){
  if(!dl('gd.so')){
    echo 'error failed to lord gd.so';
    exit;
  }
}

//////////////////////////////////////////////
// Check MB_String module and load it if not
//////////////////////////////////////////////
if(!extension_loaded('mbstring')){
  if(!dl('mbstring.so')){
    echo 'error failed to lord mbstring.so';
    exit;
  }
}

//////////////////////////////////////
// Set output encoding for http text
// (ASCII, JIS, UTF-8, EUC-JP, SJIS)
//////////////////////////////////////
function SetKanjiOutput( $code ) {
  mb_http_output($code);
}

//////////////////////////////////////
// Set output kanji font
// (goth, min)
//////////////////////////////////////
function ImageSetKanjiFont( $font ) {
  global $mincho_font;
  global $gothic_font;
  global $font_file;

  if ( $font == "goth" ) {
    $font_file = $gothic_font;
  } else if ( $font == "min" ) {
    $font_file = $mincho_font;
  } else if ( is_file( $font ) ) {
    $font_file = $font;
  }
}

////////////////////////////////////////////////////////////////////////
// Kanji output to internal GD image in horizontal direction
//	$im: internal image
//	$size: font size(1,2,3)
//	$x: horizontal location from left
//	$y: virtical location from top
//	$text: test strings to output
//	$col: font color
////////////////////////////////////////////////////////////////////////
function ImageKanji ($im, $size, $x, $y, $text, $col) {
  global $font_file;

  $angle = 0;
  $size = $size * 4;
  $x-=$size;
  $y+=$size;
  ImageTTFText($im, $size, $angle, $x, $y, $col, $font_file, $text);
  $x++;
  ImageTTFText($im, $size, $angle, $x, $y, $col, $font_file, $text);
  $y--;
  ImageTTFText($im, $size, $angle, $x, $y, $col, $font_file, $text);
  $x--;
  ImageTTFText($im, $size, $angle, $x, $y, $col, $font_file, $text);
}

////////////////////////////////////////////////////////////////////////
// Kanji output to internal GD image in virtical direction
//	$im: internal image
//	$size: font size(1,2,3)
//	$x: horizontal location from left
//	$y: virtical location from top
//	$text: test strings to output
//	$col: font color
////////////////////////////////////////////////////////////////////////
function ImageKanjiUp ($im, $size, $x, $y, $text, $col) {
  global $font_file;

  $angle = 90;
  $size = $size * 4;
  $x+=$size;
  $y-=$size;
  ImageTTFText($im, $size, $angle, $x, $y, $col, $font_file, $text);
  $x++;
  ImageTTFText($im, $size, $angle, $x, $y, $col, $font_file, $text);
  $y--;
  ImageTTFText($im, $size, $angle, $x, $y, $col, $font_file, $text);
  $x--;
  ImageTTFText($im, $size, $angle, $x, $y, $col, $font_file, $text);
}
?>
