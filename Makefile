dev-from-scratch: composer

composer:
	-rm -rf ./vendor
	composer install

pretty:
	./vendor/bin/pretty

pretty-fix:
	./vendor/bin/pretty fix

stan:
	./vendor/bin/phpstan analyse -l 5 src

test:
	./vendor/bin/phpunit

test-CI:
	./vendor/bin/phpunit --coverage-clover=coverage.clover

release:
	git add CHANGELOG.md && git commit -m "release(v$(VERSION))" && git tag v$(VERSION) && git push && git push --tags

.PHONY: dev-from-scratch composer pretty pretty-fix stan test test-CI release
