#!/bin/sh
java org.apache.fop.fonts.apps.TTFReader -ttcname "IPAPGothic" \
    /usr/share/fonts/ja/TrueType/ipagp.ttf ipagp.xml
java org.apache.fop.fonts.apps.TTFReader -ttcname "IPAPMincho" \
    /usr/share/fonts/ja/TrueType/ipamp.ttf ipamp.xml
