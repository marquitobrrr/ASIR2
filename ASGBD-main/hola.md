# Inserción de Datos en MongoDB

Este documento explica cómo insertar datos en MongoDB utilizando las colecciones **mandarinas**, **melocotones** y **caquis**.

## **1. Colección: Mandarinas**
La colección `mandarinas` almacena la información sobre mandarinas con los siguientes campos:
- **color**: El color de la mandarina.
- **tipo**: El tipo de mandarina.
- **size**: Tamaño de la mandarina.
- **fecha_recogida**: La fecha en que se recogió.

### **Inserción de un Documento**
```javascript
db.mandarinas.insertOne({
  "color": "Naranja",
  "tipo": "Mandarina Clementina",
  "size": "Mediana",
  "fecha_recogida": ISODate("2024-06-01")
});
```

![image](https://github.com/user-attachments/assets/79a6e6f4-bf67-4d86-8657-4db733081f62)

### **Comprobación**
Para comprobar los documentos insertados:
```javascript
db.mandarinas.find().pretty();
```
![image](https://github.com/user-attachments/assets/975c5172-f6ac-43c5-8c94-7ca05b64f7a1)

---

## **2. Colección: Melocotones**
La colección `melocotones` almacena la información sobre melocotones con los siguientes campos:
- **tipo**: El tipo de melocotón.
- **suavidad**: Booleano que indica si el melocotón es suave (true) o no (false).

### **Inserción de un Documento**
```javascript
db.melocotones.insertOne({
  "tipo": "Melocotón Amarillo",
  "suavidad": true
});
```

![image](https://github.com/user-attachments/assets/1357cb49-e693-48dc-83f5-1b540dae103e)

### **Comprobación**
Para comprobar los documentos insertados:
```javascript
db.melocotones.find().pretty();
```
![image](https://github.com/user-attachments/assets/1d639aba-52c5-439e-895b-159290b2ce95)

---

## **3. Colección: Caquis**
La colección `caquis` almacena información sobre caquis con referencias a las colecciones **mandarinas** y **melocotones**:
- **id_mandarina**: ID que referencia una mandarina.
- **id_melocoton**: ID que referencia un melocotón.
- **color**: El color del caqui.
- **pedunculo**: Booleano que indica si tiene pedúnculo (true) o no (false).
- **tiempo_maduracion**: El tiempo de maduración en días.

### **Inserción de un Documento**
Para insertar un caqui, primero necesitamos obtener los IDs de una mandarina y un melocotón ya existentes.

#### **1. Obtener IDs de `mandarinas` y `melocotones`**
```javascript
var mandarina = db.mandarinas.findOne();
var melocoton = db.melocotones.findOne();
```

#### **2. Insertar un Caqui**
```javascript
db.caquis.insertOne({
  "id_mandarina": mandarina._id,
  "id_melocoton": melocoton._id,
  "color": "Rojo",
  "pedunculo": true,
  "tiempo_maduracion": 15
});
```

![image](https://github.com/user-attachments/assets/d27e2a22-4a2d-4d0f-a660-1325d495f59f)

### **Comprobación**
Para comprobar los documentos insertados:
```javascript
db.caquis.find().pretty();
```
![image](https://github.com/user-attachments/assets/f64dcd7c-4129-4174-b0f7-b39600d29732)

---

## **Resumen Final**
Este documento muestra cómo insertar documentos en las siguientes colecciones:
- `mandarinas`
- `melocotones`
- `caquis` (con referencias a las otras colecciones).

Usa los comandos de verificación (`find()`) para asegurarte de que los datos se insertaron correctamente.

---

**Notas**:
- MongoDB genera automáticamente el campo `_id` como identificador único.
- `ISODate()` se utiliza para fechas en formato adecuado.
- Las referencias a otras colecciones se manejan utilizando los IDs (`_id`) de documentos existentes.

---

### **Paso 1: Preparación Inicial en MongoDB**

1. **Instala MongoDB y MongoDB Compass**:  
   - Descarga MongoDB desde [mongodb.com](https://www.mongodb.com/try/download/community) e instálalo.  
   - Instala MongoDB Compass, la herramienta gráfica para trabajar con bases de datos Mongo.

2. **Abre la Terminal MongoDB**:
   - Ejecuta MongoDB con el siguiente comando:
     ```bash
     mongod
     ```
   - Accede a MongoShell con:
     ```bash
     mongo
     ```

3. **Crea la Base de Datos Principal**:
   ```bash
   use mi_comercio
   ```

---

## **1. Diseño del Modelo en MongoDB**

### **Esquema en Documentos de MongoDB**
A partir del modelo relacional propuesto:

1. **Colección de Usuarios (`users`)**  
   Documento de ejemplo:
   ```json
   db.users.insertOne({
       "user_id": 1,
       "name": "Alice",
       "email": "alice@example.com"
   });
   ```

![image](https://github.com/user-attachments/assets/60e703aa-bb58-43d4-82a2-7697e4e56e08)

2. **Colección de Pedidos (`orders`)**  
   ```json
   db.orders.insertOne({
       "order_id": 1,
       "user_id": 1,
       "total": 50.00
   });
   ```

![image](https://github.com/user-attachments/assets/9ab46c11-db65-4de6-b0fa-2833c8c1b6cb)

3. **Colección de Productos (`products`)**  
   ```json
   db.products.insertOne({
       "product_id": 1,
       "name": "Laptop",
       "price": 1000
   });
   ```

![image](https://github.com/user-attachments/assets/3d650ae0-44ce-4a0b-932c-68031ec2dc75)

4. **Colección `order_products`** (relación N:M):  
   ```json
   db.order_products.insertOne({
       "order_id": 1,
       "product_id": 1
   });
   ```

![image](https://github.com/user-attachments/assets/ce3ac0e6-78f8-4fe6-aaeb-9c71a97ccc75)

---

## **2. Inserción de Datos en MongoDB**

Inserta documentos en MongoShell usando el comando `insertOne()`.

### **Colección: users**
```bash
db.users.insertOne({ "user_id": 1, "name": "Alice", "email": "alice@example.com" });
db.users.insertOne({ "user_id": 2, "name": "Bob", "email": "bob@example.com" });
```

![image](https://github.com/user-attachments/assets/6c9922ff-c283-45bc-8176-fcb1b604c332)

### **Colección: orders**
```bash
db.orders.insertMany([
    { "order_id": 1, "user_id": 1, "total": 50.00 },
    { "order_id": 2, "user_id": 1, "total": 30.00 },
    { "order_id": 3, "user_id": 2, "total": 20.00 }
]);
```

![image](https://github.com/user-attachments/assets/8cf496b7-ab1b-4a34-81ec-4066bf758d8a)

### **Colección: products**
```bash
db.products.insertMany([
    { "product_id": 1, "name": "Laptop", "price": 1000 },
    { "product_id": 2, "name": "Mouse", "price": 20 },
    { "product_id": 3, "name": "Keyboard", "price": 50 }
]);
```

![image](https://github.com/user-attachments/assets/fa54d318-1c09-402a-ad0d-b15f3cb89caf)

### **Colección: order_products**
```bash
db.order_products.insertMany([
    { "order_id": 1, "product_id": 1 },
    { "order_id": 1, "product_id": 2 },
    { "order_id": 2, "product_id": 2 }
]);
```

![image](https://github.com/user-attachments/assets/de30fba8-1e25-4a69-96a7-68174fba6bf9)

---

## **3. Ejecución de Consultas en MongoDB**

Aquí tienes un listado de **consultas clave**. Ejecuta cada una y observa los resultados:

### **Consulta 1: Listar todas las colecciones**
```bash
show collections
```

![image](https://github.com/user-attachments/assets/e37944ab-1bd0-4478-9c29-8d15f12da0f9)

### **Consulta 2: Mostrar todos los usuarios**
```bash
db.users.find()
```

![image](https://github.com/user-attachments/assets/0bac4116-5e66-4d77-a072-46d45c64aa5e)

### **Consulta 3: Pedidos de un usuario específico (user_id = 1)**
```bash
db.orders.find({ "user_id": 1 })
```

![image](https://github.com/user-attachments/assets/e7dd611a-46aa-4d35-853e-898c6ef9d1b4)

### **Consulta 4: Listar productos con precio mayor a 30**
```bash
db.products.find({ "price": { $gt: 30 } })
```

![image](https://github.com/user-attachments/assets/894442a7-4dbc-4a8b-b8e5-f2e068fc0bd2)

### **Consulta 5: Buscar pedidos que contengan un producto específico**
Supongamos que el **product_id = 2** (Mouse):
```bash
db.order_products.find({ "product_id": 2 })
```

![image](https://github.com/user-attachments/assets/a7ee50af-3069-4d0c-b121-a8f68c12797c)

### **Consulta 6: Mostrar pedidos y sumar su total agrupado por usuario**
```bash
db.orders.aggregate([
    { $group: { _id: "$user_id", totalPedidos: { $sum: "$total" } } }
])
```

![image](https://github.com/user-attachments/assets/cde08f43-aa55-4dd6-b7b5-3962fbf13fbd)

### **Consulta 7: Encontrar usuarios con un pedido del producto "Mouse"**
Usamos la relación entre `orders`, `order_products` y `products`:
```bash
db.order_products.aggregate([
    { $lookup: { from: "products", localField: "product_id", foreignField: "product_id", as: "product" }},
    { $match: { "product.name": "Mouse" }},
    { $lookup: { from: "orders", localField: "order_id", foreignField: "order_id", as: "order" }},
    { $project: { order_id: 1, "order.user_id": 1, "product.name": 1 }}
])
```

![image](https://github.com/user-attachments/assets/4cea8a0a-6629-48f9-b5ee-d81485369ce9)

---

## **4. Comparativa de la Terminal y MongoDB Compass**

1. **MongoShell**:
   - ✅ Más rápido y ligero.
   - ✅ Permite ejecutar consultas avanzadas.
   - ❌ Requiere conocimiento de sintaxis.

2. **MongoDB Compass**:
   - ✅ Interfaz visual e intuitiva.
   - ✅ Facilidad para realizar agregaciones y consultar datos.
   - ❌ Menos eficiente para operaciones complejas.
