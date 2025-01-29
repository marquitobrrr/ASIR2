Realiza los siguientes pasos y ejemplos haciendo pantallazos de los más relevantes.

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
SISMEMBER mi_conjunto valor
```