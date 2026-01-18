# 🗣 Toma JEroma - eCommerce Especializado

Bienvenido a **TomaJeroma**, una plataforma de comercio electrónico. Este proyecto ha sido desarrollado como parte del ciclo formativo de Grado Superior en **Desarrollo de Aplicaciones Web (DAW)**.

---

## 👥 Autores
* **Javier Díaz López** - [GitHub/Enlace](https://github.com/Azvi01)
* **Pedro José Martínez Robles** - [GitHub/Enlace](https://github.com/AidenBlaze)

---

### Pre-requisitos
* Tener instalado [Docker](https://www.docker.com/) y Docker Desktop.
* Tener instalado [Node.js](https://nodejs.org/) (para compilar Tailwind).

## 🛠️ Stack Tecnológico

El proyecto está construido bajo una arquitectura robusta y moderna:

* **Backend:** PHP con arquitectura **MVC** (Modelo-Vista-Controlador).
* **Frontend:** JavaScript y **Tailwind CSS** para un diseño responsivo y moderno.
* **Base de Datos:** MySQL / MariaDB (inicializada mediante scripts SQL).
* **Contenedores:** Docker y Docker Compose para asegurar un entorno de desarrollo idéntico en cualquier máquina.
* **Gestión de Paquetes:** NPM para las dependencias de frontend.

---

## 🏗️ Arquitectura del Proyecto

El proyecto sigue una estructura de carpetas organizada para separar la lógica de negocio de la interfaz de usuario:

* `/app`: Contiene el núcleo del MVC (Controladores, Modelos y Librerías).
* `/app/views`: Plantillas de la interfaz y layouts.
* `/public`: Punto de acceso público del servidor, contiene el `index.php`, estilos (CSS), imágenes y scripts de cliente.
* `/bbdd`: Carpeta que guarda la base de datos (`init.sql`).

---

## 🚀 Instalación y Despliegue

Sigue estos pasos para levantar el entorno de desarrollo localmente:

### Pasos a seguir

1.  **Clonar el repositorio:**
    ```bash
    git clone https://github.com/Azvi01/Proyecto-DAW2
    cd Proyecto-DAW2
    ```

2.  **Instalar dependencias de Frontend:**
    ```bash
    npm install
    ```

3.  **Compilar estilos con Tailwind (Modo Watch):**
    ```bash
    npm run dev
    ```

4.  **Levantar los contenedores de Docker:**
    ```bash
    docker compose up -d
    ```

El servidor estará disponible en `http://localhost:8000`.

---

## 🐳 Configuración de Docker

El proyecto utiliza tres servicios principales definidos en `docker-compose.yml`:
1.  **tomajeroma_php:** Configurado mediante el `Dockerfile` para servir la aplicación.
2.  **eCommerce:** Servidor de base de datos que carga automáticamente el archivo `bbdd/init.sql` al iniciar por primera vez.
3.  **tomajeroma_phpmyadmin:** Servidor que proporciona acceso a phpmyadmin poder ver mejor la base de datos.

---

## 📝 Licencia
Este proyecto es de uso educativo para el grado superior de DAW.