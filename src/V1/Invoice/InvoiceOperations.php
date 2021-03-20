<?php
/**
 * Created by PhpStorm
 * FileName: InvoiceOperations.php
 * User: imokhles
 * Date: 19/03/2021
 * Time: 21:10
 * Copyright 2021 imokhles, All rights reserved
 */

namespace iMokhles\PayLinkAPI\V1\Invoice;

use iMokhles\PayLinkAPI\V1\PLNKConnect;

class InvoiceOperations extends PLNKConnect
{

    /**
     * @param $customerName
     * @param $invoiceValue
     * @param $params
     * @return mixed|string
     */
    public function createInvoice($customerName, $invoiceValue, $params) {

        $parameters = [
            'clientName' => $customerName,
            'amount' => $invoiceValue,
        ];

        if (array_key_exists('clientMobile', $params)) {
            $parameters['clientMobile'] = $params['clientMobile'];
        }

        if (array_key_exists('clientEmail', $params)) {
            $parameters['clientEmail'] = $params['clientEmail'];
        }

        if (array_key_exists('callBackUrl', $params)) {
            $parameters['callBackUrl'] = $params['callBackUrl'];
        }

        if (array_key_exists('orderNumber', $params)) {
            $parameters['orderNumber'] = $params['orderNumber'];
        }

        if (array_key_exists('products', $params)) {
            $parameters['products'] = $params['products'];
        }

        $url = $this->getUrl('addInvoice');
        return $this->postJson($url, $parameters, $this->header);

    }

    /**
     * @param $transactionNo
     * @return mixed|string
     */
    public function checkInvoice($transactionNo) {

        $url = $this->getUrl('getInvoice/'.$transactionNo);
        return $this->get($url, [], $this->header);
    }
}