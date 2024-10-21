
# Administración de Usuarios en MySQL

## 1. Indica el nombre de las tablas que aparecen en tu base de datos MySQL.

![cap0](https://github.com/user-attachments/assets/2b860101-14f1-410d-ad02-483c97f6be3b)

## 2. Creación de usuarios

### Crea el usuario "Bego" con contraseña "Begoña" para que pueda acceder desde localhost.
### Crea el usuario "Mati" con contraseña "Mti90" para que pueda acceder desde el dominio lasalleinstitucion.es.
### Crea el usuario "Mifli" con contraseña "lopol45" para que pueda acceder desde el dominio lasalleinstitucion.es.

![cap1](https://github.com/user-attachments/assets/15a63c65-4448-4835-9905-9b912db1057f)

### Comandos: 

```sql
create user 'bego'@'localhost' identified by 'begoña';
create user 'mati'@'lasalleinstitucion.es' identified by 'mati90';
create user 'milfi'@'lasalleinstitucion.es' identified by 'lopol45';
```

---

## 3. Muestra los usuarios creados (los que están en la tabla user de la base de datos mysql). Indica la sentencia que has utilizado para mostrar a esos usuarios.

![cap2](https://github.com/user-attachments/assets/a1d9c7ce-b9ff-4bfb-a861-d087d352202a)

### Comandos:

```sql
select user, host from mysql.user;
```

---

## 4. Muestra el usuario con el que te has logado, utilizando para ello una función. Indica la sentencia que has utilizado para ello.

![cap3](https://github.com/user-attachments/assets/d78151ef-26c7-4b27-8b0b-2504aeb6122a)

### Comandos:

```sql
select current_user();
```

---

## 5. Cambia la contraseña de Mati, de manera que la nueva contraseña sea "minuevacontraseña". Indica la sentencia que has utilizado para ello.

![cap4](https://github.com/user-attachments/assets/e6217bf5-8a75-4009-b8b8-ae9b2a50be6c)

### Comandos:

```sql
alter user 'Mati'@'lasalleinstitucion.es' identified by 'minuevacontraseña';
```

---

## 6. Muestra los privilegios del usuario Bego. Indica la sentencia que has utilizado para ello.

![cap5](https://github.com/user-attachments/assets/96741d21-d958-4dee-9f12-e5ca5f68ffea)

### Comandos:

```sql
show grants for 'Bego'@'localhost';
```

---

## 7. Muestra los privilegios del usuario con el que te has logado. Indica la sentencia que has utilizado para ello.

![cap6](https://github.com/user-attachments/assets/ed94c742-5ba1-4463-bfc9-1aef747fe24a)

### Comandos:

```sql
show grants for 'root'@'localhost';
```

---

## 8. Concede permisos al usuario Bego de lectura y actualización sobre la tabla usuario.

![cap7](https://github.com/user-attachments/assets/50c393af-d286-480d-9a2c-ecc2093478e5)

### Comandos:

```sql
grant select, update on mysql_asir.usuario to 'Bego'@'localhost';
```

---

## 9. Conéctate como Bego y lanza una sentencia select y otra update sobre la tabla usuario. Lanza también una sentencia delete. Muestra las sentencias y sus efectos sobre la base de datos de la red social.

![cap8](https://github.com/user-attachments/assets/6c2e542d-ab22-418e-9f27-22d26f9a5d66)

### Comandos:

```bash
sudo mysql -u Bego -p

update usuario set nombre = 'bego' where nombre = 'bega';
delete from usuario where nombre = 'javi';
```

---

## 10. Concede permisos al usuario Mati de borrado sobre la tabla grupo.

![cap9](https://github.com/user-attachments/assets/531c14b0-0bd5-4a72-904f-468aaec8ca1d)

### Comandos:

```sql
grant delete on mysql_asir.grupo to 'Mati'@'lasalleinstitucion.es';
```

---

## 11. Crea el usuario Crispula con contraseña "rosita" para que pueda acceder desde el dominio lasalleinstitucion.es y con permiso de lectura, actualización y borrado sobre las tablas usuario, grupo y comentario. Concede además permisos a Crispula para que pueda conceder sus permisos a otros usuarios.

![cap10](https://github.com/user-attachments/assets/424dd7e3-7c9a-4089-9b0c-54f70ed314d3)

### Comandos: 

```sql
create user 'crispula'@'lasalleinstitucion.es' identified by 'rosita';

grant select, update, delete on mysql_asir.usuario to 'crispula'@'lasalleinstitucion.es';
grant select, update, delete on mysql_asir.grupo to 'crispula'@'lasalleinstitucion.es';
flush privileges;
```

---

## 12. Conéctate con el usuario Crispula e inserta un registro en la tabla comentario. Actualiza un registro de la tabla grupo. Muestra las sentencias y su resultado al ejecutarlas sobre la base de datos de la red social.

![cap12](https://github.com/user-attachments/assets/5be23d60-e217-4b6f-b06a-81b7a140897d)

### Comandos:

```sql
insert into comentario (id, contenido) values (1, 'hola que tal');
update grupo set nombre_grupo = 'Grupo B' where id = 1;
```

---

## 13. Concede permiso de borrado sobre la tabla usuario a Bego. Muestra la sentencia utilizada y el resultado de su ejecución. Concede permiso de lectura y actualización sobre la tabla grupo a Mati. Muestra la sentencia utilizada y el resultado de su ejecución.

![cap13](https://github.com/user-attachments/assets/e93bb80f-2270-4117-aac2-47f322b02a73)

### Comandos:

```sql
grant delete on mysql_asir.usuario to 'bego'@'localhost';
grant select, update on mysql_asir.grupo to 'mati'@'lasalleinstitucion.es';
```

---

## 14. Vuelve a conectarte con tu usuario de MySQL. Concede permisos totales sobre todas las tablas de la base de datos de la red social a Mifli. Muestra la sentencia utilizada y el resultado de su ejecución.

![cap14](https://github.com/user-attachments/assets/18eb0e7a-e25d-4f27-8f3c-2991c446834e)

### Comandos:

```sql
grant all privileges on mysql_asir.* to 'Milfi'@'lasalleinstitucion.es';
```

---

## 15. Quitale permisos de borrado sobre todas las tablas de la base de datos de la red social a Mifli. Muestra la sentencia utilizada y el resultado de su ejecución.

![cap15](https://github.com/user-attachments/assets/87478379-61c1-4e39-807c-8b3d20687469)

### Comandos:

```sql
revoke delete on mysql_asir.* from 'Milfi'@'lasalleinstitucion.es';
```

---

## 16. Muestra los usuarios creados y sus privilegios (los que están en la tabla user de la base de datos mysql). Indica la sentencia que has utilizado para mostrar esos usuarios.

![cap16](https://github.com/user-attachments/assets/de14e4ae-84c4-4827-a073-30d0d1e80b56)

### Comandos:

```sql
use mysql;
select * from user;
```
---
## 17. Cambia la contraseña del usuario Mifli modificando directamente la tabla user. Indica la sentencia que has utilizado para ello.

---![capbrrr](https://github.com/user-attachments/assets/b27916b9-32df-4dc2-ab6f-9cf2ba4c4317)

```sql
UPDATE user SET Password = 'Minuevacontraseña' WHERE User = 'Milfi';
```
- No deja realizar el UPDATE para modificar la contraseña, ya que user, no es una tabla sino una vista.
---
## 18. Explica el porqué y para qué sirve FLUSH PRIVILEGES.

- FLUSH PRIVILEGES es un comando que asegura que todos los cambios en los privilegios de usuario sean reconocidos y aplicados de inmediato. Sin este comando, cualquier cambio realizado directamente en las tablas de privilegios puede no tener efecto hasta que se reinicie el servidor, lo que podría causar problemas de acceso y seguridad.

## 19. ¿Puedo utilizar la función PASSWORD con GRANT? Justifica tu respuesta.

- No se puede usar PASSWORD con GRANT porque GRANT no permite la especificación de contraseñas de esta manera. Es recomemdable usar CREATE USER o ALTER USER para manejar contraseñas.
---
## 20. Elimina el usuario Mifli. Muestra la sentencia utilizada y el resultado de su ejecución.

![cap17](https://github.com/user-attachments/assets/a7c1b0de-0e54-4022-98df-91c6618c1118)

