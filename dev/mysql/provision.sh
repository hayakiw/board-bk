#!/bin/sh

cd /vagrant/dev/mysql

data=false

for cname in `docker ps --filter="name=board-mysql" --format "{{.Names}}" -q -a`
do
    if [ "$cname" = board-mysql ]
    then
        docker stop $cname
        docker rm $cname
    fi

    if [ "$cname" = board-mysql-data ]
    then
        data=true
    fi
done

if [ "$data" = false ]
then
    docker run --name board-mysql-data -v /var/lib/mysql busybox
fi

docker build -t board/mysql .

docker run \
       -d \
       --restart=always \
       -v /etc/localtime:/etc/localtime:ro \
       --name board-mysql \
       --hostname board-mysql \
       -p 3306:3306 \
       --volumes-from board-mysql-data \
       -e MYSQL_DATABASE=board \
       -e MYSQL_USER=board \
       -e MYSQL_PASSWORD=board \
       -e MYSQL_ALLOW_EMPTY_PASSWORD=yes \
       board/mysql \
       --character-set-server=utf8 \
       --collation-server=utf8_unicode_ci
