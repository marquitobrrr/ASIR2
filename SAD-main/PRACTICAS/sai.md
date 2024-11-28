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
       
![slc3000r](https://github.com/user-attachments/assets/4e267f7e-d8d0-41ff-966c-4fdb23ddcfea)


2. **CyberPower**:
   - **Modelo recomendado**: **CP1500PFCLCDR** (considerar el modelo en rack CP3000PFCLCD también).
     - **Capacidad**: 3000 VA (versión de rack).
     - **Características**: Tecnología de onda sinusoidal pura, puerto USB para monitoreo y gestión de energía, ideal para servidores y equipos críticos.
       
![12296448](https://github.com/user-attachments/assets/01171d2f-c8c4-4fd8-8841-4fa1fa3b161c)


3. **APC**:
   - **Modelo recomendado**: **APC Smart-UPS SRT 3000VA RM** 
     - **Capacidad**: 3000 VA (se puede considerar una versión de 5000 VA para mayor margen).
     - **Características**: SAI en rack con tecnología de doble conversión, ofrece conectividad para monitoreo y gestión, y está diseñado para proteger equipos de red, servidores y sistemas críticos.
     - 

![apc](https://github.com/user-attachments/assets/8163be51-46e7-4b7e-9166-28a0ee46e22f)

---

# Conclusiones

Al seleccionar un SAI, es fundamental considerar no solo la capacidad de VA, sino también las características específicas que se alineen con las necesidades de protección y gestión de energía de los dispositivos conectados. Además, asegúrate de revisar las especificaciones técnicas de cada modelo en la web oficial de los fabricantes antes de realizar una compra.


# Parte 1: Configuración de NUT en modo simulado

1. **Instalar NUT**.
   
![cap1](https://github.com/user-attachments/assets/c8e634ac-bf82-4df2-ac79-c677b1c9a8b5)

3. **Configurar NUT en modo simulado**:
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

4. **Configurar el servicio de NUT**:
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

## Parte 2: Monitorización de eventos con Kibana

1. **Instalar Kibana.**
![cap1](https://github.com/user-attachments/assets/202edfa4-8e99-4b51-9c0a-f90ea2a23475)

![cap2](https://github.com/user-attachments/assets/d9c14003-c333-4975-ab7b-c0d1d351120c)

![cap3](https://github.com/user-attachments/assets/dc17f807-cf02-4736-b99a-0313a73432f6)

![cap4](https://github.com/user-attachments/assets/bab9c2dd-40e5-4793-b9f3-d5cef8902b18)

![cap5](https://github.com/user-attachments/assets/4dc52f15-8570-46e0-99c4-a4b34e98e37c)

![cap6](https://github.com/user-attachments/assets/c9a313b0-03b2-44f1-ba61-0c401f6b4ff2)

![cap7](https://github.com/user-attachments/assets/f9fc832d-aa96-4dd9-a2ef-27240f929393)

![cap8](https://github.com/user-attachments/assets/f7e9b816-079f-4dbd-8953-3ad4e304addc)

2. **Configurar NUT para enviar logs.**
   - NUT registra eventos críticos, como batería baja o fallos de alimentación, en el archivo de log del sistema. Estos logs pueden enviarse a Kibana para su análisis. Asegúrate de que rsyslog esté configurado para enviar los logs al puerto adecuado de Kibana.


![cap9](https://github.com/user-attachments/assets/d708a0a5-5d21-4e3c-9dfa-5ddda9145bb2)

![cap10](https://github.com/user-attachments/assets/bb2001b8-dc87-4331-a612-a9d2f23d29dc)

![capfin](https://github.com/user-attachments/assets/2a88a6f5-7ad3-4e4c-8bd3-630ffa54c271)

2. **Configurar NUT para enviar logs.**
   - NUT registra eventos críticos, como batería baja o fallos de alimentación, en el archivo de log del sistema. Estos logs pueden enviarse a Kibana para su análisis. Asegúrate de que rsyslog esté configurado para enviar los logs al puerto adecuado de Kibana.

3. **Crear filtros y dashboards en Kibana para analizar y visualizar los logs generados por NUT.**
   - Configura Kibana para analizar y visualizar los logs generados por NUT, tales como:
     - Estado de la batería.
     - Tiempo de respaldo.
     - Eventos críticos como sobrecarga o fallo de alimentación.
   - Crea un dashboard que muestre visualmente los eventos más relevantes, como las caídas de energía o la activación del modo batería.

4. **Simulación de eventos críticos.**
   - Cambia los parámetros en el archivo de configuración de NUT (`ups.conf`) para simular eventos como batería baja o fallo de alimentación:
     - `ups.status = OB LB` # Modo batería, baja carga
     - `battery.charge = 10` # Simula un 10% de batería restante
   - Reinicia NUT y verifica cómo se registran los eventos en Kibana. Estos eventos deberán aparecer como logs críticos, que pueden generar alertas si están configuradas.
