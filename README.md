# Dashboard de Gestión de Personas - Grupo Apple

Sistema integral de gestión de personas compuesto por un **Backend REST API en CodeIgniter 4**, un **Dashboard Web Administrativo**, y el instalador **Móvil Android en Flutter**.

---

## 📱 Componentes del Proyecto

1. **Backend & Dashboard Web**: Desarrollado en CodeIgniter 4 (PHP 8.5) con MySQL. Incluye un dashboard visual moderno y un CRUD completo de 7 tablas:
   - Personas
   - Géneros
   - Sexos
   - Estados Civiles
   - Teléfonos
   - Direcciones
   - Correos Electrónicos
2. **API RESTful**: Endpoints JSON con soporte CORS completo (`GET`, `POST`, `PUT`, `DELETE`, `OPTIONS`) en `/api/`.
3. **Aplicación Móvil Android**: Instalador listo para usar ubicado en la raíz:
   - `GrupoApple_Movil.apk` (48 MB, firmado y listo para instalar en cualquier teléfono Android).
4. **Base de Datos**: Script SQL completo ubicado en `BD/gestion_personas.sql`.

---

## 🚀 Puesta en Marcha Rápida

### 1. Base de Datos
Importa el script `BD/gestion_personas.sql` en tu gestor MySQL (phpMyAdmin, Workbench, HeidiSQL o CLI):
```sql
CREATE DATABASE IF NOT EXISTS gestion_personas;
USE gestion_personas;
-- Ejecutar el contenido de BD/gestion_personas.sql
```

La configuración en `.env` ya viene lista:
- **Host**: `localhost:3306`
- **Base de datos**: `gestion_personas`
- **Usuario**: `root`
- **Contraseña**: `12345`

### 2. Iniciar el Servidor Web / API
Simplemente haz **doble clic** en:
```text
iniciar_servidor.bat
```
O desde la consola PowerShell/CMD:
```powershell
php spark serve --host 0.0.0.0
```
> **Nota:** El servidor está preconfigurado para escuchar en `0.0.0.0:8080`, lo que permite conexiones simultáneas desde:
> - La PC local: `http://localhost:8080`
> - Cable USB (ADB): `http://localhost:8080/api`
> - Celular por Wi-Fi o Hotspot: `http://<IP_Laptop>:8080/api`

---

## 📲 Instalación en el Celular Android
1. Pasa el archivo `GrupoApple_Movil.apk` a tu teléfono Android.
2. Ábrelo e instálalo (permite la instalación de orígenes desconocidos si el sistema lo solicita).
3. Abre la app **Grupo Apple** y usa el **Selector de Red** para conectarte a tu servidor con 1 solo toque.
