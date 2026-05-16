# EUMS - Enterprise User Management System 🚀

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Architecture](https://img.shields.io/badge/Architecture-Hexagonal%20%2B%20CQRS-orange?style=for-the-badge)

EUMS es una plataforma avanzada de gestión de identidades diseñada bajo los principios de **Clean Architecture**, utilizando un enfoque **Hexagonal con CQRS y DDD**. El sistema ha sido modernizado con una interfaz **"Cyber-Dark Dashboard"** de alto impacto visual.

## 📸 Visual Showcase

### 🖥️ Dashboard Principal
![Dashboard](screenshots/Home.png)

### 🔐 Acceso de Seguridad
<p align="center">
  <img src="screenshots/Login%20PHP.png" width="45%" />
  <img src="screenshots/Gestion%20de%20usuarios.png" width="45%" />
</p>

### 🎥 Demostración en Video
[![Ver Demo en YouTube](https://img.shields.io/badge/YouTube-Video%20Demo-red?style=for-the-badge&logo=youtube)](https://youtu.be/UGU6ZAgrlLg)

*Haz clic en el botón de arriba para ver la demostración completa en YouTube.*

## 📸 Galería del Sistema

### 🏠 Inicio y Bienvenida
<p align="center">
  <img src="screenshots/Home.png" width="48%" />
  <img src="screenshots/Bienvenida.png" width="48%" />
</p>

### 🔐 Autenticación y Registro
<p align="center">
  <img src="screenshots/Login%20PHP.png" width="32%" />
  <img src="screenshots/Register1.png" width="32%" />
  <img src="screenshots/Register2.png" width="32%" />
</p>
<p align="center">
  <img src="screenshots/Nuevo%20registro%201.png" width="48%" />
  <img src="screenshots/Nuevo%20registro%202.png" width="48%" />
</p>

### 👥 Administración de Usuarios
<p align="center">
  <img src="screenshots/Gestion%20de%20usuarios.png" width="100%" />
</p>
<p align="center">
  <img src="screenshots/Detalle%20de%20identidad.png" width="48%" />
  <img src="screenshots/Editar%20usuario%201.png" width="48%" />
</p>
<p align="center">
  <img src="screenshots/Editar%20usuario2.png" width="100%" />
</p>

## 🛠️ Stack Tecnológico

- **Backend:** PHP 8.2 (Pure Hexagonal Architecture)
- **Frontend:** Tailwind CSS (Modern Admin UI)
- **Base de Datos:** MySQL (PDO)
- **Patrones:** CQRS (Command Query Responsibility Segregation), DDD (Domain-Driven Design), Dependency Injection.

## ✨ Características Principales

- **Dashboard Moderno:** Interfaz responsiva con estética "Cyber-Dark" y soporte para roles.
- **Gestión de Usuarios (CRUD):** Registro, edición, visualización y eliminación de entidades con validación estricta de dominio.
- **Seguridad Robusta:** Autenticación local segura y manejo de sesiones optimizado.
- **Arquitectura desacoplada:** Separación total entre la infraestructura, la aplicación y el dominio.

## 🏗️ Arquitectura del Proyecto

El proyecto sigue una estructura de capas estricta:
- **Domain:** Lógica de negocio pura (Entidades, Repositorios e Interfaces).
- **Application:** Casos de uso y orquestación de comandos/consultas.
- **Infrastructure:** Implementaciones técnicas (Base de datos, Entrypoints Web, Presentación).

## 🚀 Instalación y Uso

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/SamuelOsp/php-hexagonal-ddd-cqrs.git
   ```
2. **Configurar la Base de Datos:**
   Importa el archivo SQL incluido en el proyecto a tu servidor MySQL (XAMPP/Laragon).
3. **Configurar Conexión:**
   Asegúrate de que `Common/DependencyInjection.php` tenga las credenciales correctas de tu DB.
4. **Ejecutar:**
   Inicia el servidor local y accede a `localhost`.

## 👤 Autor

Desarrollado por **Samuel Ospina** ([@SamuelOsp](https://github.com/SamuelOsp))
*Estudiante de Ingeniería de Software - Semestre 7*

---
*Este proyecto fue refactorizado para cumplir con los más altos estándares de calidad de software y diseño moderno.*
