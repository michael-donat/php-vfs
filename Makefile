.PHONY: cs md

cs:
	phpcs --standard=PSR2 src/

md:
	phpmd src/
