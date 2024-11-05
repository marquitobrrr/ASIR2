# Parte 1: Configuración de NUT en modo simulado

1. **Instalar NUT**.

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
     
3. **Configurar el servicio de NUT**:
   - Edita el archivo /etc/nut/upsmon.conf para definir la monitorización del SAI:
          MONITOR simups@localhost 1 upsuser password master
        - Asegúrate de que los permisos del archivo estén correctamente configurados.

4. **Iniciar el servicio de NUT**.

5. **Verificar el estado del SAI simulado**:
   - Esto debería devolver el estado del SAI simulado, mostrando valores como el nivel de carga de la batería y su estado.
     ```
     upsc simups@localhost
