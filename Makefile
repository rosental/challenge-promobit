SHELL=/bin/sh

commands:
	$(commands)

# Constrói a aplicação em desenvolvimento e deixa o output do Docker ativo na tela.
develop_up:
	docker-compose -f docker-compose-develop.yml up --remove-orphans --build

# Constrói a aplicação em desenvolvimento e a coloca em segundo plano.
develop_up_d:
	docker-compose -f docker-compose-develop.yml up --remove-orphans -d --build

# Entra no bash do container do PHP.
develop_bash_php:
	docker-compose -f docker-compose-develop.yml exec php-fpm bash

# Realiza a instalação do composer em desenvolvimento usando o container do php-fpm
develop_composer_install:
	docker-compose -f docker-compose-develop.yml exec php-fpm composer install

# Faz a listagem das rotas usando o container ativo do php-fpm
routes_list:
	docker-compose exec php-fpm bin/console debug:route

# Faz a instalação das dependências do Node através do container do php-fpm
npm_install:
	docker-compose exec php-fpm npm install

# Roda o Node NPM em modo de desenvolvimento
npm_dev:
	docker-compose exec php-fpm npm run dev

# Roda o watch em modo de desenvolvimento
npm_watch:
	docker-compose exec php-fpm npm run watch

# Para a aplicação em desenvolvimento
develop_down:
	docker-compose -f docker-compose-develop.yml down

# Inativa os volumes em desenvolvimento
down_volumes:
	docker-compose down -v

# Constrói a aplicação em produção e deixa o output do Docker ativo na tela.
production_up:
	docker-compose -f docker-compose-production.yml up --remove-orphans --build

# Constrói a aplicação em produção e a coloca em segundo plano.
production_up_d:
	docker-compose -f docker-compose-production.yml up --remove-orphans -d --build

# Para a aplicação em produção
production_down:
	docker-compose -f docker-compose-production.yml down

# Entra no bash do container do PHP em ambiente de produção.
production_bash_php:
	docker-compose -f docker-compose-production.yml exec php-fpm bash

### Configure Production Env
production_composer_install:
	docker-compose -f docker-compose-production.yml exec php-fpm composer install --prefer-dist --no-interaction --optimize-autoloader # --no-dev

production_cache_clear:
	 docker-compose -f docker-compose-production.yml exec php-fpm bin/console cache:clear

production_bin_console:
	docker-compose -f docker-compose-production.yml exec php-fpm bin/console
