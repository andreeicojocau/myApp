# myApp
Small PHP project

Requirements: docker, docker-compose

From /docker folder run
docker-compose --build -d

You need to also run "composer install" outside of the container since i can't make it work in eighter Dockerfile or docker-compose.yaml 

Server should start at http://localhost:8082/
