# board

## Development

```
$ git clone

$ cd board/dev
$ vagrant up
```

When the virtual machine is up successfully, access to http://localhost:8080.

### About vboxsf error

```
local$ vagrant ssh
board$ sudo yum update -y kernel
board$ sudo yum install -y kernel-devel kernel-headers gcc gcc-c++
board$ exit
local$ vagrant reload --provision

```

## SSHing to web server.

```
local$ cd dev
local$ vagrant ssh
board$ docker exec -it board-php /bin/bash
```

Source code is at /vagrant directory.


## SSHing to mysql server.

```
local$ cd dev
local$ vagrant ssh
board$ docker exec -it board-mysql /bin/bash
```

## Testing

### Test setting.
```
docker$ cd /vagrant
docker$ cp .env.example .env.testing
docker$ php artisan key:generate --env=testing
docker$ vim .env.testing
docker$ php composer.phar install
```

### .env.testing
```
#DB_DATABASE=board
#DB_USERNAME=board
#DB_PASSWORD=board
DB_DATABASE=board_test
DB_USERNAME=board_test
DB_PASSWORD=board_test
```

### Run testing
```
docker$ cd /vagrant
docker$ php composer.phar test
```
