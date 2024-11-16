
# Ejercicio 1: Gestión de Permisos en un Entorno de Trabajo Multiusuario

## Escenario:

Imagina que eres el administrador de un equipo de desarrollo con varios usuarios, y necesitas configurar los permisos de un proyecto compartido entre tres usuarios: monon1, tronko2 y birmingan3. Cada uno debe tener permisos específicos para un directorio de proyecto, de acuerdo con su rol.

### Paso 1: Crear un entorno simulado de usuarios y grupos

- Crea los tres usuarios y un grupo común llamado `devErlia2`.
![cap1](https://github.com/user-attachments/assets/ed11fc0b-f6f7-481a-bdde-83ef099e38e8)
![cap2](https://github.com/user-attachments/assets/4dc90581-65bf-4dd5-9805-deaf2dcbc711)
![cap3](https://github.com/user-attachments/assets/9e203fd7-e606-421b-b0a6-96500458251f)
![cap4 ](https://github.com/user-attachments/assets/134ab2e2-268d-4670-b348-77d06f997645)



### Paso 2: Configuración de permisos básicos

- Crea un directorio llamado `di_recto` para el proyecto y cambia el grupo propietario a `devErlia2`.
- Configura los permisos para que solo los usuarios del grupo `devErlia2` puedan escribir en el directorio.
- Verifica mostrando los permisos del directorio.
- `monon1` debe tener permisos completos (lectura, escritura, ejecución) en todo el proyecto. Cambia el propietario del directorio a `monon1`.
- Los otros dos usuarios del grupo solo deben poder leer y ejecutar archivos, pero no modificarlos. Cambia los permisos de modo que el grupo `devErlia2` solo tenga permisos de lectura y ejecución.

![cap5](https://github.com/user-attachments/assets/84012b63-27ab-4d28-bba7-2d1ef43b89e2)

![cap6](https://github.com/user-attachments/assets/a06b7068-3564-46d0-9bc0-5588a23e3006)

### Preguntas:

#### ¿Qué sucede si un usuario fuera del grupo `devErlia2` intenta acceder al directorio?
- No podria acceder por falta de permisos. 
#### ¿Qué sucede si `tronko2` intenta modificar un archivo dentro del directorio?
- Se le permitiria ya que tiene los permisos de escritura sobre el directorio.
  
# Ejercicio 2: Control de Acceso con el Bit SGID en Directorios

## Escenario:

El equipo de desarrollo necesita colaborar en un subdirectorio dentro de `di_recto`. Queremos asegurarnos de que cualquier archivo creado en ese subdirectorio tenga automáticamente el mismo grupo propietario (`devErlia2`), para facilitar la colaboración.

### Paso 1: Crear un subdirectorio para colaboración

- Crea un subdirectorio llamado `di_afano` dentro de `di_recto`.
- Cambia el grupo propietario del subdirectorio a `devErlia2`.
  
![cap1](https://github.com/user-attachments/assets/48c42fd3-d361-484d-9cd3-7f76ef788bf4)

### Paso 2: Aplicar el bit SGID

- Aplica el bit SGID al subdirectorio `di_afano`, para que todos los archivos creados en él hereden el grupo propietario.
- Verifica y muestra los permisos del subdirectorio.

![cap2](https://github.com/user-attachments/assets/124507bf-2cfc-4554-b121-438634f1e8e7)

### Paso 3: Crear archivos de prueba

- Cambia a `tronko2` y crea un archivo llamado `archivo_tronko2.txt` dentro del subdirectorio `di_afano`.
- Verifica y muestra los permisos y el grupo propietario del archivo.

![cap3](https://github.com/user-attachments/assets/031c23f1-a1be-4e71-b344-16eca1113b8c)

### Preguntas:

#### ¿Cuál es el grupo propietario del archivo creado por `tronko2`?
- El grupo propietario sera devEria2 ya que ha heredado los permisos.
  
#### ¿Qué ventaja aporta el bit SGID en un entorno de colaboración?
- Las ventajas del bit SGID en un entorno de colaboración son:
- Heredar el grupo propietario del directorio para archivos y subdirectorios creados.
- Unificar permisos de grupo, facilitando el acceso entre usuarios.
- Simplificar la administración de permisos en directorios compartidos.
- Evitar conflictos de acceso causados por grupos diferentes.
- Mejorar la colaboración al asegurar que todos los archivos sean accesibles para el grupo sin ajustes adicionales.

# Ejercicio 3: Gestión de Archivos Temporales con Sticky Bit

## Escenario:

Se ha creado un directorio temporal compartido entre todos los usuarios del sistema. Necesitas asegurarte de que los usuarios puedan crear y modificar sus propios archivos, pero no puedan eliminar o modificar los archivos de otros usuarios.

### Paso 1: Crear un directorio temporal

- Crea un directorio llamado `tmp_rano` en `/tmp`.
- Cambia los permisos para que todos los usuarios puedan leer, escribir y ejecutar en el directorio.
  
![cap1](https://github.com/user-attachments/assets/083e3393-7a04-4267-a4ed-dcab36d8de00)

### Paso 2: Aplicar el sticky bit

- Aplica el sticky bit al directorio para evitar que los usuarios eliminen archivos de otros.
- Verifica los permisos del directorio.

  ![cap2](https://github.com/user-attachments/assets/6fd6ab58-143b-4367-bcfc-0628507fac9c)

### Paso 3: Crear archivos de prueba

- Cambia a `monont` y crea un archivo en el directorio temporal.
- Cambia a `birmingham3` y verifica si puede eliminar el archivo de `monont`.

![cap3](https://github.com/user-attachments/assets/9a4c0543-2da3-4381-9039-6193ac567057)

### Preguntas:

#### ¿Pudo `birmingham3` eliminar el archivo de `monont`? ¿Por qué?
- No, no pudo. Monon no podría eliminar el archivo porque no es el propietario del archivo ni del directorio, y el sticky bit está activado. Solo el propietario del archivo, del directorio o el superusuario pueden hacerlo.
#### ¿Cómo ayuda el sticky bit a mejorar la seguridad en directorios compartidos?
- Previene eliminación accidental o malintencionada de archivos de otros usuarios.
- Protege la integridad de los datos en directorios compartidos.
- Mantiene el control de los archivos en manos de sus dueños.

# Ejercicio 4: Configuración de umask y Creación de Archivos Nuevos

## Escenario:

Quieres configurar el entorno de trabajo para que todos los archivos nuevos creados por los usuarios tengan permisos predeterminados restrictivos (solo lectura y escritura para el propietario, sin acceso para el grupo y otros).

### Paso 1: Configurar umask

- Verifica el valor actual de umask.
- Cambia el valor de umask a `077` para que los archivos creados sean accesibles solo por el propietario.

![cap1](https://github.com/user-attachments/assets/0070e8f0-ca42-47d4-8ede-f5c7248e92db)

### Paso 2: Crear archivos de prueba

- Crea un archivo nuevo llamado `gorras_umask` y verifica sus permisos.

![cap2](https://github.com/user-attachments/assets/756f5116-1424-40f2-9e22-9538e9cf7ae5)

### Paso 3: Restablecer umask

- Si deseas restaurar el valor predeterminado de umask, puedes hacerlo.

![cap3](https://github.com/user-attachments/assets/dabdb38d-84f0-4c97-86a0-c6c94ebf83d0)

### Preguntas:

#### ¿Cómo afecta el valor de umask a los permisos de los nuevos archivos?
- ·Umask establece qué permisos deben ser bloqueados o restringidos automáticamente por lo tanto obtendran los permisos que hayamos configurado en umask, en este caso 077 por lo tanto se quedearian en 600. lectura y escritura para el propietario y ningun permiso para grupo propietario y otros.
#### ¿Cómo podrías usar umask para mejorar la seguridad de los archivos en un sistema multiusuario?
- Estableceiendo umask restrictivo:
- Configurar umask a 077.
- Archivos: permisos 600 (solo el propietario puede acceder).
- Evitar eliminación accidental
- Restringir el acceso a otros usuarios para proteger la integridad de los archivos.
- Controlar acceso a archivos
- Obligar al propietario a gestionar cuidadosamente los permisos.

# Ejercicio 5: Implementación de ACLs

Queremos que `birmingham3` pueda leer un archivo específico dentro de un nuevo directorio que se tiene que crear llamado `archivos_criticos`, pero sin poder modificarlo.

- Habilita ACLs en el sistema si no están habilitadas (si ya lo están, omite este paso).
  ![cap1](https://github.com/user-attachments/assets/cdc6f101-78af-496f-9918-afbb1038ec85)
  
- Crea un archivo llamado `osaka.txt` dentro de `archivos_criticos`.
  ![cap2](https://github.com/user-attachments/assets/ed31474a-feac-428a-975f-5f90f62ef8d1)

- Añade una ACL para que `birmingham3` pueda leer el archivo `osaka.txt`, pero no modificarlo.
  ![cap3](https://github.com/user-attachments/assets/c64afb63-6bd7-422d-8a8d-ac6bb990d83b)

- Verifica y muestra las ACLs del archivo.
  ![cap4](https://github.com/user-attachments/assets/77ac1c71-da20-466b-84cd-b67c3da19286)


### Preguntas:

#### ¿Cómo afectan las ACLs al comportamiento de permisos tradicionales?
- Permiten definir permisos específicos para múltiples usuarios y grupos, más allá del propietario, grupo y otros.
- Asignan permisos específicos (lectura, escritura, ejecución) a un número ilimitado de usuarios y grupos.
- Pueden modificar o anular permisos tradicionales, permitiendo acceso a usuarios que, de otro modo, no tendrían permiso.
#### ¿Qué sucede si `birmingham3` intenta modificar el archivo?

# Ejercicio 6: Auditoría y control de accesos mediante logs de permisos

## Escenario:

Como administrador, necesitas auditar los accesos a archivos críticos para asegurarte de que nadie acceda de manera indebida a los datos sensibles. Implementarás auditorías en archivos clave para monitorizar el acceso.

### Paso 1: Configuración de auditoría de accesos con auditd

- Instala el servicio de auditoría si no está instalado.
  
  ![cap1](https://github.com/user-attachments/assets/9065a451-bec1-439c-9bd0-e8d105191025)
  ![cap2](https://github.com/user-attachments/assets/f1cf5962-51a4-4e46-93c1-cc825a6afb6f)


- Configura una regla para auditar los accesos al archivo `_archivo_tronco1.txt`.

![cap3](https://github.com/user-attachments/assets/0392075f-fb27-4447-a5b8-49830c07df8b)

### Paso 2: Verificación de logs de auditoría

- Accede al archivo `_archivo_tronco1.txt` como `monont`.
- Verifica e interpreta los logs de auditoría.
- Accede al archivo `_archivo_tronco2.txt` como `tronko2`.
- Verifica e interpreta los logs de auditoría.
- Accede al archivo `_archivo_tronco3.txt` como `birmingham3`.
- Verifica e interpreta los logs de auditoría.

![cap4](https://github.com/user-attachments/assets/2ee35680-955f-4ab1-8100-481ddc2c0fc2)

### Pregunta:

#### ¿Cómo puedes usar las auditorías para mejorar la seguridad de tu sistema?
- Observa lo que hacen los usuarios en el sistema para detectar comportamientos sospechosos.
- Guarda un registro de acciones importantes, como accesos a archivos y cambios de configuración.
- Revisa los registros regularmente para encontrar patrones extraños que podrían indicar problemas.
- Busca debilidades en el sistema y actualiza el software para corregirlas.
