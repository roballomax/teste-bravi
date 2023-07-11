# Teste Bravi

### Teste de lógica
O teste de lógica se encontra na rais do projeto, para executar o mesmo basta executar o comando abaixo:
```shell
 php suportes-balanceados.php
```
### API Laravel
Para instalar e rodar a api basta executar os seguintes comandos:
```sh
    cd api-contatos
    composer install
    ./vendor/bin/sail up
```
<small>**Obs:** É necessário o docker instalado para que a aplicação funcione</small> 
<br/>
<br/>
Para rodar os testes automatizados, no contexto da aplicação basta executar o comando
```sh
    php artisan test
```