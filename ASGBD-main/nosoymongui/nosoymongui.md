
# Docker-Mongo:
![cap1](https://github.com/user-attachments/assets/84ce1c59-4168-401c-90f6-3b6e6ef472cc)
![cap2](https://github.com/user-attachments/assets/3faf6ddc-c7fe-486f-b443-b71397ae9212)

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
![cap3](https://github.com/user-attachments/assets/dabe332b-91e1-49cf-8904-831cbf74f152)

- Melocotones:
    - id_melocoton (INTEGER, PK, AUTOINCREMENT): Identificador único para cada melocotón.
    - tipo (TEXT, NOT NULL): Tipo de melocotón.
    - suavidad (BOOLEAN, NOT NULL): Indica si el melocotón es suave (1) o no (0).

      ```javascript
      db.melocotones.insertOne({
        "tipo": "Melocotón Amarillo",
        "suavidad": true
      });
![cap4](https://github.com/user-attachments/assets/5a413f1f-75e8-4bdb-80b9-e9d370cf3c14)

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
![cap5](https://github.com/user-attachments/assets/eac6759e-1d2a-445b-b28d-b002ba6f6b36)


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
![cap6](https://github.com/user-attachments/assets/705bede8-51c6-4668-b996-9a1e167f5a69)

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
    ![cap7](https://github.com/user-attachments/assets/3d0d2ce3-865b-4b60-9cc9-e948da5ba9de)
  
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
      ![cap8](https://github.com/user-attachments/assets/ff51773a-ca40-4d5c-81a0-75cea535f1bd)

- 4. Tabla intermedia order_products`
    - order_id (FOREIGN KEY)
    - product_id (FOREIGN KEY)

     ```json
     db.order_products.insertOne({
         "order_id": 1,
         "product_id": 1
     });
     ```
     ![cap9](https://github.com/user-attachments/assets/eca11a04-e6bb-48a0-9d72-9b07daba196f)

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
![cap10](https://github.com/user-attachments/assets/67a09c86-0558-4d46-aa1e-ea02b15099cb)

### **Inserción: orders**
```bash
db.orders.insertMany([
    { "order_id": 1, "user_id": 1, "total": 50.00 },
    { "order_id": 2, "user_id": 1, "total": 30.00 },
    { "order_id": 3, "user_id": 2, "total": 20.00 }
]);
```
![cap11](https://github.com/user-attachments/assets/c4f350e7-9620-4404-a1d6-66333e455819)

### **Inserción: products**
```bash
db.products.insertMany([
    { "product_id": 1, "name": "Laptop", "price": 1000 },
    { "product_id": 2, "name": "Mouse", "price": 20 },
    { "product_id": 3, "name": "Keyboard", "price": 50 }
]);
```
![cap12](https://github.com/user-attachments/assets/6dfd9532-2ae5-4915-8999-a0f172082557)

### **Inserción: order_products**
```bash
db.order_products.insertMany([
    { "order_id": 1, "product_id": 1 },
    { "order_id": 1, "product_id": 2 },
    { "order_id": 2, "product_id": 2 }
]);
```
![cap13](https://github.com/user-attachments/assets/187d596d-46f1-40b0-867f-1172b89c152b)

---

- Realiza las siguientes consultas:
    - Consulta 0: Lista todas la colecciones
      
      ```bash
      show collections
      ```
      ![cap14](https://github.com/user-attachments/assets/d60a4a84-96c4-43c4-91a3-68948deb5d0e)

    - Consulta 1: Listar todos los usuarios
 
      ```bash
      db.users.find()
      ```
![cap15](https://github.com/user-attachments/assets/edae172c-4961-4cea-ba34-52f6ac7ebf6a)

    - Consulta 2: Buscar pedidos de un usuario cuyo id sea 1
 
      ```bash
      db.orders.find({ "user_id": 1 })
      ```
![cap16](https://github.com/user-attachments/assets/51d8e0ba-5d9e-4a78-931e-7bc7686c07e9)

    - Consulta 3: Listar productos con precio mayor a 30
 
      ```bash
      db.products.find({ "price": { $gt: 30 } })
      ```
![cap17](https://github.com/user-attachments/assets/5e2c86d6-acf1-4828-8387-551e61a0c702)

    - Consulta 4: Buscar pedidos que contengan un producto con id = 2
 
      ```bash
      db.order_products.find({ "product_id": 2 })
      ```
![cap18](https://github.com/user-attachments/assets/d68fe1f0-e4c7-4af1-9c1a-706a773de5fc)

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
![cap19](https://github.com/user-attachments/assets/d8dc86d6-7655-4c1c-a1db-b3395e03072b)

    - Consulta 6: Mostrar solo los nombres y correos de los usuarios

      ```bash
      db.users.find({}, { _id: 0, name: 1, email: 1 });
      ```
![cap20](https://github.com/user-attachments/assets/63ca659e-be54-42d4-b1ff-c652f7cd9661)

    - Consulta 7: Contar cuántos productos tienen un precio menor o igual a 50

      ```bash
      db.products.countDocuments({ price: { $lte: 50 } });
      ```
![cap21](https://github.com/user-attachments/assets/92d3d1c4-726e-4ec3-aeb3-88916f90cce9)

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
![cap22](https://github.com/user-attachments/assets/274a1bd7-bdf2-480e-bbe7-cebf3a4b3888)

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
      ![cap23](https://github.com/user-attachments/assets/3ea9bb92-57f0-4b96-a22f-a98b85283339)

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
