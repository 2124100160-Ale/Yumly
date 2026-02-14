<!DOCTYPE html>
<html lang="es">
<head>
    <title>Entrar a Yumly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center p-5 shadow rounded">
        <h2>Bienvenido a Yumly</h2>
        <p>Inicia sesión para gestionar tus recetas</p>
        <hr>
        <a href="{{ url('/auth/google') }}" class="btn btn-outline-danger btn-lg">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" width="20" class="me-2">
            Iniciar sesión con Google
        </a>
    </div>
</body>
</html>