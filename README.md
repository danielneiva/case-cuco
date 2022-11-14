### Case Cuco Health

## Requerimentos para execução ##
```
PHP 8.1
Composer 2
Node 16+
```

## Instruções para execução ##

### 1 - Clonar repositório ###
```
git clone https://github.com/danielneiva/case-cuco.git
```

### 2 - Configurar API ###
```
cd case-cuco/api &&
cp .env.example .env &&
composer install &&
php artisan key:generate

```
### 2.1 - Configurar Banco de Dados ###
É necessário criar um banco de dados para a aplicação. Após criado, é necessário alterar o arquivo .env com os dados do banco. O projeto foi testado com MySQL, portanto recomenda-se o seu uso.

### 2.2 - Rodar migrations ###
```
php artisan migrate
```
### 2.3 - (Opcional) Inserir clientes fake para testagem ###
A aplicação contém um seeder que cria 100 clientes fake no banco de dados. Para criar, deve-se executar:
```
php artisan db:seed
```

### 2.4 - Abrir servidor de desenvolvimento ###
```
php artisan serve
```

### 2.5 - Rodar os testes
```
php artisan test
```

OBS: caso não seja possível conectar ao banco de dados, tente cachear as configurações:
```
php artisan config:cache
```


### 3 - Configurar Frontend ###
Em outra janela do terminal, deve-se ir até o diretório do repositório e executar:
```
cd frontend &&
cp .env.example .env
```

### 3.1 - Especificar o URL da API ###
É necessário especificar o URL da API. Após criado, é necessário alterar o arquivo .env, especificando o URL da API na variável VITE_API_URL

### 3.2 - Instalar pacotes e executar ###
```
npm install &&
npm run dev
```
