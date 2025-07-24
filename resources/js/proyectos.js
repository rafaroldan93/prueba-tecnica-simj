import { Calendar } from '@fullcalendar/core'
import { Draggable } from '@fullcalendar/interaction'
import interactionPlugin from '@fullcalendar/interaction'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'

document.addEventListener('DOMContentLoaded', function () {
    const modalNuevoProyecto = new bootstrap.Modal(document.getElementById('modalCrearProyecto'))
    const modalCrearTarea = new bootstrap.Modal(document.getElementById('modalCrearTarea'))
    const modalCrearInforme = new bootstrap.Modal(document.getElementById('modalCrearInforme'))
    const formCrearTarea = document.getElementById('formCrearTarea')
    const formCrearProyecto = document.getElementById('formCrearProyecto')
    const formCrearInforme = document.getElementById('formCrearInforme')
    const selectorUsuario = document.getElementById('selectorUsuario')

    function cargarProyectos () {
        fetch(`/proyectos/lista`)
            .then(response => response.json())
            .then(proyectos => {
                const lista = document.getElementById('listaProyectos')
                const selectProyecto = document.getElementById('selectProyecto')
                lista.innerHTML = proyectos.length === 0 ? '<p>Sin proyectos para mostrar</p>' : ''
                selectProyecto.innerHTML = '<option value="">Todos los proyectos</option>'
                proyectos.forEach(proyecto => {
                    const elementoLista = document.createElement('div')
                    elementoLista.classList.add('fc-event', 'bg-info', 'p-2', 'mb-2', 'rounded')
                    elementoLista.setAttribute('data-id', proyecto.id)
                    elementoLista.setAttribute('data-nombre', proyecto.nombre)
                    elementoLista.textContent = `${proyecto.nombre} - ${proyecto.user.name}`
                    elementoLista.setAttribute('draggable', 'true')
                    lista.appendChild(elementoLista)

                    const option = document.createElement('option')
                    option.value = proyecto.id
                    option.textContent = proyecto.nombre
                    selectProyecto.appendChild(option)
                })
            })
    }

    cargarProyectos()

    document.getElementById('btnCrearProyecto').addEventListener('click', function () {
        formCrearProyecto.reset()
        modalNuevoProyecto.show()
    })

    document.getElementById('btnCrearInforme').addEventListener('click', function () {
        formCrearInforme.reset()
        modalCrearInforme.show()
    })

    formCrearProyecto.addEventListener('submit', e => {
        e.preventDefault()
        const data = {
            nombre: formCrearProyecto.nombre.value
        }
        fetch(`/proyectos`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                modalNuevoProyecto.hide()
                cargarProyectos()
            })
    })

    formCrearInforme.addEventListener('submit', e => {
        e.preventDefault()
        const params = new URLSearchParams({
            proyecto_id: formCrearInforme.selectProyecto.value,
            usuario_id: formCrearInforme.selectUsuario.value,
            inicio: formCrearInforme.fecha_inicio_informe.value,
            fin: formCrearInforme.fecha_fin_informe.value,
        })

        window.open(`/proyectos/informe?${params.toString()}`, '_blank')
        console.log(`/proyectos/informe?${params.toString()}`)
    })

    let dropInfo = null
    const calendarEl = document.getElementById('calendar')
    let calendar = new Calendar(calendarEl, {
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin],
        initialView: 'dayGridMonth',
        timeZone: 'local',
        droppable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        events: function (fetchInfo, successCallback, failureCallback) {
            const userId = selectorUsuario.value
            fetch(`/proyectos/duracion/${userId}`)
                .then(response => response.json())
                .then(data => successCallback(data))
                .catch(error => failureCallback(error))
        },
        drop: function (info) {
            dropInfo = info

            const proyectoId = info.draggedEl.getAttribute('data-id')

            const date = new Date(info.date)
            const offset = date.getTimezoneOffset()
            const localDate = new Date(date.getTime() - offset * 60 * 1000)
            const formattedDate = localDate.toISOString().slice(0, 16)

            document.getElementById('proyecto_id').value = proyectoId
            document.getElementById('inicio_tarea').value = formattedDate
            document.getElementById('fin_tarea').value = ''
            document.getElementById('descripcion_tarea').value = ''

            modalCrearTarea.show()
        }
    })

    calendar.render()

    selectorUsuario.addEventListener('change', function () {
        calendar.refetchEvents()
    })

    document.getElementById('modalCrearTarea').addEventListener('hidden.bs.modal', function () {
        calendar.refetchEvents()
    })

    formCrearTarea.addEventListener('submit', function (e) {
        e.preventDefault()

        const proyecto_id = document.getElementById('proyecto_id').value
        const inicio = document.getElementById('inicio_tarea').value
        const fin = document.getElementById('fin_tarea').value
        const descripcion = document.getElementById('descripcion_tarea').value

        const data = {
            proyecto_id,
            inicio,
            fin,
            descripcion
        }

        fetch(`/proyectos/nueva_tarea`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    const existingEvent = calendar.getEventById(proyecto_id)
                    if (existingEvent) {
                        existingEvent.remove()
                    }

                    calendar.addEvent({
                        id: proyecto_id,
                        title: dropInfo.draggedEl.getAttribute('data-nombre'),
                        start: inicio,
                        end: fin,
                        allDay: false
                    })

                    modalCrearTarea.hide()

                    alert('Tarea creada correctamente.')
                } else {
                    alert(`Error al crear la tarea: ${response.message}`)
                }
            })
            .catch(() => alert(`Error al crear la tarea: ${response.message}`))
    })

    new Draggable(document.getElementById('listaProyectos'), {
        itemSelector: '.fc-event',
        eventData: function (eventEl) {
            return {
                title: eventEl.getAttribute('data-nombre'),
                id: eventEl.getAttribute('data-id')
            }
        }
    })
})