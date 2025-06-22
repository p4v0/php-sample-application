# Instructivo para desplegar la aplicación con Docker Compose

## 1. Pre-requisitos

- Tener instalado [Docker](https://docs.docker.com/get-docker/) y [Docker Compose](https://docs.docker.com/compose/install/).

## 2. descarga el archivo [docker-compose-pub.yml](https://raw.githubusercontent.com/p4v0/php-sample-application/refs/heads/master/docker-compose-pub.yml)

En la web que abre el link, clic drecho, Guardar como... y elige una carpeta de tu equipo.

> **asegúrate de que quede guardado como "docker-compose-pub.yml"**

## 3. Variables de entorno

Crea un archivo llamado `.env` en la misma carpeta donde descargaste `docker-compose-pub.yml`. Y copia el siguiente contenido en el `.env` (ajusta los valores según tu caso):

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
- El archivo `docker-compose-pub.yml` está configurado para usar las imágenes publicadas en Docker Hub y las variables de entorno definidas.

cpavony
