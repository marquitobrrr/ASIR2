Realiza los siguientes pasos y ejemplos haciendo pantallazos de los más relevantes.

# Parte 1: Instalación de Redis

### Actualizar el sistema y los repositorios

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