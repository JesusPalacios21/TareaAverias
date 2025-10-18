<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Avería</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8fafc;
      font-family: "Segoe UI", Roboto, sans-serif;
    }

    .card {
      max-width: 600px;
      margin: 50px auto;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .card-header {
      background-color: #0d6efd;
      color: #fff;
      font-weight: 600;
      text-align: center;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
      font-size: 1.3rem;
      padding: 15px;
    }

    .form-label {
      font-weight: 500;
      color: #333;
    }

    textarea {
      resize: none;
    }

    .btn-primary {
      width: 100%;
      font-weight: 500;
    }

    .btn-secondary {
      margin-top: 10px;
      width: 100%;
    }
  </style>
</head>

<body>

  <div class="card">
    <div class="card-header">
      <i class="bi bi-wrench-adjustable-circle"></i> Registrar Avería
    </div>
    <div class="card-body">
      <form action="/guardar" method="post">

        <div class="mb-3">
          <label for="cliente" class="form-label">Cliente</label>
          <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Nombre del cliente" required>
        </div>

        <div class="mb-3">
          <label for="problema" class="form-label">Problema</label>
          <textarea id="problema" name="problema" class="form-control" rows="4" placeholder="Describe el problema..." required></textarea>
        </div>

        <div class="mb-3">
          <label for="fechahora" class="form-label">Fecha y Hora del Problema</label>
          <input type="datetime-local" id="fechahora" name="fechahora" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
          <i class="bi bi-save2"></i> Guardar Avería
        </button>

        <a href="/listar/clientes" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Volver al Listado
        </a>

      </form>
    </div>
  </div>

</body>
</html>
