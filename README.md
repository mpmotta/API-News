  oooooooo8 oooooooooo ooooo  oooo ooooooooo        oooo   oooo ooooooooooo oooo     oooo oooooooo8  
o888     88  888    888 888    88   888    88o       8888o  88   888    88   88   88  88 888         
888          888oooo88  888    88   888    888       88 888o88   888ooo8      88 888 88   888oooooo  
888o     oo  888  88o   888    88   888    888       88   8888   888    oo     888 888           888 
 888oooo88  o888o  88o8  888oo88   o888ooo88        o88o    88  o888ooo8888     8   8    o88oooo888  
                                                                                                     


API - Portal de Notícias (Backend PHP)

Esta é a documentação para a API backend do Portal de Notícias. A API é construída em PHP e fornece endpoints RESTful para o gerenciamento completo (CRUD) de notícias.

1. Visão Geral

A API permite que aplicações cliente (como um site front-end ou um aplicativo móvel) possam:

Listar todas as notícias.

Obter detalhes de uma notícia específica.

Criar uma nova notícia.

Atualizar uma notícia existente.

Remover uma notícia.

2. Estrutura de Dados (JSON)

O principal recurso gerenciado por esta API é a Noticia. A estrutura de dados utilizada para criar e retornar notícias segue o formato abaixo:

{
    "id": 1,
    "titulo": "Governo anuncia novo pacote de medidas econômicas",
    "noticia": "O ministério da economia detalhou hoje o novo pacote de medidas que visa estimular o crescimento.\n\nEspecialistas analisam o impacto das propostas no mercado financeiro e no dia a dia da população. A bolsa de valores reagiu positivamente nas primeiras horas do pregão.",
    "imagem": "no-image.jpg",
    "categoria": "Política",
    "data_postagem": "2025-11-14",
    "quem_postou": "Ana Pereira"
}


Campos:

id (int): Identificador único (gerado automaticamente).

titulo (string): O título principal da notícia.

noticia (text): O corpo completo da notícia (permite quebras de linha \n).

imagem (string): URL ou nome do arquivo da imagem de capa.

categoria (string): Categoria da notícia (ex: "Política", "Economia", "Esportes").

data_postagem (date): Data da publicação (gerada automaticamente no backend ou enviada).

quem_postou (string): Nome do autor ou jornalista.

3. Endpoints da API (CRUD)

Assumindo que a base da URL da API seja http://seuservidor.com/api/.

READ (Leitura)

1. Listar todas as Notícias

Retorna um array com todas as notícias cadastradas.

Endpoint: GET /noticias

Resposta (Sucesso 200 OK):

[
    {
        "id": 1,
        "titulo": "Governo anuncia novo pacote...",
        "noticia": "O ministério da economia detalhou...",
        "imagem": "no-image.jpg",
        "categoria": "Política",
        "data_postagem": "2025-11-14",
        "quem_postou": "Ana Pereira"
    },
    {
        "id": 2,
        "titulo": "Novo campeão de fórmula 1",
        "noticia": "O piloto X venceu a corrida de hoje...",
        "imagem": "f1-image.jpg",
        "categoria": "Esportes",
        "data_postagem": "2025-11-15",
        "quem_postou": "Carlos Silva"
    }
]


2. Obter uma Notícia Específica

Retorna os detalhes de uma única notícia com base no seu id.

Endpoint: GET /noticias/{id} (ex: /noticias/1)

Resposta (Sucesso 200 OK):

{
    "id": 1,
    "titulo": "Governo anuncia novo pacote...",
    "noticia": "O ministério da economia detalhou...",
    "imagem": "no-image.jpg",
    "categoria": "Política",
    "data_postagem": "2025-11-14",
    "quem_postou": "Ana Pereira"
}


Resposta (Erro 404 Not Found):

{
    "erro": "Notícia não encontrada."
}


CREATE (Criação)

3. Criar uma Nova Notícia

Adiciona uma nova notícia ao banco de dados.

Endpoint: POST /noticias

Corpo da Requisição (Body) (JSON):

O id não é enviado (será gerado pelo banco).

data_postagem é opcional (o backend pode definir o valor padrão como NOW()).

{
    "titulo": "Nova descoberta científica",
    "noticia": "Cientistas da universidade X anunciaram hoje...",
    "imagem": "science.jpg",
    "categoria": "Ciência",
    "quem_postou": "Mariana Costa"
}


Resposta (Sucesso 201 Created):

Retorna o objeto completo da notícia recém-criada, incluindo seu novo id.

{
    "id": 3,
    "titulo": "Nova descoberta científica",
    "noticia": "Cientistas da universidade X anunciaram hoje...",
    "imagem": "science.jpg",
    "categoria": "Ciência",
    "data_postagem": "2025-11-16",
    "quem_postou": "Mariana Costa"
}


UPDATE (Atualização)

4. Atualizar uma Notícia

Atualiza os dados de uma notícia existente. Recomenda-se o uso do método PUT para substituir o recurso completo ou PATCH para atualizações parciais. (Exemplo com PUT).

Endpoint: PUT /noticias/{id} (ex: /noticias/1)

Corpo da Requisição (Body) (JSON):

Envia todos os campos que devem ser atualizados.

{
    "titulo": "Governo REVISA pacote de medidas econômicas",
    "noticia": "Após reações do mercado, o ministério da economia revisou as medidas...",
    "categoria": "Economia"
}


(Nota: Neste exemplo, apenas titulo, noticia e categoria serão atualizados. Os outros campos (imagem, quem_postou) permanecerão os mesmos).

Resposta (Sucesso 200 OK):

Retorna o objeto completo da notícia atualizada.

{
    "id": 1,
    "titulo": "Governo REVISA pacote de medidas econômicas",
    "noticia": "Após reações do mercado, o ministério da economia revisou as medidas...",
    "imagem": "no-image.jpg",
    "categoria": "Economia",
    "data_postagem": "2025-11-14",
    "quem_postou": "Ana Pereira"
}


DELETE (Remoção)

5. Remover uma Notícia

Exclui uma notícia do banco de dados permanentemente.

Endpoint: DELETE /noticias/{id} (ex: /noticias/1)

Resposta (Sucesso 200 OK ou 204 No Content):

Pode retornar uma mensagem de sucesso ou simplesmente um código 204 (Sem conteúdo), indicando que a operação foi bem-sucedida.

{
    "mensagem": "Notícia (id: 1) removida com sucesso."
}


4. Pré-requisitos (Para rodar o projeto)

Servidor Web (Apache ou Nginx)

PHP (v8.0 ou superior)

Banco de Dados (MySQL, PostgreSQL, etc.)

(Opcional) Composer para gerenciamento de dependências.

5. Instalação

Clone este repositório: git clone [URL_DO_REPOSITORIO]

Navegue até a pasta do projeto.

Configure seu arquivo de conexão com o banco de dados (ex: config.php ou .env).

Importe a estrutura do banco de dados (use o arquivo database.sql, se fornecido).

Inicie seu servidor local.
