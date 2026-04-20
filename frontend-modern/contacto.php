<?php
$sent = false;
$error = null;
$old = ['nombre' => '', 'email' => '', 'asunto' => '', 'mensaje' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre  = trim($_POST['nombre']  ?? '');
    $email   = trim($_POST['email']   ?? '');
    $asunto  = trim($_POST['asunto']  ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');
    $hp      = trim($_POST['website'] ?? ''); // honeypot

    $old = compact('nombre', 'email', 'asunto', 'mensaje');

    if ($hp !== '') {
        $error = 'Error de envío.';
    } elseif ($nombre === '' || $email === '' || $mensaje === '') {
        $error = 'Completa los campos requeridos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Correo electrónico no válido.';
    } elseif (preg_match("/[\r\n]/", $nombre . $email . $asunto)) {
        $error = 'Entrada inválida.';
    } else {
        $para = 'contacto@videoaccesos.net';
        $subject = $asunto !== '' ? "[Contacto Web] $asunto" : '[Contacto Web] Nuevo mensaje';
        $body = "Nombre: $nombre\nCorreo: $email\nAsunto: $asunto\n\nMensaje:\n$mensaje\n";

        $headers  = "From: Sitio Web <no-reply@videoaccesos.net>\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "MIME-Version: 1.0\r\n";

        if (@mail($para, $subject, $body, $headers)) {
            $sent = true;
            $old = ['nombre' => '', 'email' => '', 'asunto' => '', 'mensaje' => ''];
        } else {
            $error = 'No pudimos enviar tu mensaje. Intenta más tarde o escríbenos directamente a contacto@videoaccesos.net';
        }
    }
}

function h($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Contacto — Video Accesos</title>
<meta name="description" content="Ponte en contacto con Video Accesos. Oficina en Culiacán Rosales, Sinaloa. Atención telefónica y por correo." />
<link rel="icon" href="assets/img/logo.png" type="image/png" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = { theme: { extend: { colors: { brand: { DEFAULT:'#0040FF', dark:'#0030CC', light:'#E6EEFF' } } } } }
</script>
<link rel="stylesheet" href="assets/css/custom.css" />
</head>
<body class="bg-white text-slate-900">

<header id="site-header" class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-100 transition-shadow">
  <div class="container mx-auto max-w-7xl px-4 flex items-center justify-between h-20">
    <a href="index.html" class="flex items-center gap-2"><img src="assets/img/logo.png" alt="Video Accesos" class="h-12 md:h-14 w-auto" /></a>
    <nav class="hidden md:flex items-center gap-7">
      <a href="index.html" class="nav-link">Inicio</a>
      <a href="nosotros.html" class="nav-link">Nosotros</a>
      <a href="productos.html" class="nav-link">Productos</a>
      <a href="servicios.html" class="nav-link">Servicios</a>
      <a href="contacto.php" class="nav-link active">Contacto</a>
      <a href="contacto.php" class="btn-brand px-4 py-2 rounded-lg text-sm font-semibold">Cotizar</a>
    </nav>
    <button id="menu-toggle" class="md:hidden p-2" aria-label="Abrir menú" aria-expanded="false">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
  </div>
  <div id="mobile-menu" class="md:hidden border-t border-slate-100">
    <div class="px-4 py-3 space-y-2">
      <a href="index.html" class="block py-2">Inicio</a>
      <a href="nosotros.html" class="block py-2">Nosotros</a>
      <a href="productos.html" class="block py-2">Productos</a>
      <a href="servicios.html" class="block py-2">Servicios</a>
      <a href="contacto.php" class="block py-2">Contacto</a>
    </div>
  </div>
</header>

<section class="hero" style="min-height:280px">
  <div class="hero-bg" style="background-image:url('assets/img/hero-monitoreo.jpg')"></div>
  <div class="container mx-auto max-w-7xl px-4">
    <p class="uppercase tracking-widest text-sm text-white/80 mb-2">Contacto</p>
    <h1 class="text-4xl md:text-5xl font-extrabold">Hablemos</h1>
    <p class="mt-4 text-lg text-white/90 max-w-2xl">Cuéntanos sobre tu residencial o proyecto y te enviamos una propuesta sin compromiso.</p>
  </div>
</section>

<section class="py-16">
  <div class="container mx-auto max-w-7xl px-4 grid lg:grid-cols-3 gap-10">
    <!-- Info lateral -->
    <div class="lg:col-span-1 space-y-8">
      <div>
        <h3 class="font-bold text-lg">Oficina</h3>
        <p class="text-slate-600 mt-2">Av. Gral. Ramón Corona 122<br>Col. Miguel Alemán, C.P. 80200<br>Culiacán Rosales, Sinaloa</p>
      </div>
      <div>
        <h3 class="font-bold text-lg">Teléfonos</h3>
        <p class="text-slate-600 mt-2">
          <a href="tel:+526679960606" class="hover:text-brand block">+52 667 996 0606</a>
          <a href="tel:+526672639025" class="hover:text-brand block">+52 667 263 9025</a>
        </p>
      </div>
      <div>
        <h3 class="font-bold text-lg">Correo</h3>
        <p class="text-slate-600 mt-2">
          <a href="mailto:contacto@videoaccesos.net" class="hover:text-brand break-all">contacto@videoaccesos.net</a>
        </p>
      </div>
      <div class="rounded-xl overflow-hidden border border-slate-200">
        <iframe title="Ubicación Video Accesos" src="https://maps.google.com/maps?q=Av.%20Gral.%20Ram%C3%B3n%20Corona%20122%2C%20Miguel%20Alem%C3%A1n%2C%20Culiac%C3%A1n%20Rosales%2C%20Sinaloa&amp;z=16&amp;output=embed" class="w-full h-64" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>

    <!-- Formulario -->
    <div class="lg:col-span-2">
      <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-6 md:p-8">
        <h2 class="text-2xl font-bold">Formulario de contacto</h2>
        <p class="text-slate-600 mt-1 text-sm">Los campos marcados con <span class="text-red-500">*</span> son requeridos.</p>

        <?php if ($sent): ?>
          <div class="mt-6 rounded-lg bg-green-50 border border-green-200 text-green-800 p-4">
            Gracias <?= h($old['nombre'] ?: 'por escribirnos') ?>. Tu mensaje fue enviado. Te contactaremos a la brevedad.
          </div>
        <?php endif; ?>

        <?php if ($error): ?>
          <div class="mt-6 rounded-lg bg-red-50 border border-red-200 text-red-800 p-4">
            <?= h($error) ?>
          </div>
        <?php endif; ?>

        <ul id="form-errors" class="mt-4 hidden list-disc list-inside text-red-700 text-sm bg-red-50 border border-red-200 rounded-lg p-3"></ul>

        <form id="contact-form" method="POST" action="contacto.php" class="mt-6 grid md:grid-cols-2 gap-5">
          <div class="md:col-span-1">
            <label class="block text-sm font-medium text-slate-700 mb-1">Nombre <span class="text-red-500">*</span></label>
            <input type="text" name="nombre" value="<?= h($old['nombre']) ?>" required maxlength="120" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand focus:border-brand" />
          </div>
          <div class="md:col-span-1">
            <label class="block text-sm font-medium text-slate-700 mb-1">Correo electrónico <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="<?= h($old['email']) ?>" required maxlength="120" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand focus:border-brand" />
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-slate-700 mb-1">Asunto</label>
            <input type="text" name="asunto" value="<?= h($old['asunto']) ?>" maxlength="160" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand focus:border-brand" />
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-slate-700 mb-1">Mensaje <span class="text-red-500">*</span></label>
            <textarea name="mensaje" required rows="5" maxlength="2000" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand focus:border-brand"><?= h($old['mensaje']) ?></textarea>
          </div>
          <!-- honeypot -->
          <div class="hidden" aria-hidden="true">
            <label>Sitio web</label>
            <input type="text" name="website" tabindex="-1" autocomplete="off" />
          </div>
          <div class="md:col-span-2 flex items-center justify-between gap-4">
            <p class="text-xs text-slate-500">Al enviar, aceptas nuestro <a href="aviso.html" class="text-brand hover:underline">aviso de privacidad</a>.</p>
            <button type="submit" class="btn-brand px-6 py-3 rounded-lg font-semibold">Enviar mensaje</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<footer class="bg-slate-900 text-slate-300">
  <div class="container mx-auto max-w-7xl px-4 py-14 grid md:grid-cols-4 gap-10">
    <div class="md:col-span-2">
      <img src="assets/img/logo.png" alt="Video Accesos" class="h-12 md:h-14 w-auto" />
      <p class="mt-4 text-sm leading-relaxed max-w-md">Empresa innovadora especializada en soluciones de seguridad electrónica, control de acceso y monitoreo residencial. Con sede en Culiacán Rosales, Sinaloa.</p>
    </div>
    <div>
      <h4 class="text-white font-semibold mb-4">Navegación</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="nosotros.html" class="hover:text-white">Nosotros</a></li>
        <li><a href="productos.html" class="hover:text-white">Productos</a></li>
        <li><a href="servicios.html" class="hover:text-white">Servicios</a></li>
        <li><a href="contacto.php" class="hover:text-white">Contacto</a></li>
        <li><a href="aviso.html" class="hover:text-white">Aviso de Privacidad</a></li>
        <li><a href="terminos.html" class="hover:text-white">Términos y Condiciones</a></li>
      </ul>
    </div>
    <div>
      <h4 class="text-white font-semibold mb-4">Contacto</h4>
      <ul class="space-y-2 text-sm">
        <li>Av. Gral. Ramón Corona 122</li>
        <li>Col. Miguel Alemán, C.P. 80200</li>
        <li>Culiacán Rosales, Sinaloa</li>
        <li class="pt-2">+52 667 996 0606</li>
        <li>+52 667 263 9025</li>
        <li><a href="mailto:contacto@videoaccesos.net" class="hover:text-white">contacto@videoaccesos.net</a></li>
      </ul>
    </div>
  </div>
  <div class="border-t border-slate-800">
    <div class="container mx-auto max-w-7xl px-4 py-5 text-sm text-slate-400 flex flex-col md:flex-row justify-between gap-2">
      <p>&copy; <span id="y"></span> Video Accesos. Todos los derechos reservados.</p>
      <p>Culiacán Rosales, Sinaloa · México</p>
    </div>
  </div>
</footer>

<script>document.getElementById('y').textContent = new Date().getFullYear();</script>
<script src="assets/js/main.js"></script>
</body>
</html>
