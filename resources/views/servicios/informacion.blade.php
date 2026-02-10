@extends('layouts.plantilla')

@section('contenido')
<div class="container mt-4">
    <h2 class="text-orange mb-4"><i class="fas fa-globe"></i> Información en Tiempo Real</h2>

    <div class="text-center mb-4">
    <div class="badge bg-dark p-3" style="font-size: 1.2rem; border-radius: 50px;">
        <i class="fas fa-clock"></i> Hora de consulta: 
        <span id="reloj-vivo">Cargando hora...</span>
    </div>
</div>

<script>
    function actualizarReloj() {
        const ahora = new Date();
        // Formateamos la hora para que siempre tenga 2 dígitos (ej: 09:05:01)
        const horas = String(ahora.getHours()).padStart(2, '0');
        const minutos = String(ahora.getMinutes()).padStart(2, '0');
        const segundos = String(ahora.getSeconds()).padStart(2, '0');
        
        const tiempoString = `${horas}:${minutos}:${segundos}`;
        document.getElementById('reloj-vivo').textContent = tiempoString;
    }

    // Ejecutar la función cada segundo (1000 milisegundos)
    setInterval(actualizarReloj, 1000);
    
    // Llamarla de inmediato para que no espere el primer segundo
    actualizarReloj();
</script>
    

        <div class="col-md-4">
            <div class="card shadow-sm border-primary mb-3">
                <div class="card-header bg-primary text-white">Tu Ubicación</div>
                <div class="card-body">
                    <p><strong>País:</strong> {{ $datosGeo['country'] }}</p>
                    <p><strong>Ciudad:</strong> {{ $datosGeo['city'] }}</p>
                    <p><strong>IP:</strong> {{ $datosGeo['query'] }}</p>
                    <p><strong>ISP:</strong> {{ $datosGeo['isp'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-info mb-3">
                <div class="card-header bg-info text-white">Clima Local</div>
                <div class="card-body text-center">
                    <h1 class="display-4">{{ $datosClima['current_weather']['temperature'] }}°C</h1>
                    <p>Velocidad del viento: {{ $datosClima['current_weather']['windspeed'] }} km/h</p>
                    <small class="text-muted">Lat: {{ $datosClima['latitude'] }}, Lon: {{ $datosClima['longitude'] }}</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-success mb-3">
                <div class="card-header bg-success text-white">Tipo de Cambio</div>
                <div class="card-body text-center">
                    <h5>1 USD =</h5>
                    <h2 class="text-success">${{ number_format($datosDivisa['rates']['MXN'], 2) }} MXN</h2>
                    <p class="small text-muted">Datos actualizados de Frankfurter API</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection