# Запуск docker-конейтеров для первого запуска

```bash
docker-compose -f ./.configuration/docker/docker-compose.yml up --build
```

# Запуск docker-конейтеров для последующих

```bash
docker-compose -f ./.configuration/docker/docker-compose.yml up
```

# Зайти в docker-конейтер php

```bash
docker exec -it docker_php_microservice bash
```

# Дать права 777 на все файлы

```bash
sudo chmod 777 -R .
```
