# BAWHALE

É uma aplicação web de uma loja de artigos sobre baleias.



## Descrição do sistema

É um sistema simples que simula as funcionalidades de uma loja online com uma página inicial com vários produtos já adicionados que podem ser levados ao carrinho. 

Um sistema de login completo com endereço, CPF, nome, CEP e Email. 

Validação de dados cadastrais e dados dos produtos

Um usuário administrador com poder de remover e adicionar produtos nas páginas itens.php e produtos.php que são bloqueadas para usuários comuns.


## Funcionamento e como usar

Abrir o ```config.php``` e trocar as credenciais para o seu usuário, senha e host.
Abrir o ```setup.php``` para criar a database e as tabelas e inserir os produtos nas tabelas
Por fim apertar o link de Login que aparece após a criação das tabelas no setup.php

Cadastrar um usuário básico clicando no botão de cadastro na tela de login Caso queira olhar o site como visitante apenas trocar o ```login.php``` para ```index.php```
Após a realização do cadastro ou login
o site terá algumas funcionalidades,  a mais óbvia é o botão de adicionar ao carrinho
ao clicar no adicionar ao carrinho os produtos entram no carrinho e pode mudar a quantidade ou clicando novamente no botão ou apertando no + na quantidade
o botão X remove do carrinho 1 por vez.

ao clicar em ver produto uma página com uma descrição básica do produto e sua foto em tamanho expandido abre
ao clicar em ir para o pagamento uma página de checkout aparece com a funcionalidade de remoção de itens, e finalização de compra. a finalização de compra seria o passo final de comprar inserção de metódo de pagamento mas isso não foi implementado então ela só mostra um alerta que a compra foi realizada e apaga o carrinho.

agora a funcionalidade do botão de Perfil - abre uma página com os dados cadastrais do usuário ao clicar em editar perfil o usuário é levado a uma página aonde ele pode alterar os dados cadastrais dele, após a alteração é necessário relogar para as mudanças mudarem na sessão. isso é avisado com um alerta e é facilitado com um botão de logout nessa pagina de edição.

## Funcionamento do modo administrador

realizar o login como administrador:
### Dados do usuário administrador:
### email - admin@root.com
### senha - admin
como administrador é possível adicionar e remover produtos do site, para isso é necessário clicar no "visualizar produtos"
esse link vai levar o usuário a uma página que lista todos os produtos do site, apertando no X esses itens são removidos 1 por 1 da tabela products
a opção de adição pode ser encontrada ao clicar em "cadastrar novo produto"
para adicionar um produto é necessário informar nome, preço, upar uma imagem pra esse produto e adicionar uma breve descrição sobre ele.


## Autor
Thalyson [GitHub](https://github.com/nooneknowws)

