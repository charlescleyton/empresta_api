# API de Simulação de Empréstimos

Bem-vindo à **API de Simulação de Empréstimos**! 🎉 Essa é uma API REST feita com PHP e Laravel para ajudar a simular empréstimos de forma prática. Com ela, você pode listar instituições financeiras, convênios (como INSS ou Siape) e fazer simulações de empréstimo informando o valor desejado, número de parcelas e, se quiser, filtrar por instituições ou convênios. Tudo isso usando arquivos JSON, sem precisar de banco de dados.

## O que essa API faz?

-   **Lista instituições**: Mostra as instituições disponíveis (ex.: Pan, Bmg, Ole).
-   **Lista convênios**: Exibe os convênios disponíveis (ex.: INSS, Federal, Siape).
-   **Simula empréstimos**: Calcula o valor das parcelas com base no valor solicitado e em coeficientes pré-definidos.

## Pré-requisitos

Essa aplicação foi constrída usando os seguintes requisitos:

-   PHP 8.4
-   Composer (para instalar dependências)
-   Laravel 12

## Como instalar

1. **Baixe o projeto**:
   Clone o repositório do GitHub:

    ```bash
    git clone https://github.com/charlescleyton/empresta_api.git
    cd empresta_api
    ```

2. **Instale as dependências**:
   Use o Composer para instalar tudo que a API precisa:

    ```bash
    composer install
    ```

3. **Rode a API**:
   Inicie o servidor de desenvolvimento:
    ```bash
    php artisan serve
    ```
    A API estará disponível em `http://localhost:8000`.

## Como usar a API

A API tem três endpoints principais. Você pode testá-los usando ferramentas como Postman ou Insomnia.

### 1. Listar Instituições

-   **Endpoint**: `GET /api/instituicoes`
-   **O que faz**: Mostra todas as instituições financeiras disponíveis.
-   **Exemplo de resposta**:
    ```json
    {
        "chave": "PAN",
        "valor": "Pan"
    },
    {
        "chave": "OLE",
        "valor": "Ole"
    },
    {
        "chave": "BMG",
        "valor": "Bmg"
    }
    ```

### 2. Listar Convênios

-   **Endpoint**: `GET /api/convenios`
-   **O que faz**: Exibe todos os convênios disponíveis.
-   **Exemplo de resposta**:
    ```json
    {
        "chave": "INSS",
        "valor": "INSS"
    },
    {
        "chave": "FEDERAL",
        "valor": "Federal"
    },
    {
        "chave": "SIAPE",
        "valor": "Siape"
    }
    ```

### 3. Simular Empréstimo

-   **Endpoint**: `POST /api/simulacao`
-   **O que faz**: Faz uma simulação de empréstimo com base nos dados enviados.
-   **Exemplo de requisição**:
    ```json
    {
        "valor": 10000,
        "instituicoes": ["BMG", "PAN"],
        "convenios": ["INSS"],
        "parcela": 72
    }
    ```
    -   **Exemplo de resposta**:
    ```json
    "BMG": [
        {
            "taxa": 2.05,
            "parcelas": 72,
            "valor_parcela": 260.4,
            "convenio": "INSS"
        }
    ],
    "PAN": [
        {
            "taxa": 2.08,
            "parcelas": 72,
            "valor_parcela": 284.3,
            "convenio": "INSS"
        }
    ]
    ```

## Como testar manualmente

1. Use o arquivo Empresta_api.postman_collection na raís do projeto para chamar os endpoints.
2. Experimente os exemplos acima.
3. Caso envie dados inválidos (ex.: `valor_emprestimo` negativo), a API vai retornar um erro com uma mensagem explicando o problema.

## Como fazer os testes

1. Execute o comando abaixo para rodar os testes.

```bash
    php artisan test
```

2. Os testes verificam se a API está funcionando corretamente, incluindo casos de erro.

## Como funciona o cálculo?

O valor da parcela é calculado assim:

```
valor_parcela = valor_emprestimo * coeficiente
```

O `coeficiente` vem do arquivo `taxas_instituicoes.json` e depende da instituição, convênio e número de parcelas. A API filtra os resultados com base nos parâmetros que você enviar (instituições, convênios ou parcelas). Se você não passar filtros, ela mostra todas as opções possíveis.

## Observações

-   A API usa arquivos JSON em vez de banco de dados, então mantenha os arquivos `instituicoes.json`, `convenios.json` e `taxas_instituicoes.json` na pasta `storage/app`.
-   O código foi organizado para ser fácil de entender e manter, usando boas práticas do Laravel.
-   Para projetos com muitos acessos, considere usar cache para os dados dos JSON.
-   Se for enviar o projeto para avaliação, inclua o link do repositório GitHub e uma coleção do Postman.

## Problemas ou dúvidas?

Se algo der errado ou você precisar de ajuda, abra uma issue no repositório ou entre em contato pelo canal indicado. Vamos resolver juntos! 😊

---

**Feito com 💻 e ☕ por Charles Pereira!**
