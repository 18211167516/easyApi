#!/bin/bash
DIR='./App'
cur_dateTime="`date +%Y-%m-%d,%H:%m:%s`"  
if [ ! -n "$DIR" ] ;then
    echo "you have not choice Application directory !"
    exit
fi

php easyswoole stop
php easyswoole start d

inotifywait -m -r -t 0 $DIR | while read file
do
   php easyswoole reload all
   echo "${cur_dateTime} : ${file} was modify" >> ./Temp/reload.log 2>&1
done