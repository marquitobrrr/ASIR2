# Fase 1: Configuración de un NAS Synology para controlar un SAI

Para configurar un NAS de Synology para que controle un SAI (Sistema de Alimentación Ininterrumpida) y se apague en caso de una pérdida de energía, se deben seguir los siguientes pasos:

1. **Conectar el NAS al SAI**: 
   - Asegúrate de que el NAS esté conectado a un puerto del SAI mediante un cable de alimentación. Esto permite que el NAS reciba energía del SAI durante un corte eléctrico.

2. **Configurar el SAI**:
   - Verifica que el SAI sea compatible con el NAS. Synology soporta una variedad de modelos de SAI, por lo que se debe consultar la lista de SAI compatibles en el sitio web de Synology.
   - Algunos SAI ofrecen un software para gestionar la comunicación entre el SAI y el NAS. Si es el caso, asegúrate de que esté instalado y configurado correctamente.

3. **Acceder a la interfaz de administración del NAS**:
   - Inicia sesión en el sistema DSM (DiskStation Manager) de tu NAS Synology.

4. **Configurar la gestión de energía**:
   - Ve a "Panel de control" y selecciona "Hardware y energía".
   - Accede a la pestaña "UPS" (SAI).
   - Activa la opción "Habilitar soporte UPS".
   - Selecciona el tipo de conexión (usualmente se selecciona “USB” si el SAI está conectado por USB).
   - Configura los parámetros de apagado:
     - Establece el tiempo de espera antes de que el NAS se apague después de que se detecte un corte de energía.
     - Puedes configurar la duración del funcionamiento del SAI antes de que el NAS se apague automáticamente, dependiendo de la capacidad del SAI y de la carga del NAS.

5. **Guardar la configuración** y realizar pruebas para asegurarte de que el NAS responda correctamente al corte de energía.

---

# Fase 2: Modelos de SAI en rack para una carga aproximada de 4000 VA

A continuación se presentan las recomendaciones de SAI en rack para cada una de las marcas solicitadas:

1. **Salicru**:
   - **Modelo recomendado**: **SLC 3000 R** 
     - **Capacidad**: 3000 VA (disponible en versiones de mayor capacidad, como 4000 VA).
     - **Características**: SAI online de doble conversión, que proporciona un suministro de energía constante y protección contra interrupciones.
![slc3000r](https://github.com/user-attachments/assets/6cba9480-6cbc-48ce-a59d-0e3c4c2c0093)

2. **CyberPower**:
   - **Modelo recomendado**: **CP1500PFCLCDR** (considerar el modelo en rack CP3000PFCLCD también).
     - **Capacidad**: 3000 VA (versión de rack).
     - **Características**: Tecnología de onda sinusoidal pura, puerto USB para monitoreo y gestión de energía, ideal para servidores y equipos críticos.
![cp15000](https://github.com/user-attachments/assets/27784df1-b7c2-491e-a8e3-6269a048db4d)

3. **APC**:
   - **Modelo recomendado**: **APC Smart-UPS SRT 3000VA RM** 
     - **Capacidad**: 3000 VA (se puede considerar una versión de 5000 VA para mayor margen).
     - **Características**: SAI en rack con tecnología de doble conversión, ofrece conectividad para monitoreo y gestión, y está diseñado para proteger equipos de red, servidores y sistemas críticos.
![apc](https://github.com/user-attachments/assets/9ac96327-7417-4062-9dc1-5f3f203d759b)

---

# Conclusiones

Al seleccionar un SAI, es fundamental considerar no solo la capacidad de VA, sino también las características específicas que se alineen con las necesidades de protección y gestión de energía de los dispositivos conectados. Además, asegúrate de revisar las especificaciones técnicas de cada modelo en la web oficial de los fabricantes antes de realizar una compra.


# Parte 1: Configuración de NUT en modo simulado

1. **Instalar NUT**.
![cap1](https://github.com/user-attachments/assets/c8e634ac-bf82-4df2-ac79-c677b1c9a8b5)

2. **Configurar NUT en modo simulado**:
   - Edita el archivo de configuración de NUT (/etc/nut/ups.conf) y configura un SAI simulado usando el driver dummy-ups.
   - Añade la siguiente configuración para simular un SAI:
          [simups]
     driver = dummy-ups
     port = /dev/ttyS0
     battery.charge = 80
     # Simula un 80% de carga de batería
     ups.status = OL
     # SAI en línea, sin problemas
     desc = "Simulated UPS"
     
     ![cap2](https://github.com/user-attachments/assets/21dfa2c3-bad3-40bb-be94-9698c225ff43)

3. **Configurar el servicio de NUT**:
   - Edita el archivo /etc/nut/upsmon.conf para definir la monitorización del SAI:
          MONITOR simups@localhost 1 upsuser password master
        - Asegúrate de que los permisos del archivo estén correctamente configurados.
![cap6](https://github.com/user-attachments/assets/4c50199d-4a43-415e-8615-cb3da24af406)

![cap3](https://github.com/user-attachments/assets/a4762c8c-0c61-4fcf-b442-a92c9c8473d2)

4. **Iniciar el servicio de NUT**.

5. **Verificar el estado del SAI simulado**:
   - Esto debería devolver el estado del SAI simulado, mostrando valores como el nivel de carga de la batería y su estado.
![cap4](https://github.com/user-attachments/assets/694d4667-7415-46b1-9129-6617adf7cfc8)

     ```
     upsc simups@localhost
![cap5](https://github.com/user-attachments/assets/dc84f74b-45e7-416f-a466-326d50c3dc00)
