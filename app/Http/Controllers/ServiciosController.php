<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ServiciosController extends Controller
{
    public function mostrarPanel()
    {
        // 1. Geolocalización por IP (IP-API)
        $geoResponse = Http::get('http://ip-api.com/json/');
        $datosGeo = $geoResponse->json();

        // Extraemos latitud y longitud para el clima
        $lat = $datosGeo['lat'] ?? '20.65';
        $lon = $datosGeo['lon'] ?? '-103.34';

        // 2. Clima (Open-Meteo) usando la ubicación obtenida
        $climaResponse = Http::get("https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true");
        $datosClima = $climaResponse->json();

        // 3. Tipo de Cambio (Frankfurter) - USD a MXN
        $divisaResponse = Http::get('https://api.frankfurter.app/latest?from=USD&to=MXN');
        $datosDivisa = $divisaResponse->json();

        return view('servicios.informacion', compact('datosGeo', 'datosClima', 'datosDivisa'));
    }
}
