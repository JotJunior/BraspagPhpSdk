<?php

require_once("vendor/autoload.php");

use Braspag\ApiService;
use Braspag\Model\Sale;

$orderId = date('YmdHi');

$sale = [
    'merchantOrderId' => 2016060900,
    'customer' => [
        'name' => 'Comprador de Testes',
        'identity' => '11225468954',
        'identityType' => 'CPF',
        'email' => 'compradordetestes@braspag.com.br',
        'birthDate' => '1991-01-02',
        'address' => [
            'street' => 'Av. Marechal Câmara',
            'number' => 160,
            'complement' => 'Sala 934',
            'zipCode' => '20020-080',
            'district' => 'Centro',
            'city' => 'Rio de Janeiro',
            'state' => 'RJ',
            'country' => 'BRA',
        ],
        'deliveryAddress' => [
            'street' => 'Av. Marechal Câmara',
            'number' => 160,
            'complement' => 'Sala 934',
            'zipCode' => '20020-080',
            'district' => 'Centro',
            'city' => 'Rio de Janeiro',
            'state' => 'RJ',
            'country' => 'BRA',
        ]
    ],
    'payment' => [
        'type' => 'CreditCard',
        'amount' => 100,
        'currency' => 'BRL',
        'country' => 'BRA',
        'provider' => 'Simulado',
        'serviceTaxAmount' => 0,
        'installments' => 1,
        'interest' => \Braspag\Model\Interest::ByMerchant,
        'capture' => true,
        'authenticate' => false,
        'softDescriptor' => 'tst',
        'creditCard' => [
            'cardNumber' => '4532117080573700',
            'holder' => 'Test T S Testando',
            'expirationDate' => '12/2021',
            'securityCode' => '000',
            'saveCard' => false,
            'brand' => 'Visa',
        ],
        'extraDataCollection' => [
            [
                'name' => 'NomeDoCampo',
                'value' => '1234567'
            ]
        ]

    ]

];

$sale = new Sale($sale);

$service = new ApiService([
    'merchantId' => '00000000-0000-0000-0000-000000000000',
    'merchantKey' => '0000000000000000000000000000000000000000',
]);

// retorna Braspag\Model\Sale
$result = $service->authorize($sale);

if ($result->isValid()) {
    // Braspag\Model\Payment
    $payment = $result->getPayment();

    // Array do pagamento
    $paymentArray = $result->getPayment()->toArray();

    // Braspag\Model\Customer
    $customer = $result->getCustomer();

    // Array do cliente
    $customer = $result->getCustomer()->toArray();

    // Array do pedido completo
    $result->toArray();


} else {
    $messages = $result->getMessages();
    // mensagens de alerta e erros
}
