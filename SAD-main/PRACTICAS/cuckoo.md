
## 1. Configuración del Anfitrión (Host Principal)

```bash
    VBoxmanage modifyv "Kali_Linux_SAD" --nested-hw-virt on
```
![cap0](https://github.com/user-attachments/assets/f211288d-8c94-448b-85c9-666fdb60a400)

### 1.1 Instalar dependencias necesarias

Asegúrate de tener una distribución Linux (preferiblemente Ubuntu o Debian).
Instala las siguientes dependencias:

```bash
    sudo apt update && sudo apt upgrade -y
    sudo apt install -y python3 python3-pip python3-dev libffi-dev libssl-dev libxml2-dev libxslt1-dev libjpeg-dev zlib1g-dev postgresql postgresql-contrib mongodb redis-server tcpdump libvirt-daemon libvirt-daemon-system libvirt-clients qemu-kvm virtualbox
```
![cap1](https://github.com/user-attachments/assets/7d098e83-dc97-45b9-82a7-1b93b0fae99a)

![cap2](https://github.com/user-attachments/assets/387bdd12-c7e5-4642-a893-4fc9b1fbab71)

### 1.2 Iniciar los servicios.
```bash
sudo systemctl start postgresql
sudo systemctl enable postgresql
sudo systemctl start mongodb
sudo systemctl enable mongodb
sudo systemctl start redis
sudo systemctl enable redis
```
![cap3](https://github.com/user-attachments/assets/38d9adbd-a310-42a8-bc60-ac19a01bbbd1)

### 1.2 Instalar y crear y activar un entorno virtual de Python

Crea un entorno virtual para aislar las dependencias de Cuckoo:
```bash
sudo apt install python2-venv
```
![cap4](https://github.com/user-attachments/assets/5e42bdb3-5adb-400b-bdff-d42077d35335)

```bash
python2 -m venv ~/cuckoo_env
source ~/cuckoo_env/bin/activate
```
![cap5](https://github.com/user-attachments/assets/ed9cbb63-2cb8-4da2-9b6c-a088333b45c7)

![cap6](https://github.com/user-attachments/assets/03da1e72-9116-49e2-b4fa-733f55b4fcc1)

### 1.3 Instalar Cuckoo

```bash
pip2 install cuckoo
```
![cap7](https://github.com/user-attachments/assets/f83c30d8-8128-46b4-b91c-af3e603a22eb)

Verificar la instalación con este comando:

```bash
cuckoo --version
```

### 1.4 Configurar la base de datos de Cuckoo

Edita el archivo de configuración:
```bash
nano ~/.cuckoo/conf/reporting.conf
```
Activa el soporte para mongo:

![cap12](https://github.com/user-attachments/assets/182423a3-54a2-41e2-901c-60dff298a403)


## 2. Configuración del Huésped (Windows)

### 2.1 Crear una máquina virtual

Abre VirtualBox y crea una nueva máquina virtual con las siguientes especificaciones:
  - **Nombre:** cuckoo1
  - **Tipo:** Microsoft Windows
  - **Versión:** Windows 10.
  - 
![cap10](https://github.com/user-attachments/assets/d1e4458c-0308-444a-b2e2-3ec349e46623)
![cap13](https://github.com/user-attachments/assets/1b15f553-f36e-4645-af7f-2e52106e15b3)


### 2.2 Configurar red

Configura la red de la máquina virtual para trabajar en modo "Solo-anfitrion".
![cap8](https://github.com/user-attachments/assets/49a35bed-3ca7-46f3-a0a3-efdb042d84bc)



### 2.3 Configurar herramientas de análisis

Instala las siguientes herramientas en la máquina huésped:
  - **Procmon**: Para monitorear procesos.
  - **Wireshark**: Para análisis de tráfico.
  - **Python**: Para scripts adicionales si son necesarios.

---

## 3. Configurar la Integración entre Anfitrión y Huésped

### 3.1 Configurar la red Host-Only

En VirtualBox, ve a **Preferencias > Red > Redes Host-Only**:
  - Agrega una nueva red con el siguiente rango:
    - Dirección IP: 192.168.56.1
    - Máscara: 255.255.255.0
      
![cap8](https://github.com/user-attachments/assets/1fbd46f9-77e5-4761-b2c5-54562bb2537e)

### 3.2 Configurar el huésped para análisis

Configura la IP estática del huésped en el mismo rango que la red Host-Only:
  - IP: 192.168.56.101
  - Gateway: 192.168.56.1
    
![cap9](https://github.com/user-attachments/assets/950f7e85-96c0-48ea-b894-b26272dde98b)

### 3.3 Configurar agente de Cuckoo

Descarga y ejecuta el agente de Cuckoo en el huésped:

## 4. Configurar y Usar Cuckoo

### 4.1 Editar configuraciones principales

Modifica el archivo ~/.cuckoo/conf/cuckoo.conf:

```javascript
[virtualbox]
path = /usr/bin/VBoxManage
machines = cuckoo1
```
![cap14](https://github.com/user-attachments/assets/08f6d65c-9fd9-4932-97cf-8a545a25a45b)

### 4.2 Verificar configuración

Verifica que el anfitrión pueda comunicarse con el huésped:
bash
ping 192.168.56.101

### 4.3 Ejecutar una muestra

Lanza Cuckoo

![cap11](https://github.com/user-attachments/assets/820f65d3-b674-4d34-8b6f-1c10a43d0c39)

### 4.4 Monitorear el análisis



