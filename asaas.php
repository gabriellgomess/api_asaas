<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Inclua a classe AsaasAPI
require_once 'api.php';
include 'variaveis_ambiente.php';


// Instancie a classe passando a chave de acesso do Asaas
$asaas = new AsaasAPI($api_key);

$param = $_GET['param'];


switch ($param) {
        // #################################################################
        // ################ MÉTODOS PARA CLIENTES ##########################
        // #################################################################
    case '1': // CRIAR UM CLIENTE ----------------------------------------
        $name = 'Gabriel L Gomes'; // Obrigatório
        $email = '';
        $phone = '';
        $mobilePhone = '51992049874'; // Obrigatório
        $cpfCnpj = '83029052087'; // Obrigatório
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
        $customerID = '';
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
        $response = $asaas->updateCustomer($customerID, $name, $email, $phone, $mobilePhone, $cpfCnpj, $postalCode, $address, $addressNumber, $complement, $province, $externalReference, $notificationDisabled, $additionalEmails, $municipalInscription, $stateInscription);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cliente atualizado com sucesso!';
        }
        break;
    case '3': // BUSCAR UM CLIENTE ----------------------------------------
        $customerID = '';

        $response = $asaas->getCustomer($customerID);

        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Informações do cliente:';
            echo 'Nome: ' . $response['name'];
            echo 'CPF/CNPJ: ' . $response['cpfCnpj'];
            echo 'Celular: ' . $response['mobilePhone'];
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
        $customerID = '';
        $response = $asaas->restoreCustomer($customerID);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cliente restaurado com sucesso!';
        }
        break;
    case '6': // EXCLUIR UM CLIENTE ---------------------------------------
        $customerID = '';
        $response = $asaas->deleteCustomer($customerID);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cliente excluído com sucesso!';
        }
        break;
        // #################################################################
        // ################ MÉTODOS PARA COBRANÇAS #########################
        // #################################################################
    case '7': // CRIAR UMA COBRANÇA --------------------------------------

        $customerID = 'cus_000055948355'; // Obrigatório
        $dueDate = '2023-06-05'; // Obrigatório
        $value = '10.00'; // Obrigatório
        $cpfCnpj = '83029052087'; // Obrigatório
        $description = '';
        $externalReference = '';
        $canBePaidAfterDueDate = false; // Obrigatório 
        $discountValue = '0'; // Obrigatório
        $discountDueDateLimit = '0'; // Obrigatório
        $fineValue = '0'; // Obrigatório
        $interestValue = '0'; // Obrigatório
        $postalService = false;

        $response = $asaas->createCharge($customerID, $dueDate, $value, $description, $externalReference, $canBePaidAfterDueDate, $discountValue, $discountDueDateLimit, $fineValue, $interestValue, $postalService);

        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cobrança criada com sucesso! ID: ' . $response['id'];
            // Salve o ID da cobrança em seu banco de dados, para futuras consultas
        }

        break;
    case '8': // CRIAR UMA COBRANÇA COM CARTÃO DE CRÉDITO -----------------

        $customerID = ''; // Obrigatório
        $dueDate = ''; // Obrigatório
        $value = ''; // Obrigatório
        $description = '';
        $externalReference = '';
        $holderName = ''; // Obrigatório
        $number = ''; // Obrigatório
        $expiryMonth = ''; // Obrigatório
        $expiryYear = ''; // Obrigatório
        $ccv = ''; // Obrigatório
        $name = ''; // Obrigatório
        $email = ''; // Obrigatório
        $cpfCnpj = ''; // Obrigatório
        $postalCode = ''; // Obrigatório
        $addressNumber = ''; // Obrigatório
        $addressComplement = '';
        $phone = ''; // Obrigatório
        $mobilePhone = '';
        $creditCardToken = ''; // Obrigatório
        $remoteIp = ''; // Obrigatório

        $response = $asaas->createCreditCardCharge($customerID, $dueDate, $value, $description, $externalReference, $holderName, $number, $expiryMonth, $expiryYear, $ccv, $name, $email, $cpfCnpj, $postalCode, $addressNumber, $addressComplement, $phone, $mobilePhone, $creditCardToken, $remoteIp);
        // Verifique a resposta e trate os erros, se necessário

        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cobrança com cartão de crédito criada com sucesso! ID: ' . $response['id'];
        }
        break;
    case '9': // CRIAR COBRANÇA PARCELADA ---------------------------------
        $customerID = ''; // Obrigatório
        $dueDate = ''; // Obrigatório
        $value = '';
        $billingType = ''; // CREDIT_CARD OU BOLETO
        $description = '';
        $externalReference = '';
        $installmentCount = ''; // Obrigatório
        $installmentValue = ''; // Obrigatório ou totalValue
        $totalValue = ''; // Obrigatório ou installmentValue
        $canBePaidAfterDueDate = false;
        $discountValue = '0';
        $discountDueDateLimit = '0';
        $fineValue = '0';
        $interestValue = '0';
        $postalService = false;

        $response = $asaas->createInstallmentCharge($customerID, $dueDate, $value, $billingType, $description, $externalReference, $installmentCount, $installmentValue, $totalValue, $canBePaidAfterDueDate, $discountValue, $discountDueDateLimit, $fineValue, $interestValue, $postalService);
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cobrança parcelada criada com sucesso! ID: ' . $response['id'];
        }

        break;
    case '10': // RECUPERAR COBRANÇA ÚNICA -------------------------------

        $chargeID = 'pay_1788179071737256'; // Obrigatório
        $response = $asaas->getCharge($chargeID);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            // Salve os dados da cobrança em seu banco de dados, para futuras consultas
            echo 'Cobrança recuperada com sucesso!';
            echo $response['id'];
        }

        break;
    case '11': // LISTAR COBRANÇAS ----------------------------------------

        $response = $asaas->listCharges();
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            // Salve os dados das cobranças em seu banco de dados, para futuras consultas
            echo 'Cobranças listadas com sucesso!<br>';
            foreach ($response['data'] as $charge) {
                echo $charge['id'] . "<br>";
            }
        }

        break;
    case '12': // ATUALIZAR COBRANÇA EXISTENTE ---------------------------

        $chargeID = ''; // Obrigatório
        $billingType = ''; // Obrigatório
        $dueDate = ''; // Obrigatório
        $value = ''; // Obrigatório
        $description = '';
        $externalReference = '';
        $canBePaidAfterDueDate = false;
        $discountValue = '0';
        $discountDueDateLimit = '0';
        $fineValue = '0';
        $interestValue = '0';
        $postalService = false;

        $response = $asaas->updateCharge($chargeID, $billingType, $dueDate, $value, $description, $externalReference, $canBePaidAfterDueDate, $discountValue, $discountDueDateLimit, $fineValue, $interestValue, $postalService);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cobrança atualizada com sucesso!';
        }

        break;
    case '13': // REMOVER COBRANÇA ----------------------------------------
        $chargeID = ''; // Obrigatório
        $response = $asaas->deleteCharge($chargeID);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cobrança removida com sucesso!';
        }

        break;
    case '14': // RESTAURAR COBRANÇA REMOVIDA ----------------------------
        $chargeID = ''; // Obrigatório
        $response = $asaas->restoreCharge($chargeID);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cobrança restaurada com sucesso!';
        }

        break;
    case '15': // ESTORNAR COBRANÇA ---------------------------------------
        $chargeID = ''; // Obrigatório
        $value = ''; // Obrigatório
        $description = '';

        $response = $asaas->refundCharge($chargeID, $value, $description);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            echo 'Cobrança estornada com sucesso!';
        }

        break;
    case '16': // OBTER QR CODE PARA PAGAMENTO PIX -------------------------
        $chargeID = ''; // Obrigatório
        $response = $asaas->getQRCode($chargeID);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            // Salve os dados do QR Code em seu banco de dados, para futuras consultas
            echo 'QR Code obtido com sucesso!<br>';
            echo $response['encodedImage'] . "<br>";
            echo $response['payload'] . "<br>";
            echo $response['expirationDate'] . "<br>";
        }

        break;
    case '17': // OBTER LINHA DIGITÁVEL -------------------------------------
        $chargeID = 'pay_5954759860264569'; // Obrigatório
        $response = $asaas->getDigitableLine($chargeID);
        // Verifique a resposta e trate os erros, se necessário
        if (isset($response['errors'])) {
            echo 'Erro: ' . $response['errors'][0]['description'];
        } else {
            // Salve os dados da linha digitável em seu banco de dados, para futuras consultas
            echo 'Linha digitável obtida com sucesso!<br>';
            echo $response['identificationField'] . "<br>"; // linha digitável
            echo $response['barCode'] . "<br>"; // código de barras

        }
        break;

    default:
        echo 'Valor inválido para o parâmetro "param"';
        break;
}

// pay_5954759860264569

// MODELO DO RETORNO DA COBRANÇA POR CARTÃO DE CRÉDITO
// {
//     "object": "payment",
//     "id": "pay_6249395324297088",
//     "dateCreated": "2023-06-01",
//     "customer": "cus_000055909237",
//     "paymentLink": null,
//     "value": 5,
//     "netValue": 4.37,
//     "originalValue": null,
//     "interestValue": null,
//     "description": "",
//     "billingType": "CREDIT_CARD",
//     "confirmedDate": "2023-06-01",
//     "creditCard": {
//         "creditCardNumber": "1701",
//         "creditCardBrand": "MASTERCARD"
//     },
//     "pixTransaction": null,
//     "status": "CONFIRMED",
//     "dueDate": "2023-07-01",
//     "originalDueDate": "2023-07-01",
//     "paymentDate": null,
//     "clientPaymentDate": "2023-06-01",
//     "installmentNumber": null,
//     "invoiceUrl": "https://www.asaas.com/i/6249395324297088",
//     "invoiceNumber": "209094394",
//     "externalReference": null,
//     "deleted": false,
//     "anticipated": false,
//     "anticipable": false,
//     "creditDate": "2023-07-03",
//     "estimatedCreditDate": "2023-07-03",
//     "transactionReceiptUrl": "https://www.asaas.com/comprovantes/8380758150507516",
//     "nossoNumero": null,
//     "bankSlipUrl": null,
//     "lastInvoiceViewedDate": null,
//     "lastBankSlipViewedDate": null,
//     "postalService": false,
//     "custody": null,
//     "refunds": null
// }
