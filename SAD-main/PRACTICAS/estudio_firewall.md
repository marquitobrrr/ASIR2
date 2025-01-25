# Estudio Firewall

## Definición de firewall:

Un firewall es una herramienta de seguridad que controla y filtra el tráfico de red, protegiendo la red de amenazas externas al establecer un perímetro entre una red confiable (interna) y una no confiable (externa), como Internet. Ya sea en forma de hardware o software, inspecciona los paquetes de datos, permitiendo o bloqueando su paso según reglas predefinidas, basadas en criterios como direcciones IP, puertos y protocolos. Los firewalls son esenciales para evitar accesos no autorizados y proteger los datos de actores maliciosos, como hackers y bots. Hoy en día, con la evolución de las amenazas, se requieren firewalls de nueva generación (NGFW) y tecnologías avanzadas, como inteligencia artificial, para enfrentar ciberataques más complejos.

## ¿Cómo actúa un firewall?

Un firewall actúa controlando el tráfico de red en tiempo real, inspeccionando los paquetes de datos para identificar amenazas y decidiendo si permitir o bloquear el acceso según las reglas configuradas. Su objetivo es proteger las redes privadas y los dispositivos de punto de conexión, conocidos como hosts, que se comunican entre sí enviando y recibiendo tráfico tanto de redes internas como externas. Los firewalls separan el tráfico seguro del peligroso, protegiendo contra amenazas como virus, correos fraudulentos y ataques DDoS, y limitando el acceso a aplicaciones y recursos dentro de la red corporativa.

Las redes están segmentadas en diferentes tipos para garantizar la seguridad y privacidad, tales como:

### Redes públicas externas:
Corresponden al Internet público o global, accesible desde cualquier lugar y con menor seguridad.

### Redes privadas internas:
Son redes más protegidas, como las domésticas o las intranets de empresas, accesibles solo desde dentro o por usuarios autorizados.

### Redes de perímetro:
Son una capa de seguridad adicional entre las redes internas y externas, con hosts bastión dedicados que protegen los servicios orientados al exterior (servidores web, correo electrónico, FTP, VoIP, etc.).

El tráfico de red se filtra utilizando reglas preestablecidas o aprendidas dinámicamente. Los firewalls regulan el flujo de tráfico de acuerdo con varios criterios, como:

- **Origen**: Lugar desde donde se intenta establecer la conexión.
- **Destino**: Lugar al que se intenta dirigir la conexión.
- **Contenido**: Información enviada en la conexión.
- **Protocolos del paquete**: Lenguaje usado para transmitir el mensaje, como TCP/IP y protocolos de aplicaciones (HTTP, Telnet, FTP, DNS, SSH).

El firewall puede aplicar reglas de filtrado basadas en estos identificadores para permitir, bloquear o redirigir el tráfico, dependiendo de la seguridad de los puntos de origen y destino, los puertos y las direcciones IP involucradas. Existen dos tipos de firewalls más comunes:

### Firewalls de red:
Utilizan uno o más firewalls entre redes externas e internas, regulando el tráfico de red entrante y saliente. Estos pueden ser implementados como hardware dedicado, software o soluciones virtuales.

### Firewalls de host:
Requieren la instalación de firewalls en dispositivos individuales de la red, proporcionando una capa adicional de protección para cada dispositivo, filtrando el tráfico y los protocolos específicos.

Los firewalls de red suelen ser más fáciles de configurar y adaptados para un control integral, mientras que los firewalls de host ofrecen un mayor nivel de personalización y control sobre el tráfico específico de cada equipo. Sin embargo, la combinación de ambos proporciona un sistema de seguridad más robusto mediante una arquitectura de seguridad de múltiples capas.

En resumen, el firewall es crucial para proteger tanto las redes internas como los dispositivos conectados a ellas, bloqueando accesos no autorizados, protegiendo contra ciberamenazas y asegurando que el tráfico solo pase si cumple con las reglas de seguridad establecidas.

## Firewall vs Antivirus:

Un firewall y un antivirus trabajan juntos, pero tienen funciones diferentes. Mientras que un firewall regula el tráfico de red y evita accesos no autorizados, el antivirus protege los dispositivos individuales de malware y otros virus. Los firewalls son soluciones de red, y los antivirus actúan a nivel de dispositivo. Ambos son complementarios y juntos proporcionan una defensa en capas.

## Tecnologías relacionadas con firewalls:

- **NAT (Traducción de direcciones de red)**: El NAT permite que varios dispositivos utilicen una sola dirección IP pública para acceder a Internet, lo que ayuda a ocultar la red interna y protegerla de accesos no autorizados.
- **VPN (Red Privada Virtual)**: Las VPN permiten crear conexiones seguras y cifradas a través de Internet, asegurando que los empleados remotos o los dispositivos puedan acceder de manera segura a la red corporativa. Esto es especialmente relevante en entornos híbridos, donde se combinan trabajo remoto y oficinas físicas.

## Tipos de Firewalls:

Los firewalls se clasifican según sus métodos de filtrado, que evolucionan para mejorar la seguridad mientras conservan elementos clave de generaciones anteriores. Los principales métodos incluyen seguimiento de conexión, reglas de filtrado y registros de auditoría. Su funcionamiento se relaciona con las capas del modelo OSI, lo que define cómo interactúan con las conexiones.

### Firewall de filtrado estático de paquetes
- **Capa OSI**: Red (Capa 3).
- **Funcionamiento**: Inspecciona paquetes de datos individuales según su dirección IP, puerto y protocolo, pero no rastrea conexiones previamente autorizadas.
- **Ventajas**: Ofrece un nivel básico de protección al bloquear conexiones no autorizadas.
- **Desventajas**: Requiere reglas manuales rígidas, no supervisa el contenido de los paquetes y necesita mantenimiento constante, lo que limita su eficacia en redes grandes.

### Firewall de puerta de enlace de nivel de circuito
- **Capa OSI**: Sesión (Capa 5).
- **Funcionamiento**: Evalúa la funcionalidad de los paquetes antes de establecer una conexión persistente entre redes, pero deja de monitorear una vez que la conexión está activa.
- **Ventajas**: Proporciona un filtrado intermedio similar al de firewalls proxy.
- **Desventajas**: Las conexiones abiertas sin supervisión pueden permitir el acceso de actores maliciosos.

### Firewall de inspección con estado
- **Capacidades**: Supervisa conexiones activas y mantiene un registro de conexiones previas en una tabla de estados.
- **Capa OSI**: Comienza en Transporte (Capa 4) y actualmente puede operar en la capa de Aplicación (Capa 7).
- **Funcionamiento**: Además de filtrar por propiedades técnicas (IP, puerto, protocolo), aprende de conexiones pasadas para bloquear patrones de tráfico problemáticos.
- **Ventajas**: Su capacidad dinámica y aprendizaje de eventos previos lo convierte en uno de los métodos más utilizados.
- **Desventajas**: Requiere configuración inicial adecuada y reglas de administrador para optimizar su funcionamiento.

### Firewalls sin estado vs. Firewalls con estado:

- **Firewalls sin estado**: Analizan el tráfico sin tener en cuenta el contexto o el estado de la conexión. Son rápidos y económicos, pero no pueden detectar amenazas complejas o malware en los datos del paquete.
- **Firewalls con estado**: Estos firewalls siguen el estado de las conexiones, lo que les permite ofrecer una protección más robusta al analizar el contexto de las comunicaciones y detectar patrones sospechosos. Sin embargo, su análisis más profundo puede afectar el rendimiento de la red.

## Implementación de firewall

Al seleccionar un firewall, es fundamental tener en cuenta el caso de uso específico de la red a proteger. Cada tipo de red, ya sea una sucursal, campus, centro de datos o entorno multinube, tiene necesidades particulares de seguridad. A continuación, se detallan los diferentes escenarios y cómo un firewall adecuado puede proteger cada uno.

### Sucursal:
Los firewalls deben ofrecer una defensa inicial contra accesos no autorizados y ciberamenazas, utilizando IA y aprendizaje automático para detectar amenazas emergentes y garantizando seguridad con SD-WAN para operaciones de red seguras.

### Campus:
En entornos de sede central, los firewalls proporcionan visibilidad y protección a través de una gestión centralizada, defendiendo contra ciberamenazas y asegurando el cumplimiento de las políticas de seguridad.

### Centro de datos:
Los firewalls de hiperescala protegen la infraestructura crítica, controlan el flujo de tráfico y mitigan amenazas en entornos de alta demanda.

### Segmentación de red:
Los firewalls ayudan a segmentar redes grandes y complejas, aislando amenazas y creando zonas seguras, minimizando riesgos y facilitando la contención de brechas de seguridad.

### Entornos multinube:
Los firewalls protegen datos sensibles en nubes públicas y privadas, integrando la protección de forma centralizada y controlando el tráfico de red en diversos entornos de nube.

### Acceso remoto:
Los firewalls en entornos híbridos, a través del concepto de "Firewall como servicio" y SASE, aseguran la protección de datos y aplicaciones para trabajadores remotos mediante administración centralizada y defensa avanzada contra amenazas.

## Invención de los firewalls

La invención de los firewalls es un proceso evolutivo en el que han participado varios creadores desde finales de la década de 1980. Brian Reid, Paul Vixie y Jeff Mogul, mientras trabajaban en Digital Equipment Corp (DEC), desarrollaron tecnología de filtrado de paquetes que sentó las bases de los firewalls modernos. Aunque su creación no era un firewall completo, introdujo el concepto clave de filtrar conexiones externas antes de acceder a redes internas.

### Ejemplo

El Gran Firewall de China, implementado desde el año 2000, restringe el acceso a servicios e información globales para crear una intranet nacional controlada. Este sistema permite la censura, vigilancia y manipulación de Internet a favor del gobierno, limitando la libertad de expresión y favoreciendo a empresas locales. Sin embargo, el uso de VPNs y proxys ha permitido protestas internas contra estas restricciones.

---

# Resumen: Estudio Firewalls

## ¿Qué es un Firewall?

Un firewall es una herramienta de seguridad esencial que protege redes internas al filtrar y controlar el tráfico de datos entre redes confiables y no confiables, como Internet. Funciona mediante reglas predefinidas que evalúan direcciones IP, puertos y protocolos, bloqueando accesos no autorizados y mitigando ciberamenazas como malware, ataques DDoS y accesos no deseados. Existen firewalls físicos (hardware) y virtuales (software). Los modernos, conocidos como NGFW (firewalls de nueva generación), emplean inteligencia artificial para enfrentar amenazas avanzadas.

## ¿Cómo funciona un Firewall?

El firewall analiza el tráfico en tiempo real para decidir si permite o bloquea conexiones según criterios como:

- **Origen**: Dirección desde donde se intenta acceder.
- **Destino**: Lugar al que se dirige la conexión.
- **Contenido**: Información transmitida.
- **Protocolos**: Reglas de comunicación (HTTP, FTP, DNS, etc.).

### Segmenta redes en:

- **Redes públicas**: Acceso global con menor seguridad (Internet).
- **Redes privadas**: Acceso interno con alta protección (intranets).
- **Redes de perímetro**: Capa intermedia que protege servidores externos como correo o FTP.

### Tipos de Firewalls:

#### Filtrado Estático de Paquetes (Capa 3 OSI):
- Inspecciona paquetes individuales según IP, puerto y protocolo, pero no rastrea conexiones previas. Es básico, requiere mantenimiento manual y tiene protección limitada.

#### Puerta de Enlace de Nivel de Circuito (Capa 5 OSI):
- Establece conexiones si los paquetes son funcionales, pero no supervisa una vez abierta la comunicación. Riesgo: permite accesos maliciosos si la conexión ya está activa.

#### Inspección con Estado (Capa 4 y 7 OSI):
- Supervisa conexiones activas y recuerda interacciones previas para aprender y bloquear tráfico sospechoso. Es flexible y ampliamente usado, pero necesita configuración inicial adecuada.

### Firewalls con Estado vs. Sin Estado:

- **Sin Estado**: Analizan tráfico sin contexto ni historial. Son rápidos y económicos, pero inadecuados para amenazas avanzadas.
- **Con Estado**: Supervisan patrones de conexión y analizan contexto, ofreciendo mayor seguridad a cambio de mayor consumo de recursos.

## Tecnologías Relacionadas:

- **NAT (Traducción de Direcciones de Red)**: Oculta redes internas al permitir que varios dispositivos usen una sola dirección IP pública.
- **VPN (Red Privada Virtual)**: Asegura conexiones cifradas para accesos remotos, especialmente útil en entornos híbridos.

## Aplicaciones y Escenarios de Firewalls:

- **Sucursal**: Protección básica contra accesos no autorizados mediante IA y SD-WAN.
- **Campus**: Gestión centralizada para visibilidad y cumplimiento de políticas de seguridad.
- **Centro de Datos**: Firewalls de hiperescala para mitigar amenazas en tráfico crítico.
- **Entornos Multinube**: Protección integrada de datos sensibles en nubes públicas y privadas.
- **Acceso Remoto**: Con SASE y "Firewall como servicio", protege datos y aplicaciones en entornos híbridos.

## Diferencia entre Firewall y Antivirus:

- **Firewall**: Regula el tráfico de red, bloqueando accesos no autorizados.
- **Antivirus**: Protege dispositivos individuales detectando y eliminando malware.

Ambos son complementarios y forman una estrategia de seguridad en capas.

## Evolución de los Firewalls:

Los firewalls comenzaron en los años 80 con el trabajo de Brian Reid, Paul Vixie y Jeff Mogul en DEC, desarrollando tecnologías como el filtrado de paquetes, base de los sistemas actuales. Con el tiempo, han evolucionado hacia soluciones más avanzadas como NGFW, integrando IA y aprendizaje automático.

### Ejemplo: El Gran Firewall de China:

Desde el año 2000, China implementó un sistema nacional de censura que filtra contenido externo e impone restricciones a los usuarios de Internet. Aunque permite vigilancia y control político, su efectividad se ve limitada por el uso de VPNs y proxies para evadirlo.
