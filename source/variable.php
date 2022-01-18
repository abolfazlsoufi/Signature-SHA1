<?php


    $processor = new RSAProcessor($privateKey,RSAKeyType::XMLString);

    /*$Data_String = "#" . $merchantCode . "#" . $terminalCode . "#" . $invoiceNumber . "#" . $invoiceDate .
    "#" . $amount . "#" . $redirectAddress . "#" . $action . "#" . $timestamp . "#" . $bankGatewayCode .
    "#" . $currency . "#" . $CurrencyRegionCode . "#" . $customerID . "#" . $storeId . "#";*/

    $Data_String = '#111#222#2447#2021/12/19#56600.00#https://pax.test/my-account/?wc-api=pax_bwg_full_payment#1003#2021/12/19 13:46:10#5555#Rial#1331#093935455356#63110db4-b13a-4199-bab4-90ccf6fc0d8c#';

    echo $Data_String . "\n";

    /** Create Sign **/
    $data   = sha1($Data_String,true);
    $data   = $processor->sign($data);
    $result1 = base64_encode($data);

    //echo $result . "\n"; exit();

    /** Convert To Array **/
    $data_array = array(
    'amount'                => number_format($amount, 2, '.', ''),
    'action'                => (int)$action,
    'invoiceNumber'         => $invoiceNumber,
    'invoiceDate'           => $invoiceDate,
    'merchantCode'          => (int)$merchantCode,
    'terminalCode'          => (int)$terminalCode,
    'timestamp'             => $timestamp,
    'customerID'            => strval($customerID),
    'redirectAddress'       => $redirectAddress,
    'currency'              => $currency,
    'currencyRegionCode'    => $CurrencyRegionCode,
    'storeId'               => $storeId,
    'bankGatewayCode'       => $bankGatewayCode
    );

    //echo $data_array; exit();


    /** Get Token With Curl **/
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://paymentgateway.morsasw.local/PaymentGateway/GetToken',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data_array),
    CURLOPT_HTTPHEADER => array(
    'sign:' . $result,
    'Content-Type:application/json'
    ),
    ));
    $response = curl_exec($curl);
    curl_exec($curl);
    curl_close($curl);

    echo $response;
