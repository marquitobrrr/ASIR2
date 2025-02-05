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
