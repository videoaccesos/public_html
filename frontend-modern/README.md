# Frontend Modern — videoaccesos.net

Versión moderna, responsive y auto-contenida del sitio web público de
**videoaccesos.net**. Reemplaza la versión original basada en jQuery + plugins
de 2013 por HTML5 semántico + Tailwind CSS + JavaScript vanilla.

> Esta carpeta es **paralela** a `frontend/` y a los archivos de la raíz.
> Despliégala cuando estés listo para sustituir el sitio público.

## Contenido

```
frontend-modern/
├── index.html         Landing con hero animado, productos, servicios, nosotros, clientes
├── nosotros.html      Misión, visión, valores
├── productos.html     Automatizaciones, Control de Acceso, CCTV, Satelital y Alarmas
├── servicios.html     Venta de Tarjetas, Guardián, Kit Vecino, Mi Residencial
├── contacto.php       Formulario de contacto con validación server-side y honeypot
├── aviso.html         Aviso de privacidad
├── terminos.html      Términos y condiciones
└── assets/
    ├── css/custom.css Estilos que complementan a Tailwind
    ├── js/main.js     Menú móvil, slider, validación de formulario
    └── img/           Imágenes optimizadas y organizadas por sección
```

## Stack

- **HTML5** semántico
- **Tailwind CSS** vía Play CDN (`https://cdn.tailwindcss.com`) — cero build
- **Google Fonts** (Inter)
- **JS vanilla** — sin jQuery ni dependencias
- **PHP** solo en `contacto.php` para enviar el correo

## Características

- ✅ Diseño responsive mobile-first
- ✅ Menú móvil con hamburguesa accesible
- ✅ Hero con slider automático de 3 imágenes (cross-fade)
- ✅ Navegación sticky con sombra al hacer scroll
- ✅ Anchors deep-link (`productos.html#cctv`, etc.)
- ✅ Sitio completamente navegable con teclado
- ✅ Metadatos SEO (title, description, favicon) por página
- ✅ Imágenes con `loading="lazy"`
- ✅ Formulario de contacto con:
  - Validación client-side (JS)
  - Validación server-side (PHP)
  - Protección contra header injection
  - Honeypot anti-spam
  - `Reply-To` al correo del usuario

## Despliegue

**Opción A — reemplazar el sitio actual:**
Sube el contenido de `frontend-modern/` a la raíz pública del servidor. El
sistema administrativo seguirá funcionando en sus rutas (`administradores/`,
`ticket/`, etc.) porque esta carpeta no las toca.

```bash
rsync -av --exclude='.git' frontend-modern/ usuario@servidor:/home/wwwvideoaccesos/public_html/
```

Nota: esto sobrescribirá `index.html`, `nosotros.html`, `contacto.php`, etc.
Haz un backup antes.

**Opción B — servir desde subruta:**
Déjalo en `public_html/frontend-modern/` y sírvelo en `videoaccesos.net/frontend-modern/`
para probar antes de hacer el switch definitivo.

**Opción C — desarrollo local:**
Cualquier servidor estático con soporte PHP funciona. Por ejemplo:

```bash
cd frontend-modern
php -S localhost:8080
```

Y abre <http://localhost:8080>.

## Notas sobre Tailwind Play CDN

El Play CDN (`cdn.tailwindcss.com`) es ideal para prototipado y sitios de
baja complejidad como éste. Genera el CSS en el navegador en tiempo de carga.
Si quieres optimizar para producción:

1. Instalar Tailwind como dependencia (`npm i tailwindcss`)
2. Configurar `tailwind.config.js` con el `content` apuntando a los HTML/PHP
3. Compilar `tailwind.css` y reemplazar el `<script src="cdn.tailwindcss.com">`
   por `<link rel="stylesheet" href="assets/css/tailwind.css">`

Eso elimina el flash inicial y ~50 KB de JS; no cambia nada visualmente.

## Personalización rápida

- **Paleta de color**: editar `:root` en `assets/css/custom.css` y el
  `tailwind.config` (inline en cada `<head>`).
- **Logo**: reemplazar `assets/img/logo.png`.
- **Hero**: cambiar imágenes en `assets/img/hero-*.jpg`.
- **Texto**: edición directa en los HTML — son legibles.

## Diferencias respecto al original

- Consolidado: 4 páginas de productos + 4 de servicios → 2 páginas con
  anchors (reduce clicks).
- Eliminado: widget de Twitter (`lopezobrador_`) y chat de Zopim del footer
  original (quedaron huérfanos del stack viejo).
- Actualizado: `terminos.html` con un texto coherente con Video Accesos
  (el original hablaba de "AccessBot" y procesamiento de pagos, no aplicaba).
- Eliminado: enlaces al sistema administrativo (`administradores/login.php`,
  `formulario.php`).
- Arreglado: `contacto.php` ahora valida input, previene header injection y
  usa `Reply-To` en vez de `From` con el email del usuario.
