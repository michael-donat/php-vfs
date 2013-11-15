.PHONY: cs md cov pear

cs:
	phpcs --standard=PSR2 src/

md:
	phpmd src/

cov:
	phpunit --coverage-html=build/log/coverage

pear:
	./build/pear/package.php --source=src/ --version=$(version) > package.xml
	pear package
	mv VirtualFileSystem-$(version).tgz ../pear.thornag.github.io/
	cd ../pear.thornag.github.io && /usr/local/opt/php55/bin/pirum add . VirtualFileSystem-$(version).tgz
	cd ../pear.thornag.github.io && git add . && git commit -a -m'adding VirtualFileSystem-$(version).tgz' && git push
