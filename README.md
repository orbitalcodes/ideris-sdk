# SDK PHP para API [Ideris](https://www.ideris.com.br/)

### Documentação da API:

https://documenter.getpostman.com/view/4554319/S1a63SJM#intro

### Requerimento:
* PHP >= 7.4

## Get started

* [Instalação](#Instalação)
* [Autenticação](#Autenticação)
* [Executar os testes unitários](#Executar os testes unitários)


### Instalação

Usando composer execute o comando para instalar o pacote:

`composer require prhost/ideris-sdk`

### Autenticação

Veja o exemplo abaixo de como criar uma instância do SDK e principalmente para autenticar com a API:

```php
use Ideris\Api\Ideris;

$iderisSdk = new Ideris('login_token');
```

### Executar os testes unitários

Para executar os testes unitários, antes precisa setar uma variável de ambiente chamada `LOGIN_TOKEN`