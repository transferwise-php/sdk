.PHONY: test
test: test_unit

.PHONY: test_unit
test_unit:
	vendor/bin/phpunit --verbose --debug

.PHONY: lint
lint:
	./vendor/bin/php-cs-fixer fix --diff --dry-run

.PHONY: lint_fix
lint_fix:
	./vendor/bin/php-cs-fixer fix --diff