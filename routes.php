<?php
// Caminho para o diretório de upload
// Ajuste este caminho se necessário.
define('UPLOAD_DIR_BACKEND', $_SERVER['DOCUMENT_ROOT'] . '/Front-Loja/img/');

return [
    ['GET',    ['noticias'],                           'index',                 0],
    ['GET',    ['noticias', '{id}'],                    'show',                  1],
    ['POST',   ['noticias'],                           'store',                 0],
    
    // Rota de DADOS (JSON)
    ['PUT',    ['noticias', '{id}'],                    'update',                1],
    
    // Rota de IMAGEM (FormData)
    ['POST',   ['noticias', '{id}'],                   'updateImage',           1], 
    
    ['DELETE', ['noticias', '{id}'],                    'destroy',               1],

    // --- Suas rotas de filtro ---
    ['GET',    ['noticias', 'categoria', '{categoria}'], 'filterByCategoria',     1],
    ['GET',    ['noticias', 'titulo', '{titulo}'],          'filterByTitulo',          1],
    ['GET',    ['noticias', 'dataMenor', '{valor}'],   'filterByDataMenor',    1],
    ['GET',    ['noticias', 'dataMaior', '{valor}'],   'filterByDataMaior',    1],
];