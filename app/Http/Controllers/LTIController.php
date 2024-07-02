<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ceLTIc\LTI\Tool;

class LTIController extends Controller
{
    protected $tool;

    public function __construct()
    {
        // Inicialización de $this->tool
    }

    public function launch(Request $request)
    {
        Log::info('Datos de lanzamiento LTI recibidos:', $request->all());

        if ($this->tool->handleRequest()) {
            $userId = $request->input('user_id');
            $contextId = $request->input('context_id');

            return view('lti.launch', [
                'userId' => $userId,
                'contextId' => $contextId,
            ]);
        } else {
            Log::error('Lanzamiento LTI inválido');
            return response('Lanzamiento LTI no válido', 401);
        }
    }
}