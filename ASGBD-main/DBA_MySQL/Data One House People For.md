# Data One House People For


| Parametro | Valor | Porqué |
|--------------|--------------|--------------|
| innodb_buffer_pool_size | 16G | Permite almacenar en memoria los datos e índices más utilizados, mejorando el rendimiento en lecturas pesadas y reduciendo la necesidad de acceder al disco. |
| innodb_log_file_size | 1G | Incrementa el tamaño de los logs de transacciones, mejorando la escritura eficiente y reduciendo la necesidad de vaciar logs constantemente. |
| query_cache_size | 128M| Permite almacenar resultados de consultas complejas, mejorando el rendimiento de consultas repetitivas sin sobrecargar el sistema. |
| table_open_cache | 20000|Aumenta el número de tablas abiertas en caché, mejorando el rendimiento al evitar la apertura y cierre repetido de tablas. |
| slow_query_log | ON | Permite registrar consultas lentas para su análisis y optimización, crucial para identificar y mejorar el rendimiento de consultas complejas. |
| max_heap_table_size | 1G | Permite mantener tablas temporales más grandes en memoria, mejorando el rendimiento de consultas intensivas en uso de memoria. |
| innodb_flush_log_at_trx_commit | 1 | Ofrece un balance entre seguridad y rendimiento, garantizando la durabilidad de las transacciones sin una sobrecarga excesiva. |
