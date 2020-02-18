<?php
$code = 'SJIS';
if ($code == 'EUC-JP') {
  $Ascii = '[\x21-\x7E]';
  $Hkana = '(?:\x8E[\xA6-\xDF])';
  $Zspace = '(?:\xA1\xA1)';
  $Zdigit = '(?:\xA3[\xB0-\xB9])';
  $Zuletter = '(?:\xA3[\xC1-\xDA])';
  $Zlletter = '(?:\xA3[\xE1-\xFA])';
  $Zhiragana = '(?:\xA4[\xA1-\xF3])';
  $Zkana = '(?:\xA5[\xA1-\xF6])';
  $Kanji = '(?:[\xB0-\xF4][\xA1-\xFF]|\x8F[\xA1-\xFE][\xA1-\xFE])';
} elseif ($code == 'SJIS') {
  $Ascii = '[\x21-\x7E]';
  $Hkana = '[\xA6-\xDF]';
  $Zspace = '(?:\x81\x40)';
  $Zdigit = '(?:\x82[\x4F-\x58])';
  $Zuletter = '(?:\x82[\x60-\x79])';
  $Zlletter = '(?:\x82[\x81-\x9A])';
  $Zhiragana = '(?:\x82[\x9F-\xF1])';
  $Zkana = '(?:\x83[\x40-\x96])';
  $Kanji = '(?:[\x88-\x9F\xE0-\xFC][\x40-\x7E\x80-\xFC])';
} else { // Unicode (UCS2)
  $Ascii = '(?:\x00[\x21-\x7F])';
  $Hkana = '(?:\xFF[\x61-\x9F])';
  $Zspace = '(?:\x30\x00)';
  $Zdigit = '(?:\xFF[\x10-\x19])';
  $Zuletter = '(?:\xFF[\x21-\x3A])';
  $Zlletter = '(?:\xFF[\x41-\x5A])';
  $Zhiragana = '(?:\x30[\x40-\x9F])';
  $Zkana = '(?:\x30[\xA0-\xFF])';
  $IsCJKUnifiedIdeographs = '[\x4E-\x9F][\x00-\xFF]';
  $IsCJKCompatibility = '\x33[\x00-\xFF]';
  $IsCJKCompatibilityIdeographs = '[\xF9-\xFA][\x00-\xFF]';
  $IsCJKCompatibilityForms = '\xFE[\x30-\x4F]';
  $Kanji = "(?:$IsCJKUnifiedIdeographs|$IsCJKCompatibility|
               $IsCJKCompatibilityIdeographs|$IsCJKCompatibilityForms)";
}
?>
