.PHONY: test
test: test_unit

.PHONY: test_unit
test_unit:
	vendor/bin/phpunit --verbose --debug