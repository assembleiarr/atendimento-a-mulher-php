## Instalação CHAME

1) Clonar o projeto do Repositório GIT: 

```sh
git clone ttps://gitlab.com/ale-rr/php/chame.git chame
cd chame
```

2) Instalar dependências PHP:

```sh
composer install
```

3) Instalar dependências NPM:

```sh
npm ci
```

4) Criar arquivo de configurações:

```sh
cp .env.example .env
```

5) Criar um BD postreSQL:

6) Setar as configurações no BD no arquivo .env

7) Gerar a chave da aplicação:

```sh
php artisan key:generate
```

8) Gerar as tabelas da base de dados:

```sh
php artisan migrate --seed
```

9) Compilar os arquivos Vue:

```sh
npm run prod
```

