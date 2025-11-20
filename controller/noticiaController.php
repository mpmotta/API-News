<?php
require_once __DIR__ . '/../model/Noticia.php';

class noticiaController {

    public function index() {
        $noticiaModel = new Noticia();
        return $noticiaModel->consulta();
    }
    public function show($id) {
        $noticiaModel = new Noticia();
        return $noticiaModel->consultaID($id);
    }

    public function store($data) {
        $noticia = $this->popularnoticia($data);
        $noticiaModel = new Noticia();
        $noticiaModel->inserir($noticia);
    }

    // Método para atualizar DADOS (JSON)
    public function update($id, $data) {
        $noticia = $this->popularnoticia($data);
        $noticia->setId($id);
        $noticiaModel = new Noticia();
        $noticiaModel->editar($noticia, $id);
    }

    public function destroy($id) {
        $noticiaModel = new Noticia();
        $noticiaModel->excluir($id);
    }

    // --- Métodos de Filtro Completos ---
    public function filterByCategoria($categoria) {
        $noticiaModel = new Noticia();
        return $noticiaModel->consultaPorCategoria($categoria);
    }

    public function filterByTitulo($titulo) {
        $noticiaModel = new Noticia();
        // Você precisará criar 'consultaPorNome' no seu Model
        return $noticiaModel->consultaPorTitulo($titulo); 
    }


    public function filterByDataMenor($data) {
        $noticiaModel = new Noticia();
        // Você precisará criar 'consultaPorValorMenor' no seu Model
        return $noticiaModel->consultaPorDataMenor($data);
    }

    public function filterByDataMaior($data) {
        $noticiaModel = new Noticia();
        // Você precisará criar 'consultaPorValorMaior' no seu Model
        return $noticiaModel->consultaPorDataMaior($data);
    }

    // --- Fim dos Filtros ---

    private function popularnoticia($dados) {
        $noticia = new Noticia();
        $noticia->setTitulo($dados['nome'] ?? '');
        $noticia->setNoticia($dados['marca'] ?? '');
        $noticia->setCategoria($dados['categoria'] ?? '');
        return $noticia;
    }

   
    
}