## Configuración

Esta aplicación requiere la creación de dos archivos `.env` para funcionar correctamente.

### Archivo `.env` de la carpeta raíz

Crea un archivo `.env` en la carpeta raíz del proyecto y establece las siguientes variables:

- DB_HOST=
- DB_NAME=
- DB_USER=
- DB_PASSWORD=

### Archivo `.env` de la carpeta `data`

Crea un archivo `.env` en la carpeta `data` y establece las siguientes variables:

- POSTGRES_USER=
- POSTGRES_PASSWORD=
- POSTGRES_DB=

## Levantamiento del contenedor

Una vez que hayas creado los archivos `.env`, puedes ejecutar el proyecto con el siguiente comando:

`docker-compose up -d`

## Instalado dependencias

Ejecuta el siguiente comando para instalar las dependencias del proyecto:

`composer install`
