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
... (208 líneas restantes)
