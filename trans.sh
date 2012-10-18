#!/bin/bash
INPUT=/home/brian/www/codesgist/app/views/
OUTPUT=/home/brian/www/codesgist/lang/
php /home/brian/www/codesgist/tools/tsmarty2c.php $INPUT > ${OUTPUT}smarty.c
touch ${OUTPUT}messages.po
xgettext --no-wrap -j $OUTPUTsmarty.c -d ${OUTPUT}messages
#find $2 -iname "*.inc" -exec xgettext --no-wrap -j -L PHP {} \;
#find $2 -iname "*.php" -exec xgettext --no-wrap -j -L PHP {} \;
