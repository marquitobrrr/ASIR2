# Creación de Tablas y Estructura

## Estructura de Tablas

### Mandarinas
- **id_mandarina** (INTEGER, PK, AUTOINCREMENT): Identificador único para cada mandarina.
- **color** (TEXT, NOT NULL): Color de la mandarina.
- **nombre** (TEXT, NOT NULL): Nombre de la mandarina.
- **fecha_recoleccion** (DATE, NOT NULL): Fecha en la que se recogió la mandarina.

### Melocotones
- **id_melocoton** (INTEGER, PK, AUTOINCREMENT): Identificador único para cada melocotón.
- **tipo** (TEXT, NOT NULL): Tipo de melocotón.
- **suave** (BOOLEAN, NOT NULL): Indica si el melocotón es suave (1) o no (0).

### Caquis
- **id_caqui** (INTEGER, PK, AUTOINCREMENT): Identificador único para cada caqui.
- **id_mandarina** (INTEGER, FK, NOT NULL): Relacionado con id_mandarina en la tabla mandarinas.
- **id_melocoton** (INTEGER, FK, NOT NULL): Relacionado con id_melocoton en la tabla melocotones.
- **color** (TEXT, NOT NULL): Color del caqui.
- **pedunculo** (BOOLEAN, NOT NULL): Indica si el caqui tiene pedúnculo (1) o no (0).
- **tiempo_maduracion** (INTEGER, NOT NULL): Tiempo de maduración en días.


---

## Código SQL para Crear las Tablas

```sql
CREATE TABLE Mandarinas (
    id_mandarina INTEGER PRIMARY KEY AUTOINCREMENT,
    color TEXT,
    tipo TEXT NOT NULL,
    size TEXT NOT NULL,
    fecha_recogida DATE NOT NULL
);

CREATE TABLE Melocotones (
    id_melocoton INTEGER PRIMARY KEY AUTOINCREMENT,
    tipo TEXT NOT NULL,
    suavidad BOOLEAN NOT NULL
);

CREATE TABLE Caquis (
    id_caqui INTEGER PRIMARY KEY AUTOINCREMENT,
    id_mandarina INTEGER NOT NULL,
    id_melocoton INTEGER NOT NULL,
    color TEXT NOT NULL,
    pedunculo BOOLEAN NOT NULL,
    tiempo_maduracion INTEGER NOT NULL,
    FOREIGN KEY (id_mandarina) REFERENCES Mandarinas(id_mandarina),
    FOREIGN KEY (id_melocoton) REFERENCES Melocotones(id_melocoton)
);
```

---

## Explicación de las Tablas

- **Tabla Mandarinas**:
  - `id_mandarina` es una clave primaria que se incrementa automáticamente.
  - `color` es opcional, mientras que `tipo`, `size` y `fecha_recogida` son campos obligatorios.

- **Tabla Melocotones**:
  - `id_melocoton` es una clave primaria que se incrementa automáticamente.
  - `tipo` es obligatorio y `suavidad` es un valor booleano para indicar suavidad.

- **Tabla Caquis**:
  - `id_caqui` es una clave primaria que se incrementa automáticamente.
  - `id_mandarina` y `id_melocoton` son claves externas que enlazan a `Mandarinas` y `Melocotones`, respectivamente.
  - `color`, `pedunculo`, y `tiempo_maduracion` son campos obligatorios.

---

## Tamaño y Crecimiento de la Base de Datos

El tamaño de una base de datos SQLite aumenta al:

- **Insertar datos**: Crece casi de inmediato.
- **Actualizar datos**: Crece solo si los datos nuevos ocupan más espacio.
- **Eliminar datos**: No reduce el tamaño del archivo; solo marca el espacio como reutilizable.

### Optimización del Tamaño
Realizar vistas e índices para evitar crecimiento innecesario y compactar la base de datos periódicamente para reducir el tamaño y mejorar el rendimiento.

---

## Optimización del Rendimiento y Mantenimiento

Se han encontrado varias consultas repetitivas en la tabla Mandarinas sin filtros específicos y consultas sobre `fecha_recogida` en rangos de fechas. Para optimizar esto, se sugieren los siguientes índices:

### Índices

```sql
CREATE INDEX idx_caquis_id_mandarina ON Caquis(id_mandarina);
CREATE INDEX idx_caquis_id_melocoton ON Caquis(id_melocoton);
CREATE INDEX idx_mandarinas_color ON Mandarinas(color);
CREATE INDEX idx_caquis_color ON Caquis(color);
CREATE INDEX idx_fecha_recogida ON Mandarinas(fecha_recogida);
CREATE INDEX idx_color_tamaño ON Mandarinas(color, tamaño);
CREATE INDEX idx_pedunculo_caquis ON Caquis(pedunculo);
```

### Vistas

```sql
CREATE VIEW vista_caquis_completo AS
SELECT
    Caquis.id_caqui,
    Mandarinas.color AS color_mandarina,
    Mandarinas.tipo AS tipo_mandarina,
    Mandarinas.size AS size_mandarina,
    Mandarinas.fecha_recogida,
    Melocotones.tipo AS tipo_melocoton,
    Melocotones.suavidad,
    Caquis.color AS color_caqui,
    Caquis.pedunculo,
    Caquis.tiempo_maduracion
FROM Caquis
JOIN Mandarinas ON Caquis.id_mandarina = Mandarinas.id_mandarina
JOIN Melocotones ON Caquis.id_melocoton = Melocotones.id_melocoton;

CREATE VIEW vista_mandarinas_tipo_color AS
SELECT
    tipo,
    color,
    COUNT(id_mandarina) AS total_mandarinas,
    MIN(fecha_recogida) AS fecha_primera_recoleccion,
    MAX(fecha_recogida) AS fecha_ultima_recoleccion
FROM Mandarinas
GROUP BY tipo, color;

CREATE VIEW vista_mandarinas_simple AS
SELECT color, tamaño, fecha_recogida
FROM Mandarinas;
```

---

## Copias de Seguridad y Restauración

### Realización de una copia de seguridad

```bash
.backup 'frutitas_bonitas_bonitas.db'
```

### Restauración desde la copia de seguridad

```bash
.restore 'frutitas_bonitas_bonitas.db'
```

---

## Automatización de Backups

Script para realizar un backup automático diariamente a las 23:59:59:

```bash
#!/bin/bash

# Configuración
DB_NAME="frutitas.db"                
BACKUP_NAME="frutitas_bonitas_bonitas.db"

if [ ! -f "$DB_NAME" ]; then
    echo "La base de datos $DB_NAME no existe."
    exit 1
fi

cp "$DB_NAME" "$BACKUP_NAME"
echo "Backup realizado: $BACKUP_NAME"
```

Crontab para ejecutar el script automáticamente:

```bash
59 23 * * * /bin/bash /home/alumno/scripts/backup_frutitas.sh
```

---

## PRAGMAs y Rendimiento

- **PRAGMA synchronous**: Ajusta la velocidad de escritura y durabilidad.
- **PRAGMA cache_size**: Afecta la rapidez de acceso a datos.
- **PRAGMA journal_mode**: Influye en la velocidad y el tamaño del archivo de base.

### Seguridad
- **PRAGMA secure_delete**: Asegura que los datos eliminados no sean recuperables.
- **PRAGMA cipher** (con extensiones): Permite cifrado, protegiendo datos en reposo.

---

## Mecanismos de Protección en Entornos de Producción

Para proteger SQLite en producción, usaría:

- **Cifrado**: Utilizar SQLCipher u otras extensiones para cifrar la base de datos.
- **Acceso controlado**: Limitar el acceso al archivo a usuarios específicos y restringir permisos.
- **Backups seguros**: Automatizar y almacenar los backups de forma cifrada.
- **Validación de datos**: Implementar sanitización de entradas para prevenir inyecciones SQL.

---

## Modos de Journaling en SQLite

- **DELETE**: Crea y elimina un archivo de journal por transacción; seguro pero lento.
- **TRUNCATE**: Trunca el journal en lugar de eliminarlo; un poco más rápido.
- **WAL**: Escribe en un archivo separado, permitiendo lecturas concurrentes; ideal para entornos de muchas lecturas y escrituras.
