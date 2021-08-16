<?php

    global $routes;
    $routes = [
        '/galeria/{id}' => '/galeria/abrir/:id',
        //'/galeria/{id}/{titulo}' => '/galeria/abrir/:id/:titulo',
        '/news/{id}' => '/noticia/abrir/:id',
        '/home' => '/home/index',
        //'/{titulo}' => '/noticia/abrirTitulo/:titulo'
    ];
