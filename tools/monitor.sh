#!/bin/bash

#
# MLM System
#
# @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
# @copyright 2012 Adrian Wądrzyk. All rights reserved.
#

if [ $# -lt 3 ]; then
	echo "Usage: `basename $0` src_folder extension output_file"
	exit 0
fi

BASEDIR=`dirname $1`"/"`basename $1`
TYPE=$2
OUTPUT=$3
LAST_MD5=0
COMPRESS=0
COMPRESSOR="yui/yuicompressor-2.4.7.jar"

if [ $# -eq 5 ] && [ $4 = 'c' ]; then
	COMPRESS=1
	COMPRESS_FILE_TYPE=$5;
fi

while [ true ]; do
	CURRENT_MD5=`find $BASEDIR -type f -iname "*.$TYPE" -printf "%f %T@\n" | md5sum | cut -c -32`

	if [ $LAST_MD5 != 0 ] && [ $LAST_MD5 != $CURRENT_MD5 ]; then
		echo -e "\e[1;34m `date` \e[0m"
		truncate --size 0 $OUTPUT

		for file in `ls $BASEDIR/*.$TYPE`; do
			if [ $COMPRESS -eq 1 ]; then
				java -jar $COMPRESSOR --charset utf8 --type $COMPRESS_FILE_TYPE $file >> $OUTPUT;
			else
				cat $file >> $OUTPUT;
			fi

			echo >> $OUTPUT;
			
			echo " - "`basename $file`;
		done
		echo
	fi

	LAST_MD5=$CURRENT_MD5;
	sleep 1 
done

