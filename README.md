### Exemplo de API + SPA
Este repositório é um exemplo de implementação de API usando Laravel, e frontend usando VueJs + Quasar.
O sistema conta com um CRUD básico de Clientes, com Nome, CPF, Nascimento e Telefone, além de um filtro para clientes, onde se pode buscá-los por nome e CPF.

___
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
___
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

### 3 - Rodar os testes
```
php artisan test
```

**Caso não seja possível conectar ao banco de dados, tente cachear as configurações:**
```
php artisan config:cache
```
***OBS.: O sistema reseta o banco sempre que os testes são rodados. Para repopular o banco, volte ao passo 2.3**

___
### 4 - Configurar Frontend ###
Em outra janela do terminal, deve-se ir até o diretório do repositório e executar:
```
cd frontend &&
cp .env.example .env
```

### 4.1 - Especificar o URL da API ###
É necessário especificar o URL da API. Após criado, é necessário alterar o arquivo .env, especificando o URL da API na variável VITE_API_URL

### 4.2 - Instalar pacotes e executar ###
```
npm install &&
npm run dev
```
