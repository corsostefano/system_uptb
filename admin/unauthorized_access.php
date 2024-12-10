<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso no autorizado</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ff6f61, #d6249f);
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .error-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        .error-container h1 {
            font-size: 4rem;
            font-weight: bold;
        }
        .error-container p {
            font-size: 1.2rem;
            margin: 15px 0;
        }
        .error-container a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            background: rgba(0, 0, 0, 0.3);
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .error-container a:hover {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>403</h1>
        <p>No tienes permiso para acceder a esta página.</p>
  
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
