<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LTIService;
use Illuminate\Support\Facades\Auth;

class LTIController extends Controller
{
    protected $ltiService;

    public function __construct(LTIService $ltiService)
    {
        $this->ltiService = $ltiService;
    }

    public function launch(Request $request)
    {
        // Verificar la solicitud LTI
        $valid = $this->ltiService->validateLTIRequest($request);

        if ($valid) {
            // Crear o autenticar al usuario en Laravel
            $user = $this->ltiService->findOrCreateUser($request);

            // Loguear al usuario
            Auth::login($user);

            // Redirigir al usuario a la página principal
            return redirect('/home');
        }

        return response('Invalid LTI request', 400);
    }
}