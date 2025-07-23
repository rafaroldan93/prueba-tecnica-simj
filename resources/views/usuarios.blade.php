@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Usuarios')
@section('content_header_title', 'Usuarios')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="mb-3">
        <button class="btn btn-success" id="btnCrearUsuario">
            <i class="fas fa-user-plus"></i> Nuevo Usuario
        </button>
    </div>

    <table class="table-borderless table-hover table-light table rounded" id="tablaUsuarios">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    @include('components.modal_usuario')
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabla = document.querySelector('#tablaUsuarios tbody')
            const modal = new bootstrap.Modal(document.getElementById('modalUsuario'))
            const form = document.getElementById('formUsuario')

            function editarUsuario(id) {
                fetch(`/usuarios/${id}`)
                    .then(res => res.json())
                    .then(user => {
                        form.reset()
                        document.getElementById('usuarioId').value = user.id
                        document.getElementById('name').value = user.name
                        document.getElementById('email').value = user.email
                        document.getElementById('is_admin').checked = user.is_admin
                        document.getElementById('password').required = false
                        document.getElementById('modalTitulo').textContent = 'Editar usuario'
                        modal.show()
                    })
            }

            function eliminarUsuario(id) {
                if (!confirm("¿Eliminar este usuario?")) return
                fetch(`/usuarios/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(() => cargarUsuarios())
            }

            function cargarUsuarios() {
                fetch('/usuarios/lista')
                    .then(res => res.json())
                    .then(usuarios => {
                        tabla.innerHTML = ''
                        usuarios.forEach(user => {
                            tabla.innerHTML += `
                        <tr>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>
                                <span class="badge bg-${user.is_admin ? 'success' : 'secondary'}">
                                    ${user.is_admin ? 'Sí' : 'No'}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-editar" data-id="${user.id}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger btn-eliminar" data-id="${user.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>`

                            tabla.querySelectorAll('.btn-eliminar').forEach(btn => {
                                btn.addEventListener('click', e => {
                                    const id = e.currentTarget.dataset.id;
                                    eliminarUsuario(id);
                                });
                            });

                            tabla.querySelectorAll('.btn-editar').forEach(btn => {
                                btn.addEventListener('click', e => {
                                    const id = e.currentTarget.dataset.id;
                                    editarUsuario(id);
                                });
                            });
                        })
                    })
            }

            document.getElementById('btnCrearUsuario').addEventListener('click', () => {
                form.reset()
                document.getElementById('usuarioId').value = ''
                document.getElementById('password').required = true
                document.getElementById('modalTitulo').textContent = 'Crear usuario'
                modal.show()
            })

            form.addEventListener('submit', e => {
                e.preventDefault()
                const id = form.usuarioId.value
                const data = {
                    name: form.name.value,
                    email: form.email.value,
                    is_admin: form.is_admin.checked ? 1 : 0,
                }
                if (form.password.value) {
                    data.password = form.password.value
                }

                const method = id ? 'PUT' : 'POST'
                const url = id ? `/usuarios/${id}` : `/usuarios`

                fetch(url, {
                    method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(() => {
                    modal.hide()
                    cargarUsuarios()
                })
            })

            cargarUsuarios()
        })
    </script>
@endpush
