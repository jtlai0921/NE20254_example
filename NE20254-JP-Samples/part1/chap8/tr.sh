#!/bin/sh
sed 's/","/,/g' < KEN_ALL.CSV | sed 's/"//g' | nkf -w > all.csv
