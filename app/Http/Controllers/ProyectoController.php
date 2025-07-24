<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Tarea;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = User::all();
        $usuario_actual = $request->user();
        return view('proyectos', compact('usuarios', 'usuario_actual'));
    }

    public function list(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $proyectos = Proyecto::with('user')->where('user_id', $user_id)->latest()->get();
        return response()->json($proyectos);
    }

    // public function duration(User $user)
    // {
    //     return Proyecto::where('user_id', $user->id)
    //         ->whereNotNull('inicio')
    //         ->whereNotNull('fin')
    //         ->get()
    //         ->map(function ($proyecto) {
    //             return [
    //                 'id' => $proyecto->id,
    //                 'title' => $proyecto->nombre,
    //                 'start' => Carbon::parse($proyecto->inicio)->toIso8601String(),
    //                 'end' => Carbon::parse($proyecto->fin)->toIso8601String()
    //             ];
    //         });
    // }

    public function report(Request $request)
    {
        $usuario_id = $request->usuario_id;
        $proyecto_id = $request->proyecto_id;
        $inicio = $request->inicio ? Carbon::parse($request->inicio) : null;
        $fin = $request->fin ? Carbon::parse($request->fin)->endOfDay() : null;

        $tareas = Tarea::query()
            ->when($usuario_id, fn($q) => $q->where('user_id', $usuario_id))
            ->when($proyecto_id, fn($q) => $q->where('proyecto_id', $proyecto_id))
            ->when($inicio, fn($q) => $q->where('inicio', '>=', $inicio))
            ->when($fin, fn($q) => $q->where('fin', '<=', $fin))
            ->with('user')
            ->get();

        $datos = $tareas->map(function ($tarea) {
            $minutos = $tarea->inicio && $tarea->fin
                ? Carbon::parse($tarea->inicio)->diffInMinutes(Carbon::parse($tarea->fin))
                : 0;

            return [
                'nombre' => $tarea->proyecto->nombre,
                'descripcion' => $tarea->descripcion,
                'inicio' => $tarea->inicio,
                'fin' => $tarea->fin,
                'usuario' => $tarea->user->name ?? '—',
                'minutos' => $minutos,
            ];
        });

        $datos_agrupados = $datos->groupBy('nombre');

        $pdf = Pdf::loadView('informe', [
            'proyectos' => $datos_agrupados,
            'filtros' => compact('usuario_id', 'proyecto_id', 'inicio', 'fin')
        ]);

        return $pdf->stream('informe_proyectos.pdf');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255'
            ]);

            $validated['user_id'] = $request->user()->id;

            Proyecto::create($validated);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el proyecto: ' . $e->getMessage()], 500);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $proyecto = Proyecto::findOrFail($id);

    //     $validated = $request->validate([
    //         'nombre' => 'sometimes|string|max:255',
    //         'inicio' => 'sometimes|date',
    //         'fin' => 'sometimes|date',
    //         'descripcion' => 'sometimes|string|max:1000'
    //     ]);

    //     $proyecto->update($validated);

    //     return response()->json(['success' => true, 'proyecto' => $proyecto]);
    // }
}
