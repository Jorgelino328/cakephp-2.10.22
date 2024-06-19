# Website CakePHP

Este é um projeto de website em CakePHP projetado para demonstrar a configuração e uso de uma aplicação CakePHP.

## Começando

Siga estes passos para configurar o website CakePHP:

```bash
git clone <url-do-repositório>
cd cakephp-website
```

### 2. Configurar Banco de Dados

Copie o arquivo `database.php.default` localizado em `app/Config/` para `database.php`:

```bash
cp app/Config/database.php.default app/Config/database.php
```

Edite o arquivo `database.php` e configure a conexão do banco de dados da seguinte maneira:

```php
public $default = array(
    'datasource' => 'Database/Postgres',
    'persistent' => false,
    'host' => 'db',
    'login' => 'postgres',
    'password' => 'senhadb',
    'database' => 'echo_db',
    'prefix' => '',
    'encoding' => 'utf8',
);
```

Substitua `'senhadb'` pela sua senha do PostgreSQL se for diferente.

### 3. Construir e Executar Contêineres Docker

Execute o seguinte comando para construir e iniciar os contêineres Docker:

```bash
docker-compose up --build
```

### 4. Conectar ao Banco de Dados

Conecte-se ao banco de dados PostgreSQL usando um terminal ou uma ferramenta de gerenciamento de banco de dados como DBeaver ou pgAdmin. Use os seguintes detalhes de conexão:

- **Host**: db
- **Usuário**: postgres
- **Senha**: senhadb (ou sua senha do PostgreSQL)
- **Banco de Dados**: echo_db

### 5. Executar Schema

Execute o schema localizado em `app/config/echo_db.sql` no seu banco de dados PostgreSQL. Você pode fazer isso via terminal ou usando uma ferramenta de gerenciamento de banco de dados.

## Uso

Após a configuração estar completa, você pode acessar o website CakePHP navegando para `http://localhost:8080` no seu navegador web.

## Contribuições

Sinta-se à vontade para contribuir para este projeto enviando solicitações de pull ou relatando problemas.

## Licença

Este projeto é licenciado sob a [Licença MIT](LICENSE).
