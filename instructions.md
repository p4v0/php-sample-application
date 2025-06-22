# Instructivo para desplegar la aplicación con Docker Compose

## 1. Pre-requisitos

- Tener instalado [Docker](https://docs.docker.com/get-docker/) y [Docker Compose](https://docs.docker.com/compose/install/).

## 2. descarga el archivo [docker-compose-pub.yml]()

## 2. Variables de entorno

Crea un archivo llamado `.env` en la misma carpeta donde está el `docker-compose` provisto con el siguiente contenido (ajusta los valores según tu caso):

```
MYSQL_DATABASE=nombre_de_tu_bd
MYSQL_USER=usuario_bd
MYSQL_PASSWORD=pass_bd
MYSQL_ROOT_PASSWORD=pass_root
```

> **No compartas tu archivo `.env` en repositorios públicos.**

## 3. Levantar los servicios

Ejecuta en la terminal, dentro de la carpeta del proyecto:

```sh
docker-compose -f docker-compose-pub.yml up -d
```

Esto descargará y ejecutará las imágenes necesarias, configurando la base de datos y la aplicación automáticamente.

## 4. Acceder a la aplicación

Abre tu navegador y visita:  
[http://localhost:8080](http://localhost:8080)

---

**Notas:**

- Si necesitas detener los servicios, ejecuta:
  ```sh
  docker-compose down
  ```
- El archivo `docker-compose.yml` ya está configurado para usar las imágenes publicadas en Docker Hub y las variables de entorno definidas
