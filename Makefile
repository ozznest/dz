SERVICE=

.PHONY: build up redeploy down ps exec config_build config_up

build:
	docker-compose -f docker-compose.yaml -f docker-compose.build.yaml build $(SERVICE)

up:
	docker-compose -f docker-compose.yaml -f docker-compose.dev.up.yaml up -d $(SERVICE)


down:
	docker-compose -f docker-compose.yaml -f docker-compose.dev.up.yaml down -v

exec:
	docker exec -ti $(SERVICE) /bin/sh