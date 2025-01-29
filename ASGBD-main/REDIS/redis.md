
# Parte 1: Instalación de Redis

### Actualizar el sistema y los
 repositorios

```bash
sudo apt update && sudo apt upgrade -y
```

### Instalar Redis
```bash
sudo apt install redis-server -y
```

### Verificar la instalación
```bash
php -m | grep redis  
```

### Iniciar el servicio de Redis
```bash
sudo systemctl start redis
```

### Habilitar Redis para que inicie automáticamente al arrancar:
```bash
sudo systemctl enable redis
```

### Comprobar que el servicio está corriendo:
```bash
systemctl status redis
```

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

### Probar un comando básico:
```bash
PING
```
### Debería responder con PONG.

### Especificar una base de datos (por defecto usa la 0)
```bash
redis-cli -n 1
```

---

# Parte 2: Comandos básicos en Redis

## Comprueba cada uno de los siguientes comandos en tu instalación:
## Comandos básicos para claves

### Establecer y obtener el valor de una clave
```bash
SET clave valor
GET clave
```

### Eliminar una clave
```bash
DEL clave
```

### Verificar si una clave existe
```bash
EXISTS clave
```

### Establecer una clave con tiempo de expiración (en segundos)
```bash
SETEX clave tiempo valor
```

### Obtener el tiempo restante de una clave
```bash
TTL clave
```

### Renombrar una clave
```bash
RENAME clave nueva_clave
```

---

## Listas

### Agregar elementos al principio y al final de una lista
```bash
LPUSH mi_lista valor1
RPUSH mi_lista valor2
```

### Obtener todos los elementos de una lista
```bash
LRANGE mi_lista 0 -1
```

### Obtener y eliminar el primer o último elemento de una lista
```bash
LPOP mi_lista
RPOP mi_lista
```

### Longitud de la lista
```bash
LLEN mi_lista
```

---

## Conjuntos (Sets)

### Agregar elementos a un conjunto
```bash
SADD mi_conjunto valor1 valor2
```

### Obtener todos los elementos de un conjunto
```bash
SMEMBERS mi_conjunto
```

### Verificar si un elemento pertenece a un conjunto
```bash
SISMEMBER mi_conjunto valor1
```

### Eliminar un elemento de un conjunto
```bash
SREM mi_conjunto valor1
```

### Operaciones entre conjuntos (intersección, unión, diferencia)
```bash
SINTER conjunto1 conjunto2
SUNION conjunto1 conjunto2
SDIFF conjunto1 conjunto2
```

---

# Hashes

### Agregar un campo a un hash
```bash
HSET mi_hash campo1 valor1
```

### Obtener el valor de un campo
```bash
HGET mi_hash campo1
```

### Obtener todos los campos y valores
```bash
HGETALL mi_hash
```

### Verificar si un campo existe
```bash
HEXISTS mi_hash campo1
```

### Eliminar un campo
```bash
HDEL mi_hash campo1
```

---

# Administración de bases de datos

### Cambiar de base de datos
```bash
SELECT número_base_datos
```

### Ver claves en la base de datos actual
```bash
KEYS *
```

### Limpiar todas las claves de la base de datos actual
```bash
FLUSHDB
```

### Limpiar todas las claves de todas las bases de datos
```bash
FLUSHALL
```

---

# Información y monitoreo

### Obtener información del servidor
```bash
INFO
```

### Ver estadísticas en tiempo real
```bash
MONITOR
```

### Ver configuración actual
```bash
CONFIG GET *
```

### Cambiar configuración (temporalmente, mientras Redis esté en ejecución)
```bash
CONFIG SET parametro valor
```

---

# Copias de seguridad y restauración

### Forzar la creación de un snapshot
```bash
SAVE
```

### Realizar una copia asincrónica
```bash
BGSAVE
```

---

# Parte 3: Uso de un cliente visual

1. **Instalar RedisInsight** (cliente visual oficial)
   - Descargar la última versión desde la web oficial:  
     [https://redis.com/redis-enterprise/redis-insight/](https://redis.com/redis-enterprise/redis-insight/)

### Instalar RedisInsight:
```bash
sudo dpkg -i <archivo_descargado>.deb
```

### Abrir RedisInsight:
```bash
redisinsight
```

Conectar al servidor Redis (por defecto, host: `127.0.0.1`, puerto: `6379`).

### Explorar Redis desde RedisInsight
Crear claves, insertar datos en listas o hashes, y observar las estructuras visualmente.

# Parte 4: Otro ejercicio

## 1. Operaciones

Crear un sistema de gestión de inventario:

- Añade 5 productos (usando hashes con `HSET`).
- Incrementa el stock de uno de los productos (`HINCRBY`).
- Elimina un producto cuando el stock llegue a 0.

---

## 2. Simular un carrito de compras

Crear un carrito con la estructura de listas:
```bash
LPUSH carrito "Producto1" "Producto2"
LRANGE carrito 0 -1
```

---

## 3. Ranking de usuarios

Usar un conjunto ordenado para guardar puntuaciones:
```bash
ZADD ranking 100 "usuario1" 200 "usuario2" 150 "usuario3"
ZRANGE ranking 0 -1 WITHSCORES
ZREVRANK ranking "usuario2"
```

---

## 4. Simulación de notificaciones

Usar listas para simular una cola de notificaciones:
```bash
LPUSH notificaciones "Notificación 1" "Notificación 2"
RPOP notificaciones
```

---

# Parte 5: Otro Ejercicio Más

Diseña un sistema de control de tareas con Redis. Debe permitir:

1. Añadir tareas con nombre y prioridad.
2. Consultar todas las tareas en orden de prioridad.
3. Marcar tareas como completadas (eliminarlas de la lista).

### Pistas:
Usa listas (`LPUSH` y `LPOP`) o conjuntos ordenados (`ZADD` y `ZRANGE`).
