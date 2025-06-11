<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bem-vindo à Nossa Empresa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css"> 

</head>

<body class="<?php echo (isset($_COOKIE['modo']) && $_COOKIE['modo'] === 'dark') ? 'dark-mode' : ''; ?>">
  <?php include 'includes/menu.php'; ?>
 
  <main>
    <header class="bg-primary text-white text-center py-5">
      <div class="container">
        <h1>Bem-vindo à Nossa Empresa</h1>
        <p class="lead">Inovando com qualidade e compromisso desde 2024</p>
      </div>
    </header>

    <section class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <h2>Quem Somos</h2>
          <p>Somos uma empresa dedicada a oferecer os melhores produtos e serviços aos nossos clientes. Com uma equipe especializada e apaixonada pelo que faz, buscamos sempre a excelência em cada projeto.</p>
        </div>
        <div class="col-md-6">
   
        </div>
      </div>
    </section>

    <section class="text-section">
      <div class="container text-center">
        <h2>Nossos Valores</h2>
        <p>Compromisso, inovação, ética e qualidade.</p>
      </div>
    </section>
  </main>

  <?php include('includes/footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggle = document.getElementById('toggle-dark');
      const body = document.body;

      if (localStorage.getItem('modo') === 'dark') {
        body.classList.add('dark-mode');
        document.cookie = "modo=dark; path=/";
      }

      if (toggle) {
        toggle.addEventListener('click', function () {
          body.classList.toggle('dark-mode');
          const modo = body.classList.contains('dark-mode') ? 'dark' : 'light';
          localStorage.setItem('modo', modo);
          document.cookie = "modo=" + modo + "; path=/";
        });
      }
    });
  </script>
</body>
</html>
