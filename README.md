# 🛒 Sistema de Gestión y Punto de Venta (Minimarket)

Este proyecto es un Sistema de Punto de Venta (POS) y Gestión de Inventario desarrollado con arquitectura **MVC (Modelo-Vista-Controlador)**. Fue diseñado para automatizar las ventas, el control de stock, el seguimiento de cuentas corrientes de clientes y la emisión de reportes gerenciales para un comercio minorista.

## 🚀 Características Principales

* **Arquitectura MVC:** Separación clara entre la lógica de negocio, el acceso a datos y la interfaz de usuario.
* **Punto de Venta Dinámico:** Carrito de compras temporal utilizando variables de Sesión (`$_SESSION`) en PHP.
* **Integridad de Datos (Transacciones SQL):** El procesamiento de ventas utiliza `beginTransaction` y `commit`/`rollBack` para garantizar que el stock solo se descuente si el ticket completo se guarda correctamente.
* **Preservación Histórica:** El sistema registra el precio histórico del producto en el momento de la venta, independientemente de futuras actualizaciones de precios en el catálogo.
* **Reportes PDF:** Generación dinámica de reportes de ventas (semanales, mensuales y anuales) utilizando la librería **FPDF**.
* **Gestión de Deudores (Cuentas Corrientes):** Control de saldos de clientes con funcionalidad de pago rápido en un clic.
* **Alertas Inteligentes:** Notificación automática en el Dashboard cuando el stock de un producto es crítico (<= 5 unidades), utilizando consultas SQL con `GROUP BY` y `SUM`.
* **Seguridad y Accesos:** Sistema de Login encriptado (`password_hash`) y registro de nuevos empleados protegido mediante un **PIN de Autorización Gerencial**.

## 🛠️ Tecnologías Utilizadas

* **Backend:** PHP 8+ (Nativo)
* **Base de Datos:** MySQL (Conexión segura mediante PDO)
* **Frontend:** HTML5, CSS3, JavaScript
* **Framework CSS:** Bootstrap 5 (UI/UX responsivo)
* **Librerías Externas:** FPDF (Generación de documentos PDF)

## 📂 Estructura del Proyecto

El sistema sigue un estricto patrón MVC organizado en los siguientes directorios:

- `/config` : Archivos de configuración y conexión a la base de datos (PDO).
- `/controlador` : Lógica intermedia, validación de formularios y manejo de sesiones.
- `/modelo` : Consultas SQL preparadas, ABM/CRUD y reglas de negocio.
- `/vista` : Interfaces de usuario, dashboards y modales de Bootstrap.
- `/fpdf186` : Core de la librería para impresión de tickets y balances.

## ⚙️ Instalación y Configuración (Entorno Local)

Para ejecutar este proyecto en tu computadora utilizando entornos como Laragon o XAMPP:

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/tu-usuario/nombre-del-repo.git](https://github.com/tu-usuario/nombre-del-repo.git)
