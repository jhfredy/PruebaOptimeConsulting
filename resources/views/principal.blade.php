<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel Vue Js">
    <meta name="author" content="John Fredy Osorio">
    <meta name="keyword" content="Laravel Vue Js">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Prueba Oprime Consulting</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Escritorio</a>
            </li>
            
        </ul>
    </header>

    <div class="app-body">
        
        @include('plantilla.sidebar')
        <!-- Contenido Principal -->
        @yield('contenido')
        <!-- /Fin del contenido principal -->
    </div>   
    </div>
    <footer class="app-footer">
        <span class="ml-auto">Desarrollado por <a href="#">John Fredy Osorio Franco</a></span>
    </footer>
    

    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>