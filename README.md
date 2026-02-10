# 🚀 IA Decorate - Backend Laravel

Backend API RESTful para la plataforma IA Decorate desarrollado con Laravel 10 y autenticación JWT.

## 📋 Características

- ✅ Autenticación JWT (JSON Web Tokens)
- ✅ Gestión de usuarios con roles (Admin/User)
- ✅ CRUD completo de productos
- ✅ Sistema de carrito de compras
- ✅ Gestión de pedidos
- ✅ Sistema de incidencias/tickets
- ✅ Mensajería entre usuarios
- ✅ Validación de datos
- ✅ Manejo de errores
- ✅ CORS configurado
- ✅ Seeders con datos de ejemplo

## 🛠️ Tecnologías

- **Laravel 10**
- **PHP 8.1+**
- **XAMPP**
- **JWT Auth (tymon/jwt-auth)**
- **Composer**

## 📦 Instalación Paso a Paso

### 1. Requisitos Previos

```bash
# Verificar versiones
php -v        # Debe ser 8.1 o superior
composer -v   # Composer instalado
npm -v #npm instalado para el vite
```

### 2. Clonar o Crear Proyecto

Si tienes el código:
```bash
cd ia-decorate-laravel
```

Si empiezas desde cero:
```bash
composer create-project laravel/laravel ia-decorate-laravel
cd ia-decorate-laravel
```

### 3. Instalar Dependencias

```bash
composer install
```

### 4. Instalar JWT Auth

```bash
composer require tymon/jwt-auth
```

### 5. Configurar Entorno

```bash
# Copiar archivo de entorno
cp .env.example .env

# Generar key de aplicación
php artisan key:generate

# Publicar configuración JWT
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

# Generar JWT secret
php artisan jwt:secret
```

### 6. Configurar Base de Datos

Editar `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ia_decorate
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

Crear base de datos:

```bash
# Entrar a MySQL
mysql -u root -p

# Crear BD
CREATE DATABASE ia_decorate CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

### 7. Copiar Archivos del Proyecto

Copiar los archivos proporcionados en sus ubicaciones correspondientes:

- `app/Models/` → Modelos
- `app/Http/Controllers/Api/` → Controladores
- `app/Http/Middleware/` → Middlewares
- `database/migrations/` → Migraciones
- `database/seeders/` → Seeders
- `routes/api.php` → Rutas
- `config/auth.php` → Configuración de autenticación

### 8. Registrar Middleware

Editar `bootstrap/app.php` y añadir:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})
```

O editar `app/Http/Kernel.php`:

```php
protected $middlewareAliases = [
    // ... otros middlewares
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
];
```

### 9. Ejecutar Migraciones y Seeders

```bash
# Ejecutar migraciones
php artisan migrate

# O resetear y ejecutar con seeders
php artisan migrate:fresh --seed
```

### 10. Iniciar Servidor

```bash
php artisan serve
```

La API estará disponible en: **http://localhost:8000**

## 🔑 Credenciales por Defecto

Después de ejecutar los seeders:

**Administrador:**
- Email: `admin@iadecorate.com`
- Password: `admin123`

**Usuario Normal:**
- Email: `user@iadecorate.com`
- Password: `user123`

## 📡 Endpoints de la API

### Autenticación

#### Registro
```http
POST /api/auth/register
Content-Type: application/json

{
  "nombre": "Juan",
  "apellidos": "Pérez",
  "email": "juan@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

#### Login
```http
POST /api/auth/login
Content-Type: application/json

{
  "email": "admin@iadecorate.com",
  "password": "admin123"
}
```

**Respuesta:**
```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "type": "Bearer",
  "user": {
    "id": 1,
    "nombre": "Admin",
    "apellidos": "IA Decorate",
    "email": "admin@iadecorate.com",
    "nombre_usuario": "admin",
    "roles": ["admin", "user"]
  }
}
```

#### Obtener Usuario Autenticado
```http
GET /api/auth/me
Authorization: Bearer {token}
```

#### Logout
```http
POST /api/auth/logout
Authorization: Bearer {token}
```

### Productos

#### Listar Productos
```http
GET /api/productos
```

**Parámetros opcionales:**
- `categoria` - Filtrar por categoría
- `destacado=true` - Solo productos destacados
- `buscar` - Buscar por nombre

#### Ver Producto
```http
GET /api/productos/{id}
```

#### Categorías Disponibles
```http
GET /api/productos/categorias
```

#### Productos Destacados
```http
GET /api/productos/destacados
```

#### Crear Producto (Admin)
```http
POST /api/productos
Authorization: Bearer {token}
Content-Type: application/json

{
  "nombre": "Sofá Nuevo",
  "descripcion": "Descripción del sofá",
  "precio": 599.99,
  "categoria": "Sofás",
  "stock": 10,
  "altura": 85,
  "ancho": 220,
  "profundidad": 90,
  "activo": true,
  "destacado": false
}
```

#### Actualizar Producto (Admin)
```http
PUT /api/productos/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "nombre": "Sofá Actualizado",
  "precio": 549.99
}
```

#### Eliminar Producto (Admin)
```http
DELETE /api/productos/{id}
Authorization: Bearer {token}
```

### Health Check
```http
GET /api/health
```

## 🔐 Autenticación

Para acceder a endpoints protegidos, incluye el token JWT en el header:

```http
Authorization: Bearer tu_token_aqui
```

## 📁 Estructura del Proyecto

```
ia-decorate-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── AuthController.php
│   │   │       └── ProductoController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Rol.php
│       ├── Producto.php
│       ├── Carrito.php
│       ├── Pedido.php
│       ├── DetallePedido.php
│       ├── Incidencia.php
│       └── Mensaje.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000000_create_users_table.php
│   │   ├── 2024_01_01_000001_create_roles_table.php
│   │   ├── 2024_01_01_000002_create_role_user_table.php
│   │   ├── 2024_01_01_000003_create_productos_table.php
│   │   └── ... (8 migraciones en total)
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── RoleSeeder.php
│       ├── AdminSeeder.php
│       └── ProductoSeeder.php
├── routes/
│   └── api.php
├── config/
│   ├── auth.php
│   └── jwt.php
├── .env
├── .env.example
├── composer.json
└── README.md
```

## 🧪 Probar la API (ESTO SE HARÁ MAS ADELANTE, VAMOS POR LO ANTERIOR QUE ES LO ESENCIAL)

### Con cURL:

```bash
# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@iadecorate.com","password":"admin123"}'

# Listar productos
curl http://localhost:8000/api/productos

# Crear producto (necesitas el token del login)
curl -X POST http://localhost:8000/api/productos \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TU_TOKEN_AQUI" \
  -d '{"nombre":"Sofá Test","precio":299.99,"categoria":"Sofás","stock":5}'
```

### Con Postman:

1. Importar colección de Postman (crear una)
2. Hacer login para obtener token
3. Configurar Authorization: Bearer Token
4. Probar endpoints

## 🔄 Comandos Útiles

```bash
# Ver rutas
php artisan route:list

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Resetear base de datos
php artisan migrate:fresh --seed

# Ver logs
tail -f storage/logs/laravel.log

# Crear migración
php artisan make:migration create_ejemplo_table

# Crear modelo con migración y controlador
php artisan make:model Ejemplo -mcr

# Crear controlador
php artisan make:controller Api/EjemploController --api

# Crear seeder
php artisan make:seeder EjemploSeeder
```

## 🐛 Solución de Problemas

### Error: "No application encryption key"
```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [2002] Connection refused"
- Verifica que MySQL esté corriendo
- Revisa credenciales en `.env`

### Error: "Class 'JWT' not found"
```bash
composer dump-autoload
php artisan config:clear
php artisan jwt:secret
```

### Permisos en Linux/Mac:
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Error de CORS:
Editar `config/cors.php`:
```php
'paths' => ['api/*'],
'allowed_origins' => ['http://localhost:5500', 'http://127.0.0.1:5500'],
```

## 🌐 Configurar CORS

Editar `config/cors.php`:

```php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5500', 'http://127.0.0.1:5500'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
```

## 📝 Próximas Funcionalidades

- [ ] Sistema de carrito completo
- [ ] Gestión de pedidos
- [ ] Sistema de incidencias
- [ ] Mensajería entre usuarios
- [ ] Recuperación de contraseña
- [ ] Subida de imágenes
- [ ] Notificaciones por email
- [ ] Sistema de valoraciones

## 📚 Documentación

- Laravel: https://laravel.com/docs
- JWT Auth: https://jwt-auth.readthedocs.io

## 👥 Autor

Equipo IA Decorate

---

**¡Backend Laravel listo para usar! 🎉**
