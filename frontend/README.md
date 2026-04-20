# Frontend — videoaccesos.net

Copia limpia y auto-contenida del sitio web público de **videoaccesos.net**,
separada del sistema administrativo (login de administradores, módulos de
tickets, reportes, pagos, tarjetas, etc.).

Esta carpeta contiene únicamente el material necesario para servir el sitio
informativo/marketing al público general.

## Estructura

```
frontend/
├── index.html              Página de inicio
├── nosotros.html           Nosotros
├── automatizaciones.html   Producto: Automatizaciones
├── control_acceso.html     Producto: Control de Acceso
├── cctv.html               Producto: CCTV
├── kitvecinoseguro.html    Producto: Kit Vecino Seguro
├── miresidencial.html      Producto: Mi Residencial
├── satelital_alarmas.html  Producto: Rastreo Satelital y Alarmas
├── servicioguardian.html   Servicio Guardián
├── ventasacceso.html       Solicitud de Compras y Ventas de Acceso
├── vecinoseguroac.html     Vecino Seguro AC
├── aviso.html              Aviso de Privacidad
├── terminos.html           Términos y Condiciones
├── contacto.php            Formulario de contacto (envía email via mail())
├── css/
│   └── style.css
├── images/                 Íconos, logos, plantilla, redes sociales
└── imagenes/               Fotografías del contenido (cámaras, productos, etc.)
```

## Cambios respecto al original

Este `index.html` ya no enlaza al sistema administrativo. Los dos CTAs del
slider que apuntaban a `formulario.php` (compra de tarjetas) y a
`administradores/login.php` (reporte de privada) se reemplazaron por un único
CTA a `contacto.php`.

El resto del contenido se copió textual del original.

## Requisitos para que el sitio funcione

Todas las páginas HTML hacen referencia a librerías JS/CSS que **no están
versionadas en el repositorio original** (existen solo en el servidor de
producción):

```
scripts/jquery.js
scripts/main.js
scripts/validar.js           (solo contacto.php)
layout/plugins/html5.js
layout/plugins/prettyphoto/css/prettyPhoto.css
layout/plugins/prettyphoto/jquery.prettyPhoto.js
layout/plugins/tools/jquery.tools.min.js
layout/plugins/scrollto/jquery.scroll.to.min.js
layout/plugins/flexslider/flexslider.css
layout/plugins/flexslider/jquery.flexslider-min.js
layout/plugins/ajaxform/jquery.form.js
layout/plugins/tweet/tweet.widget.js
layout/plugins/sort/jquery.sort.min.js
layout/plugins/roundabout/jquery.roundabout.min.js
layout/plugins/onebyone/css/jquery.onebyone.css
layout/plugins/onebyone/css/animate.css
layout/plugins/onebyone/jquery.onebyone.min.js
```

Sin estos archivos el sitio **sí carga** pero pierde:
- El slider de portada (OneByOne / FlexSlider)
- Los tabs de productos
- El lightbox PrettyPhoto
- La validación AJAX del formulario de contacto

### Opciones para resolverlo

1. Copiar `scripts/` y `layout/` desde el servidor de producción de
   videoaccesos.net a esta carpeta.
2. Sustituir las librerías por CDN públicas equivalentes (jQuery desde
   jquery.com, FlexSlider desde GitHub, etc.) y ajustar los `<script src="">`
   de cada HTML.
3. Migrar a un stack moderno (Vite/Next/etc.) si se va a rehacer el sitio.

## Despliegue

Es un sitio **estático + 1 PHP** (contacto.php). Requisitos mínimos del host:
- PHP 7+ (solo para `contacto.php`)
- Función `mail()` habilitada, o bien reemplazarla por PHPMailer / SMTP.

Basta con subir el contenido de `frontend/` a la raíz del documento del
servidor web.

## Notas de seguridad observadas en el original

El `contacto.php` copiado mantiene los defectos del original:
- Usa variables `$_POST` sin sanitizar en la cabecera del correo (riesgo de
  header injection).
- Usa `$_POST[asunto]` y `$_POST[email]` sin comillas (bareword).
- La reCAPTCHA está declarada en HTML pero no se valida del lado servidor.

Se recomienda reescribir `contacto.php` antes de exponerlo públicamente.
