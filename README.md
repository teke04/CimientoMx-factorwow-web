# Soren Framework - PHP MVC

Soren es un framework PHP ligero basado en el patrón MVC (Modelo-Vista-Controlador) con sistema de enrutamiento, gestión de base de datos y integración con Tailwind CSS.

## 📋 Tabla de Contenidos

- [Características](#características)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Uso](#uso)
- [Desarrollo con Tailwind CSS](#desarrollo-con-tailwind-css)
- [Sistema de Rutas](#sistema-de-rutas)
- [Controladores](#controladores)
- [Vistas](#vistas)
- [Base de Datos](#base-de-datos)
- [Changelog](#changelog)
- [Contribuir](#contribuir)

## ✨ Características

- **Patrón MVC Simple con Singleton y DRY**: Arquitectura limpia y organizada basada en el patrón Modelo-Vista-Controlador (MVC), complementada con el uso del patrón Singleton para garantizar una única instancia de los componentes principales del framework, y el principio DRY (Don't Repeat Yourself) para promover la reutilización de funciones y evitar redundancias

- **Modo landing/web**: Configura de manera sencilla el proyecto para funcionar como landing page o sitio web completo desde tu environment

- **Enrutamiento Automático**: Gestión automática de URLs con función `crearRuta()` en el archivo rutas.php

- **Sistema de Keywords Autoadministrables con Métricas de Resultados**: Gestión dinámica de páginas de aterrizaje desde la base de datos, con un sistema integrado para el análisis de métricas y rendimiento de keywords

- **Manejo de Errores Avanzado**: Sistema robusto de gestión de errores que incluye registro detallado en logs, interfaz de depuración para identificar y resolver problemas rápidamente, y notificaciones automáticas por correo para fallos críticos

- **Sistema de Notificaciones por Email**: Plantillas y envío automático de correos, con notificaciones de error, creación de usuarios, 

- **Panel de Administración modular**: Panel de administración con diseño minimalista y modo oscuro/claro, con modulos para editar datos de contacto, correos de notificaciones, imagenes, textos, etc, con sistea de autenticacion de usuarios y encriptado de contraseñas básico

- **Gestión de Base de Datos**: Sistema que actualiza automáticamente la base de datos al agregar nuevas migraciones, asegurando que la estructura esté siempre sincronizada. Además, utiliza sanitisación de valores en todas las operaciones para garantizar la seguridad y prevenir inyecciones SQL

- **Integración con Tailwind CSS**: Estilos modernos y responsivos con clases personalizadas únicas

- **Cache Busting Automático**: Sistema optimizado para invalidación automática de assets al realizar cambios, funcional para scripts de js, imagenes, videos y archivos de estilos como fuentes y css

- **Sistema de Placeholder**: Proporciona fallbacks automáticos para enlaces de imágenes rotos, mostrando una imagen predeterminada en lugar de un error visual. Además, incluye páginas de error personalizadas para manejar errores 400 (solicitudes incorrectas) y 500 (errores internos del servidor), garantizando una experiencia de usuario consistente y profesional.

- **SEO Automático**: Robots.txt y sitemap.xml autogenerados en modo web

- **Montaje Sencillo con Validaciones Automáticas**: Configuración a través de archivo .env con validaciones automáticas de parámetros y autoloader inteligente para controladores, garantizando un arranque sin errores y carga ordenada de componentes

- **Helpers Simplificados**: El framework incluye una serie de helpers que simplifican el uso de las funciones principales, permitiendo un desarrollo más ágil y limpio.

- **Animaciones Scroll-Driven**: Repositorio de animaciones optimizadas para scroll, diseñadas para una carga rápida y una experiencia de usuario moderna.

## 📁 Estructura del Proyecto

```
soren/
├── .env                        # Variables de entorno
├── .env.example                # Ejemplo de configuración de entorno
├── .gitignore                  # Ignorar archivos sensibles
├── .htaccess                   # Configuración de servidor web
├── config.php                  # Configuración principal (solo datos)
├── index.php                   # Punto de entrada
├── rutas.php                   # Definición de rutas
├── tailwind.bat                # Script de compilación Tailwind
├── tailwind.config.js          # Configuración de Tailwind CSS
├── controladores/              # Controladores de la aplicación
│   ├── Controlador.php         # Controlador base
│   ├── Controlador_Documentos.php
│   ├── Controlador_Landing.php
│   ├── Controlador_Prospectos.php
│   ├── Controlador_Web.php
│   └── admin/                  # Controladores del panel admin
│       ├── Controlador_Admin_Base.php
│       ├── Controlador_Configuraciones.php
│       ├── Controlador_Landings.php
│       ├── Controlador_Leads.php
│       ├── Controlador_Login.php
│       └── Controlador_Resultados.php
├── db/                         # Base de datos
│   ├── usuarios_iniciales.example.php
│   ├── usuarios_iniciales.php
│   └── migraciones/            # Migraciones de base de datos
│       ├── v1_crear_tabla_users.php
│       ├── v2_crear_tabla_intereses.php
│       ├── v3_crear_tabla_servicios.php
│       ├── v4_crear_tabla_landings.php
│       ├── v5_crear_tabla_prospectos.php
│       ├── v6_poblar_tabla_users.php
│       ├── v7_poblar_tabla_intereses.php
│       ├── v8_poblar_tabla_servicios.php
│       ├── v9_poblar_tabla_landings.php
│       └── v10_crear_tabla_configuraciones.php
├── framework/                  # Core del framework Soren
│   ├── arranque.php            # Sistema de inicialización y carga
│   ├── funciones.php           # Funciones auxiliares
│   ├── core/                   # Componentes principales
│   │   ├── Db.php
│   │   ├── Enrutador.php
│   │   ├── Entorno.php
│   │   ├── Errores.php
│   │   ├── Logger.php
│   │   └── Migraciones.php
├── logs/                       # Archivos de logs
│   └── logs_aaaa-mm-dd.log
├── recursos/                   # Recursos estáticos
│   ├── logoWA.svg
│   ├── placeholder.svg
│   └── scripts/                # Scripts JavaScript
│       ├── animaciones.js
│       └── navbar.js
├── vistas/                     # Plantillas y vistas
│   ├── 404.php
│   ├── gracias.php
│   ├── robots.php
│   ├── sitemap.php
│   ├── admin/                  # Vistas del panel admin
│   │   ├── resultados.php
│   │   ├── verconfiguraciones.php
│   │   ├── verleads.php
│   │   ├── componentes/
│   │   │   ├── barra-lateral.php
│   │   │   └── header.php
│   │   ├── cuentas/
│   │   │   ├── crear.php
│   │   │   ├── login.php
│   │   │   ├── recuperar.php
│   │   │   └── recuperarForm.php
│   │   ├── landings/
│   │   │   ├── crear-landings.php
│   │   │   ├── editar-landings.php
│   │   │   └── ver-landings.php
│   │   └── plantillas/
│   │       └── metas-basicas.php
│   ├── emails/                 # Plantillas de email
│   │   ├── lead.php
│   │   └── recuperar.php
│   ├── landing/                # Páginas de landing
│   │   ├── home.php
│   │   ├── componentes/
│   │   │   ├── flotante-whatsapp.php
│   │   │   ├── footer.php
│   │   │   ├── formulario-contacto.php
│   │   │   └── navbar.php
│   │   └── plantillas/
│   │       ├── estilos.php
│   │       └── metas-basicas.php
│   └── web/                    # Páginas web principales
│       ├── contacto.php
│       ├── home.php
│       ├── pagina2.php
│       ├── pagina3.php
│       ├── componentes/
│       │   ├── flotante-whatsapp.php
│       │   ├── footer.php
│       │   ├── formulario-contacto.php
│       │   └── navbar.php
│       └── plantillas/
│           ├── estilos.php
│           ├── metadatos.php
│           └── metas-basicas.php
```

## 🚀 Instalación

1. **Clonar el repositorio o descargar como ZIP**
   ```bash
   git clone https://github.com/teke04/soren.git
   cd soren
   ```
   O bien, descarga el archivo ZIP desde el repositorio y descomprímelo en la carpeta raíz de tu servidor Apache, como `htdocs` en XAMPP o `www` en Laragon.

2. **Configurar el servidor web**
   - Asegúrate de tener PHP 7.4+ instalado
   - Configura tu servidor web (Apache/Nginx) para apuntar al directorio del proyecto
   - Si tienes varios proyectos en la raíz del servidor, usa la variable de entorno 'URL' para usar el proyecto "encarpetado" dentro de la raíz
   - Configura la variable de entorno ENVIRONMENT como development / production
   - Configura la variable de entorno MODO_PROYECTO como web / landing
   - Configura la variable de entorno DOMINIO con la url completa tal cual como quieres que se acceda al proyecto

3. **Crear la base de datos y configurar las variables de entorno**
   - Crea una base de datos en tu servidor MySQL con el nombre que prefieras.
   - Configura las variables de entorno en el archivo `.env` (o copia y edita el archivo `.env.example`) con los datos de conexión a la base de datos:
     ```env
     DB_HOST=localhost
     DB_NAME=nombre_de_tu_base_de_datos
     DB_USER=tu_usuario
     DB_PASSWORD=tu_contraseña
     ```

4. **Ejecución automática de migraciones**
   - Una vez configuradas las variables de entorno, accede al proyecto desde tu navegador.
   - El framework detectará automáticamente las migraciones pendientes y las ejecutará para mantener la base de datos actualizada.


5. **Configurar el correo de remitente**
   - Crea una cuenta de correo en el mismo servidor donde está montado el proyecto.
   - Configura la variable de entorno EMAIL_REMITENTE para indicar el correo desde el cual se envian las notificaciones `.env`:
     ```env
     EMAIL_REMITENTE=noreply@tevenproyect.com
     ```
   - Asegúrate de que el servidor tenga habilitado el servicio SMTP para el envío de correos.

6. **Copiar archivos de configuración inicial**
   - Copia y renombra los archivos `usuarios_iniciales.example.php` y `.env.example` para crear sus versiones activas:
     ```bash
     cp db/usuarios_iniciales.example.php db/usuarios_iniciales.php
     cp .env.example .env
     ```
   - Esto asegurará que los archivos de configuración inicial estén listos para su uso.


### Sistema de Variables de Entorno (.env)

Soren utiliza un sistema de variables de entorno para gestionar la configuración de manera segura y flexible. Los datos sensibles (contraseñas, keys) se almacenan en un archivo `.env` que **no debe subirse a Git**. Ya viene bloqueado en el .gitignore por defecto


### Sistema de Arranque

Soren utiliza un sistema modular de inicialización que carga todos los componentes del framework de manera ordenada:

**Flujo de arranque:**
1. `index.php` - Punto de entrada principal
2. `framework/arranque.php` - Carga todos los componentes necesarios:
   - `framework/entorno.php` - Carga variables desde `.env` y valida la configuración
   - `framework/core/Errores.php` - Manejo de errores y excepciones
   - `framework/core/Logger.php` - Registro de logs y eventos
   - `framework/core/Db.php` - Conexión a la base de datos
   - `framework/core/Migraciones.php` - Gestión de migraciones de base de datos
   - `framework/core/Enrutador.php` - Sistema de enrutamiento
   - `framework/funciones.php` - Funciones auxiliares
3. `rutas.php` - Definición de rutas

Este flujo asegura que los componentes críticos del framework se carguen en el orden correcto, garantizando un arranque sin errores y una ejecución eficiente.

### Validación Automática de Configuración

El framework incluye un sistema de validación que verifica todos los parámetros de configuración al iniciar la aplicación. Si algún valor está mal configurado, mostrará un error detallado y detendrá la ejecución.

**Validaciones implementadas:**
- ✅ `ENVIRONMENT`: Debe ser 'development' o 'production'
- ✅ `MODO-PROYECTO`: Debe ser 'web' o 'landing'
- ✅ `SERVERNAME`: No puede estar vacío
- ✅ `DBNAME`: No puede estar vacío
- ✅ `USERNAME`: Debe ser una cadena de texto
- ✅ `PASSWORD`: Debe existir (puede estar vacío)
- ✅ `URL`: Debe comenzar y terminar con '/'
- ✅ `DOMINIO`: Debe comenzar con 'http://' o 'https://' y terminar con '/'
- ✅ `SENDEREMAIL`: Debe ser un email válido
- ✅ `EMPRESA`: No puede estar vacío
- ✅ `COLOR-PRIMARIO`: Debe ser un color hexadecimal válido (#XXXXXX)

### Variables de Configuración

| Variable Entorno | Descripción | Valores |
|------------------|-------------|---------|
| `ENVIRONMENT`   | Entorno de ejecución | `development`, `production` |
| `MODO_PROYECTO` | Modo del proyecto | `web`, `landing` |
| `DB_HOST`       | Servidor de base de datos | `localhost`, IP |
| `DB_NAME`       | Nombre de la base de datos | Nombre de tu BD |
| `DB_USER`       | Usuario de BD | Usuario con permisos |
| `DB_PASSWORD`   | Contraseña de BD | Contraseña del usuario |
| `URL`           | Ruta relativa del proyecto | `/framework/`, `/` |
| `DOMINIO`       | URL completa del sitio | `https://tudominio.com/` |
| `EMAIL_REMITENTE` | Email para envíos | Email válido |
| `EMPRESA`       | Nombre de la empresa | Texto libre |
| `COLOR_PRIMARIO` | Color principal | Código hex |

### Acceso a Variables de Configuración

Soren utiliza directamente las variables de entorno a través de la función helper `env()`:

```php
// Función helper env()
env('EMPRESA'); // "Tu Empresa"
env('DOMINIO'); // "http://localhost/framework/"
env('DB_HOST', 'localhost'); // Con valor por defecto

// Desde cualquier parte del código
$empresa = env('EMPRESA');
$modo = env('MODO_PROYECTO');

// En vistas PHP
<title><?= env('EMPRESA') ?></title>
<meta name="theme-color" content="<?= env('COLOR_PRIMARIO') ?>">
```

#### Desarrollo (Development)
```env
ENVIRONMENT=development
MODO_PROYECTO=landing

DB_HOST=localhost
DB_NAME=default_db
DB_USER=root
DB_PASSWORD=

URL=/framework/
DOMINIO=http://localhost/framework/

EMAIL_REMITENTE=noreply@tevenproyect.com

EMPRESA=Teven
COLOR_PRIMARIO=#FFFFFF
AGENCIA=Teven Proyect
```

#### Producción (Production)
```env
ENVIRONMENT=production
MODO_PROYECTO=web

DB_HOST=localhost
DB_NAME=produccion_db
DB_USER=admin
DB_PASSWORD=securepassword

URL=/
DOMINIO=https://produccion.com/

EMAIL_REMITENTE=contacto@produccion.com

EMPRESA=Producción
COLOR_PRIMARIO=#000000
AGENCIA=Producción Agencia
```
### Seguridad

✅ **Buenas prácticas implementadas**:
- `.env` está en `.gitignore` (no se sube al repositorio).
- `.env.example` proporciona plantilla sin datos sensibles.
- Valores por defecto seguros en `config.php`.
- Validación automática de todos los parámetros.
- **Sanitización de valores en consultas SQL**: Todas las consultas a la base de datos utilizan sentencias preparadas para evitar inyecciones SQL.
- **Contraseñas seguras**: Las contraseñas se almacenan utilizando hashing seguro (por ejemplo, `password_hash`) con sal para mayor protección.
- **Bloqueo de acceso a directorios y archivos sensibles**: Archivos como `.env`, `logs/` y otros directorios críticos están protegidos mediante reglas en `.htaccess` o configuraciones del servidor.
- **HTTPS forzado en producción**: En el entorno de producción, se fuerza el uso de HTTPS para garantizar la seguridad de las conexiones.

⚠️ **Importante**:
- Nunca subas el archivo `.env` a Git.
- Cambia las contraseñas en producción.
- Usa HTTPS en producción (`DOMINIO=https://...`).

### Configuración de Rutas

Las rutas se definen en `rutas.php` utilizando la función `crearRuta()`. Soren soporta dos modos de proyecto: web y landing (páginas de aterrizaje)

#### Función crearRuta()

```php
/**
 * Agregar rutas al sistema de enrutamiento
 * @param string $ruta - La ruta URL ('home', 'admin/usuarios')
 * @param string $controlador - Nombre del controlador ('Controlador_Web')
 * @param string $metodo - Método del controlador ('home')
 */
crearRuta($ruta, $controlador, $metodo);
```

#### Modo Web (Sitio Web Completo)

```php
// Cuando env('MODO-PROYECTO') === 'web'

// Rutas principales
crearRuta('', 'Controlador_Web', 'home');           // Página principal
crearRuta('home', 'Controlador_Web', 'home');       // Alias de inicio
crearRuta('pagina2', 'Controlador_Web', 'pagina2');  // Página secundaria
crearRuta('pagina3', 'Controlador_Web', 'pagina3');  // Página tertiary

// Rutas técnicas (SEO automático)
crearRuta('sitemap.xml', 'Controlador_Web', 'sitemap');  // Sitemap autogenerado
crearRuta('robots.txt', 'Controlador_Web', 'robots');    // Robots.txt autogenerado
crearRuta('aviso-de-privacidad', 'Controlador_Web', 'avisoPrivacidad');
```

#### Modo Landing (Páginas de Aterrizaje)

En este modo, por cada "keyword" o "slug" de landing creada en el panel de administración, el sistema genera automáticamente una ruta correspondiente. Esto permite gestionar dinámicamente las páginas de aterrizaje desde la base de datos sin necesidad de definirlas manualmente.

#### Rutas Comunes (Ambos Modos)

```php
// Gestión de leads
crearRuta('gracias', 'Controlador_Prospectos', 'guardarLead');

// Autenticación
crearRuta('login', 'Controlador_Login', 'login');
crearRuta('logout', 'Controlador_Login', 'logout');
crearRuta('recuperar-cuenta', 'Controlador_Login', 'recuperar');

// Panel de administración
crearRuta('admin', 'Controlador_Admin', 'resultados');
crearRuta('admin/leads', 'Controlador_Admin', 'verleads');
crearRuta('admin/keywords', 'Controlador_Keywords', 'verkeywords');
crearRuta('admin/configuraciones', 'Controlador_Admin', 'verconfiguraciones');
```

### SEO Automático en Modo Web

Soren genera automáticamente archivos SEO esenciales cuando está en modo web:

#### Sitemap.xml Dinámico
- **Generación automática**: Incluye todas las rutas del `Controlador_Web`
- **Filtrado inteligente**: Excluye rutas técnicas como robots.txt, sitemap.xml
- **Fechas actualizadas**: Usa la fecha de modificación de archivos de vista
- **Configuración SEO**: Priority y changefreq personalizables por página

#### Robots.txt Dinámico  
- **Configuración automática**: Apunta al sitemap generado
- **Adaptable al entorno**: Diferentes reglas para development/production
- **URL dinámica**: Usa la configuración de `DOMINIO` del proyecto

#### Ejemplo de configuración SEO:
```php
// En Controlador_Web->sitemap()
$configuracionPersonalizada = [
    '' => [
        'priority' => '1.0',      // Página principal - máxima prioridad
        'changefreq' => 'daily'   // Se actualiza diariamente
    ],
    'pagina2' => [
        'priority' => '0.8',      // Página secundaria
        'changefreq' => 'weekly'  // Se actualiza semanalmente
    ]
];
```

## 🎯 Uso

### Crear un Controlador

Los controladores extienden de la clase base `Controlador` y tienen acceso a propiedades globales como `$CONFIG`, `db()` y `$RUTAS`:

```php
<?php
class Controlador_MiSeccion extends Controlador {
    
    public function home() {
        // Mostrar vista principal con datos
        $this->mostrar('mi_seccion/home', [
            'titulo' => 'Mi Página Principal',
            'usuario' => $_SESSION['usuario'] ?? null
        ]);
    }
    
    public function detalle() {
        // Consulta a la base de datos
        $sql = "SELECT * FROM productos WHERE activo = ? ORDER BY fecha DESC";
        $productos = $this->db->ejecutarConsulta($sql, [1]);
        
        $this->mostrar('mi_seccion/detalle', [
            'productos' => $productos,
            'total' => count($productos)
        ]);
    }
}
```

### Crear una Vista

Las vistas tienen acceso a las variables pasadas desde el controlador y pueden usar métodos helper:

```php
<!DOCTYPE html>
<html lang="ES">
<head>
    <!-- Plantillas del framework -->
    <?php $this->plantilla('metas-basicas')?>
    <?php $this->plantilla('estilos')?>
    <?php $this->plantilla('metadatos')?>
    
    <title><?= $CONFIG['EMPRESA'] ?> - <?= $titulo ?></title>
    <meta name="description" content="Descripción de la página">
    <link rel="canonical" href="<?= ruta('mi-seccion') ?>"/>
</head>
<body class="w-screen overflow-x-clip">
    
    <!-- Componentes reutilizables -->
    <?php $this->componente('navbar'); ?>
    <?php $this->componente('flotante-whatsapp'); ?>
    
    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6"><?= $titulo ?></h1>
        
        <?php if (!empty($productos)): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($productos as $producto): ?>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold"><?= $producto['nombre'] ?></h3>
                        <p class="text-gray-600"><?= $producto['descripcion'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">No hay productos disponibles.</p>
        <?php endif; ?>
    </main>
    
    <?php $this->componente('footer'); ?>
</body>
</html>
```

### Vista de Panel de Administración

Para el panel administrativo, las vistas siguen una estructura similar pero incluyen componentes específicos:

```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="<?= importAsset('tailwind/output.css'); ?>" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen w-screen flex flex-col">

    <?php require 'header.php'; ?>
  
    <main class="flex flex-grow">
        
        <?php require 'barraLateral.php'; ?>

        <!-- Contenido principal -->
        <section class="flex-grow bg-sky-50 relative">
            <div class="flex items-start justify-center w-full">
                <div class="flex flex-col items-start text-gray-700 mt-[40px] size-full py-12 px-12">
                    <h1 class="text-3xl font-bold mb-4"><?= $titulo ?></h1>
                    
                    <!-- Tabla de datos -->
                    <div class="overflow-x-auto max-h-[440px] w-full pr-6 border-slate border-b-2">
                        <table class="table-auto border-collapse border border-gray-400 w-full">
                            <thead>
                                <tr class="bg-gray-500 text-white">
                                    <th class="border border-slate-700 px-4 py-2">ID</th>
                                    <th class="border border-slate-700 px-4 py-2">Nombre</th>
                                    <th class="border border-slate-700 px-4 py-2">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datos as $item): ?>
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-slate-300 px-4 py-2"><?= $item['id'] ?></td>
                                        <td class="border border-slate-300 px-4 py-2"><?= $item['nombre'] ?></td>
                                        <td class="border border-slate-300 px-4 py-2"><?= $item['fecha'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
```

## 🎨 Desarrollo con Tailwind CSS

### Compilar CSS

Para compilar los estilos de Tailwind CSS, ejecuta:

```bash
./tailwind.bat
```

### Clases Personalizadas Disponibles

El framework incluye las siguientes clases de animación personalizadas:

- `float-up`: Animación de flotación hacia arriba
- `rotate-in-from-left`: Rotación desde la izquierda
- `rotate-in-from-right`: Rotación desde la derecha
- `slide-in-from-left`: Deslizamiento desde la izquierda
- `slide-in-from-right`: Deslizamiento desde la derecha

## ⚡ Cache Busting Automático

Soren incluye un sistema optimizado de invalidación automática de assets que elimina problemas de caché en navegadores.

### Función importAsset()

```php
/**
 * Importar assets con cache busting automático
 * @param string $nombreasset - Archivo relativo a /recursos/ 
 * @return string - URL con parámetro de versión automático
 */
function importAsset($nombreasset);
```

### Cómo Funciona

```php
// Uso en vistas
<link href="<?= importAsset('tailwind/output.css'); ?>" rel="stylesheet">
<script src="<?= importAsset('vistas/animaciones.js'); ?>"></script>
<img src="<?= importAsset('logo.svg'); ?>" alt="Logo">

// El framework automáticamente genera:
// /recursos/tailwind/output.css?v=1698547200  // timestamp del archivo
// /recursos/vistas/animaciones.js?v=1698547100
// /recursos/logo.svg?v=1698546900
```

### Beneficios del Sistema

- **✅ Automático**: Sin configuración manual de versiones
- **✅ Optimizado**: Usa `filemtime()` para versiones reales
- **✅ Inteligente**: Solo cambia la versión cuando el archivo se modifica
- **✅ Fallback Inteligente**: Usa imagen placeholder para evitar links rotos
- **✅ Universal**: Funciona con CSS, JS, imágenes y cualquier asset

### Sistema de Fallback con Placeholder

Soren incluye protección contra assets faltantes:

```php
// Si el asset no existe, automáticamente retorna:
return ruta('recursos/placeholder.svg');

// Ejemplo: si logo.png no existe
importAsset('logo.png')         // → /recursos/placeholder.svg
importAsset('imagen-faltante')  // → /recursos/placeholder.svg
```

**Ventajas del Placeholder:**
- **🚫 Evita enlaces rotos**: Nunca se muestran imágenes quebradas (404)
- **🎨 Experiencia consistente**: Siempre hay algo que mostrar
- **🔧 Debug más fácil**: Sabes inmediatamente qué asset falta
- **📱 UI limpia**: No se rompe el diseño por assets faltantes

### Ubicación de Assets

```
recursos/
├── tailwind/
│   ├── output.css      # CSS compilado de Tailwind
│   └── styles.css      # CSS fuente
├── vistas/
│   └── animaciones.js  # JavaScript de animaciones
├── logo.svg           # Logo de la empresa
├── logoWA.svg         # Logo de WhatsApp
├── favicon.ico        # Favicon del sitio
└── placeholder.svg    # ⭐ Imagen de fallback para assets faltantes
```

## 🌐 Sistema de Rutas

El sistema de enrutamiento automático mapea URLs a controladores y métodos:

- `/` → `Controlador_Web@index`
- `/admin` → `admin/Controlador_Admin@index`
- `/admin/usuarios` → `admin/Controlador_Admin@usuarios`

## 🎛️ Controladores

### Controlador Base

Todos los controladores extienden de la clase `Controlador` que proporciona funcionalidades base:

```php
class Controlador {
    protected $CONFIG;  // Configuración global
    // Usar db() para acceder a la instancia de base de datos
    protected $RUTAS;   // Array de rutas del sistema

    public function __construct() {
        session_start();
        global $CONFIG, $RUTAS;
        $this->CONFIG = $CONFIG;
        $this->db = db();
        $this->RUTAS = $RUTAS;
    }

    // Mostrar vista con datos
    protected function mostrar($vista, $datos = []) {
        $datos['CONFIG'] = $this->CONFIG;
        extract($datos);
        include 'vistas/' . $vista . '.php';
    }

    // Incluir componentes web
    public function componente($componente, $datos = []) {
        $datos['CONFIG'] = $this->CONFIG;
        extract($datos);
        include 'vistas/web/componentes/' . $componente . '.php';
    }

    // Incluir componentes de landing
    public function componente($componente, $datos = []) {
        $datos['CONFIG'] = $this->CONFIG;
        extract($datos);
        include 'vistas/landing/componentes/' . $componente . '.php';
    }
}
```

### Controladores Disponibles

- **Controlador_Web**: Páginas principales del sitio web público
- **Controlador_Landing**: Páginas de aterrizaje específicas  
- **Controlador_Prospectos**: Gestión de leads y formularios de contacto
- **Controlador_Admin**: Panel de administración y reportes
- **Controlador_Login**: Autenticación y gestión de sesiones de usuarios

### Controlador Admin Base

Los controladores del panel de administración extienden de `Controlador_Admin_Base`, que incluye **autenticación automática**:

```php
<?php
class Controlador_Admin_Base extends Controlador {
    
    public function __construct() {
        parent::__construct();
        $this->verificar_sesion(); // Verificación automática de sesión
    }
}
```

**✅ Beneficios de heredar de `Controlador_Admin_Base`:**
- **Autenticación automática**: Verifica la sesión del usuario en cada petición
- **Redirección automática**: Si no hay sesión válida, redirige al login
- **Protección de rutas**: No necesitas verificar manualmente la autenticación
- **Sesión persistente**: Mantiene la sesión activa durante la navegación

### Ejemplo de Controlador Admin

```php
<?php
class Controlador_Admin extends Controlador_Admin_Base {

    public function verleads() {
        // ✅ La autenticación ya está verificada automáticamente
        // ✅ Si no hay sesión, ya se redirigió al login
        
        // Consulta SQL con JOIN para obtener leads con información de landing
        $sql = "
            SELECT 
                prospectos.id,
                prospectos.creada,
                landings.keyword,
                prospectos.nombre,
                prospectos.telefono,
                prospectos.correo
            FROM 
                prospectos
            INNER JOIN 
                landings ON prospectos.landing_id = landings.id
            ORDER BY prospectos.creada DESC;
        ";

        $leads = $this->db->ejecutarConsulta($sql, []);

        $this->mostrar('admin/verleads', [
            'usuario' => $_SESSION['usuario'],
            'seleccionado' => 'leads',
            'leads' => $leads,
            'total' => count($leads)
        ]);
    }
}
```

### Análisis de Métricas de Keywords

Soren incluye un sistema avanzado de análisis de métricas para keywords en modo landing:

#### Panel de Resultados
```php
public function resultados() {
    // Obtener estadísticas de rendimiento por keyword
    $sql = "
        SELECT 
            landings.keyword AS landing,
            COUNT(prospectos.id) AS total_leads
        FROM 
            landings
        LEFT JOIN 
            prospectos ON landings.id = prospectos.landing_id
        GROUP BY 
            landings.id
        ORDER BY 
            total_leads DESC
        LIMIT 10;
    ";

    $landings = $this->db->ejecutarConsulta($sql, []);

    $this->mostrar('admin/resultados', [
        'usuario' => $_SESSION['usuario'],
        'seleccionado' => 'resultados',
        'landings' => $landings,
    ]);
}
```

#### Métricas Disponibles

- **📈 Total de Leads por Keyword**: Conversiones generadas por cada landing
- **🎯 Ranking de Performance**: Keywords ordenadas por efectividad
- **📊 Análisis Comparativo**: Rendimiento relativo entre keywords
- **📅 Seguimiento Temporal**: Evolución de conversiones en el tiempo
- **💡 Insights Automáticos**: Identificación de keywords de alto rendimiento

#### Beneficios del Sistema de Métricas

- **🔍 Visibilidad Total**: Dashboard completo del rendimiento de keywords
- **📊 Decisiones Basadas en Datos**: Optimización guiada por métricas reales
- **⚡ Tiempo Real**: Actualizaciones automáticas de estadísticas
- **🎯 ROI Mejorado**: Identificación de keywords más rentables
- **📈 Escalabilidad**: Análisis masivo de múltiples keywords simultáneamente

## 🎨 Vistas

### Estructura de Vistas

- `vistas/web/`: Páginas públicas del sitio web
  - `componentes/`: Componentes específicos para web (navbar, footer, flotante-whatsapp)
  - `plantillas/`: Plantillas base para web (estilos, metadatos, metas-basicas)
- `vistas/admin/`: Panel de administración
- `vistas/landing/`: Páginas de aterrizaje
  - `componentes/`: Componentes específicos para landing (navbar, footer, flotante-whatsapp, tagmanager)
  - `plantillas/`: Plantillas base para landing
- `vistas/emails/`: Plantillas de correo electrónico
- Archivos especiales en raíz: `404.php`, `gracias.php`, `robots.php`, `sitemap.php`

### Componentes Incluidos

- **Navbar**: Barra de navegación
- **Footer**: Pie de página
- **Flotante WhatsApp**: Botón flotante de WhatsApp
- **Tag Manager**: Integración con Google Tag Manager

## ⚡ Utilidades JavaScript

### scrollHacia()

Función de scroll suave que desplaza la vista hacia un elemento específico de la página usando su ID.

#### Sintaxis

```javascript
scrollHacia(elementId)
```

#### Parámetros

- **elementId** (string): El ID del elemento HTML hacia el cual se desea hacer scroll

#### Características

- ✅ **Scroll suave**: Utiliza `behavior: "smooth"` para animación fluida
- ✅ **Manejo de errores**: Muestra advertencia en consola si el elemento no existe
- ✅ **Compatible**: Funciona con cualquier elemento que tenga un ID único
- ✅ **Accesibilidad**: Mantiene el foco y navegación por teclado

#### Ejemplo de Uso

```javascript
// Hacer scroll hacia una sección específica
scrollHacia('contacto');

// Ejemplo con botón de navegación
<button onclick="scrollHacia('servicios')">Ver Servicios</button>

// Ejemplo en navbar
<a href="#" onclick="scrollHacia('sobre-nosotros'); return false;">
    Sobre Nosotros
</a>

// Ejemplo con evento programático
document.querySelector('.cta-button').addEventListener('click', function() {
    scrollHacia('formulario-contacto');
});
```

#### Uso en el Framework

La función `scrollHacia()` está disponible globalmente en `recursos/scripts/animaciones.js` y se utiliza comúnmente en:

- **Navbars**: Enlaces de navegación que llevan a secciones de la página
- **Landing Pages**: Botones CTA que dirigen a formularios o secciones clave
- **Páginas Web**: Navegación interna entre secciones

```html
<!-- Ejemplo real en navbar de landing -->
<nav>
    <a href="#" onclick="scrollHacia('hero'); return false;">Inicio</a>
    <a href="#" onclick="scrollHacia('caracteristicas'); return false;">Características</a>
    <a href="#" onclick="scrollHacia('contacto'); return false;">Contacto</a>
</nav>

<!-- Ejemplo en botón CTA -->
<button 
    class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg"
    onclick="scrollHacia('formulario')">
    ¡Solicita más información!
</button>
```

#### Notas Técnicas

- La función está definida en `recursos/scripts/animaciones.js`
- Debe incluirse el script antes de usar la función:
  ```html
  <script src="/recursos/scripts/animaciones.js"></script>
  ```
- Si el elemento no existe, aparecerá un warning en la consola del navegador
- El comportamiento `smooth` está soportado en todos los navegadores modernos

## 🗄️ Base de Datos

### Conexión y Consultas

Soren utiliza una clase `DB` para gestionar la base de datos con consultas preparadas:

```php
// Ejecutar consulta con parámetros (más seguro)
$sql = "SELECT * FROM usuarios WHERE activo = ? AND rol = ?";
$usuarios = $this->db->ejecutarConsulta($sql, [1, 'admin']);

// Consulta simple sin parámetros
$sql = "SELECT COUNT(*) as total FROM productos";
$resultado = $this->db->ejecutarConsulta($sql, []);

// Insertar datos
$sql = "INSERT INTO prospectos (nombre, telefono, correo, landing_id) VALUES (?, ?, ?, ?)";
$this->db->ejecutarConsulta($sql, [$nombre, $telefono, $correo, $landing_id]);

// Consulta con JOIN (ejemplo del framework)
$sql = "
    SELECT 
        prospectos.id,
        prospectos.creada,
        landings.keyword,
        prospectos.nombre,
        prospectos.telefono
    FROM 
        prospectos
    INNER JOIN 
        landings ON prospectos.landing_id = landings.id
    ORDER BY prospectos.creada DESC
    LIMIT 10;
";
$leads_recientes = $this->db->ejecutarConsulta($sql, []);
```

### Estructura

La estructura de la base de datos se encuentra en `db/crear_bdd.sql` e incluye tablas para:

- **usuarios**: Gestión de cuentas de administrador
- **landings**: Configuración de páginas de aterrizaje
- **prospectos**: Almacenamiento de leads capturados
- **configuraciones**: Ajustes del sistema

## 📋 Changelog

### [1.0.0] - 2025-10-28

#### ✨ Características Principales
- **Patrón MVC Simple**: Arquitectura limpia sin complejidad innecesaria
- **Enrutamiento Automático**: Sistema con función `crearRuta()` para gestión de URLs
- **Sistema de Keywords Autoadministrables con Métricas de Resultados**: Gestión dinámica de páginas desde la base de datos, con un sistema integrado para el análisis de métricas y rendimiento de keywords
- **Panel de Administración**: Sistema completo con control de usuarios y autenticación automática
- **Sistema de Notificaciones por Email**: Plantillas y envío automático

#### 🔧 Funcionalidades Técnicas
- **Cache Busting Automático**: Invalidación optimizada de assets con timestamps
- **Sistema de Placeholder**: Fallback automático para evitar enlaces rotos
- **SEO Automático**: Generación de robots.txt y sitemap.xml en modo web
- **Integración Tailwind CSS**: Estilos modernos con clases personalizadas únicas
- **Base de Datos**: Gestión con consultas preparadas y clase DB optimizada

#### ⚙️ Configuración y Flexibilidad
- **Modo Dual**: Configurable entre modo web (sitio completo) y landing (páginas específicas)
- **Configuración Centralizada**: Array `$CONFIG` para toda la configuración del sistema
- **Autenticación Integrada**: Protección automática de rutas administrativas
- **Estructura Organizada**: Separación clara entre controladores, vistas y recursos

#### 🎨 Interfaz y UX
- **Componentes Reutilizables**: Navbar, footer, flotante WhatsApp, Tag Manager
- **Plantillas Flexibles**: Sistema de plantillas para web y landing por separado
- **Responsive Design**: Optimizado para todos los dispositivos
- **Clases de Animación**: Sistema de animaciones personalizadas (float-up, rotate-in, slide-in)

---

Para ver el historial completo de cambios, consulta el archivo [CHANGELOG.md](CHANGELOG.md).

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -am 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## 📝 Notas de Desarrollo

- Asegúrate de compilar Tailwind CSS después de hacer cambios en los estilos
- Sigue la estructura MVC para mantener el código organizado
- Utiliza los componentes existentes para mantener consistencia

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

---

**Soren Framework - Desarrollado con ❤️ usando PHP y Tailwind CSS**