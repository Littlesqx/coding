SHELL := /bin/bash
BASEDIR = $(shell pwd)

# build with version info
versionDir = "./pkg/version"
gitTag = $(shell if ["`git describe --tags --abbrev=0 2>/dev/null`" != ""];then git describe --tags --abbrev=0; else git log --pretty=format:'%h' -n 1; fi)
buildDate = $(shell TZ=Asia/Shanghai date +%FT%T%z)
gitCommit = $(shell git log --pretty=format:'%H' -n 1)
gitTreeState = $(shell if git status|grep -q 'clean'; then echo clean; else echo dirty; fi)

ldflags = "-w -X ${versionDir}.gitTag=${gitTag} -X ${versionDir}.buildDate=${buildDate} -X ${versionDir}.gitCommit=${gitCommit} -X ${versionDir}.gitTreeState=${gitTreeState}"

all: gotool
	@echo "${ldflags}"
	@go build -v -ldflags ${ldflags} .

clean:
	rm -f ch10
	find . -name "[._]*.s[a-w][a-z]" | xargs -i rm -f {}

gotool:
	gofmt -w .
	go tool vet . | grep -v vendor;true

ca:
	openssl req -new -nodes -x509 -out config/server.crt -keyout config/server.key -days 3650 -subj "/C=DE/ST=NRW/L=Earth/O=Random Company/OU=IT/CN=127.0.0.1/emailAddress=xxxxx@qq.com"

help:
	@echo "make \t\t compile the source code"
	@echo "make clean \t remove binary file and vim swp files"
	@echo "make gotool \t run go tool 'fmt' and 'vet'"
	@echo "make ca \t generate ca files"

.PHONY: clean gotool ca help