<!DOCTYPE html>
<html lang="es">
<head>
    <title>Entrar a Yumly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center p-5 shadow rounded" style="width: 450px;">
        <h2>Bienvenido a Yumly</h2>
        <p>Inicia sesión para gestionar tus recetas</p>
        <hr>

        @if ($errors->any())
            <div class="alert alert-danger text-start">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="mb-4">
            @csrf
            
            <div class="mb-3 text-start">
                <label for="correo" class="form-label">Correo Electrónico:</label>
                <input type="email" name="correo" class="form-control" id="correo" required value="{{ old('correo') }}">
            </div>

            <div class="mb-3 text-start">
                <label for="contraseña" class="form-label">Contraseña:</label>
                <input type="password" name="contraseña" class="form-control" id="contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>

        <div class="mb-3 text-muted">o también puedes</div>

        <a href="{{ url('/auth/google') }}" class="btn btn-outline-danger w-100">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" width="20" class="me-2">
            Iniciar sesión con Google
        </a>
    </div>
</body>
</html>