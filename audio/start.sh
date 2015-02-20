#!/bin/sh

##########################################################
# Downloading videos and converting them into audios
# Exporting podcast list
##########################################################

homepath=$PWD
videopath=${homepath}/data/video
audiopath=${homepath}/data/audio
podcastpath=${homepath}/data/podcast

echo 'Saving list to database...'
php -f ${homepath}/saveListToDb.php program=qqsrx

echo 'Finding videos which need to be filled audio url...'
php -f ${homepath}/findVideosNeedFillAudioUrl.php program=qqsrx > ${homepath}/videos.list
echo '---------------------------------------------------'
cat ${homepath}/videos.list
echo '---------------------------------------------------'
echo ''

echo 'Downloading videos...'
cd $videopath
awk -F '\t' '{system(sprintf("wget -O %s.mp4 %s", $1, $2))}' ${homepath}/videos.list
cd $homepath

echo 'Converting videos to audios...'
cd $audiopath
awk -F '\t' '{system(sprintf("ffmpeg -i ../video/%s.mp4 %s.mp3", $1, $1))}' ${homepath}/videos.list
cd $homepath

echo 'Updating videos in database...'
php -f ${homepath}/updateAudioUrlToDatabase.php < ${homepath}/videos.list

echo 'Updating rss cache...'
php -f ${homepath}/exportPodcastXml.php program=qqsrx > ${podcastpath}/qqsrx.xml

echo 'DONE'
