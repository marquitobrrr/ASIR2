# INSTRUCCIONES:
- Haz commit en cada clase con el comentario: [clase] 'tarea realizada'
- Lo que trabajes en casa haz commit al terminar con el comentario: [casa] 'tarea realizada'
- Rellena el portfolio Wix con tu feedback del desafío.
  
# 0. Esquema de la Base de Datos Relacional de mandarinas
- Mandarinas:
    - id_mandarina (INTEGER, PK, AUTOINCREMENT): Identificador único para cada mandarina.
    - color (TEXT, NOT NULL): Color de la mandarina.
    - tipo (TEXT, NOT NULL): Tipo de mandarina.
    - size (TEXT, NOT NULL): Tamaño de la mandarina.
    - fecha_recogida (DATE, NOT NULL): Fecha en la que se recogió la mandarina.
      
      ```javascript
      db.mandarinas.insertOne({
        "color": "Naranja",
        "tipo": "Mandarina Clementina",
        "size": "Mediana",
        "fecha_recogida": ISODate("2024-06-01")
      });
      ```
- Melocotones:
    - id_melocoton (INTEGER, PK, AUTOINCREMENT): Identificador único para cada melocotón.
    - tipo (TEXT, NOT NULL): Tipo de melocotón.
    - suavidad (BOOLEAN, NOT NULL): Indica si el melocotón es suave (1) o no (0).

      ```javascript
      db.melocotones.insertOne({
        "tipo": "Melocotón Amarillo",
        "suavidad": true
      });
      
- Caquis:
    - id_caqui (INTEGER, PK, AUTOINCREMENT): Identificador único para cada caqui.
    - id_mandarina (INTEGER, FK, NOT NULL): Relacionado con id_mandarina en la tabla 'mandarinas'.
    - id_melocoton (INTEGER, FK, NOT NULL): Relacionado con `id_melocoton en la tabla 'melocotones'.
    - color (TEXT, NOT NULL): Color del caqui.
    - pedunculo (BOOLEAN, NOT NULL): Indica si el caqui tiene pedúnculo (1) o no (0).
    - tiempo_maduracion (INTEGER, NOT NULL): Tiempo de maduración en días.

      ```javascript
      db.caquis.insertOne({
        "id_mandarina": mandarina._id,
        "id_melocoton": melocoton._id,
        "color": "Rojo",
        "pedunculo": true,
        "tiempo_maduracion": 15
      });
      ```
Basándose en el esquema relacional anterior, se debe diseñar la estructura de los documentos en Mongo DB para cada colección que se considere necesaria para cubrir todos los datos que pueda albergar la bas e de datos.

# 1. Esquema de la Base de Datos Relacional de un comercio
## La base de datos relacional consta de las siguientes tablas:
- 1. Tabla users
    - user_id (PRIMARY KEY)
    - name (TEXT)
    - email (TEXT)

      ```json
       db.users.insertOne({
           "user_id": 1,
           "name": "Alice",
           "email": "alice@example.com"
       });
       ```
      
- 2. Tabla orders`
    - order_id (PRIMARY KEY)
    - user_id (FOREIGN KEY)
    - total (REAL)

      ```json
       db.orders.insertOne({
           "order_id": 1,
           "user_id": 1,
           "total": 50.00
       });
       ```
      
- 3. Tabla products`
    - product_id (PRIMARY KEY)
    - name (TEXT)
    - price (REAL)

      ```json
       db.products.insertOne({
           "product_id": 1,
           "name": "Laptop",
           "price": 1000
       });
       ```
      
- 4. Tabla intermedia order_products`
    - order_id (FOREIGN KEY)
    - product_id (FOREIGN KEY)

     ```json
     db.order_products.insertOne({
         "order_id": 1,
         "product_id": 1
     });
     ```
# Diseño de Documentos en MongoDB
Basándose en el esquema relacional anterior, se debe diseñar la estructura de los documentos en Mongo DB para cada colección que se considere necesaria para cubrir todos los datos que pueda albergar la bas e de datos. Y teniendo en cuenta las relaciones y la optimización de las consultas. Después de diseñar las colecciones, crear los documentos específicos para poder insertar exactamente los datos de los ejemplos anteriores.

## 1.  Inserción de Datos
### A. Utilizando la Terminal de mongo
- Inserta los documentos anteriores en las colecciones correspondientes.
  
  ### **Inserción: users**
```bash
db.users.insertOne({ "user_id": 1, "name": "Alice", "email": "alice@example.com" });
db.users.insertOne({ "user_id": 2, "name": "Bob", "email": "bob@example.com" });
```

### **Inserción: orders**
```bash
db.orders.insertMany([
    { "order_id": 1, "user_id": 1, "total": 50.00 },
    { "order_id": 2, "user_id": 1, "total": 30.00 },
    { "order_id": 3, "user_id": 2, "total": 20.00 }
]);
```

### **Inserción: products**
```bash
db.products.insertMany([
    { "product_id": 1, "name": "Laptop", "price": 1000 },
    { "product_id": 2, "name": "Mouse", "price": 20 },
    { "product_id": 3, "name": "Keyboard", "price": 50 }
]);
```

### **Inserción: order_products**
```bash
db.order_products.insertMany([
    { "order_id": 1, "product_id": 1 },
    { "order_id": 1, "product_id": 2 },
    { "order_id": 2, "product_id": 2 }
]);
```

---

- Realiza las siguientes consultas:
    - Consulta 0: Lista todas la colecciones
      
      ```bash
      show collections
      ```
      
    - Consulta 1: Listar todos los usuarios
 
      ```bash
      db.users.find()
      ```

    - Consulta 2: Buscar pedidos de un usuario cuyo id sea 1
 
      ```bash
      db.orders.find({ "user_id": 1 })
      ```

    - Consulta 3: Listar productos con precio mayor a 30
 
      ```bash
      db.products.find({ "price": { $gt: 30 } })
      ```

    - Consulta 4: Buscar pedidos que contengan un producto con id = 2
 
      ```bash
      db.order_products.find({ "product_id": 2 })
      ```

    - Consulta 5: Obtener usuarios que hayan realizado pedidos con un total mayor a 40

      ```bash
      db.users.aggregate([
      {
          $lookup: {
              from: "orders",
              localField: "user_id",
              foreignField: "user_id",
              as: "orders"
          }
      },
      {
          $unwind: "$orders"
      },
      {
          $match: {
              "orders.total": { $gt: 40 }
          }
      },
      {
          $project: {
              _id: 0,
              user_id: 1,
              name: 1,
              email: 1
          }
      }
      ]);
      ```

    - Consulta 6: Mostrar solo los nombres y correos de los usuarios

      ```bash
      db.users.find({}, { _id: 0, name: 1, email: 1 });
      ```

    - Consulta 7: Contar cuántos productos tienen un precio menor o igual a 50

      ```bash
      db.products.countDocuments({ price: { $lte: 50 } });
      ```

    - Consulta 8: Encontrar usuarios que hayan pedido un producto llamado "Mouse"

      ```bash
      db.users.aggregate([
      {
          $lookup: {
              from: "orders",
              localField: "user_id",
              foreignField: "user_id",
              as: "orders"
          }
      },
      {
          $unwind: "$orders"
      },
      {
          $lookup: {
              from: "order_products",
              localField: "orders.order_id",
              foreignField: "order_id",
              as: "order_products"
          }
      },
      {
          $unwind: "$order_products"
      },
      {
          $lookup: {
              from: "products",
              localField: "order_products.product_id",
              foreignField: "product_id",
              as: "products"
          }
      },
      {
          $unwind: "$products"
      },
      {
          $match: {
              "products.name": "Mouse"
          }
      },
      {
          $project: {
              _id: 0,
              user_id: 1,
              name: 1,
              email: 1
          }
      }
      ]);
      ```

    - Consulta 9: Agrupar los pedidos por usuario y calcular el total gastado por cada uno

      ```bash
        db.orders.aggregate([
      {
          $group: {
              _id: "$user_id",
              total_gastado: { $sum: "$total" }
          }
      },
      {
          $lookup: {
              from: "users",
              localField: "_id",
              foreignField: "user_id",
              as: "user"
          }
      },
      {
          $unwind: "$user"
      },
      {
          $project: {
              _id: 0,
              user_id: "$user.user_id",
              name: "$user.name",
              email: "$user.email",
              total_gastado: 1
          }
      }
      ]);
      ```

    - Consulta 10: Listar productos únicos comprados en todos los pedidos

      ```bash
        db.order_products.aggregate([
      {
          $lookup: {
              from: "products",
              localField: "product_id",
              foreignField: "product_id",
              as: "product"
          }
      },
      {
          $unwind: "$product"
      },
      {
          $group: {
              _id: "$product.product_id",
              name: { $first: "$product.name" }
          }
      },
      {
          $project: {
              _id: 0,
              name: 1
          }
      }
      ]);
      ```
      
    ### Resumen de Consultas en MongoDB

    #### Consulta 0: Lista todas las colecciones
    - Muestra todas las colecciones disponibles en la base de datos actual.
    
    #### Consulta 1: Listar todos los usuarios
    - Devuelve todos los documentos de la colección `users`.
    
    #### Consulta 2: Buscar pedidos de un usuario cuyo `user_id` sea 1
    - Encuentra todos los pedidos asociados al usuario con `user_id = 1` en la colección `orders`.
    
    #### Consulta 3: Listar productos con precio mayor a 30
    - Muestra todos los productos cuyo precio es superior a 30.
    
    #### Consulta 4: Buscar pedidos que contengan un producto con `product_id = 2`
    - Identifica los pedidos que incluyen el producto con `product_id = 2`.
    
    #### Consulta 5: Obtener usuarios que hayan realizado pedidos con un total mayor a 40
    - Filtra usuarios cuyos pedidos tengan un total superior a 40 e incluye su información básica.
    
    #### Consulta 6: Mostrar solo los nombres y correos de los usuarios
    - Extrae únicamente el nombre y correo electrónico de todos los usuarios.
    
    #### Consulta 7: Contar cuántos productos tienen un precio menor o igual a 50
    - Cuenta el número de productos cuyo precio es menor o igual a 50.
    
    #### Consulta 8: Encontrar usuarios que hayan pedido un producto llamado "Mouse"
    - Identifica a los usuarios que hayan comprado un producto con el nombre "Mouse".
    
    #### Consulta 9: Agrupar los pedidos por usuario y calcular el total gastado por cada uno
    - Calcula el gasto total acumulado por cada usuario considerando sus pedidos.
    
    #### Consulta 10: Listar productos únicos comprados en todos los pedidos
    - Genera una lista de productos únicos que hayan sido adquiridos en los pedidos realizados.

### B. Realiza lo mismo desde la interfaz gráfica MongoDB Compass creando una base de datos llamada mi_comercio2

- 1. Reflexión sobre las diferencias entre trabajar con MongoDB desde la terminal y desde Compass, destacando ventajas y desventajas de cada método.
