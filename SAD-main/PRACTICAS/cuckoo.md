
## 1. Configuración del Anfitrión (Host Principal)

### 1.1 Instalar dependencias necesarias

Asegúrate de tener una distribución Linux (preferiblemente Ubuntu o Debian).
Instala las siguientes dependencias:
bash
sudo apt update && sudo apt install -y python3 python3-pip virtualbox tcpdump

### 1.2 Crear y activar un entorno virtual de Python

Crea un entorno virtual para aislar las dependencias de Cuckoo:
bash
python3 -m venv cuckoo_env
source cuckoo_env/bin/activate


### 1.3 Instalar Cuckoo

Instala Cuckoo desde su repositorio oficial:
bash
pip2 install cuckoo


Verifica la instalación:
bash
cuckoo --version


### 1.4 Configurar la base de datos de Cuckoo

Edita el archivo de configuración:
bash
nano ~/.cuckoo/conf/reporting.conf
Activa el soporte para SQLite:
ini
[sqlite]
enabled = yes
---

## 2. Configuración del Huésped (Windows)

### 2.1 Crear una máquina virtual

Abre VirtualBox y crea una nueva máquina virtual con las siguientes especificaciones:
  - **Nombre:** WinTest
  - **Tipo:** Microsoft Windows
  - **Versión:** Windows 7/10 (dependiendo de la muestra a analizar).

### 2.2 Configurar red

Configura la red de la máquina virtual para trabajar en modo "Host-Only".

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

### 3.2 Configurar el huésped para análisis

Configura la IP estática del huésped en el mismo rango que la red Host-Only:
  - IP: 192.168.56.101
  - Gateway: 192.168.56.1

### 3.3 Configurar agente de Cuckoo

Descarga y ejecuta el agente de Cuckoo en el huésped:
bash
wget https://cuckoo.sh/agent.py
python agent.py
---

## 4. Configurar y Usar Cuckoo

### 4.1 Editar configuraciones principales

Modifica el archivo ~/.cuckoo/conf/cuckoo.conf:
ini
[virtualbox]
path = /usr/bin/VBoxManage
machines = WinTest
### 4.2 Verificar configuración

Verifica que el anfitrión pueda comunicarse con el huésped:
bash
ping 192.168.56.101
### 4.3 Ejecutar una muestra

Lanza Cuckoo y carga una muestra de malware:
bash
cuckoo submit /path/to/sample.exe
### 4.4 Monitorear el análisis

Usa el comando:
bash
cuckoo
---

