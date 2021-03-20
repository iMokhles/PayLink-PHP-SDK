<?php
/**
 * Created by PhpStorm
 * FileName: SendPaymentTest.php
 * User: imokhles
 * Date: 17/11/2020
 * Time: 01:00
 * Copyright 2020 imokhles, All rights reserved
 */

namespace iMokhles\PayLinkAPI\Test\Invoice;



use GuzzleHttp\Exception\BadResponseException;
use iMokhles\PayLinkAPI\V1\Invoice\InvoiceOperations;
use PHPUnit\Framework\TestCase;

class AddInvoiceTest extends TestCase
{

    /**
     * Generate payment url to pay through MyFatoorah pages
     */
    public function testCreateInvoice() {
        $initInvoice = new InvoiceOperations('APP_ID_1603009563', '4a446a20-4f4d-37fc-a27f-dc5b2b6bce0b', true);
//        $this->assertIsArray($initInvoice);

        try {
            $createInvoice = $initInvoice->createInvoice('Test Name', 50, [
                'callBackUrl' => 'https://www.example.com',
                'orderNumber' => 123123123,
                'products' => [
                    [
                        'description' => 'Test Description',
                        'imageSrc' => '',
                        'price' => 50,
                        'qty' => 1,
                        'title' => 'Product Name',
                    ],
                ]
            ]);
            print PHP_EOL.print_r($createInvoice, true).PHP_EOL;
        }  catch (BadResponseException $ex) {
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();
            print PHP_EOL.print_r($jsonBody, true).PHP_EOL;
        }

    }
}