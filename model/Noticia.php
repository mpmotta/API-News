<?php
require_once __DIR__ . '/../config.php';

class Noticia {
    private $pdo;
    private $tabela = 'noticias';

    // Propriedades
    private $id;
    private $titulo;
    private $categoria;
    private $noticia;
    private $dataPostagem;
    private $quemPostou;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function consulta() {
        $sql = "SELECT * FROM $this->tabela";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function consultaID($id) {
        $sql = "SELECT * FROM $this->tabela WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Inserir (sem imagem)
    public function inserir(Noticia $noticia) {
        $sql = "INSERT INTO $this->tabela (titulo, noticia, imagem, categoria, quemPostou)
                VALUES (:titulo, :noticia, 'no-image.jpg', :categoria, :quemPostou)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':titulo', $noticia->getTitulo(), PDO::PARAM_STR);
        $stmt->bindParam(':noticia', $noticia->getNoticia(), PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $noticia->getCategoria(), PDO::PARAM_STR);
        $stmt->bindParam(':quemPostou', $noticia->getquemPostou());
        return $stmt->execute();
    }

    // Editar (só dados, sem imagem)
    public function editar(Noticia $noticia, $id) {
        $sql = "UPDATE $this->tabela SET 
                    titulo = :titulo, 
                    noticia = :noticia, 
                    categoria = :categoria, 
                    quemPostou = :quemPostou, 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':titulo', $noticia->getTitulo(), PDO::PARAM_STR);
        $stmt->bindParam(':noticia', $noticia->getNoticia(), PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $noticia->getCategoria(), PDO::PARAM_STR);
        $stmt->bindParam(':quemPostou', $noticia->getQuemPostou());
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    // Atualizar (só imagem)
    public function atualizarImagem($id, $nomeImagem) {
        $sql = "UPDATE $this->tabela SET imagem = :imagem WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':imagem', $nomeImagem, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluir($id) {
        $sql = "DELETE FROM $this->tabela WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    // --- Métodos de Filtro Completos ---
    
    public function consultaPorCategoria($categoria) {
        $sql = "SELECT * FROM $this->tabela WHERE categoria = :categoria";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function consultaPorTitulo($titulo) {
        $sql = "SELECT * FROM $this->tabela WHERE nome LIKE :titulo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':titulo', '%' . $titulo . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function consultaPorDataMenor($data) {
        $sql = "SELECT * FROM $this->tabela WHERE data_postagem < :data";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':data', $data);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function consultaPorDataMaior($data) {
        $sql = "SELECT * FROM $this->tabela WHERE data_postagem < :data";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':data', $data);
        $stmt->execute();
        return $stmt->fetchAll();
    }

  
    // --- Fim dos Filtros ---


    // Getters e setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getTitulo() { return $this->titulo; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function getNoticia() { return $this->noticia; }
    public function setNoticia($noticia) { $this->noticia = $noticia; }
    public function getCategoria() { return $this->categoria; }
    public function setCategoria($categoria) { $this->categoria = $categoria; }
    public function getDataPostagem() { return $this->dataPostagem; }
    public function getQuemPostou() { return $this->quemPostou; }
    public function setQuemPostou($quemPostou) { $this->quemPostou = $quemPostou; }
}