#!/bin/sh
# set variables
if [ ."$1" = ."" ]; then
  date_today=`date +"%Y%m%d"`
else
  date_today=$1
fi
encode_template="/home/users/kansoku/public_html/server/kansoku_param.template"
encode_param="encode.param"
jpeglist="ls_jpg.lis"

# make a parameter file for mpeg_encode
#find . -size 0 -exec rm -f {} \;
#ls *.jpg | sort > $jpeglist
find . -name "*.jpg" -a -not -size 0 | sort > $jpeglist
sed -e "s/%%YYYYMMDD%%/$date_today/" \
	-e "/%%JPEG_FILES%%/r $jpeglist" \
	-e '/%%JPEG_FILES%%/d' $encode_template \
> $encode_param

# encode from jpeg to mpeg
mpeg_encode $encode_param
