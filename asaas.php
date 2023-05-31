<?php

// Inclua a classe AsaasAPI
require_once 'api.php';
include 'variaveis_ambiente.php';


// Instancie a classe passando a chave de acesso do Asaas
$asaas = new AsaasAPI($api_key);

$param = $_GET['param'];


switch ($param) {
    case '1': // CRIAR UM CLIENTE ----------------------------------------
        $name = ''; // Obrigatório
        $email = '';
        $phone = '';
        $mobilePhone = ''; // Obrigatório
        $cpfCnpj = ''; // Obrigatório
        $postalCode = '';
        $address = '';
        $addressNumber = '';
        $complement = '';
        $province = '';
        $externalReference = '';
        $notificationDisabled = '';
        $additionalEmails = '';
        $municipalInscription = '';
        $stateInscription = '';
        $observations = '';

        // Exemplo de uso do método createCustomer
        $response = $asaas->createCustomer($name, $email, $phone, $mobilePhone, $cpfCnpj, $postalCode, $address, $addressNumber, $complement, $province, $externalReference, $notificationDisabled, $additionalEmails, $municipalInscription, $stateInscription, $observations);

        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Ocorreu um erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cliente criado com sucesso! ID: ' . $response['id'];
            // Salve o ID do cliente em seu banco de dados, para futuras cobranças
        }       
        break;
    case '2': // ATUALIZAR UM CLIENTE ------------------------------------
        $customer_id = '';
        $name = '';
        $email = '';
        $phone = '';
        $mobilePhone = '';
        $cpfCnpj = '';
        $postalCode = '';
        $address = '';
        $addressNumber = '';
        $complement = '';
        $province = '';
        $externalReference = '';
        $notificationDisabled = '';
        $additionalEmails = '';
        $municipalInscription = '';
        $stateInscription = '';
        $response = $asaas->updateCustomer($customer_id, $name, $email, $phone, $mobilePhone, $cpfCnpj, $postalCode, $address, $addressNumber, $complement, $province, $externalReference, $notificationDisabled, $additionalEmails, $municipalInscription, $stateInscription);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cliente atualizado com sucesso!';
        }        
        break;
    case '3': // BUSCAR UM CLIENTE ----------------------------------------
        $customer_id = '';
        
        $response = $asaas->getCustomer($customer_id);

        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Informações do cliente:';
            echo 'Nome: ' . $response['name'];
            echo 'Email: ' . $response['email'];
            echo 'Telefone: ' . $response['phone'];
        }
        break;
    case '4': // LISTAR TODOS OS CLIENTES ---------------------------------
        $response = $asaas->listCustomers();

        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Clientes:';
            foreach ($response['data'] as $customer) {
                echo 'ID: ' . $customer['id'];
                echo 'Nome: ' . $customer['name'];
                echo 'Email: ' . $customer['email'];
                echo 'CPF/CNPJ: ' . $customer['cpfCnpj'];
                echo 'Telefone: ' . $customer['phone'];
                echo 'Celular: ' . $customer['mobilePhone'];
                echo '-----------------------------------';
            }
        }
        break;
    case '5': // RESTAURAR UM CLIENTE -------------------------------------
        $customer_id = '';
        $response = $asaas->restoreCustomer($customer_id);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cliente restaurado com sucesso!';
        }
        break;
    case '6': // EXCLUIR UM CLIENTE ---------------------------------------
        $customer_id = '';
        $response = $asaas->deleteCustomer($customer_id);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cliente excluído com sucesso!';
        }
      
        break;
    case '7':
         // Exemplo de uso do método getAccountBalance
       $response = $asaas->getAccountBalance();

       if (isset($response['errors'])) {
           echo 'Erro: ' . $response['errors'][0]['description'];
       } else {
           echo 'Saldo da conta: R$ ' . $response['balance'];
       }
        break;
    case '8':
       
    default:
         // Exemplo de uso do método createCharge
         $response = $asaas->createCharge('ID_DO_CLIENTE', 100.00, 'Descrição da cobrança');

         if (isset($response['errors'])) {
             echo 'Erro: ' . $response['errors'][0]['description'];
         } else {
             echo 'Cobrança criada com sucesso! ID: ' . $response['id'];
         }
        break;
}
