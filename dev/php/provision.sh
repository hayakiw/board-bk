#!/bin/sh

cd /vagrant/dev/php


for cname in `docker ps --filter="name=board-php" --format "{{.Names}}" -q -a`
do
    if [ "$cname" = board-php ]
    then
        docker stop $cname
        docker rm $cname
    fi
done

docker build -t board/php .

docker run \
       -d \
       --restart=always \
       -v /etc/localtime:/etc/localtime:ro \
       --name board-php \
       --hostname board-php \
       -p 80:80 \
       -v /vagrant:/vagrant \
       --link board-mysql:board-mysql \
       -e DESKTOP_NOTIFIER_SERVER_URL=http://192.168.88.1:12345 \
       board/php

docker cp \
       /vagrant/dev/php/desktop-notifier-client \
       board-php:/usr/bin/notify-send

docker exec board-php /vagrant/dev/php/init-env.sh
