# Sistema Bancário (API)

API RESTful desenvolvida com **Slim Framework 4** para gerenciamento de usuários e transferências bancárias. É necessário passar um token no header em toda requisição.

**ATENÇÃO:** Esta api foi feito para estudos de headers, por causo disto, qualquer usuário ao colocar o token pode ter acesso a tudo, adicionar, remover ou ver os usuários.

## Tecnologias

- PHP 8+
- [Slim Framework 4](https://www.slimframework.com/)
- Composer

## Instalação

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

## Rotas

### Usuários


| Método | Rota                | Descrição                     |
| ------- | ------------------- | ------------------------------- |
| GET     | `/users`            | Lista todos os usuários        |
| GET     | `/user/{id}`        | Detalha um usuário específico |
| POST    | `/user/add/{id}`    | Adiciona um novo usuário       |
| POST    | `/user/remove/{id}` | Remove um usuário              |

### Transferências


| Método | Rota                    | Descrição                            |
| ------- | ----------------------- | -------------------------------------- |
| GET     | `/transfers`            | Lista todas as transferências         |
| GET     | `/transfer/{id}`        | Detalha uma transferência específica |
| POST    | `/transfer/add/{value}` | Cria uma nova transferência           |

### EXEMPLO DE PYTHON

```py
import requests
import json

# Código para registrar transferência de R$10,00
requi = requests.post('http://localhost:8000/transfer/add/10', headers={
    'Authorization': 'Bearer myToken',
})

print(requi.json(''))
```
