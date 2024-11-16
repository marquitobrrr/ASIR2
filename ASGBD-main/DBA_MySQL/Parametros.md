1. innodb_buffer_pool_size
Descripción: Define el tamaño de la buffer pool de InnoDB, que es la memoria asignada para almacenar datos e índices de tablas.
Uso: Se utiliza para mejorar el rendimiento de las consultas al mantener los datos más frecuentemente en memoria.

2. innodb_log_file_size
Descripción: Define el tamaño de los archivos de log de transacciones de InnoDB.
Uso: Afecta el rendimiento de transacciones. Un tamaño mayor permite una mejor velocidad de escritura de grandes cantidades de datos.

3. max_connections
Descripción: Establece el número máximo de conexiones simultáneas permitidas al servidor MySQL.
Uso: Controla la cantidad de usuarios o procesos que pueden conectarse a la base de datos al mismo tiempo.

4. query_cache_size
Descripción: Define el tamaño de la caché de consultas.
Uso: Almacena resultados de consultas SELECT para reducir el tiempo de respuesta de consultas repetitivas.

5. table_open_cache
Descripción: Define el número máximo de tablas que pueden mantenerse abiertas simultáneamente en caché.
Uso: Afecta el rendimiento cuando hay muchas tablas accedidas con frecuencia.

6. tmp_table_size
Descripción: Especifica el tamaño máximo permitido para las tablas temporales en memoria.
Uso: Afecta a las operaciones de consultas que requieren tablas temporales (como consultas con GROUP BY o ORDER BY).

7. max_heap_table_size
Descripción: Especifica el tamaño máximo de las tablas HEAP (tablas en memoria).
Uso: Afecta las tablas temporales y HEAP que se crean en memoria.

8. innodb_flush_log_at_trx_commit
Descripción: Controla cómo y cuándo se escriben los logs de transacciones de InnoDB en disco.
Uso:
Valor 0: El log se vacía a disco cada segundo.
Valor 1: El log se vacía a disco en cada commit de transacción (opción más segura).
Valor 2: El log se vacía al sistema operativo en cada commit, pero se guarda a disco cada segundo.

9. log_bin
Descripción: Activa el log binario, que almacena todas las modificaciones a las bases de datos.
Uso: Es necesario para replicación y recuperación de datos.

10. slow_query_log
Descripción: Activa el registro de consultas lentas (slow queries).
Uso: Sirve para identificar consultas que tardan más de lo esperado en ejecutarse, lo cual es útil para la optimización del rendimiento.

11. slow_query_log_file
Descripción: Especifica el archivo donde se guardarán las consultas lentas.
Uso: Indica la ubicación del archivo de log de consultas lentas.

12. long_query_time
Descripción: Establece el umbral de tiempo en segundos que debe superar una consulta para ser considerada "lenta".
Uso: Si una consulta tarda más que este tiempo, se registra en el slow_query_log.

13. bind_address
Descripción: Especifica la dirección IP en la que el servidor MySQL escucha las conexiones.
Uso: Se puede configurar para permitir conexiones locales (127.0.0.1) o conexiones remotas (IP específica).

14. innodb_file_per_table
Descripción: Si está habilitado, InnoDB crea un archivo separado por cada tabla en lugar de usar el archivo compartido ibdata1.
Uso: Permite mayor flexibilidad en la gestión del espacio en disco, ya que cada tabla tiene su propio archivo .ibd.

15. performance_schema
Descripción: Activa el esquema de rendimiento en MySQL.
Uso: Proporciona información detallada sobre la actividad interna de MySQL para el monitoreo y ajuste del rendimiento.
