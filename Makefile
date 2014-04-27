.PHONY: cs md cov pear

cs:
	phpcs --standard=PSR2 --ignore=Wrapper.php src/

md:
	phpmd src/

cov:
	phpunit --coverage-html=build/log/coverage
	open build/log/coverage/index.html

scru:
	scrutinizer run --output-file=build/log/scrutinizer.json ./

pear:
	./build/pear/package.php --source=src/ --version=$(version) > package.xml
	pear package
	mv VirtualFileSystem-$(version).tgz build/dist/
	/usr/local/opt/php55/bin/pirum add ../pear.thornag.github.io build/dist/VirtualFileSystem-$(version).tgz
	cd ../pear.thornag.github.io && git add . && git commit -a -m'adding VirtualFileSystem-$(version).tgz' && git push
