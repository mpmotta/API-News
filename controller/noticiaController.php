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

    // Método para atualizar IMAGEM (FormData)
    public function updateImage($id, $files) {
        
        if (isset($files['imagem']) && $files['imagem']['error'] === UPLOAD_ERR_OK) {
            
            $nomeDoArquivo = $this->gerenciarUpload($files['imagem']); // Faz o upload

            try {
                $noticiaModel = new Noticia();
                $noticiaModel->atualizarImagem($id, $nomeDoArquivo); // Salva no banco
                
                return $nomeDoArquivo; 

            } catch (Exception $e) {
                throw new Exception("Falha ao ATUALIZAR O BANCO: " . $e->getMessage());
            }

        } else {
            throw new Exception("Nenhum arquivo 'imagem' foi recebido pelo backend.");
        }
    }

    // Método de upload
    private function gerenciarUpload($file) {
        if (!is_dir(UPLOAD_DIR_BACKEND)) {
            mkdir(UPLOAD_DIR_BACKEND, 0777, true); 
        }
        
        $extensao = pathinfo($file['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid() . '.' . $extensao; 
        $destino = UPLOAD_DIR_BACKEND . $novoNome;

        if (move_uploaded_file($file['tmp_name'], $destino)) {
            return $novoNome;
        } else {
            throw new Exception("Falha ao mover o arquivo de upload para o destino.");
        }
    }
}