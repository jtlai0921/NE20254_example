#!/bin/sh
#awk '{printf "%0.3d:  %s\n",NR,$0}'
#awk '{printf "%3d:  %s\n",NR,$0}'

if [ "$1" = "" ]; then
  echo "Usage:"
  echo "	$0 <filename>"
  exit
fi

n=`wc -l $1 | awk '{print length($1)}'`
#echo ${n}
expand $1 | awk "{printf \"%${n}d:  %s\n\",NR,\$0}"
