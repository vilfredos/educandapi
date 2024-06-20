<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Importar la clase Str

class LTIService
{
    public function validateLTIRequest(Request $request)
    {
        // Validar la solicitud LTI (aquí podrías usar librerías como IMSGlobal\LTI)
        $consumer_key = env('LTI_CONSUMER_KEY');
        $shared_secret = env('LTI_SHARED_SECRET');

        // Aquí validarías la firma de la solicitud
        // Retorna true si la solicitud es válida, false si no lo es

        return true; // Simplificado para ejemplo
    }

    public function findOrCreateUser(Request $request)
    {
        // Extraer información del usuario de la solicitud LTI
        $email = $request->input('lis_person_contact_email_primary');
        $name = $request->input('lis_person_name_full');

        // Buscar o crear el usuario en la base de datos
        $user = User::firstOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make(Str::random(16))] // Usar Str::random()
        );

        return $user;
    }
}