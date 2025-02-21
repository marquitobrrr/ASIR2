# Desafío NCA: Implementación en la Nube con AWS

## Requisitos previos
- Crear una tarjeta Revolut que contenga por lo menos 2 euros.

## Descripción del curso
Sigue el siguiente curso paso a paso, en el que trabajarás en la nube de Amazon (AWS).  
En este desafío NCA se juntan los módulos **IAW, BASES DE DATOS y SAD**.  
Lee y visualiza muy a detalle todo lo que se expone, hay mucha información muy condensada.  

- Se desplegará una aplicación web PHP con su base de datos **RDS (MySQL)** en la nube.  
- Se trabajará sobre su seguridad con varios mecanismos, **ACL y propios de Amazon**.  
- Se desplegarán y configurarán **firewalls Pfsense en la nube**.  
- Se creará una **red DMZ en la nube**.  
- Documentar en **GitHub** con lo que consideréis más relevante.  

## Contenido del curso

### Módulo 1: Introducción a AWS
 **01** - Introducción a AWS (Amazon Web Services).mkv 
 **02** - Registro y configuración de una cuenta en AWS  
 **03** - Costes en AWS  

### Módulo 2: Despliegue de una Aplicación Web en la Nube
 **04_1** - userdata.txt  
 **04_2** - Tarea: Despliegue de una aplicación web en la nube.mkv  
 **05** - Solución: Despliegue de una aplicación web en la nube.mkv *(18 de febrero)*  

### Módulo 3: Despliegue de una Base de Datos en la Nube
 **06** - Solución: Despliegue de una base de datos en la nube.mkv *(19 de febrero)*  

### Módulo 4: Seguridad y Firewalls en AWS
 **07** - Teoría: Firewall.pdf  
 **08** - Teoría: Firewall.mkv  
 **09** - Tarea: Despliegue de un Firewall en AWS.pdf  
 **10** - Tarea: Despliegue de un Firewall en AWS.mkv  
 **11** - Solución: Despliegue de un Firewall en AWS.mkv *(20 de febrero)*  

### Módulo 5: Implementación de una DMZ en AWS
 **12** - Teoría: Zona Desmilitarizada (DMZ).pdf  
 **13** - Teoría: Zona Desmilitarizada (DMZ).mkv  
 **14** - Tarea: Despliegue de una DMZ con un Firewall empresarial - Pfsense.mkv *(21 de febrero)*  

### Pendiente por subir:
 **15** - Solución: Despliegue de una DMZ con un Firewall empresarial - Pfsense  

---

📌 **Fuente:** *Curso Completo de Ciberseguridad Defensiva (Udemy)*


## INTRODUCCION A AWS
Amazon Web Services (AWS) es una plataforma de computación en la nube de Amazon que ofrece una amplia gama de servicios para empresas y desarrolladores. AWS proporciona soluciones escalables, seguras y de bajo costo para necesidades de computación, almacenamiento, bases de datos, redes, análisis de datos, inteligencia artificial, y más.

Fundada en 2006, AWS revolucionó el mercado al permitir que las empresas accedieran a infraestructura de TI de manera flexible, pagando solo por lo que usan. Algunos de sus servicios más populares incluyen Amazon EC2 (servidores virtuales), Amazon S3 (almacenamiento de objetos), Amazon RDS (bases de datos), y Amazon Lambda (computación sin servidores).

AWS es el líder en el mercado de la nube gracias a su innovación constante, su alcance global con centros de datos en múltiples regiones, y su amplio ecosistema de servicios que permiten a las empresas optimizar costos y acelerar su transformación digital.

## CREACION CUENTA REVOLUT Y AWS
### Cuenta Revolut 
![image](https://github.com/user-attachments/assets/fffbdf39-b71b-41be-a882-7b6d6cd730a4)

### Creacion cuenta AWS
![image](https://github.com/user-attachments/assets/d1ea54bc-bdcb-45fd-a6f3-15b452dd4e91)
![image](https://github.com/user-attachments/assets/32452188-69ea-4f22-a481-2568d3392392)
![image](https://github.com/user-attachments/assets/437f9549-d328-47fd-b348-47f1e36ff508)

### Active el acceso de IAM
![image](https://github.com/user-attachments/assets/6ba8189e-4ae2-4655-b8e7-14dbddfed0b7)

###  Seguridad de la cuenta de AWS
![image](https://github.com/user-attachments/assets/c6c812b7-be22-498e-9d67-57c68b469a69)

### Creacion de usuario
![image](https://github.com/user-attachments/assets/57a2cf9a-250c-4477-b548-2aa638bedab6)

### Creacion de grupo Admins donde el usuario que acabamos de crears formara parte de él
![image](https://github.com/user-attachments/assets/4e08d9bd-bad4-4f01-a0d8-926788ba3460)
![image](https://github.com/user-attachments/assets/b474cd17-cad5-4690-9a0f-8506bc0496d9)
![image](https://github.com/user-attachments/assets/ae62f100-f4c2-46c7-ae5a-8b4dd9fb94d5)
![image](https://github.com/user-attachments/assets/265e1490-7a3b-45c2-b38e-f48e415b5f68)

---

## CONFIGURACION DE SERVICIOS
### Despliegue de vpc y subredes
#### VPC
![image](https://github.com/user-attachments/assets/896b1314-852e-4512-b56c-a77cd873cbc1)
#### SUBREDES
Subred 1 publica
![image](https://github.com/user-attachments/assets/40ab4d71-f56d-426a-8313-02cae9f7a650)
Subred 2 privada para la base de datos
![image](https://github.com/user-attachments/assets/fb9adba7-1c4f-458c-98de-0f5df16bef61)
Subred 3 privada replica de la base de datos
![image](https://github.com/user-attachments/assets/a285c78a-5f01-401f-8beb-c9f97512dc92

Tabla de subredes
![image](https://github.com/user-attachments/assets/b9bde86a-31b6-45f8-a4fa-f77ac5a208cd)

### Despliegue de instancias
#### Instancia WebServer
![image](https://github.com/user-attachments/assets/8e7c2141-96cd-4d6d-937c-55b3d0d82f7c)
![image](https://github.com/user-attachments/assets/981c7180-155a-4cd3-865b-f25a60c27269)
![image](https://github.com/user-attachments/assets/ee747101-47fa-4059-b84f-9bbd40ae65d0)
![image](https://github.com/user-attachments/assets/e0327809-a20d-4110-a36f-6805665286d0)
![image](https://github.com/user-attachments/assets/9fe4848b-bf41-4e1b-90a6-c958cda636a4)

#### Gateway
![image](https://github.com/user-attachments/assets/3b951766-114b-4549-b479-b593f9a2d174)

#### Tablas de enrutamiento
![image](https://github.com/user-attachments/assets/70d58a28-f844-4e49-97fd-e886e1b77222)
![image](https://github.com/user-attachments/assets/e18dc415-8c8c-4cad-a41e-1000cadd9fde)

#### Conexion SSH 
![image](https://github.com/user-attachments/assets/134b34bd-4307-45f7-8364-549922e58773)
![image](https://github.com/user-attachments/assets/0c4c7976-7f56-4bef-91aa-9bd7295aea74)

##### Ejecutar el script
![image](https://github.com/user-attachments/assets/02787706-b2d9-4bab-be91-33e4b30fe448)
![image](https://github.com/user-attachments/assets/1650693b-4718-411c-a7c5-58c4c587a6eb)
![image](https://github.com/user-attachments/assets/23e8f91b-adb0-45d7-9572-0812c7fe3878)

#### Conexion HTTP
![image](https://github.com/user-attachments/assets/1ab4811f-bc51-43df-b7ab-8af07d571db0)

---

### Creacion Base de datos
#### Grupo de subredes
![image](https://github.com/user-attachments/assets/37a9851f-33fe-4c7b-9b5a-a1e81c5c94ee)
![image](https://github.com/user-attachments/assets/02e40a2f-df8e-4969-a9c8-c71f5f852fa7)
![image](https://github.com/user-attachments/assets/8be244ec-e85d-4ade-894a-caa2c3314d6f)
0.

#### Creacion bae de datos
![image](https://github.com/user-attachments/assets/e0f16afb-2cbb-4a1f-a089-59038c2aeb40)
![image](https://github.com/user-attachments/assets/e0a24fc9-fbfb-4d26-a349-f49c3b76f0cb)
![image](https://github.com/user-attachments/assets/551d7a5a-1086-484a-88be-2651bdd6183a)
![image](https://github.com/user-attachments/assets/4949a564-b22a-48ea-a33e-cec2aedb8d9c)
![image](https://github.com/user-attachments/assets/0695d095-2c88-4d2e-904a-21a2d654f354)

#### Desde terminal ejecutar este comando 
```bash
  mysql -u -admin -h database-marcoasir.cj8masiai201.eu-west-3.rds.amazonaws.com -p
  sudo yum install mysql
```
---

### Firewall
#### Firewall Stateless
##### Reglas ACL Entrada
![image](https://github.com/user-attachments/assets/c2cb41e7-31b3-4ad7-a9b9-2c6873618b16)
##### Reglas ACL Salida
![image](https://github.com/user-attachments/assets/9c344f2c-d0de-4571-bc08-49283a4b8673)

##### Asignar ACl a subred publica
![image](https://github.com/user-attachments/assets/8e55ed63-90d2-44fb-bfe6-942099b411f0)
![image](https://github.com/user-attachments/assets/d1165798-a88f-4dba-a975-43a9741482c0)

#### Firewall Statefull
##### Reglas ACL desde grupos de seguridad con acceso desde HTTP HTTPS SSH.
###### Reglas de entrada 
![image](https://github.com/user-attachments/assets/ab93b3db-d8e8-48fd-be00-8ccf9f4927c5)
###### Reglas de salida
![image](https://github.com/user-attachments/assets/ef61a9e2-83da-404a-a4c1-bf4919f13837)
###### Grupo de seguridad
![image](https://github.com/user-attachments/assets/309552f7-69b9-4c1b-ac0f-e07a22819133)
![image](https://github.com/user-attachments/assets/f41a4e35-9c0c-467b-88ac-547056fbfe99)

###### Asignar Grupo de Seguridad a la instancia.
![image](https://github.com/user-attachments/assets/749b4081-d598-492f-adda-38036c6ca7eb)
![image](https://github.com/user-attachments/assets/7b9cd918-0295-465c-9638-67fa1d178adf)

![image](https://github.com/user-attachments/assets/a0f25983-6bb1-44e9-af78-c036ef3c3ada)
![image](https://github.com/user-attachments/assets/86292e57-bfa2-4ff1-8fad-0d39d6dc4e63)

