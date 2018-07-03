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
