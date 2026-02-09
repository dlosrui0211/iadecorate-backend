# IA Decorate - Backend Spring Boot

Backend completo para la plataforma IA Decorate desarrollado con Spring Boot 3.2.1, Spring Security, JWT y MySQL.

## 📋 Características

- ✅ Autenticación y autorización con JWT
- ✅ Gestión de usuarios con roles (USER, ADMIN)
- ✅ CRUD completo de productos
- ✅ Gestión de carrito de compras
- ✅ Sistema de pedidos
- ✅ Gestión de incidencias
- ✅ Sistema de mensajería entre usuarios
- ✅ Configuración CORS
- ✅ Validación de datos
- ✅ Manejo global de excepciones
- ✅ Documentación de API

## 🛠️ Tecnologías Utilizadas

- **Spring Boot 3.2.1**
- **Spring Security** con JWT
- **Spring Data JPA**
- **MySQL** (base de datos principal)
- **H2** (base de datos para desarrollo/testing)
- **Lombok** (reducción de código boilerplate)
- **ModelMapper** (mapeo de DTOs)
- **Maven** (gestión de dependencias)

## 📦 Requisitos Previos

- Java 17 o superior
- Maven 3.6 o superior
- MySQL 8.0 o superior (o usar H2 para desarrollo)

## 🚀 Instalación y Configuración

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd ia-decorate-backend
```

### 2. Configurar la base de datos

#### Opción A: Usar MySQL (Recomendado para producción)

1. Crear la base de datos:
```sql
CREATE DATABASE ia_decorate CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Configurar las credenciales en `src/main/resources/application.properties`:
```properties
spring.datasource.url=jdbc:mysql://localhost:3306/ia_decorate?createDatabaseIfNotExist=true&useSSL=false&serverTimezone=UTC
spring.datasource.username=tu_usuario
spring.datasource.password=tu_contraseña
```

#### Opción B: Usar H2 (Desarrollo rápido)

Descomentar estas líneas en `application.properties`:
```properties
spring.datasource.url=jdbc:h2:mem:testdb
spring.datasource.driverClassName=org.h2.Driver
spring.datasource.username=sa
spring.datasource.password=
spring.h2.console.enabled=true
spring.h2.console.path=/h2-console
```

Y comentar las líneas de MySQL.

### 3. Compilar el proyecto

```bash
mvn clean install
```

### 4. Ejecutar la aplicación

```bash
mvn spring-boot:run
```

La aplicación estará disponible en: `http://localhost:8080/api`

## 👤 Usuario Administrador por Defecto

Al iniciar la aplicación por primera vez, se crea automáticamente un usuario administrador:

- **Email:** `admin@iadecorate.com`
- **Contraseña:** `admin123`

## 📚 Endpoints Principales

### Autenticación

#### Registro de Usuario
```http
POST /api/auth/register
Content-Type: application/json

{
  "nombre": "Juan",
  "apellidos": "Pérez García",
  "email": "juan@example.com",
  "password": "password123"
}
```

#### Login
```http
POST /api/auth/login
Content-Type: application/json

{
  "email": "juan@example.com",
  "password": "password123"
}
```

**Respuesta:**
```json
{
  "token": "eyJhbGciOiJIUzUxMiJ9...",
  "type": "Bearer",
  "id": 1,
  "email": "juan@example.com",
  "nombreUsuario": "juanperezgarcia",
  "roles": ["ROLE_USER"]
}
```

### Productos

#### Obtener todos los productos
```http
GET /api/productos
```

#### Obtener producto por ID
```http
GET /api/productos/{id}
```

#### Buscar productos por nombre
```http
GET /api/productos/buscar?nombre=sofa
```

#### Filtrar por categoría
```http
GET /api/productos/categoria/muebles
```

#### Crear producto (requiere rol ADMIN)
```http
POST /api/productos
Authorization: Bearer {token}
Content-Type: application/json

{
  "nombre": "Sofá Moderno",
  "descripcion": "Sofá de diseño contemporáneo",
  "precio": 599.99,
  "categoria": "muebles",
  "stock": 10,
  "altura": 85,
  "ancho": 220,
  "profundidad": 90,
  "unidadMedida": "cm",
  "activo": true,
  "destacado": false
}
```

#### Actualizar producto (requiere rol ADMIN)
```http
PUT /api/productos/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "nombre": "Sofá Moderno Actualizado",
  "precio": 549.99,
  ...
}
```

#### Eliminar producto (requiere rol ADMIN)
```http
DELETE /api/productos/{id}
Authorization: Bearer {token}
```

## 🔐 Autenticación con JWT

Para acceder a endpoints protegidos, incluye el token JWT en el header:

```http
Authorization: Bearer eyJhbGciOiJIUzUxMiJ9...
```

## 🗄️ Estructura de la Base de Datos

### Principales Tablas

- **usuarios**: Información de usuarios
- **roles**: Roles del sistema (USER, ADMIN)
- **usuario_roles**: Relación muchos a muchos entre usuarios y roles
- **productos**: Catálogo de productos
- **carrito**: Items en el carrito de cada usuario
- **pedidos**: Pedidos realizados
- **detalle_pedido**: Líneas de cada pedido
- **incidencias**: Tickets de soporte
- **mensajes**: Sistema de mensajería

## 📁 Estructura del Proyecto

```
ia-decorate-backend/
├── src/
│   ├── main/
│   │   ├── java/com/iadecorate/
│   │   │   ├── config/           # Configuraciones (Security, CORS, DataLoader)
│   │   │   ├── controller/       # Controladores REST
│   │   │   ├── dto/              # Data Transfer Objects
│   │   │   ├── exception/        # Manejo de excepciones
│   │   │   ├── model/            # Entidades JPA
│   │   │   ├── repository/       # Repositorios Spring Data
│   │   │   ├── security/         # Clases de seguridad JWT
│   │   │   ├── service/          # Lógica de negocio
│   │   │   └── IaDecorateApplication.java
│   │   └── resources/
│   │       └── application.properties
│   └── test/                     # Tests unitarios e integración
├── pom.xml
└── README.md
```

## 🔧 Configuración Avanzada

### Cambiar el puerto del servidor

En `application.properties`:
```properties
server.port=8081
```

### Configurar tiempo de expiración del JWT

En `application.properties`:
```properties
jwt.expiration=86400000  # 24 horas en milisegundos
```

### Configurar CORS

En `application.properties`:
```properties
cors.allowed-origins=http://localhost:3000,http://localhost:5500
```

### Configurar correo electrónico

Para el sistema de recuperación de contraseñas:
```properties
spring.mail.host=smtp.gmail.com
spring.mail.port=587
spring.mail.username=tu-email@gmail.com
spring.mail.password=tu-app-password
```

## 🧪 Testing

Ejecutar tests:
```bash
mvn test
```

## 📝 Próximas Funcionalidades

- [ ] Sistema de recuperación de contraseña por email
- [ ] Subida de imágenes a servidor/cloud
- [ ] Integración con pasarela de pago
- [ ] Sistema de notificaciones en tiempo real
- [ ] API para visualización 3D
- [ ] Sistema de valoraciones y reseñas
- [ ] Reportes y estadísticas para administradores

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto es privado y de uso exclusivo para IA Decorate.

## 👥 Autores

- Equipo de desarrollo IA Decorate

## 📞 Soporte

Para reportar bugs o solicitar nuevas funcionalidades, por favor crea un issue en el repositorio.

---

**Nota**: Este es un proyecto en desarrollo activo. Consulta el changelog para ver las últimas actualizaciones.
