<?php
class AsaasAPI
{
    private $apiKey;
    private $apiUrl = 'https://www.asaas.com/api/v3/';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function sendRequest($method, $endpoint, $data = array())
    {
        $url = $this->apiUrl . $endpoint;

        $headers = array(
            'Content-Type: application/json',
            'Access-Token: ' . $this->apiKey
        );

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers
        );

        if ($method === 'POST' || $method === 'PUT') {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
    // #################################################################
    // ################ MÉTODOS PARA CLIENTES ##########################
    // #################################################################

    // CRIAR UM CLIENTE
    public function createCustomer($name, $email, $phone, $mobilePhone, $cpfCnpj, $postalCode, $address, $addressNumber, $complement, $province, $externalReference, $notificationDisabled, $additionalEmails, $municipalInscription, $stateInscription, $observations)
    {
        $endpoint = 'customers';

        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'mobilePhone' => $mobilePhone,
            'cpfCnpj' => $cpfCnpj,
            'postalCode' => $postalCode,
            'address' => $address,
            'addressNumber' => $addressNumber,
            'complement' => $complement,
            'province' => $province,
            'externalReference' => $externalReference,
            'notificationDisabled' => $notificationDisabled,
            'additionalEmails' => $additionalEmails,
            'municipalInscription' => $municipalInscription,
            'stateInscription' => $stateInscription,
            'observations' => $observations,

        );

        return $this->sendRequest('POST', $endpoint, $data);
    }

    // ATUALIZAR UM CLIENTE
    public function updateCustomer($customerID, $name, $email, $phone, $mobilePhone, $cpfCnpj, $postalCode, $address, $addressNumber, $complement, $province, $externalReference, $notificationDisabled, $additionalEmails, $municipalInscription, $stateInscription)
    {
        $endpoint = 'customers/' . $customerID;

        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'mobilePhone' => $mobilePhone,
            'cpfCnpj' => $cpfCnpj,
            'postalCode' => $postalCode,
            'address' => $address,
            'addressNumber' => $addressNumber,
            'complement' => $complement,
            'province' => $province,
            'externalReference' => $externalReference,
            'notificationDisabled' => $notificationDisabled,
            'additionalEmails' => $additionalEmails,
            'municipalInscription' => $municipalInscription,
            'stateInscription' => $stateInscription,
        );

        return $this->sendRequest('POST', $endpoint, $data);
    }


    // OBTENHA UM CLIENTE
    public function getCustomer($customerID)
    {
        $endpoint = 'customers/' . $customerID;

        return $this->sendRequest('GET', $endpoint);
    }

    // LISTAR TODOS OS CLIENTES
    public function listCustomers()
    {
        $endpoint = 'customers';

        return $this->sendRequest('GET', $endpoint);
    }

    // RESTAURAR UM CLIENTE
    public function restoreCustomer($customerID)
    {
        $endpoint = 'customers/' . $customerID . '/restore';

        return $this->sendRequest('POST', $endpoint);
    }

    // EXCLUIR UM CLIENTE
    public function deleteCustomer($customerID)
    {
        $endpoint = 'customers/' . $customerID;

        return $this->sendRequest('DELETE', $endpoint);
    }
    // ##################################################################

    // #################################################################
    // ################ MÉTODOS PARA COBRANÇA ##########################
    // #################################################################

    // CRIAR UMA COBRANÇA
    public function createCharge($customerID, $dueDate, $value, $description, $externalReference, $canBePaidAfterDueDate, $discountValue, $discountDueDateLimit, $fineValue, $interestValue, $postalService)
    {
        $endpoint = 'payments';

        $data = array(
            'customer' => $customerID,
            'billingType' => 'BOLETO',
            'dueDate' => $dueDate,
            'value' => $value,
            'description' => $description,
            'externalReference' => $externalReference,
            "canBePaidAfterDueDate" => $canBePaidAfterDueDate,
            'discount' => array(
                'value' => $discountValue,
                'dueDateLimitDays' => $discountDueDateLimit
            ),
            'fine' => array(
                'value' => $fineValue
            ),
            'interest' => array(
                'value' => $interestValue
            ),
            'postalService' => $postalService
        );

        return $this->sendRequest('POST', $endpoint, $data);
    }

    // CRIAR COBRANÇA COM CARTÃO DE CRÉDITO
    public function createCreditCardCharge($customerID, $dueDate, $value, $description, $externalReference, $holderName, $number, $expiryMonth, $expiryYear, $ccv, $name, $email, $cpfCnpj, $postalCode, $addressNumber, $addressComplement, $phone, $mobilePhone, $creditCardToken, $remoteIp)
    {
        $endpoint = 'payments';

        $data = array(
            'customer' => $customerID,
            'billingType' => 'CREDIT_CARD',
            'dueDate' => $dueDate,
            'value' => $value,
            'description' => $description,
            'externalReference' => $externalReference,
            'billingType' => 'CREDIT_CARD',
            'creditCard' => array(
                'holderName' => $holderName,
                'number' => $number,
                'expiryMonth' => $expiryMonth,
                'expiryYear' => $expiryYear,
                'ccv' => $ccv,
            ),
            'creditCardHolderInfo' => array(
                'name' => $name,
                'email' => $email,
                'cpfCnpj' => $cpfCnpj,
                'postalCode' => $postalCode,
                'addressNumber' => $addressNumber,
                'addressComplement' => $addressComplement,
                'phone' => $phone,
                'mobilePhone' => $mobilePhone,
            ),
            'creditCardToken' => $creditCardToken,
            'remoteIp' => $remoteIp,
        );

        return $this->sendRequest('POST', $endpoint, $data);
    }

    // CRIAR COBRANÇA PARCELADA
    public function createInstallmentCharge($customerID, $dueDate, $value, $billingType, $description, $externalReference, $installmentCount, $installmentValue, $totalValue, $canBePaidAfterDueDate, $discountValue, $discountDueDateLimit, $fineValue, $interestValue, $postalService)
    {
        $endpoint = 'payments';

        $data = array(
            'customer' => $customerID,
            'billingType' => $billingType,
            'dueDate' => $dueDate,
            'value' => $value,
            'description' => $description,
            'externalReference' => $externalReference,
            "canBePaidAfterDueDate" => $canBePaidAfterDueDate,
            'discount' => array(
                'value' => $discountValue,
                'dueDateLimitDays' => $discountDueDateLimit
            ),
            'fine' => array(
                'value' => $fineValue
            ),
            'interest' => array(
                'value' => $interestValue
            ),
            'postalService' => $postalService,
            'installmentCount' => $installmentCount,
            'installmentValue' => $installmentValue,
            'totalValue' => $totalValue,
        );

        return $this->sendRequest('POST', $endpoint, $data);
    }

    // RECUPERAR COBRANÇA ÚNICA
    public function getCharge($chargeID)
    {
        $endpoint = 'payments/' . $chargeID;

        return $this->sendRequest('GET', $endpoint);
    }

    // RECUPERAR COBRANÇAS
    public function listCharges()
    {
        $endpoint = 'payments';

        return $this->sendRequest('GET', $endpoint);
    }

    // ATUALIZAR COBRANÇA EXISTENTE
    public function updateCharge($chargeID, $billingType, $dueDate, $value, $description, $externalReference, $canBePaidAfterDueDate, $discountValue, $discountDueDateLimit, $fineValue, $interestValue, $postalService)
    {
        $endpoint = 'payments/' . $chargeID;

        $data = array(
            'billingType' => $billingType,
            'dueDate' => $dueDate,
            'value' => $value,
            'description' => $description,
            'externalReference' => $externalReference,
            "canBePaidAfterDueDate" => $canBePaidAfterDueDate,
            'discount' => array(
                'value' => $discountValue,
                'dueDateLimitDays' => $discountDueDateLimit
            ),
            'fine' => array(
                'value' => $fineValue
            ),
            'interest' => array(
                'value' => $interestValue
            ),
            'postalService' => $postalService
        );

        return $this->sendRequest('PUT', $endpoint, $data);
    }

    // REMOVER COBRANÇA
    public function deleteCharge($chargeID)
    {
        $endpoint = 'payments/' . $chargeID;

        return $this->sendRequest('DELETE', $endpoint);
    }

    // RESTAURAR COBRANÇA REMOVIDA
    public function restoreCharge($chargeID)
    {
        $endpoint = 'payments/' . $chargeID . '/restore';

        return $this->sendRequest('POST', $endpoint);
    }

    //ESTORNAR COBRANÇA
    public function refundCharge($chargeID, $value, $description)
    {
        $endpoint = 'payments/' . $chargeID . '/refund';

        $data = array(
            'value' => $value,
            'description' => $description
        );

        return $this->sendRequest('POST', $endpoint, $data);
    }

    // OBTER QR CODE PARA PAGAMENTO PIX
    public function getQrCode($chargeID)
    {
        $endpoint = 'payments/' . $chargeID . '/pixQrCode';

        return $this->sendRequest('GET', $endpoint);
    }

    // OBTER LINHA DIGITÁVEL DO BOLETO
    public function getDigitableLine($chargeID)
    {
        $endpoint = 'payments/' . $chargeID . '/identificationField';

        return $this->sendRequest('GET', $endpoint);
    }
}
