# Boquerón caliente


| Parametro | Valor | Porqué |
|--------------|--------------|--------------|
|innodb_buffer_pool_size | 24G | Permite almacenar en memoria datos e índices más utilizados, mejorando el rendimiento de lecturas y escrituras en bases de datos grandes.|
|innodb_log_file_size | 1G |Incrementa el tamaño de los logs de transacciones, mejorando la escritura eficiente y reduciendo la necesidad de vaciar logs constantemente.|
|max_connections | 1000|Soporta hasta 1000 conexiones simultáneas, lo cual es necesario para gestionar miles de usuarios concurrentes.|
|table_open_cache | 20000|Aumenta el número de tablas abiertas en caché, mejorando el rendimiento al evitar la apertura y cierre repetido de tablas.|
|tmp_table_size | 1G |Evita que las tablas temporales se escriban a disco, manteniéndolas en memoria para consultas que usan operaciones como GROUP BY o ORDER BY.|
|max_heap_table_size | 1G | Permite mantener tablas temporales más grandes en memoria, mejorando el rendimiento de consultas intensivas en uso de memoria.|
|log_bin | ON | Activa el log binario, necesario para la replicación y recuperación en caso de fallos, además de auditar cambios críticos.|
|innodb_file_per_table | ON | Almacena cada tabla en un archivo separado, lo que facilita la gestión del espacio en disco y mejora el rendimiento en operaciones intensivas.|

