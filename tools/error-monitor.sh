#!/bin/bash

#
# MLM System
#
# @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
# @copyright 2012 Adrian Wądrzyk. All rights reserved.
#

if [ $# -lt 1 ]; then
	echo "Usage: `basename $0` error_log"
	exit 0
fi

FILENAME=$1
LAST_FILESIZE=`cat $FILENAME | wc -c`

TEMPDIR=/tmp/
TEMPFILE=$TEMPDIR`date +"%s"`".tmp"

BYTES_PACKAGE=1

while [ -f $FILENAME ]; do
	CURRENT_FILESIZE=`cat $FILENAME | wc -c`

	if [ $LAST_FILESIZE != 0 ] && [ $LAST_FILESIZE != $CURRENT_FILESIZE ]; then
		dd if=$FILENAME bs=$BYTES_PACKAGE skip=$LAST_FILESIZE of=$TEMPFILE >& /dev/null
		echo -e "\e[1;31m`date`\e[0m";
		cat $TEMPFILE
		echo

		if [ $# = 2 ] && [ $2 = "notify" ]; then
			notify-send --expire-time=2 "`date` $FILENAME"
		fi
	fi

	LAST_FILESIZE=$CURRENT_FILESIZE
	sleep 1
done
