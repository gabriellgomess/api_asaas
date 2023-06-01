
# Integração de Aplicações com a API Asaas

Este código busca integrar um sistema, página ou aplicativo à API de cobrança Asaas, de modo que haja integração com bancos de dados.

## Funcionalidades
### Métodos para gerenciar clientes

- Criar um cliente
- Atualizar um cliente
- Buscar um cliente
- Listar todos os clientes
- Restaurar um cliente
- Excluir um cliente

### Métodos de cobrança
- Criar uma cobrança
- Criar uma cobrança com cartão de crédito
- Criar cobrança parcelada (boleto e cartão)
- Recuperar cobrança única
- Listar cobranças
- Atualizar cobrança existente
- Remover cobrança
- Restaurar cobrança removida
- Estornar cobrança
- Obter QR code para pagamento PIX
- Obter linha digitável do boleto e código de barras



## Como usar
### Requisitos

- PHP 5.6 ou superior
- Acesso à API Asaas

### Instruções

A partir de uma requisição http é chamado o arquivo asaas.php passando no `GET` o parâmetro correspondente ao método que será usado e por `POST` passamos os valores necessários ao método. 

Exemplo: `/asaas.php?param=1`

Enviando por `POST`:
- name = ''; *(Obrigatório)*
- email = '';
- phone = '';
- mobilePhone = ''; *(Obrigatório)*
- cpfCnpj = ''; *(Obrigatório)*
- postalCode = '';
- address = '';
- addressNumber = '';
- complement = '';
- province = '';
- externalReference = '';
- notificationDisabled = '';
- additionalEmails = '';
- municipalInscription = '';
- stateInscription = '';
- observations = '';

Os parâmetros dos métodos são:

1 - Cadastrar um cliente

2 - Atualizar um cliente

3 - Buscar um cliente

4 - Listar todos os clientes

5 - Restaurar um cliente

6 - Excluir um cliente

7 - Criar uma cobrança

8 - Criar uma cobrança com cartão de crédito

9 - Criar cobrança parcelada (boleto ou cartão)

10 - Recuperar cobrança única

11 - Listar cobranças

12 - Atualizar cobrança existente

13 - Remover cobrança

14 - Restaurar cobrança removida

15 - Estornar cobrança

16 - Obter QR code para pagamento PIX

17 - Obter linha digitável e código de barras do boleto

### Arquivos
- asaas.php
Este script recebe uma requisição HTTP com um parâmetro GET chamado "param" e de acordo com esse parâmetro estabelece a rota com o método.

- api.php
Este arquivo contém a classe AsaasAPI, que representa a API para integração com o Asaas, nesta classe se encontram os métodos e a requisição ao Asaas.

- variaveis_ambiente.php
Este arquivo contém os dados de conexão com o banco de dados e também a api_key de autenticação no Asaas.


