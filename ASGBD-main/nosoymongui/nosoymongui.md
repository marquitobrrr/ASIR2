# INSTRUCCIONES:
- Haz commit en cada clase con el comentario: [clase] 'tarea realizada'
- Lo que trabajes en casa haz commit al terminar con el comentario: [casa] 'tarea realizada'
- Rellena el portfolio Wix con tu feedback del desafío.
  
# 0. Esquema de la Base de Datos Relacional de mandarinas
- Mandarinas:
    - id_mandarina (INTEGER, PK, AUTOINCREMENT): Identificador único para cada mandarina.
    - color (TEXT, NOT NULL): Color de la mandarina.
    - tipo (TEXT, NOT NULL): Tipo de mandarina.
    - size (TEXT, NOT NULL): Tamaño de la mandarina.
    - fecha_recogida (DATE, NOT NULL): Fecha en la que se recogió la mandarina.
- Melocotones:
    - id_melocoton (INTEGER, PK, AUTOINCREMENT): Identificador único para cada melocotón.
    - tipo (TEXT, NOT NULL): Tipo de melocotón.
    - suavidad (BOOLEAN, NOT NULL): Indica si el melocotón es suave (1) o no (0).
- Caquis:
    - id_caqui (INTEGER, PK, AUTOINCREMENT): Identificador único para cada caqui.
    - id_mandarina (INTEGER, FK, NOT NULL): Relacionado con id_mandarina en la tabla 'mandarinas'.
    - id_melocoton (INTEGER, FK, NOT NULL): Relacionado con `id_melocoton en la tabla 'melocotones'.
    - color (TEXT, NOT NULL): Color del caqui.
    - pedunculo (BOOLEAN, NOT NULL): Indica si el caqui tiene pedúnculo (1) o no (0).
    - tiempo_maduracion (INTEGER, NOT NULL): Tiempo de maduración en días.

Basándose en el esquema relacional anterior, se debe diseñar la estructura de los documentos en Mongo DB para cada colección que se considere necesaria para cubrir todos los datos que pueda albergar la bas e de datos.

# 1. Esquema de la Base de Datos Relacional de un comercio
## La base de datos relacional consta de las siguientes tablas:
- 1. Tabla users
    - user_id (PRIMARY KEY)
    - name (TEXT)
    - email (TEXT)
- 2. Tabla orders`
    - order_id (PRIMARY KEY)
    - user_id (FOREIGN KEY)
    - total (REAL)
- 3. Tabla products`
    - product_id (PRIMARY KEY)
    - name (TEXT)
    - price (REAL)
- 4. Tabla intermedia order_products`
    - order_id (FOREIGN KEY)
    - product_id (FOREIGN KEY)


# Diseño de Documentos en MongoDB
Basándose en el esquema relacional anterior, se debe diseñar la estructura de los documentos en Mongo DB para cada colección que se considere necesaria para cubrir todos los datos que pueda albergar la bas e de datos. Y teniendo en cuenta las relaciones y la optimización de las consultas. Después de diseñar las colecciones, crear los documentos específicos para poder insertar exactamente los datos de los ejemplos anteriores.

## 1. Creación de la Base de Datos y Inserción de Datos
### A. Utilizando la Terminal de mongo
- Crea una base de datos llamada mi_comercio
- Crea las colecciones anteriores
- Inserta los documentos anteriores en las colecciones correspondientes.

- Realiza las siguientes consultas:
    - Consulta 0: Lista todas la colecciones
 
    - Consulta 1: Listar todos los usuarios

    - Consulta 2: Buscar pedidos de un usuario cuyo id sea 1

    - Consulta 3: Listar productos con precio mayor a 30

    - Consulta 4: Buscar pedidos que contengan un producto con id = 2

    - Consulta 5: Obtener usuarios que hayan realizado pedidos con un total mayor a 40

    - Consulta 6: Mostrar solo los nombres y correos de los usuarios

    - Consulta 7: Contar cuántos productos tienen un precio menor o igual a 50

    - Consulta 8: Encontrar usuarios que hayan pedido un producto llamado "Mouse"

    - Consulta 9: Agrupar los pedidos por usuario y calcular el total gastado por cada uno

    - Consulta 10: Listar productos únicos comprados en todos los pedidos

    - Resumen de todas las consultas:


### B. Realiza lo mismo desde la interfaz gráfica MongoDB Compass creando una base de datos llamada mi_comercio2
- 1. Reflexión sobre las diferencias entre trabajar con MongoDB desde la terminal y desde Compass, destacando ventajas y desventajas de cada método.
- Instalaremos MongoDB Compass para proceder a crear la base de datos:

- Una vez instalado ya podremos comenzar a utilziar MongoDB Compass:

- Crearemos la base de datos mi_comercio2:
