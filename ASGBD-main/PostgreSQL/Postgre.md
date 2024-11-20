# PostgreSQL: Gestión de Información de Equitación en la DB EquitacionSuave
![a](https://github.com/user-attachments/assets/a7b79a85-eac2-4e63-8afd-24adfba8f1af)

## Finalidad:
Se va a trabajar con comandos SQL para instalar PostgreSQL, crear tablas, gestionar usuarios, insertar y modificar datos, y utilizar pgAdmin para la administración visual.

---

## 1. Instalación de PostgreSQL en Linux

1. Actualiza los repositorios del sistema e instala PostgreSQL.
![cap1](https://github.com/user-attachments/assets/9dc8870b-29a1-4cf9-96a2-c464c62f4b82)

2. Inicia el servicio de PostgreSQL y configura el servicio para que se inicie automáticamente cada vez que se arranque el sistema.
![cap2](https://github.com/user-attachments/assets/411033ed-7c8f-4aef-8005-319aab10fbf1)

3. Cambia al usuario `postgres` y abre la consola de PostgreSQL.
![cap3](https://github.com/user-attachments/assets/74547285-12c2-4cc1-8294-2eaf417a6895)

---

## 2. Creación de la Base de Datos y Tablas

### Paso 1: Crear la base de datos

1. Conéctate a la consola de PostgreSQL como el usuario `postgres`.
![cap4](https://github.com/user-attachments/assets/f02a9cd4-5033-4aa9-9d71-651541dd53b6)
 
2. Crea una base de datos llamada `EquitacionSuave` y conéctate a ella.
![cap5](https://github.com/user-attachments/assets/62ae70d6-7da4-4129-a8de-ae2d8f24d83b)

### Paso 2: Crear las tablas principales

1. **Crea una tabla llamada `jinetes`** que incluya los siguientes campos:
   - `id`: un identificador único autoincrementado para cada jinete.
   - `nombre`: el nombre del jinete.
   - `apellido`: el apellido del jinete.
   - `categoria`: una cadena que representa el nivel de habilidad (e.g., Avanzado, Intermedio, Principiante).
   - `experiencia_años`: un número entero que indica los años de experiencia.
   - 
2. **Crea una tabla llamada `caballos`** que incluya los siguientes campos:
   - `id`: un identificador único autoincrementado para cada caballo.
   - `nombre`: el nombre del caballo.
   - `raza`: la raza del caballo.
   - `edad`: un número entero que representa la edad del caballo.
   - `jinete_id`: una referencia al `id` de la tabla `jinetes`, para indicar quién es el jinete actual del caballo.
![cap6](https://github.com/user-attachments/assets/d5486c6d-3406-4d86-9e33-26f24008f826)

---

## 3. Gestión de Usuarios y Roles

### Ejercicio 1: Crear usuarios con distintos niveles de permisos

1. Crea un usuario `admin_equitacion` con permisos para iniciar sesión en PostgreSQL y con la capacidad de crear bases de datos.
2. Crea un usuario `user_consultas` que solo pueda realizar consultas en la base de datos. 
3. Crea un usuario `user_lectura` que pueda ver datos en la base de datos pero no modificarlos.
![cap7](https://github.com/user-attachments/assets/fcd9bc4d-6e37-488d-8a3c-4433362603e8)


### Ejercicio 2: Asignar permisos

1. Conéctate a la base de datos `EquitacionSuave`.
2. Asigna permisos de consulta (`SELECT`) a `user_consultas` en las tablas `jinetes` y `caballos`.
3. Configura permisos para `user_lectura` para que solo pueda ver datos y no modificarlos en ambas tablas.
4. Da permisos completos (`SELECT`, `INSERT`, `UPDATE`, `DELETE`) al usuario `admin_equitacion` en las tablas `jinetes` y `caballos`.
![cap8](https://github.com/user-attachments/assets/4e74494d-7e6a-40d0-ae6e-d3f272dc6664)

---

## 4. Inserción de Datos en las Tablas

1. Inserta varios registros en la tabla `jinetes` con diferentes valores de nombres, apellidos, categorías y años de experiencia.
2. Inserta varios registros en la tabla `caballos`, especificando el nombre, raza, edad, y el `jinete_id` correspondiente.
![cap9](https://github.com/user-attachments/assets/099f8a30-98f4-4d9d-ba6e-5d188b757efc)

---

## 5. Consultas de Datos

1. Realiza una consulta para obtener todos los registros de la tabla `jinetes`.
2. Realiza una consulta que muestre solo los jinetes con más de dos años de experiencia.
3. Realiza una consulta para obtener los nombres de los caballos junto con los nombres de sus respectivos jinetes.
![cap10](https://github.com/user-attachments/assets/5eb16b0b-0b5f-4cc1-83ee-c73202e5cc41)
![cap11](https://github.com/user-attachments/assets/2955f753-4e0f-425e-8a30-0ecd881913b6)

---

## 6. Actualización y Eliminación de Datos

1. Realiza una actualización en la tabla `jinetes` para cambiar la categoría de un jinete.
2. Realiza una eliminación en la tabla `jinetes` para borrar un registro específico.
![cap12](https://github.com/user-attachments/assets/8fe6e287-7acf-4797-8598-feaf87af3c88)

---

## 7. Uso de pgAdmin para Administración Visual

### Paso 1: Acceso a pgAdmin y conexión al servidor PostgreSQL

1. Abre pgAdmin.
![cap13](https://github.com/user-attachments/assets/25e7bd52-320f-495c-b0b4-a418768e1319)
3. Conéctate al servidor PostgreSQL usando las credenciales de `postgres`.
4. Verifica la conexión y accede a la lista de bases de datos.

### Paso 2: Crear la base de datos `EquitacionSuave`

1. En pgAdmin, crea la base de datos `EquitacionSuave` con `postgres` como propietario.

### Paso 3: Crear las tablas `jinetes` y `caballos`

1. En la sección **Schemas > public > Tables** de pgAdmin, crea la tabla `jinetes` con los campos mencionados en el paso 2.
2. Crea también la tabla `caballos` con los campos requeridos y la referencia a la tabla `jinetes`.

### Paso 4: Insertar y consultar datos

1. Utiliza la herramienta de consulta (Query Tool) de pgAdmin para insertar y consultar datos en ambas tablas.

### Paso 5: Crear y administrar usuarios y roles en pgAdmin

1. En **Login/Group Roles** de pgAdmin, crea los usuarios `admin_equitacion`, `user_consultas` y `user_lectura`.
2. Asigna los permisos correspondientes a cada usuario en las tablas `jinetes` y `caballos` usando la interfaz gráfica de pgAdmin.

---

## 8. Características Avanzadas de PostgreSQL

### Ejercicio 1: Uso de JSON en la tabla `jinetes`

1. Añade una columna llamada `detalles_competencias` de tipo JSON en la tabla `jinetes`.
2. Inserta un nuevo registro en la tabla `jinetes` y utiliza la columna `detalles_competencias` para almacenar datos en formato JSON que incluyan las competencias y el número de victorias del jinete.

### Ejercicio 2: Uso de arreglos (ARRAYS) para certificaciones

1. Añade una columna `certificaciones` de tipo ARRAY en la tabla `jinetes`.
2. Actualiza uno de los registros en `jinetes` para almacenar múltiples certificaciones en la columna `certificaciones`.

### Ejercicio 3: Creación de Vistas Materializadas

1. Crea una vista materializada llamada `vista_jinetes_avanzados` que contenga los registros de jinetes cuya categoría sea `Avanzado`.
2. Realiza una operación para actualizar los datos de la vista materializada.

### Ejercicio 4: Herencia en Tablas para gestionar equipos de equitación

1. Crea una tabla base llamada `equipo_base` con los campos `id`, `nombre` y `tipo`.
2. Crea una tabla heredada llamada `equipo_de_salto` que extienda `equipo_base` y añada un campo `altura_maxima` para especificar la altura máxima permitida del equipo.
3. Inserta un registro en la tabla `equipo_de_salto`.

