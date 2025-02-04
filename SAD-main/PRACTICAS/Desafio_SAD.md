## Commits y Actualización del Portfolio

- Haz commit en cada clase con el comentario: `[clase] 'tarea realizada'`
- Lo que trabajes en casa haz commit al terminar con el comentario: `[casa] 'tarea realizada'`
- Rellena el portfolio Wix con tu feedback del desafío.

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

## Configuración de VirtualBox para cada Máquina

### 1. Firewall Externo (FW1 - pfSense)
#### Configuración General
- Nombre de la máquina: `FW1 (pfSense)`
- RAM: `2 GB`
- CPU: `1 vCPU`
- Disco duro: `8 GB (Dinámicamente asignado)`
- Sistema operativo: `pfSense ISO, FreeBSD 64-bit`

#### Configuración de Red
- **Adaptador 1 (WAN):**
  - Tipo: `Red NAT`
  - Propósito: `Conexión a Internet.`
- **Adaptador 2 (DMZ):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `DMZ`

Asegúrate de que la ISO de pfSense esté seleccionada como medio de inicio en la configuración del almacenamiento.

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
- **Adaptador 2 (LAN):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `LAN`

### 3. Servidor VPN (Ubuntu Server o Similar)
#### Configuración General
- Nombre de la máquina: `Servidor VPN`
- RAM: `2 GB`
- CPU: `1 vCPU`
- Disco duro: `10 GB (Dinámicamente asignado)`
- Sistema operativo: `Ubuntu Server 22.04 ISO o similar.`

#### Configuración de Red
- **Adaptador 1 (DMZ):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `DMZ`

### 4. Servidor Proxy (Squid en Ubuntu Server o Similar)
#### Configuración General
- Nombre de la máquina: `Servidor Proxy`
- RAM: `2 GB`
- CPU: `1 vCPU`
- Disco duro: `10 GB (Dinámicamente asignado)`
- Sistema operativo: `Ubuntu Server 22.04 ISO o similar.`

#### Configuración de Red
- **Adaptador 1 (LAN):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `LAN`

### 5. Cliente Interno
#### Configuración General
- Nombre de la máquina: `Cliente Interno`
- RAM: `1 GB`
- CPU: `1 vCPU`
- Disco duro: `8 GB (Dinámicamente asignado)`
- Sistema operativo: `Windows 7/10/11.`

#### Configuración de Red
- **Adaptador 1 (LAN):**
  - Tipo: `Red Interna`
  - Nombre de la red interna: `LAN`

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
