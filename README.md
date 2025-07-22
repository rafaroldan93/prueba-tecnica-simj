# Prueba técnica para Soluciones Informáticas MJ
### Expectativa
Se espera que el candidato proponga una solución realizada en el framework Laravel con PHP 8 o superior y con los estilos basados en Bootstrap 4. Debe usarse la plantilla AdminLTE 3 o similares para la base del diseño. (Se debe usar el sistema de plantillas Blade).
### Entregables
1. Etapa I: Instalación y configuración de un nuevo proyecto de Laravel con el sistema de autenticación por defecto de este framework (Inicio de Sesión y Registro) y base de datos MySQL / MariaDB.
2. Etapa II: Diseño de la interfaz de la aplicación con menú, cabecera y pie de página.
3. Etapa III: Realización de CRUD de usuarios para gestionar el acceso a la aplicación con campos como “Nombre”, “Email”, etc. (Diseño a gusto del usuario, funcionalidad mediante AJAX).
    - Se debe incluir un campo seleccionable de “Administrador” que permitirá funciones extra más adelante.
    - Insertar acceso desde el menú.
4. Etapa IV: Desarrollo de un sistema de control de tareas de proyectos basado en los siguientes puntos clave (Insertar también acceso desde el menú):
    1. Botón de añadir proyecto (No se contempla editar ni eliminar para esta prueba). Solo para usuarios “Administradores”. 
        - Se solicitará únicamente el nombre del proyecto mediante una ventana modal.
    2. Listado de proyectos ordenados por última fecha de uso con nombre del proyecto y usuario que lo ha creado, cargado mediante AJAX (Al añadir un nuevo proyecto, la lista se debe recargar automáticamente).
    3. Calendario al que se puedan arrastrar los proyectos para añadir información sobre su desarrollo (tarea) en un tramo en concreto para cada usuario de la aplicación. Por defecto el usuario seleccionado será en usuario que ha iniciado sesión. Una vez guardada la información se deberá cargar mediante AJAX las tareas del usuario seleccionado al calendario cada vez que se cambie de usuario o se entre a la página.
    4. Informe PDF de tareas agrupadas por proyectos con filtro de proyecto, fecha desde, fecha hasta y usuario que realizó la tarea. Se debe mostrar el tiempo de cada tarea y el global asignado al proyecto según los filtros.
5. Etapa V: Finalización de la prueba y presentación de la documentación.

### Puntos extra que se tendrán en cuenta:
- Tiempo de entrega.
- Uso del ORM de Laravel.
- UX / UI (Usabilidad y diseño ajustado a los anexos).
- Relaciones en Base de Datos y en modelos de Laravel.
- Organización del código fuente y documentación del proyecto.
- Memoria del proyecto presentada profesionalmente adjuntando breve manual de uso e información sobre el tipo de servidor web usado y entornos de programación con los que se ha desarrollado.