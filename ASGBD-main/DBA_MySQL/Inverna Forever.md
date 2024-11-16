# Inverna Forever 

| Parametro | Valor | Porqué |
|--------------|--------------|--------------|
| innodb_buffer_pool_size | 24G | Permite almacenar en memoria los datos e índices más utilizados, optimizando el rendimiento en lecturas y reduciendo el acceso al disco. |
| innodb_log_file_size | 1G | Aumenta el tamaño de los logs de transacciones, mejorando la eficiencia en escrituras y reduciendo la frecuencia de vaciado de logs. |
| query_cache_size | 256M| Permite almacenar resultados de consultas, mejorando el rendimiento de lecturas repetitivas, ideal para un entorno donde las lecturas son frecuentes. |
| table_open_cache | 2000 | Incrementa el número de tablas que se pueden mantener abiertas, mejorando la eficiencia en el manejo de consultas. |
| max_connections | 1000 | Soporta un alto número de conexiones simultáneas, necesario para gestionar la gran concurrencia de usuarios en la red social. |
| tmp_table_size | 256M | Permite manejar tablas temporales más grandes, lo cual es útil en operaciones que involucran agregaciones. |
| innodb_flush_log_at_trx_commit | 1 | Garantiza la durabilidad de las transacciones, asegurando la consistencia de los datos sin comprometer el rendimiento excesivamente. |
| slow_query_log | ON | Habilita el registro de consultas lentas para facilitar su análisis y optimización, crucial en entornos de alta carga para mantener el rendimiento. |
