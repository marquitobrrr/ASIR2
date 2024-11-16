# Al ataque!!!!

## 1. Instalación de Pydictor

Primero, instalamos **Pydictor** desde GitHub usando el siguiente comando:


git clone https://github.com/usuario/pydictor.git

![cap1](https://github.com/user-attachments/assets/2658d9e1-395e-4087-9b84-0fb8d7b0d75f)

### 1.1. Requisitos

Necesitamos tener **Python** instalado. Después de clonar el repositorio, navegamos a la carpeta de Pydictor y lo ejecutamos con Python 3:

![cap2](https://github.com/user-attachments/assets/9c3e2375-fb49-4226-941d-13793b25beea)


cd pydictor
python3 pydictor.py -len 6 6 -base d -o diccionario_numeros.txt


![cap3](https://github.com/user-attachments/assets/32ae141b-2633-40ea-a52d-7908266d06f0)


**Explicación del comando:**

- -len 6 6: Genera combinaciones de exactamente 6 caracteres.
- -base d: Usa solo números (0-9).
- -o diccionario_numeros.txt: Guarda las combinaciones en diccionario_numeros.txt.
  
  

### 1.2. Generación de Diccionarios con Letras Mayúsculas

Para crear un diccionario con combinaciones de letras mayúsculas, usamos este comando:

python3 pydictor.py -len 5 -base c -o diccionario_mayusculas.txt


![cap4](https://github.com/user-attachments/assets/e9e704d5-fc25-4b0b-8302-2ea8c148a986)

**Explicación del comando:**

- -len 5: Genera combinaciones de exactamente 5 caracteres.
- -base c: Usa solo letras mayúsculas (A-Z).
- -o diccionario_mayusculas.txt: Guarda las combinaciones en diccionario_mayusculas.txt.

### Resultado diccionario numerico;
  ![cap5](https://github.com/user-attachments/assets/448cad28-f314-4d13-acee-0aa63b210224)

### Resultado diccionario mayusculas;
  ![cap6](https://github.com/user-attachments/assets/37c0d1f6-a6fc-4bda-92ce-b4aca3f98628)



## 2. Combinación de Diccionarios con Dymerge

Ahora instalamos **Dymerge** desde otro repositorio de GitHub y navegamos a la carpeta:


- git clone https://github.com/usuario/dymerge.git
- cd dymerge

![cap7](https://github.com/user-attachments/assets/e92ab0c4-419a-4545-8ffb-4923e207ffa2)

Ejecutamos **Dymerge** para combinar los diccionarios generados:

![cap8](https://github.com/user-attachments/assets/7781af00-894d-4711-993a-f0b906f8f374)


python2 dymerge.py /home/alumno/pydictor/results/diccionario_numeros.txt /home/alumno/pydictor/results/diccionario_mayusculas.txt -o diccionario_combinado.txt

![cap9](https://github.com/user-attachments/assets/71329e78-5579-4575-a9c4-9c170fe52cac)

**Explicación del comando:**

- /home/alumno/pydictor/results/diccionario_numeros.txt: Ruta del diccionario de números.
- /home/alumno/pydictor/results/diccionario_mayusculas.txt: Ruta del diccionario de letras mayúsculas.
- -o diccionario_combinado.txt: Combina ambos diccionarios en diccionario_combinado.txt.


## 3. Instalación de SSH

Instalamos el servicio **SSH** en el sistema. Después, añadimos un usuario objetivo y le asignamos la contraseña 000000.

![cap10](https://github.com/user-attachments/assets/c280031c-7a2d-4560-9aec-d0d281f62730)

![cap12](https://github.com/user-attachments/assets/8db04983-6124-4bb5-9da7-2425a8fa929e)

## 4. Instalación de Hydra

Instalamos **Hydra** para realizar ataques de fuerza bruta. Primero, verificamos la dirección IP de nuestro objetivo y luego ejecutamos el siguiente comando:

![cap13](https://github.com/user-attachments/assets/d7e37b3f-82e0-423d-939c-dd0de1a7296c)



hydra -l objetivo -p /home/alumno/dymerge/diccionario_combinado.txt ssh://10.0.2.15


![cap14](https://github.com/user-attachments/assets/9b5495c4-3ef9-4abb-b954-6f6a20da774e)


**Explicación del comando:**

- -l objetivo: Especifica el usuario objetivo.
- -p diccionario_combinado.txt: Indica el archivo con las contraseñas a probar.
- ssh://10.0.2.15: Protocolo SSH y dirección IP del servidor objetivo.

Como resultado, Hydra intentará autenticar al usuario y mostrará la contraseña recuperada si tiene éxito.

![cap15](https://github.com/user-attachments/assets/49c245c2-852a-4338-9b1a-63c70c8b8243)

## 5. Instalación de DVWA

Instalamos **DVWA** (Damn Vulnerable Web Application). Si hay un error durante la instalación, puede que DVWA ya esté instalada.

![cap](https://github.com/user-attachments/assets/d87c6465-c431-47a5-b792-75671807f575)

### 5.1. Configuración de DVWA

Accedemos al archivo de configuración de DVWA. Este archivo define cómo DVWA se conecta a la base de datos y el nivel de seguridad. 

El archivo lo he configurado de la siguiente forma:

- **Gestor de Base de Datos**: Usa **MySQL** y se conecta a 127.0.0.1 con el usuario root y sin contraseña.
- **Base de Datos**: Usa la base de datos llamada dvwa en el puerto 3306.
- **Nivel de Seguridad**: El nivel de seguridad predeterminado está en **bajo** para facilitar las pruebas.

  ![cap17](https://github.com/user-attachments/assets/74b78387-9475-4def-b629-c3dd9cc9c4a9)


### 5.2. Inicialización de la Base de Datos

Iniciamos **MariaDB** y configuramos la base de datos DVWA con los siguientes comandos:

![cap17](https://github.com/user-attachments/assets/e8aef301-93fb-4f45-b33c-67091e3fbf5b)

- CREATE DATABASE dvwa;
- GRANT ALL PRIVILEGES ON dvwa.* TO 'root'@'localhost' IDENTIFIED BY '';
- FLUSH PRIVILEGES;
- EXIT;

![cap20](https://github.com/user-attachments/assets/1c6a3b17-c1bf-4689-a2b7-2fc78175f3be)

## 6. Preparación para el Ataque

Abrimos el navegador y accedemos a la URL http://localhost/DVWA/login.php. En esta página leeremos el codigo fuente preparamos el ataque.

![cap21](https://github.com/user-attachments/assets/eee5ce49-e3b9-47a9-9bd9-3eb9f8990abd)

### 6.1. Lanzamiento del Ataque

Finalmente, ejecutamos el siguiente comando usando Hydra:

hydra -l admin -p /home/alumno/dymerge/diccionario_combinado.txt http-post-form “/DVWA/login.php:username=^USER^&password=^PASS^&Login=Login failed”

![cap22](https://github.com/user-attachments/assets/b89e053b-9770-4547-86bb-cb2c5b9e4c64)

## Análisis del Comando de Hydra

Este comando de Hydra está diseñado para realizar un ataque de fuerza bruta a un formulario de inicio de sesión de una aplicación web, en este caso DVWA. A continuación, lo desglosamos:

- **hydra**: Es la herramienta que realiza el ataque de fuerza bruta.

- **-l admin**: Especifica el nombre de usuario fijo que se va a probar, en este caso admin.

- **-p /home/alumno/dymerge/diccionario_combinado.txt**: Especifica la ruta al archivo de diccionario (lista de contraseñas) que Hydra usará para probar cada contraseña en el formulario.

- **localhost**: Indica que el objetivo del ataque es el servidor local donde está corriendo DVWA.

- **http-post-form**: Indica que el tipo de ataque es sobre un formulario web que utiliza el método POST.

- **/DVWA/login.php;username=^USER^&password=^PASS^&Login=Login failed**:
  - **/DVWA/login.php**: Es la ruta al formulario de inicio de sesión de DVWA.
  - **username=^USER^&password=^PASS^&Login=Login**: Representa los parámetros que el formulario envía:
    - **^USER^**: Se reemplaza por el valor de usuario que se especificó con -l (en este caso, "admin").
    - **^PASS^**: Se reemplaza por las contraseñas del diccionario.
  - **Login failed**: Es el mensaje que aparece en la página si el intento de inicio de sesión falla. Hydra busca este mensaje para saber si la contraseña probada fue incorrecta.

# Estudio de como mitigar y prevenir ataques similares.

- Contraseñas Seguras: Contraseñas largas y complejas, con expiración periódica y bloqueo tras intentos fallidos.
- Limitar Intentos de Inicio de Sesión: Bloquear IPs o cuentas tras varios intentos fallidos (Fail2Ban).
- Cambiar Puerto de SSH: Cambiar el puerto predeterminado (22) a uno menos común.
- CAPTCHA: Añadir CAPTCHA para prevenir ataques automatizados en formularios web.
- Monitorización: Vigilar intentos sospechosos e implementar alertas.
- Ajustar Tiempos de Respuesta: Aumentar el tiempo tras intentos fallidos para ralentizar ataques.
- Firewalls: Limitar IPs permitidas y bloquear sospechosas con herramientas como iptables o Fail2Ban.
- Auditorías de Seguridad: Revisar y actualizar el sistema regularmente.


