# challenge-promobit

-------------------------------------------------

Objetivo
--------

**O sistema deverá ser capaz de:**

- CRUD DE PRODUTOS :

- [x] Criar;
- [x] Editar;
- [x] Deletar;

- CRUD DE TAGS :

- [x] Criar;
- [x] Editar;
- [x] Deletar;

- [x] RELATORIO DE RELEVANCIA DE PRODUTOS :

- [x] É desejável que o sistema tenha autenticacao;
- [x] É desejável que o sistema utilize o container docker;

#### Rodando em ambiente de desenvolvimento

Para rodar a aplicação utilizando Docker em ambiente de desenvolvimento execute:
`develop_up_d:`

Executar:
php `bin/console doctrine:database:create`
php `bin/console doctrine:schema:create`

- Passo 1:
  executar rota: 
  http://localhost:8082/procedure/first/create
  (Rota para gerar procedure.)
- Passo 2:
  executar rota:
  http://localhost:8082/procedure/first/insert
  (Rota para executar procedure.)
- Passo 3:
    executar rota:
    http://localhost:8082/first/user
    (Rota para criar usuario.)

Para entrar na aplicacao;
  `login`
- email:cristiane.rosental@mail.com;
- senha: 123456
  http://localhost:8082/first/user
  (Rota para criar usuario.)


### LICENSE

[MIT License](LICENSE)

