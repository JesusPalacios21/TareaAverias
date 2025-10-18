# ⚙️ Sistema de Gestión de Averías en Tiempo Real

Proyecto desarrollado con **CodeIgniter 4**, **Ratchet WebSocket** y **MySQL** que permite registrar, visualizar y actualizar averías de manera **dinámica y en tiempo real**.

Los clientes pueden registrar averías, y los técnicos reciben notificaciones instantáneas mediante WebSockets cuando se crea o se soluciona una avería.

---

## 🧩 Características principales

- Registro de averías con cliente, descripción y fecha/hora.
- Listado de averías pendientes tanto para **clientes** como **técnicos**.
- Actualización en tiempo real sin recargar la página (gracias a **Ratchet WebSocket**).
- Opción para que los técnicos marquen averías como **solucionadas**.
- Arquitectura limpia usando **MVC (CodeIgniter 4)**.
- Migraciones y seeds para creación automática de la base de datos.

---

## 🛠️ Tecnologías utilizadas

- PHP 8+
- [CodeIgniter 4](https://codeigniter.com/)
- [Ratchet WebSocket](http://socketo.me/)
- MySQL
- Composer
- HTML, CSS (Bootstrap opcional)

---

## ⚙️ Requisitos previos

Antes de comenzar, asegúrate de tener instalado:

- PHP 8 o superior  
- Composer  
- MySQL  
- XAMPP, Laragon o entorno similar  

---

## 💾 Configuración de la base de datos

Ejecuta los siguientes comandos en tu cliente MySQL o phpMyAdmin:

```sql
CREATE DATABASE wowdb;
USE wowdb;

SELECT * FROM averias;
```

Luego no te olvides de configurar tus credenciales en el archivo env

## Instalación del proyecto

Sigue los pasos en orden:

### 1️⃣ Clonar el repositorio
```
git clone https://github.com/tuusuario/tu-repo.git
cd tu-repo
```

### 2️⃣ Instalar dependencias
```
composer install
```

### 3️⃣ Ejecutar migraciones

Esto creará la tabla averias automáticamente.
```
php spark migrate
```

### 4️⃣ Cargar datos de ejemplo (seeds)

Esto insertará registros de prueba.
```
php spark db:seed AveriasSeeder
```

## ⚡ Ejecución del sistema
### 1️⃣ Iniciar el servidor WebSocket

Esto habilita las notificaciones en tiempo real.
```
php socket-server.php
```

Verás un mensaje como:
```
Servidor WebSocket iniciado en puerto 8080
```

💻 Uso del sistema

Registrar una avería:
```
👉 http://averias/registrar
```

Ver listado (clientes):
```
👉 http://averias/listar/clientes
```

Ver listado (técnicos):
```
👉 http://averias/listar/tecnicos
```
Cuando un cliente registra una nueva avería, todos los técnicos conectados verán la actualización al instante sin recargar la página.

Si un técnico marca una avería como solucionada, desaparece automáticamente del listado de clientes.

## 🧩 Roles del sistema
### Rol	Descripción
Cliente	Registra nuevas averías y visualiza las pendientes.
Técnico	Visualiza averías en tiempo real y las marca como solucionadas.
### 📸 Vistas principales
Registrar Avería: formulario simple con campos de cliente, problema y fecha/hora.

Listado de Averías: tabla con actualización en tiempo real vía WebSocket.

### No te olvides probar el proyecto en diferentes navegadores para ver el punto del trabajo...