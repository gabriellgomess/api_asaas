<?php
class AsaasAPI {
    private $apiKey;
    private $apiUrl = 'https://www.asaas.com/api/v3/';

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function sendRequest($method, $endpoint, $data = array()) {
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
    public function createCustomer($name, $email, $phone, $mobilePhone, $cpfCnpj, $postalCode, $address, $addressNumber, $complement, $province, $externalReference, $notificationDisabled, $additionalEmails, $municipalInscription, $stateInscription, $observations) {
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
    public function updateCustomer($customerID, $name, $email, $phone, $mobilePhone, $cpfCnpj, $postalCode, $address, $addressNumber, $complement, $province, $externalReference, $notificationDisabled, $additionalEmails, $municipalInscription, $stateInscription) {
        $endpoint = 'customers/' . $$customerID;

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
    public function getCustomer($customerID) {
        $endpoint = 'customers/' . $customerID;

        return $this->sendRequest('GET', $endpoint);
    }

    // LISTAR TODOS OS CLIENTES
    public function listCustomers() {
        $endpoint = 'customers';

        return $this->sendRequest('GET', $endpoint);
    }

    // RESTAURAR UM CLIENTE
    public function restoreCustomer($customerID) {
        $endpoint = 'customers/' . $customerID . '/restore';

        return $this->sendRequest('POST', $endpoint);
    }    

    // EXCLUIR UM CLIENTE
    public function deleteCustomer($customerID) {
        $endpoint = 'customers/' . $customerID;

        return $this->sendRequest('DELETE', $endpoint);
    }
    // ##################################################################

    // #################################################################
    // ################ MÉTODOS PARA COBRANÇA ##########################
    // #################################################################



    // Exemplo de método para emissão de uma cobrança
    public function createCharge($customerID, $value, $description) {
        $endpoint = 'payments';

        $data = array(
            'customer' => $customerID,
            'value' => $value,
            'description' => $description
        );

        return $this->sendRequest('POST', $endpoint, $data);
    }



    // Outros métodos da API podem ser implementados de forma semelhante

    // Exemplo de método para obtenção do saldo da conta
    public function getAccountBalance() {
        $endpoint = 'finance/balance';

        return $this->sendRequest('GET', $endpoint);
    }
}
