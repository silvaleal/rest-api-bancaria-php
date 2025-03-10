# Slim Framework API Template

Este repositório fornece um template básico para desenvolvimento de APIs utilizando o Slim Framework.

## 📌 Requisitos

* PHP 8.0 ou superior
* Composer

## 🚀 Instalação

1. Clone este repositório:
   ```sh
   git clone https://github.com/silvaleal/slim4-template
   cd slim4-template
   ```
2. Instale as dependências:
   ```sh
   composer install
   ```
3. Prepare seu ambiente (.env):
   ```sh
   PROJECT_NAME="my_project"

   DB_TYPE="mysql"
   DB_HOST="localhost"
   DB_PORT="3306"
   DB_NAME="slim"
   DB_USER="root"
   DB_PASS=""
   ```

## ▶️ Uso

Para iniciar a API em um servidor local, execute:

```sh
php -S localhost:8000 -t public
```

A API estará disponível em `http://localhost:8000`.

## 📌 Rotas

### `GET /`

Retorna um JSON de boas-vindas personalizada.

#### Exemplo de resposta:

```json
{
  "message":"Api online"
}
```
### `GET /book/{id}`

Retorna um JSON com os dados do livro.

#### Exemplo de resposta:

```json
{
  "id":"1",
  "title": "a"
}
```
### `GET /books`

Retorna um JSON com todos os livros

#### Exemplo de resposta:

```json
[
   {
      "id":1,
      "title":"a"
   },
   {
      "id":2,
      "title":"b"
   }
]
```