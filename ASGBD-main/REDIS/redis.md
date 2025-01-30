
# Parte 1: Instalación de Redis

### Actualizar el sistema y los
 repositorios

```bash
sudo apt update && sudo apt upgrade -y
```
![image](https://github.com/user-attachments/assets/347aa039-7305-416b-a5ae-8b2702688cc4)

### Instalar Redis
```bash
sudo apt install redis-server -y
```
![image](https://github.com/user-attachments/assets/d52125c1-a173-440e-9001-8e9ba6f83f21)

### Verificar la instalación
```bash
php -m | grep redis  
```
![image](https://github.com/user-attachments/assets/258f725d-809b-4abf-9ca1-32d9f3fb8b87)

### Iniciar el servicio de Redis
```bash
sudo systemctl start redis
```
![image](https://github.com/user-attachments/assets/5661d35a-825a-4aae-aa04-e042c6ebdd70)

### Habilitar Redis para que inicie automáticamente al arrancar:
```bash
sudo systemctl enable redis
```
![image](https://github.com/user-attachments/assets/6596d7fc-72c9-4d61-90d7-444a5768565f)

### Comprobar que el servicio está corriendo:
```bash
systemctl status redis
```
![image](https://github.com/user-attachments/assets/d0f9cf5f-cfc2-4b87-9bc2-2cf212a358a5)

### Parar y reiniciar
```bash
sudo systemctl stop redis
sudo systemctl restart redis
```

### Probar Redis desde la terminal
### Acceder al cliente de Redis:
```bash
redis-cli
```
![image](https://github.com/user-attachments/assets/626849d3-aa71-49ec-ae67-2fb2f1f364b4)

### Probar un comando básico:
```bash
PING
```
### Debería responder con PONG.
![image](https://github.com/user-attachments/assets/ada6073a-327e-48fa-be88-24eaa327c091)

### Especificar una base de datos (por defecto usa la 0)
```bash
redis-cli -n 1
```
![image](https://github.com/user-attachments/assets/4b03758e-a202-4ffb-a828-62d936b2da3d)

---

# Parte 2: Comandos básicos en Redis

## Comprueba cada uno de los siguientes comandos en tu instalación:
## Comandos básicos para claves

### Establecer y obtener el valor de una clave
```bash
SET clave valor
GET clave
```
![image](https://github.com/user-attachments/assets/a2c8dd74-a7fc-4f49-b8de-3da6d58996ea)

### Eliminar una clave
```bash
DEL clave
```
![image](https://github.com/user-attachments/assets/6974db8f-e985-4218-bfc6-aa5745757b38)

### Verificar si una clave existe
```bash
EXISTS clave
```
![image](https://github.com/user-attachments/assets/9e2202c4-653c-4279-a980-38ce10cba9c8)

### Establecer una clave con tiempo de expiración (en segundos)
```bash
SETEX clave tiempo valor
```
![image](https://github.com/user-attachments/assets/49932984-1ec7-48b7-9b12-e508bed8edaf)

### Obtener el tiempo restante de una clave
```bash
TTL clave
```
![image](https://github.com/user-attachments/assets/b3ad382c-2862-4616-8e34-c06f722b6124)

### Renombrar una clave
```bash
RENAME clave nueva_clave
```
![image](https://github.com/user-attachments/assets/b86ad688-3135-4e79-891e-bca4627bd216)

---

## Listas

### Agregar elementos al principio y al final de una lista
```bash
LPUSH mi_lista valor1
RPUSH mi_lista valor2
```
![image](https://github.com/user-attachments/assets/2782c3a7-f000-4fae-a0d2-8be4227046fa)


### Obtener todos los elementos de una lista
```bash
LRANGE mi_lista 0 -1
```
![image](https://github.com/user-attachments/assets/73e51aad-b38a-4ef5-8cab-a15c9b9135cf)

### Obtener y eliminar el primer o último elemento de una lista
```bash
LPOP mi_lista
RPOP mi_lista
```
![image](https://github.com/user-attachments/assets/808ad8a7-4f54-4238-bd8e-e38ab664edeb)

### Longitud de la lista
```bash
LLEN mi_lista
```
![image](https://github.com/user-attachments/assets/538bae57-ed18-4f5f-b689-28f8b05fa06c)

---

## Conjuntos (Sets)

### Agregar elementos a un conjunto
```bash
SADD mi_conjunto valor1 valor2
```
![image](https://github.com/user-attachments/assets/db9149b5-800b-4ca9-a350-00f6b0c24db9)

### Obtener todos los elementos de un conjunto
```bash
SMEMBERS mi_conjunto
```
![image](https://github.com/user-attachments/assets/98a213fe-42a9-4ff9-af64-7f48d1f4b409)

### Verificar si un elemento pertenece a un conjunto
```bash
SISMEMBER mi_conjunto valor1
```
![image](https://github.com/user-attachments/assets/03374ef6-6d33-4715-8102-db36cad6878e)

### Eliminar un elemento de un conjunto
```bash
SREM mi_conjunto valor1
```
![image](https://github.com/user-attachments/assets/e0985ce3-2ef3-4990-9fe8-76b16759893d)

### Operaciones entre conjuntos (intersección, unión, diferencia)
```bash
SINTER conjunto1 conjunto2
SUNION conjunto1 conjunto2
SDIFF conjunto1 conjunto2
```
![image](https://github.com/user-attachments/assets/30786bcd-9d56-4fd3-a3c1-3fe495879341)

---

# Hashes

### Agregar un campo a un hash
```bash
HSET mi_hash campo1 valor1
```
![image](https://github.com/user-attachments/assets/d6356acd-fa94-4c85-9489-db0adc6103d4)

### Obtener el valor de un campo
```bash
HGET mi_hash campo1
```
![image](https://github.com/user-attachments/assets/8df3197e-cda6-4893-bee4-0b8cfa8c60dc)

### Obtener todos los campos y valores
```bash
HGETALL mi_hash
```
![image](https://github.com/user-attachments/assets/9128145a-d92f-4358-bc82-0132625e7b0d)

### Verificar si un campo existe
```bash
HEXISTS mi_hash campo1
```

### Eliminar un campo
```bash
HDEL mi_hash campo1
```
![image](https://github.com/user-attachments/assets/7770114d-42f1-4133-a35a-7d2f0687cade)

---

# Administración de bases de datos

### Cambiar de base de datos
```bash
SELECT número_base_datos
```
![image](https://github.com/user-attachments/assets/9ebf70ca-0b91-49ed-a87d-63a71a3073cf)

### Ver claves en la base de datos actual
```bash
KEYS *
```
![image](https://github.com/user-attachments/assets/525eb897-95d6-4f8f-8d4f-81590f7a5d15)

### Limpiar todas las claves de la base de datos actual
```bash
FLUSHDB
```
![image](https://github.com/user-attachments/assets/2ede8c86-b4ee-4635-9088-ddcfca01f301)

### Limpiar todas las claves de todas las bases de datos
```bash
FLUSHALL
```
![image](https://github.com/user-attachments/assets/eeee65e3-a151-4234-954c-0ee70df57cff)

---

# Información y monitoreo

### Obtener información del servidor
```bash
INFO
```

![image](https://github.com/user-attachments/assets/8d81612d-c583-4f5b-a100-a017d1a1e513)
![image](https://github.com/user-attachments/assets/aa7227a0-da7d-41da-945c-a1c191a51d8b)

### Ver estadísticas en tiempo real
```bash
MONITOR
```

![image](https://github.com/user-attachments/assets/be7d7c05-baa4-40eb-b32b-8702dbdae3de)

### Ver configuración actual
```bash
CONFIG GET *
```

![image](https://github.com/user-attachments/assets/a51a4058-2bf4-42d0-b2a4-89ce3bebec40)

### Cambiar configuración (temporalmente, mientras Redis esté en ejecución)
```bash
CONFIG SET parametro valor
```
![image](https://github.com/user-attachments/assets/99ab9fed-9b22-489d-bedc-760834958e68)

---

# Copias de seguridad y restauración

### Forzar la creación de un snapshot
```bash
SAVE
```
![image](https://github.com/user-attachments/assets/e82db92f-a7ea-4b55-ae5a-6e3e553e2e98)

### Realizar una copia asincrónica
```bash
BGSAVE
```
![image](https://github.com/user-attachments/assets/a5474f05-dda6-4611-bfb8-550b043d0e98)

---

# Parte 3: Uso de un cliente visual

1. **Instalar RedisInsight** (cliente visual oficial)
   - Descargar la última versión desde la web oficial:  
     [https://redis.com/redis-enterprise/redis-insight/](https://redis.com/redis-enterprise/redis-insight/)
     
![image](https://github.com/user-attachments/assets/d68c966a-d15a-4e4b-b425-d9807cea08ea)

### Instalar RedisInsight:
```bash
sudo dpkg -i <archivo_descargado>.deb
```
º![image](https://github.com/user-attachments/assets/cb3b32ec-a85c-40fa-8ff6-bb4e45040d73)

### Abrir RedisInsight:
```bash
redisinsight
```
![image](https://github.com/user-attachments/assets/530f6ef0-7339-441f-ae77-099b810570a5)

Conectar al servidor Redis (por defecto, host: `127.0.0.1`, puerto: `6379`).
![image](https://github.com/user-attachments/assets/b3388f38-2814-410a-a510-672933dde28c)

### Explorar Redis desde RedisInsight
Crear claves, insertar datos en listas o hashes, y observar las estructuras visualmente.
![image](https://github.com/user-attachments/assets/d961b9cf-7265-4bba-82dd-f9c1d219eceb)
![image](https://github.com/user-attachments/assets/5d03cb56-cf42-47ee-a1cd-5428f52c3315)
![image](https://github.com/user-attachments/assets/3dec7f44-5315-497d-952b-61bb7a0bb882)
![image](https://github.com/user-attachments/assets/e00bf213-f8ae-4be1-a083-6e6e576940d5)

# Parte 4: Otro ejercicio

## 1. Operaciones

Crear un sistema de gestión de inventario:

- Añade 5 productos (usando hashes con `HSET`).
  ![image](https://github.com/user-attachments/assets/b4979119-2340-44b0-afad-ecfe2b51502c)
  ![image](https://github.com/user-attachments/assets/ae0dfba5-367b-4ed7-a882-2089db3904f8)

- Incrementa el stock de uno de los productos (`HINCRBY`).
  ![image](https://github.com/user-attachments/assets/182667c1-af5d-486e-8e2a-6d8cee52d483)
  ![image](https://github.com/user-attachments/assets/5ba29e79-e53e-49ae-a8c6-2490fe21dbe2)

- Elimina un producto cuando el stock llegue a 0.
  ![image](https://github.com/user-attachments/assets/73d0950f-9603-429c-95ad-9462246002cf)

---

## 2. Simular un carrito de compras

Crear un carrito con la estructura de listas:
```bash
LPUSH carrito "Producto1" "Producto2"
LRANGE carrito 0 -1
```
 ![image](https://github.com/user-attachments/assets/cc4dfff6-5c12-4b62-bddb-606c2371880c)

---

## 3. Ranking de usuarios

Usar un conjunto ordenado para guardar puntuaciones:
```bash
ZADD ranking 100 "usuario1" 200 "usuario2" 150 "usuario3"
ZRANGE ranking 0 -1 WITHSCORES
ZREVRANK ranking "usuario2"
```
![image](https://github.com/user-attachments/assets/f59ead3b-f412-469f-8f56-db8dc492c9a8)

---

## 4. Simulación de notificaciones

Usar listas para simular una cola de notificaciones:
```bash
LPUSH notificaciones "Notificación 1" "Notificación 2"
RPOP notificaciones
```
![image](https://github.com/user-attachments/assets/d430211e-5bac-46b6-97e9-40741711d77d)

---

# Parte 5: Otro Ejercicio Más

Diseña un sistema de control de tareas con Redis. Debe permitir:

#### Pistas:
Usa listas (`LPUSH` y `LPOP`) o conjuntos ordenados (`ZADD` y `ZRANGE`).

1. Añadir tareas con nombre y prioridad.
   ```bash
   ZADD tareas 1 "Revisar correos"
   ZADD tareas 2 "ActZREM tareas "Revisar correos"ualizar softwares"
   ZADD tareas 2 "Revisar logs"
   ```
   ![image](https://github.com/user-attachments/assets/d5e0c8d1-31e7-496c-a98a-7327ff56d987)

3. Consultar todas las tareas en orden de prioridad.
   ```bash
   ZRANGE tareas 0 -1 WITHSCORES
   ```
   ![image](https://github.com/user-attachments/assets/aed129c2-3cea-4482-879f-b2d5c463f786)

5. Marcar tareas como completadas (eliminarlas de la lista).
   ´´´bash
   ZREM tareas "Revisar correos"
   ´´´
   ![image](https://github.com/user-attachments/assets/5e1b25ac-1ebd-437e-8536-cd14c66873ca)


