# DESAFIO_SAD
![image](https://github.com/user-attachments/assets/7da08c0d-1f34-4729-8638-19c9c01b09fb)

## Implementación de la Arquitectura del Diagrama

Incluye:
- Dos firewalls pfSense.
- Un servidor VPN en la DMZ.
- Un servidor Proxy dedicado con Squid en la red interna.
- Un cliente interno que usará el Proxy para navegar por Internet.

### Esquema de la Red

| Dispositivo | Interfaz | Red / IP |
|------------|----------|----------|
| **FW1 (pfSense Externo)** | WAN | 192.168.100.0/24 (probando en un entorno NAT). |
|  | DMZ | 192.168.1.1/24 |
| **FW2 (pfSense Interno)** | DMZ | 192.168.1.2/24 |
|  | LAN | 192.168.0.1/24 |
| **Servidor VPN** | DMZ | 192.168.1.10/24 |
| **Servidor Proxy** | LAN | 192.168.0.10/24 |
| **Cliente Interno** | LAN | 192.168.0.100/24 |


# Configuración de VirtualBox para cada Máquina

## Firewal

### 1. Firewall Externo (FW1 - pfSense)
#### Configuración General
- Nombre de la máquina: `FW1 (pfSense)`
- RAM: `2 GB`
- CPU: `1 vCPU`
- Disco duro: `8 GB (Dinámicamente asignado)`
- Sistema operativo: `pfSense ISO, FreeBSD 64-bit`
  ### Configuracion adaptador de red WAN para el Firewall externo.
![image](https://github.com/user-attachments/assets/d4068220-7b6c-4001-833a-55cd907816b8)

![image](https://github.com/user-attachments/assets/dc63ce18-230c-4319-a066-08e5f9f4985b)

### Instalacion Pfsense

![image](https://github.com/user-attachments/assets/73535629-ba26-4b12-8cab-beed8a02c4d3)

![image](https://github.com/user-attachments/assets/2fbdc4cf-269d-4f81-ae61-e4dc398dbcc7)

![image](https://github.com/user-attachments/assets/c30ae39a-149e-4e42-bcbc-465912f62028)

![image](https://github.com/user-attachments/assets/97811bbc-7457-413a-a645-85425fb2666f)

![image](https://github.com/user-attachments/assets/90cf7a1b-f621-4080-a107-751765a7a2fa)

![image](https://github.com/user-attachments/assets/f5fe1641-e31a-4dfc-beab-ef7cdcfc9963)

#### Configuración de Red
- **Adaptador 1 (WAN):**
  - Tipo: `Red NAT`
  - Propósito: `Conexión a Internet.`
    ![image](https://github.com/user-attachments/assets/dc63ce18-230c-4319-a066-08e5f9f4985b)
- **Adaptador 2 (DMZ):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `DMZ`
    ![image](https://github.com/user-attachments/assets/2147493e-589b-4120-8ec7-5a4ec94be6fb)



![image](https://github.com/user-attachments/assets/b946d70c-f752-402b-9c91-4cd2ea4d1841)

### 2. Firewall Interno (FW2 - pfSense)
#### Configuración General
- Nombre de la máquina: `FW2 (pfSense)`
- RAM: `2 GB`
- CPU: `1 vCPU`
- Disco duro: `8 GB (Dinámicamente asignado)`
- Sistema operativo: `pfSense ISO, FreeBSD 64-bit`

#### Configuración de Red
- **Adaptador 1 (DMZ):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `DMZ`
    ![image](https://github.com/user-attachments/assets/d0a889d9-bc13-4722-be87-ab35b0fb772e)

- **Adaptador 2 (LAN):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `LAN`
    ![image](https://github.com/user-attachments/assets/749ade52-fe45-473c-b3fc-0f51a50ebeb8)



![image](https://github.com/user-attachments/assets/53709f52-96c7-4bf7-8c31-4b29b21f59fb)


### 3. Servidor VPN (Ubuntu Server o Similar)
#### Configuración General
- Nombre de la máquina: `Servidor VPN`
- RAM: `2 GB`
- CPU: `1 vCPU`
- Disco duro: `10 GB (Dinámicamente asignado)`
- Sistema operativo: `Ubuntu Server 22.04 ISO o similar.`
  
### Instalacion Ubuntu Server
![image](https://github.com/user-attachments/assets/974c3d84-8cdd-4796-bc58-9da4d135fc2f)
![image](https://github.com/user-attachments/assets/8ebed20c-4814-46c0-abb7-36aa00515e34)
![image](https://github.com/user-attachments/assets/59295122-0a28-47cf-baed-a936728799db)
![image](https://github.com/user-attachments/assets/518fc3e6-b3b0-4324-83da-9813c3dc52b5)


#### Configuración de Red
- **Adaptador 1 (DMZ):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `DMZ`
    
    ![image](https://github.com/user-attachments/assets/b15162bf-e705-4f71-876a-83a9de5725ef)

### 4. Servidor Proxy (Squid en Ubuntu Server o Similar)
#### Configuración General
- Nombre de la máquina: `Servidor Proxy`
- RAM: `2 GB`
- CPU: `1 vCPU`
- Disco duro: `10 GB (Dinámicamente asignado)`
- Sistema operativo: `Ubuntu Server 22.04 ISO o similar.`

### Instalacion Ubuntu Server
![image](https://github.com/user-attachments/assets/6879f07c-bb31-4b42-826b-9fc3a2b667aa)
![image](https://github.com/user-attachments/assets/87f475af-4bb9-42ee-bf04-c3d9c5897916)
![image](https://github.com/user-attachments/assets/616f07e2-c9c1-44ef-a91b-5b2385548dba)
![image](https://github.com/user-attachments/assets/fe81841d-9fb2-4a6b-83ed-ce6ece796431)


#### Configuración de Red
- **Adaptador 1 (LAN):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `LAN`
![image](https://github.com/user-attachments/assets/f088e837-c6e9-486b-9203-76b7698660fd)

### 5. Cliente Interno
#### Configuración General
- Nombre de la máquina: `Cliente Interno`
- RAM: `1 GB`
- CPU: `1 vCPU`
- Disco duro: `8 GB (Dinámicamente asignado)`
- Sistema operativo: `Windows 7/10/11.`
  
### Instalacion Windows 7
![image](https://github.com/user-attachments/assets/4c1b94bf-ed4c-4918-a803-40ce0105e246)
![image](https://github.com/user-attachments/assets/35c13de9-f410-416b-ba26-ae31babcf9b9)
![image](https://github.com/user-attachments/assets/76439e8d-f69d-4b34-a9dd-1dbf382d456e)


#### Configuración de Red
- **Adaptador 1 (LAN):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `LAN`
    ![image](https://github.com/user-attachments/assets/26db3e5d-08dc-4f09-979d-80207aaac786)


### Redes Internas en VirtualBox
Para conectar las máquinas correctamente:
1. En VirtualBox, ve a `Archivo > Configuración > Red.`
2. Agrega las redes internas necesarias:
   - Nombre: `DMZ` (sin configuraciones adicionales).
   - Nombre: `LAN` (sin configuraciones adicionales).

## Resumen de Redes

| Máquina | Interfaz | Tipo de Red | Nombre de Red |
|---------|---------|------------|--------------|
| **FW1 (pfSense)** | WAN | NAT | - |
|  | DMZ | Red Interna | DMZ |
| **FW2 (pfSense)** | DMZ | Red Interna | DMZ |
|  | LAN | Red Interna | LAN |
| **Servidor VPN** | DMZ | Red Interna | DMZ |
| **Servidor Proxy** | LAN | Red Interna | LAN |
| **Cliente Interno** | LAN | Red Interna | LAN |

... (El contenido continúa con las configuraciones de firewall, Squid, VPN y pruebas de conectividad según lo descrito en el texto original.)


# Configuración de Firewalls con pfSense

## 1. Configuración del Firewall Externo (FW1)

### Reglas de Firewall (WAN y DMZ)

#### Permitir tráfico desde DMZ hacia Internet:
- **Interfaz:** DMZ  
- **Proto:** TCP/UDP  
- **Puerto:** Any  
- **Destino:** Any  

![image](https://github.com/user-attachments/assets/d67ec968-f18c-4517-9cea-632a17dc5581)
![image](https://github.com/user-attachments/assets/96093b5d-7944-4b40-9ce2-354bcd5b868a)


#### Bloquear tráfico directo de DMZ a LAN (excepto VPN a Proxy):
- **Interfaz:** DMZ  
- **Proto:** Any  
- **Destino:** 192.168.0.0/24  
- **Acción:** Block  
- **Excepción:** 192.168.1.10 -> 192.168.0.10  
![image](https://github.com/user-attachments/assets/a12f7fd9-095f-4ae8-897a-f06a299bb94c)
![image](https://github.com/user-attachments/assets/9bf3c420-df71-4e70-ad1f-10ed7fd96adb)


### NAT en FW1
- **Outbound NAT:** Habilita NAT automático o manual.  
- **Regla NAT:** Traduce `192.168.1.0/24` → WAN (masquerade).
   
![image](https://github.com/user-attachments/assets/7be4339a-9341-428c-b0f1-4658238ee825)


## 1.2. Configuración del Firewall Interno (FW2)

### Reglas de Firewall (DMZ y LAN)

#### Permitir tráfico del Proxy a Internet:
- **Interfaz:** LAN  
- **Proto:** TCP  
- **Origen:** 192.168.0.10  
- **Destino:** Any  
- **Puerto:** 80, 443  
![image](https://github.com/user-attachments/assets/ae1399c5-6505-43a5-9fe8-0e51d29f3160)
![image](https://github.com/user-attachments/assets/56fd46ca-ac83-4dd1-9219-fd82acb81a79)


#### Permitir tráfico de Cliente Interno al Proxy (3128):
- **Interfaz:** LAN  
- **Proto:** TCP  
- **Origen:** 192.168.0.0/24  
- **Destino:** 192.168.0.10  
- **Puerto:** 3128  
![image](https://github.com/user-attachments/assets/281e9a68-3c46-4ef3-ab04-48150967b90f)
![image](https://github.com/user-attachments/assets/a49415dd-9ad4-4cf3-8917-92629342cc53)


#### Bloquear tráfico directo de DMZ a LAN (excepto VPN a Proxy):
- **Interfaz:** DMZ  
- **Proto:** Any  
- **Destino:** 192.168.0.0/24  
- **Acción:** Block  
- **Excepción:** 192.168.1.10 -> 192.168.0.10  
![image](https://github.com/user-attachments/assets/1cf5eca1-89ea-4690-95b5-18818c201179)
![image](https://github.com/user-attachments/assets/73668b9f-5dd7-4e9a-96e5-987c2e091915)

### NAT en FW2
- **Outbound NAT:** Automático.  
![image](https://github.com/user-attachments/assets/f9d80d52-b3fa-4c65-9d02-e7704622dd7c)

---

## 2. Instalación y Configuración del Servidor Proxy (Squid)

### 2.1. Instalación de Squid

**Sistema Operativo:** Ubuntu Server 22.04 o similar.

Actualizar el sistema:
```bash
sudo apt update && sudo apt upgrade -y
```
![image](https://github.com/user-attachments/assets/7173cd3f-8478-4178-b6a7-1ee60b66a437)

Instalar Squid:
```bash
sudo apt install squid -y
```
![image](https://github.com/user-attachments/assets/de191aa7-b77d-4867-9ef8-1f10f0a38443)

### 2.2. Configuración de Squid

Abre el archivo de configuración:
```bash
sudo nano /etc/squid/squid.conf
```

Realiza las siguientes modificaciones:

**Definir las redes permitidas:** Agrega las ACLs para la red interna y la VPN.
```bash
acl localnet src 192.168.0.0/24
acl vpnnet src 192.168.1.10/24
```

```bash
http_access allow localnet
http_access allow vpnnet
http_access deny all
```

**Configurar el puerto del Proxy:** Asegúrate de que Squid escucha en el puerto 3128.
```bash
http_port 3128
```

**Habilitar el acceso anónimo (opcional):** Si no necesitas autenticación, asegúrate de que no haya reglas de autenticación configuradas.

## ARCHIVO DE CONFIGURACION.

```bash
# ===============================
# CONFIGURACIÓN BÁSICA DE SQUID
# ===============================

# Configurar el puerto en el que escucha Squid (puerto estándar 3128)
http_port 3128

# ===============================
# DEFINIR LAS REDES PERMITIDAS
# ===============================

# Definir redes internas permitidas (LAN y VPN)
acl localnet src 192.168.0.0/24   # Red LAN
acl vpnnet src 192.168.1.10/24    # Red VPN (IP específica)

# ===============================
# REGLAS DE ACCESO
# ===============================

# Permitir acceso solo a las redes definidas
http_access allow localnet
http_access allow vpnnet

# Denegar acceso a todos los demás
http_access deny all

# ===============================
# CONFIGURACIÓN DEL LOGGING
# ===============================

# Configurar registros de acceso (logs) en formato estándar
access_log /var/log/squid/access.log squid

# ===============================
# CONFIGURACIÓN DEL CACHÉ (Opcional)
# ===============================

# Habilitar caché con 100 MB de espacio en disco
cache_dir ufs /var/spool/squid 100 16 256
cache_mem 64 MB
maximum_object_size 4 MB
cache_replacement_policy heap LFUDA

# ===============================
# CONFIGURACIÓN ADICIONAL
# ===============================

# Permitir conexiones persistentes
client_persistent_connections on
server_persistent_connections on

# Evitar errores de DNS (ajustar según el servidor DNS configurado)
dns_nameservers 8.8.8.8 8.8.4.4

# ===============================
# FIN DEL ARCHIVO
# ===============================

```

### Configuración de Bloqueo de Páginas Web

Crea una lista negra de URLs prohibidas:

Abre un archivo para definir las páginas bloqueadas:
```bash
sudo nano /etc/squid/blacklist.txt
```

Añade los dominios o URLs que deseas bloquear (uno por línea):
```plaintext
facebook.com
youtube.com
twitter.com
```
![image](https://github.com/user-attachments/assets/be769b8e-dbd5-489b-855c-b2e187737c67)

Guarda y cierra el archivo.

**Configurar Squid para usar la lista negra:**

Edita el archivo principal de configuración de Squid:
```bash
sudo nano /etc/squid/squid.conf
```

Añade una ACL (Access Control List) para la lista negra:
```bash
acl blocked_sites dstdomain "/etc/squid/blacklist.txt"
http_access deny blocked_sites
```
```bash
# ================================
# CONFIGURACIÓN GENERAL DE SQUID
# ================================

# Puerto en el que escucha Squid
http_port 3128

# ================================
# DEFINIR LAS REDES PERMITIDAS
# ================================
acl localnet src 192.168.0.0/24   # Red LAN
acl vpnnet src 192.168.1.10/24    # Red VPN (IP específica)

# ================================
# CONFIGURACIÓN DE LA LISTA NEGRA
# ================================
acl blocked_sites dstdomain "/etc/squid/blacklist.txt"
http_access deny blocked_sites

# ================================
# REGLAS DE ACCESO
# ================================

# Permitir acceso solo a las redes definidas
http_access allow localnet
http_access allow vpnnet

# Denegar todo el tráfico que no está explícitamente permitido
http_access deny all

# ================================
# CONFIGURACIÓN DEL LOGGING
# ================================

# Configurar registros de acceso (logs)
access_log /var/log/squid/access.log squid

# ================================
# CONFIGURACIÓN DEL CACHÉ (Opcional)
# ================================

# Habilitar caché con 100 MB de espacio en disco
cache_dir ufs /var/spool/squid 100 16 256
cache_mem 64 MB
maximum_object_size 4 MB
cache_replacement_policy heap LFUDA

# ================================
# CONFIGURACIÓN DE CONEXIONES
# ================================

# Permitir conexiones persistentes
client_persistent_connections on
server_persistent_connections on

# Evitar errores de DNS (ajustar según el servidor DNS configurado)
dns_nameservers 8.8.8.8 8.8.4.4

# ================================
# FIN DEL ARCHIVO
# ================================

```

Coloca esta regla antes de la línea `http_access allow localnet` para que tenga prioridad.

Reinicia el servicio de Squid:
```bash
sudo systemctl restart squid
```
![image](https://github.com/user-attachments/assets/a4d2cff0-aa3d-4ac8-bd39-4d12ce9f30ba)

## 2.3. Configuración de Restricciones de Tiempo

Puedes permitir o bloquear el acceso en horarios específicos para determinados usuarios o redes.

**Define las horas permitidas o bloqueadas:**

Edita el archivo de configuración de Squid:
```bash
sudo nano /etc/squid/squid.conf
```
Define un rango de tiempo usando `time ACLs`. Por ejemplo:
```bash
acl working_hours time MTWHF 08:00-18:00
```
![image](https://github.com/user-attachments/assets/abcf084b-17ad-4f43-8c25-cda34601712c)

Esto define un rango de tiempo de lunes a viernes (MTWHF) de 08:00 a 18:00.

**Aplica restricciones basadas en tiempo:**

Combina la ACL de tiempo con una red o usuarios específicos:
```bash
http_access allow localnet working_hours
http_access deny localnet !working_hours
```
![image](https://github.com/user-attachments/assets/32d22e1b-0f74-4d77-9da2-5145dbcdc68d)

Esto permite el acceso solo durante el horario laboral y lo bloquea fuera de este.

Reinicia el servicio de Squid:
```bash
sudo systemctl restart squid
```

## 3. Combinación de Restricciones de Páginas y Tiempo

Puedes combinar las ACLs de tiempo y páginas bloqueadas para aplicar reglas específicas.

Por ejemplo, bloquear YouTube fuera del horario laboral:
```bash
acl youtube dstdomain .youtube.com
acl working_hours time MTWHF 08:00-18:00
http_access deny youtube !working_hours
```
![image](https://github.com/user-attachments/assets/d6a93265-bf24-4c43-977f-f5dd6c61eb30)


## 4. Configuración del Cliente Interno

Configura el cliente para usar el Proxy:

**En el navegador:**
- Proxy HTTP: `192.168.0.10`
- Puerto: `3128`
![image](https://github.com/user-attachments/assets/08bcc3ea-fdfd-4d8c-be3a-add97b13269e)

![image](https://github.com/user-attachments/assets/c5b487d1-9022-441d-a16c-ce582d53ac4d)

## 5. Pruebas de Conectividad

### Pruebas del Proxy (Squid)

**a) Verifica conectividad desde el cliente interno (192.168.0.100)**

Prueba la navegación:
```bash
Accede a https://www.google.com
```

**Resultado esperado:** El acceso debe ser exitoso.

**Logs del Proxy:**
```bash
sudo tail -f /var/log/squid/access.log
```

**b) Bloqueo de sitios configurados en Squid**

Intenta acceder a un sitio bloqueado:
```bash
Accede a https://www.facebook.com
```

**Resultado esperado:** El acceso debe ser rechazado.

Verifica los logs del Proxy:
```bash
grep facebook /var/log/squid/access.log
```

**c) Restricciones de tiempo**

Intenta acceder a Internet fuera del horario permitido:
```bash
sudo tail -f /var/log/squid/access.log
```

## 6. Pruebas de Seguridad

### Acceso desde la DMZ a la red interna

Desde el servidor VPN (192.168.1.10) en la DMZ, intenta acceder al cliente interno:
```bash
ping 192.168.0.100
```

**Resultado esperado:** El tráfico debe estar bloqueado.

Intenta conectarte por SSH al Proxy:
```bash
ssh usuario@192.168.0.10
```

**Resultado esperado:** El acceso debe estar permitido si está configurado en el Firewall.

**Verificación del tráfico Proxy:**
```bash
sudo tail -f /var/log/squid/access.log
```

Filtra solicitudes específicas:
```bash
grep google /var/log/squid/access.log
```

**Traceroute completo:**
```bash
traceroute 8.8.8.8
```

**Resultado esperado:** El tráfico debe pasar por el Proxy.

**Prueba de DNS:**
```bash
nslookup www.google.com
```

**Resultado esperado:** La resolución debe ser exitosa.

