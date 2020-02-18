#!/bin/bash
#
# backupimages.sh
#
#	daily backup for image files of kansoku data
#
#						2002-04-08
#						jun kuwamura
#
# This script should be invoked by cron in the last minute
# of the day.  Add an ently to the crontab like the following.
#
#09 23 * * *	find /site/ftp/incoming/kansoku/. -size 0 -exec rm -f {} \;

#59 23 * * *	/home/users/kansoku/public_html/server/backupimages.sh
#
workdir=/home/users/kansoku/public_html/server
arcivdir=/home/users/kansoku/public_html/server/archive
dayprefix=`date +"%Y%m%d"`

iml_original=kansoku
iml_work=work
iml_scratch=scratch

backupshell=imlbackup-${dayprefix}.sh

cat > $backupshell <<__EOS__
# $0
cd $workdir
echo "tar cvfz ${arcivdir}/${dayprefix}.tgz kansoku/${dayprefix}*"
if  tar cvfz ${arcivdir}/${dayprefix}.tgz ${iml_original}/${dayprefix}* 1>/dev/null 2>&1 ; then
	rm -f ${iml_original}/${dayprefix}*
	rm -f ${iml_work}/${dayprefix}*
	rm -f ${iml_scratch}/${dayprefix}*
	cd ${arcivdir}
	tar xvfz ${dayprefix}.tgz
	cd kansoku/
	../../encode_kansoku_image.sh ${dayprefix}
	mv ${dayprefix}.mpg ..
	cd ..
	rm -rf kansoku/
else
	echo "${dayprefix}*: backup failed!"
fi
__EOS__

at -f ./$backupshell 5:10
