## Intenção de Compra

#### O Projeto foi desenvolvimento com Docker + PHP/Symfony + Node.js/Express.js + NGINX + Postgres 

* Levante a aplicação, rodando o comando: docker-compose up --build, dentro da pasta mono-challenge-intention 


* Para exibir a lista dos produtos da Fake Store, utilize o endpoint através do método GET: http://localhost:8002/api/produtos

	
* Após listar os produtos, para criar a intenção de compra, utilize o endpoint: http://localhost:8002/api/compras/{id} com o método POST, substituindo o {id} pelo id do produto escolhido na lista. No headers, passe a chave Content-Type e o valor application/json. No body com formato JSON, passe o nome e o endereço, conforme o exemplo abaixo:


    {
        "name":"João Silva",
        "address":{
            "address":"Rua sasa",
            "number":"123",
            "city":"Joao pessoa",
            "state":"Paraiba",
            "country":"Brasil"
        }
    }


* Para listar todos as intenções de compras que foram persistidas no banco, utilize o endpoint: http://localhost:8001/intencao/compra/lista
