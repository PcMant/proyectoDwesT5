---
title: Trabajo DWES T5
author: Juan Molina
header-includes: |
lang: es-ES
keywords: UT5. 03/03/2022
---
# Trabajo DWES T5

## Introducción
Mi proyecto es una aplicación destinada a gestionar una base de datos de libros tipo biblioteca que se trata de un servidor SOA y un cliente SOA el cual uno conecta al otro.

El servidor SOA interactúa con una base de datos y proporciona al cliente los datos y este le proporciona métodos los cuales permite interactuar con la base de datos, pero el cliente no interactúa directamente con la base de datos.

Todos los métodos disponibles precisan de un inicio de sesión el cual usa autenticación por el uso de token, si el token no es válido o no has iniciado sesión entonces no podrás hacer ninguna acción sobre la base de datos ni consultar.

## Estructura

### Carpata cliente
Es donde están todas las páginas y scripts que permite al cliente interactuar
con el servidor SOA. 
#### Carpeta assets
Es donde se encuentra la librería de boostrap, la hoja de estilos e imágenes.

#### Carpeta php
Es donde se almacenan los scripts necesarios para que funcione el cliente.

### Carpeta doc
Almacena documentación del proyecto, en este caso alberga una carpeta php
que almacena un phpdoc con información de tanto el servidor SOA como el cliente.

### Carpeta servicioSOA
En está carpeta se encuentra la librería nusoap y los scipts necesarios para funcionar acompañado del fichero wsdl. 

## Uso
- Antes de poder hacer cualquier acción debes de iniciar sesión, de lo contrario nada de lo que intentes hacer hará efecto y saldrá una alerta de bootstrap que te notificará que no tienes los privilegios.
- Dispones de un menú con varias opciones:
  - Inicio: Para iniciar la sesión.
  - Noticias: Aquí podrás ver noticias acerca de libros obtenidas de la [API mediastack](https://mediastack.com/).
  - Añadir libro: Aquí podrás añadir nuevos libros, todos los campos del formulario pueden ser vacíos excepto el título.
  - Editar libro: Aquí podrás modificar libros ya introducidos bajo el criterio de la id con el que fue registrado.
  - Borrar libro: Aquí podrás borrar libros poniendo la id con la que fue registrado.
  - Consultar: Aquí podrás consultar libros por título o auntor.