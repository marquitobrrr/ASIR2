
# Ejercicio 1: Gestión de Permisos en un Entorno de Trabajo Multiusuario

## Escenario:

Imagina que eres el administrador de un equipo de desarrollo con varios usuarios, y necesitas configurar los permisos de un proyecto compartido entre tres usuarios: monon1, tronko2 y birmingan3. Cada uno debe tener permisos específicos para un directorio de proyecto, de acuerdo con su rol.

### Paso 1: Crear un entorno simulado de usuarios y grupos

- Crea los tres usuarios y un grupo común llamado `devErlia2`.
- Crea un directorio llamado `di_recto` para el proyecto y cambia el grupo propietario a `devErlia2`.

### Paso 2: Configuración de permisos básicos

- Configura los permisos para que solo los usuarios del grupo `devErlia2` puedan escribir en el directorio.
- Verifica mostrando los permisos del directorio.

### Paso 3: Configuración de permisos avanzados

- `monon1` debe tener permisos completos (lectura, escritura, ejecución) en todo el proyecto. Cambia el propietario del directorio a `monon1`.
- Los otros dos usuarios del grupo solo deben poder leer y ejecutar archivos, pero no modificarlos. Cambia los permisos de modo que el grupo `devErlia2` solo tenga permisos de lectura y ejecución.

### Preguntas:

- ¿Qué sucede si un usuario fuera del grupo `devErlia2` intenta acceder al directorio?
- ¿Qué sucede si `tronko2` intenta modificar un archivo dentro del directorio?

# Ejercicio 2: Control de Acceso con el Bit SGID en Directorios

## Escenario:

El equipo de desarrollo necesita colaborar en un subdirectorio dentro de `di_recto`. Queremos asegurarnos de que cualquier archivo creado en ese subdirectorio tenga automáticamente el mismo grupo propietario (`devErlia2`), para facilitar la colaboración.

### Paso 1: Crear un subdirectorio para colaboración

- Crea un subdirectorio llamado `di_afano` dentro de `di_recto`.
- Cambia el grupo propietario del subdirectorio a `devErlia2`.

### Paso 2: Aplicar el bit SGID

- Aplica el bit SGID al subdirectorio `di_afano`, para que todos los archivos creados en él hereden el grupo propietario.
- Verifica y muestra los permisos del subdirectorio.

### Paso 3: Crear archivos de prueba

- Cambia a `tronko2` y crea un archivo llamado `archivo_tronko2.txt` dentro del subdirectorio `di_afano`.
- Verifica y muestra los permisos y el grupo propietario del archivo.

### Preguntas:

- ¿Cuál es el grupo propietario del archivo creado por `tronko2`?
- ¿Qué ventaja aporta el bit SGID en un entorno de colaboración?

# Ejercicio 3: Gestión de Archivos Temporales con Sticky Bit

## Escenario:

Se ha creado un directorio temporal compartido entre todos los usuarios del sistema. Necesitas asegurarte de que los usuarios puedan crear y modificar sus propios archivos, pero no puedan eliminar o modificar los archivos de otros usuarios.

### Paso 1: Crear un directorio temporal

- Crea un directorio llamado `tmp_rano` en `/tmp`.
- Cambia los permisos para que todos los usuarios puedan leer, escribir y ejecutar en el directorio.

### Paso 2: Aplicar el sticky bit

- Aplica el sticky bit al directorio para evitar que los usuarios eliminen archivos de otros.
- Verifica los permisos del directorio.

### Paso 3: Crear archivos de prueba

- Cambia a `monont` y crea un archivo en el directorio temporal.
- Cambia a `birmingham3` y verifica si puede eliminar el archivo de `monont`.

### Preguntas:

- ¿Pudo `birmingham3` eliminar el archivo de `monont`? ¿Por qué?
- ¿Cómo ayuda el sticky bit a mejorar la seguridad en directorios compartidos?

# Ejercicio 4: Configuración de umask y Creación de Archivos Nuevos

## Escenario:

Quieres configurar el entorno de trabajo para que todos los archivos nuevos creados por los usuarios tengan permisos predeterminados restrictivos (solo lectura y escritura para el propietario, sin acceso para el grupo y otros).

### Paso 1: Configurar umask

- Verifica el valor actual de umask.
- Cambia el valor de umask a `077` para que los archivos creados sean accesibles solo por el propietario.

### Paso 2: Crear archivos de prueba

- Crea un archivo nuevo llamado `gorras_umask` y verifica sus permisos.

### Paso 3: Restablecer umask

- Si deseas restaurar el valor predeterminado de umask, puedes hacerlo.

### Preguntas:

- ¿Cómo afecta el valor de umask a los permisos de los nuevos archivos?
- ¿Cómo podrías usar umask para mejorar la seguridad de los archivos en un sistema multiusuario?

# Ejercicio 5: Implementación de ACLs

Queremos que `birmingham3` pueda leer un archivo específico dentro de un nuevo directorio que se tiene que crear llamado `archivos_criticos`, pero sin poder modificarlo.

- Habilita ACLs en el sistema si no están habilitadas (si ya lo están, omite este paso).
- Crea un archivo llamado `osaka.txt` dentro de `archivos_criticos`.
- Añade una ACL para que `birmingham3` pueda leer el archivo `osaka.txt`, pero no modificarlo.
- Verifica y muestra las ACLs del archivo.

### Preguntas:

- ¿Cómo afectan las ACLs al comportamiento de permisos tradicionales?
- ¿Qué sucede si `birmingham3` intenta modificar el archivo?

# Ejercicio 6: Auditoría y control de accesos mediante logs de permisos

## Escenario:

Como administrador, necesitas auditar los accesos a archivos críticos para asegurarte de que nadie acceda de manera indebida a los datos sensibles. Implementarás auditorías en archivos clave para monitorizar el acceso.

### Paso 1: Configuración de auditoría de accesos con auditd

- Instala el servicio de auditoría si no está instalado.
- Configura una regla para auditar los accesos al archivo `_archivo_tronco1.txt`.

### Paso 2: Verificación de logs de auditoría

- Accede al archivo `_archivo_tronco1.txt` como `monont`.
- Verifica e interpreta los logs de auditoría.
- Accede al archivo `_archivo_tronco2.txt` como `tronko2`.
- Verifica e interpreta los logs de auditoría.
- Accede al archivo `_archivo_tronco3.txt` como `birmingham3`.
- Verifica e interpreta los logs de auditoría.

### Pregunta:

- ¿Cómo puedes usar las auditorías para mejorar la seguridad de tu sistema?
