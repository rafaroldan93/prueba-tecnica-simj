<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Técnica SIMJ</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            display: grid;
            grid-template-rows: auto 1fr auto;
            height: 100dvh;
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #122f6d;
            color: #fff;
            padding: 2rem 0;
            text-align: center;
        }

        main {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            max-width: 600px;
            margin: 2rem auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            padding: 2rem;
        }

        h1 {
            margin: 0 0 1rem 0;
            font-size: 2.5rem;
            font-weight: 700;
        }

        p {
            color: #334155;
            font-size: 1.1rem;
        }

        .btn {
            display: inline-block;
            background-color: #122f6d;
            color: #fff;
            padding: 0.75rem 2rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 700;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #1d4ed8;
        }

        footer {
            text-align: center;
            color: #64748b;
            margin: 2rem 0 1rem 0;
            font-size: 0.95rem;

            a {
                color: #64748b;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Prueba Técnica SIMJ</h1>
    </header>
    <main>
        <section>
            <h2>Bienvenido</h2>
            <p>
                Esta landing es el punto de inicio para la prueba técnica.
            </p>
            <p>
                Explora las funcionalidades implementadas y revisa el código para conocer la lógica y la arquitectura utilizadas.
            </p>
            <p>
                Si tienes alguna duda o necesitas más información, no dudes en contactarme: <a
                    href="mailto:rafaelroldan@protonmail.com">rafaelroldan@protonmail.com</a>
            </p>
        </section>
        <section>
            <a class="btn" href="{{ route('login') }}">Iniciar sesión</a>
            <a class="btn" href="{{ route('register') }}" style="margin-left:1rem;">Registrarse</a>
        </section>
    </main>
    <footer>
        &copy; {{ date('Y') }} <a class="text-reset" href="https://www.linkedin.com/in/rafaroldan93/" target="_blank">Rafael Roldán</a> · Este código es
        parte de una prueba
        técnica. No está permitido su uso ni su distribución para otro fin que no
        sea esta misma prueba.
    </footer>
</body>

</html>
