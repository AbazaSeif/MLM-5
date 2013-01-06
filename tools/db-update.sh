#!/bin/bash

#
# MLM System
#
# @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
# @copyright 2012 Adrian Wądrzyk. All rights reserved.
#

USER="mlm"
DBNAME="mlm"
SQL_DIR="../sql"

echo -n "Password: "
stty -echo
read PASSWORD
stty echo
echo #force new line

for file in `ls $SQL_DIR/*.sql`; do
	echo " - " `basename $file`
	mysql -u $USER -p$PASSWORD -D $DBNAME < $file
done;
