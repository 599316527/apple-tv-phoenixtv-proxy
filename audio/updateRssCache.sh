#!/bin/sh

##########################################################
# Exporting podcast list
##########################################################

homepath=$PWD
podcastpath=${homepath}/data/podcast

date
echo '==================================================='

echo 'Updating rss cache...'
php -f ${homepath}/exportPodcastXml.php program=qqsrx > ${podcastpath}/qqsrx.xml

echo 'DONE'
