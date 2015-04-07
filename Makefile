.PHONY: cs md cov pear docs check

PHP_VFS_BUILD_BRANCH=$(shell git rev-parse --abbrev-ref HEAD)
PHP_VFS_BUILD_REV=$(shell git rev-parse HEAD)

cs:
	phpcs --standard=PSR2 --ignore=Wrapper.php src/

md:
	phpmd src/

test:
	vendor/bin/phpunit

cov:
	vendor/bin/phpunit --coverage-html=build/log/coverage
	open build/log/coverage/index.html

scru:
	scrutinizer run -f json --output-file=build/log/scrutinizer.json ./

ifndef version
check:
	$(error Usage: make tag version=...)
else
check:
	@git diff --quiet HEAD || (echo WORKING DIRECTORY DIRTY && false)
endif

setup-pear:
	git remote add pear git@github.com:michael-donat/pear.git || true
	git fetch pear
	git checkout pear || git checkout -b pear pear/gh-pages
	git checkout -
	sudo pear channel-discover pear.michaeldonat.net || true
	mkdir -p build/dist

pear: check setup-pear
	./build/pear/package.php --source=src/ --version=$(version) > package.xml
	pear package
	mv VirtualFileSystem-$(version).tgz build/dist/
	git checkout pear
	pirum add . build/dist/VirtualFileSystem-$(version).tgz
	git add . && git commit -a -m'adding VirtualFileSystem-$(version).tgz' && git push pear pear:gh-pages
	git checkout -f -

docs:
	@git diff --quiet HEAD || (echo WORKING DIRECTORY DIRTY && false)
	./vendor/bin/sami.php update .sami.php
	vendor/bin/phpunit --coverage-html=build/log/coverage
	git checkout gh-pages
	git pull
	mkdir -p api
	cp -rf build/docs/api/* api/
	git add api
	mkdir -p coverage
	cp -rf build/log/coverage/* coverage/
	git add coverage
	git commit -m"auto-generated coverage & API docs for $(PHP_VFS_BUILD_BRANCH):$(PHP_VFS_BUILD_REV)" || true
	git push
	git checkout $(PHP_VFS_BUILD_BRANCH)

tag: check
	git tag v$(version)
	git push --tags

deploy: tag pear docs