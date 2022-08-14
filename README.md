## Teste M2 Digital:

- SO Ubuntu 20.04.
- Versão 9.x do Laravel.
- Banco de dados PostgreSQL.
- Utilizei o pacote Sail, do próprio Laravel, para a utilização do Docker. O Sail já traz os arquivos do Docker e docker-compose pré configurados.
- Esquema de tabelas e relacionamentos:
    ![tables](https://user-images.githubusercontent.com/61114074/184548872-bc306108-2df9-4784-9cbb-b3f52ae7670b.png)
  

### OBS:

- As portas 80 e 5432 precisam estar disponíveis, ou será preciso alterá-las no arquivo docker-compose.yml, na raíz do projeto.
- Para o feedback() do método validate() funcionar corretamente, o cliente precisa enviar o Accept no cabeçalho da requisição, com o valor application/json.

### Instruções para a execução do projeto

- Clone a branch master para um diretório de sua preferência.
- No diretório do projeto, execute os comandos:
    
   - `.vendor/bin/sail up`
   - `./vendor/bin/sail composer install`
   - `.vendor/bin/sail artisan migrate`
 
 ### Rotas

Rota                                 | Método HTTP    | Dados da requisição
------------------------------------ | -------------- | --------
localhost/api/city-groups            | POST           | city_group
localhost/api/city-groups/{id}       | PUT,PATCH      | city_group
localhost/api/city-groups            | GET            | 
localhost/api/city-groups{id}        | GET            | 
localhost/api/cities                 | POST           | city_group_id, city, uf
localhost/api/cities{id}             | PUT,PATCH      | city_group_id, city, uf
localhost/api/cities                 | GET            | 
localhost/api/cities{id}             | GET            | 
localhost/api/campaigns              | POST           | city_group_id, campaign, description
localhost/api/campaigns{id}          | PUT,PATCH      | city_group_id, campaign, description
localhost/api/campaigns              | GET            | 
localhost/api/campaigns{id}          | GET            | 
localhost/api/products               | POST           | product, description, price
localhost/api/products{id}           | PUT,PATCH      | product, description, price
localhost/api/products               | GET            | 
localhost/api/products{id}           | GET            | 
localhost/api/products-campaigns     | POST           | product_id, campaign_id, discount
localhost/api/products-campaigns{id} | PUT,PATCH      | discount
localhost/api/products-campaigns     | GET            | 
localhost/api/products-campaigns{id} | GET            | 
