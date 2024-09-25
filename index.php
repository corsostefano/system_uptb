<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Universidad Ejemplo</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Estilos personalizados */
    .hero {
      background-image: url('tu-imagen-hero.jpg');
      background-size: cover;
      background-position: center;
      height: 75vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    }
    .hero h1 {
      font-size: 3rem;
    }
    .hero p {
      font-size: 1.25rem;
    }
    .info-box {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .login-section {
      background-color: #007bff;
      color: white;
      padding: 50px 0;
      text-align: center;
    }
    .login-section h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }
    .login-section .btn {
      width: 100%;
      max-width: 300px;
    }
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }
      .hero p {
        font-size: 1rem;
      }
      .login-section h2 {
        font-size: 2rem;
      }
      .info-box h4 {
        font-size: 1.5rem;
      }
      .login-section {
        padding: 30px 0;
      }
    }
    @media (max-width: 390px) {
      .hero {
        height: 60vh;
      }
      .hero h1 {
        font-size: 1.5rem;
      }
      .hero p {
        font-size: 0.9rem;
      }
      .btn {
        font-size: 0.9rem;
        padding: 10px 15px;
      }
      .login-section h2 {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>

  <!-- Barra de navegación -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Universidad Ejemplo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Carreras</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Noticias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sección Hero -->
  <div class="hero text-center">
    <div class="container">
      <h1>Bienvenido a la Universidad Ejemplo</h1>
      <p>Tu futuro comienza aquí</p>
      <a href="#informacion" class="btn btn-primary">Más Información</a>
    </div>
  </div>

  <!-- Sección de información -->
  <section id="informacion" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="info-box">
            <h4>Carreras</h4>
            <p>Explora las diversas carreras que ofrecemos para formarte como un profesional de éxito.</p>
            <a href="#" class="btn btn-outline-primary">Ver más</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-box">
            <h4>Noticias</h4>
            <p>Mantente informado sobre los eventos y novedades de nuestra universidad.</p>
            <a href="#" class="btn btn-outline-primary">Ver más</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-box">
            <h4>Contacto</h4>
            <p>Estamos aquí para ayudarte. Contáctanos para más información sobre admisiones y programas.</p>
            <a href="#" class="btn btn-outline-primary">Contactar</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección con JavaScript interactivo -->
  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Encuentra tu carrera ideal</h2>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <form id="carreraForm">
            <div class="mb-3">
              <label for="interes" class="form-label">¿Cuál es tu área de interés?</label>
              <select class="form-select" id="interes" required>
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="tecnologia">Tecnología</option>
                <option value="ciencias">Ciencias</option>
                <option value="humanidades">Humanidades</option>
                <option value="negocios">Negocios</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="nivel" class="form-label">¿Cuál es tu nivel de estudios?</label>
              <select class="form-select" id="nivel" required>
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="pregrado">Pregrado</option>
                <option value="postgrado">Postgrado</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Buscar carreras</button>
          </form>
          <div id="resultado" class="mt-4"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Nueva Sección: Ingresar al Sistema -->
  <section class="login-section">
    <div class="container">
      <h2>Accede a tu Cuenta</h2>
      <p>Estudiantes y profesores pueden acceder a su cuenta para gestionar actividades académicas.</p>
      <a href="login.html" class="btn btn-light btn-lg">Ingresar al Sistema</a>
    </div>
  </section>

  <!-- Pie de página -->
  <footer class="bg-dark text-light text-center py-3">
    <p>&copy; 2024 Universidad Ejemplo. Todos los derechos reservados.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- JavaScript Interactivo -->
  <script>
    document.getElementById('carreraForm').addEventListener('submit', function(event) {
      event.preventDefault();
      
      const interes = document.getElementById('interes').value;
      const nivel = document.getElementById('nivel').value;
      const resultadoDiv = document.getElementById('resultado');
      
      let resultado = '';

      if (interes && nivel) {
        resultado = `Basado en tu interés en ${interes} y tu nivel de estudios (${nivel}), te recomendamos explorar nuestras carreras disponibles.`;
      } else {
        resultado = 'Por favor selecciona todas las opciones para obtener una recomendación.';
      }

      resultadoDiv.textContent = resultado;
    });
  </script>
  
</body>
</html>
