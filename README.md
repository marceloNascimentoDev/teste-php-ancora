# Sobre o projeto

Este é um projeto em PHP desenvolvido utilizando o framework Laravel 9 utilizando o padrão MVC e php 8.1.

##### Documentação da API: https://documenter.getpostman.com/view/14447906/UVyytshb

## O Desafio

#### Requisitos

- Criar uma API que implementa o crud de produtos utilizando o framework laravel.

Um produto deve possuir os seguintes dados:
- ID (PK - Inteiro)
- Código (String)
- Nome (String)
- Preço (Float)
- Qty Disponível (Inteiro)
- Marca (String Alfanumérica)

A API deve implementar os seguintes verbos e endpoint:

- GET /api/products/
  - Lista todos os produtos da aplicação.
- POST /api/products/
  - Cria um novo produto na aplicação.
  - Não deve permitir duplicação de códigos. O código deve ser único.
- GET /api/products/id/
  - Obtém um produto específico por meio do ID
- PUT /api/products/id/
  - Atualiza um produto específico (todo o objeto deve ser atualizado).
- DELETE /api/products/id/
  - Deleta um produto especifico da aplicação

- Use PHP 8.x e Mysql 8.x
- Você deve utilizar o Laravel 8 para criação da solução.
- Você deve implementar o seed de produtos no banco de dados para eventuais testes.

<br>

## A solução

#### Como rodar o projeto

**Antes de seguir os passos abaixo tenha certeza que o docker e docker-compose estão instalados na maquina. Para rodar este projeto:**

1\. Clone este repositorio  e entre na pasta

```
git clone https://github.com/marceloNascimentoDev/teste-php-ancora.git
cd teste-php-ancora
```

2\. As configurações são armazenadas no arquivo \.env (Previamente configurado)\.

3\. Faça o build dos containers \, o container **app** utilizara a porta 8001 e o container **db** utilizara a porta 8306, certifique-se que essas portas estejam livres antes de continuar. Se seu usuário não estiver incluido no grupo de permissões do **docker e docker-compose**  será necessário executar os comandos como administrador (sudo)

```
docker-compose up -d
```

4\. Caso esteja utilizando Linux basta rodar o script de configuração dentro da pasta do projeto que tudo será feito automaticamente

```
.docker/script.sh
```

<br>

5\. Caso não esteja utilizando linux basta rodar os seguintes scripts na pasta do projeto.

```
docker exec $APP_CONTAINER_ID cp .env.example .env

cp .env.example .env
docker exec $(docker ps -aqf "name=app") composer install
docker exec $(docker ps -aqf "name=app") php artisan migrate --seed --force
docker exec $(docker ps -aqf "name=app") chmod -R 777 storage bootstrap/cache
```

6\. Agora você pode acessar aplicação em [localhost ou clique aqui!](http://localhost:8001)
