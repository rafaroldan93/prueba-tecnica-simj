<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'proyecto_id' => 'required|exists:proyectos,id',
                'inicio' => 'sometimes|date',
                'fin' => 'sometimes|date',
                'descripcion' => 'sometimes|string|max:1000'
            ]);

            $validated['user_id'] = $request->user()->id;
            $tarea = Tarea::create($validated);

            return response()->json([
                'success' => true,
                'tarea' => $tarea
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la tarea: ' . $e->getMessage()], 500);
        }
    }

    public function list($user_id)
    {
        $tareas = Tarea::whereHas('proyecto', fn($q) => $q->where('user_id', $user_id))
            ->whereNotNull('inicio')
            ->whereNotNull('fin')
            ->get();

        return $tareas->map(function ($tarea) {
            return [
                'id' => $tarea->id,
                'title' => $tarea->proyecto->nombre,
                'start' => Carbon::parse($tarea->inicio)->toIso8601String(),
                'end' => Carbon::parse($tarea->fin)->toIso8601String(),
                'descripcion' => $tarea->descripcion,
                'proyecto_id' => $tarea->proyecto_id,
            ];
        });
    }
}
