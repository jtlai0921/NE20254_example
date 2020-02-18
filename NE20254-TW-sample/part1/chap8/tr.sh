#!/bin/sh
sed 's/","/,/g' < KEN_ALL.CSV | sed 's/"//g' | iconv -f SJIS -t UTF-8 > all.csv
