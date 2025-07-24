@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Proyectos')
@section('content_header_title', 'Proyectos')

{{-- Content body: main page content --}}

@section('content_body')

    <div class="row">
        <div class="col-md-4">
            <button class="btn btn-success" id="btnCrearProyecto">
                <i class="fas fa-plus"></i> Crear proyecto
            </button>
            <button class="btn btn-success" id="btnCrearInforme">
                <i class="fas fa-plus"></i> Crear informe
            </button>
            @include('components.modal_crear_proyecto')
            @include('components.modal_crear_informe')
            <div class="external-events" id="listaProyectos"></div>
        </div>
        <div class="col-md-8">
            <label class="text-secondary" for="selectorUsuario">Selector de usuario:</label>
            <select class="form-select mb-3" id="selectorUsuario">
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $usuario->id == $usuario_actual->id ? 'selected' : '' }}>
                        {{ $usuario->name }}
                    </option>
                @endforeach
            </select>
            <div class="rounded bg-white" id="calendar"></div>
        </div>
    </div>
    @include('components.modal_crear_tarea')
@stop

{{-- Push extra CSS --}}

@push('css')
    <style>
        .external-events {
            padding: 10px;
            max-height: 500px;
            overflow-y: auto;
        }

        .fc-event {
            cursor: move;
        }
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
    @vite('resources/js/proyectos.js')
@endpush
