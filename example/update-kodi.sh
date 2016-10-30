#!/bin/bash

LATEST_RELEASE="$(today-release.phar)"
REMOTE_UPDATE_FOLDER='/storage/.update'

if [ -z "$1" ]
then
	echo usage update-kodi user@ip
	exit
fi

Falls nicht mußt du nurdieses <a rel="nofollow" href="https://github.com/schmiddim/getUrlToLastestLibreelecRelease/blob/master/release/latest-release.phar?raw=true">Phar File </a> und ein<a rel="nofollow" href="https://raw.githubusercontent.com/schmiddim/getUrlToLastestLibreelecRelease/master/example/update-kodi.sh"> Bash Script</a> downloaden und in ein <strong>bin</strong> folder legen - $USER/bin wäre ein schöner Ort dafür.

if [ $LATEST_RELEASE != "" ]
	then
	echo "do an update"
	echo $LATEST_RELEASE
	echo "download to pi"
	ssh $1 wget -q $LATEST_RELEASE -P $REMOTE_UPDATE_FOLDER
	echo "reboot pi"
	ssh kodi reboot
	else
	echo "no new release"
fi