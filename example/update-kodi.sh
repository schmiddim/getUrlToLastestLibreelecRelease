#!/bin/bash

LATEST_RELEASE="$(today-release.phar)"
REMOTE_UPDATE_FOLDER='/storage/.update'

if [ -z "$1" ]
then
	echo usage update-kodi user@ip
	exit
fi


if [ "$LATEST_RELEASE" != "" ]
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