<?php
/**
 * Created by PhpStorm
 * FileName: MFConnect.php
 * User: imokhles
 * Date: 11/11/2020
 * Time: 03:36
 * Copyright 2020 imokhles, All rights reserved
 */

namespace iMokhles\PayLinkAPI\V1;


use iMokhles\PayLinkAPI\V1\Traits\PLNKHttpRequest;

class PLNKConnect
{

    use PLNKHttpRequest;

    /**
     * @var string
     */
    protected $appId;

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var boolean
     */
    protected $isTest;

    /**
     * @var array
     */
    protected $header;

    /**
     * @var string
     */
    protected $host = 'https://restapi.paylink.sa/api/';

    /**
     * @var string
     */
    protected $hostTest = 'https://restpilot.paylink.sa/api/';

    /**
     * MFConnect constructor.
     * @param $apiId
     * @param $secretKey
     * @param bool $isTest
     */
    public function __construct($apiId, $secretKey, $isTest = false )
    {
        $this->setIsTest($isTest);

        $this->appId = $apiId;
        $this->secretKey = $secretKey;

        $auth = $this->authorize();
        $token = $auth['id_token'];

        $this->setToken($token);
        $this->setHeader();
    }

    /**
     * @return mixed|string
     */
    public function authorize()
    {

        $url = $this->getUrl('auth');
        return $this->postJson($url, [
            'apiId' => $this->appId,
            'secretKey' => $this->secretKey,
            'persistToken' => true,
        ]);
    }
    /**
     * @param $isTest
     */
    protected function setIsTest($isTest)
    {
        $this->isTest = $isTest;
    }

    /**
     * @param $token
     * @return $this
     */
    protected function setToken($token)
    {
        $this->token = 'Bearer ' . $token;
        return $this;
    }

    /**
     * @param array $header
     * @return $this
     */
    protected function setHeader(array $header = [])
    {
        $header['Authorization'] = $this->token;
        $this->header = $header;
        return $this;
    }

    /**
     * @param $path
     * @return string
     */
    protected function getUrl($path)
    {
        return ($this->isTest) ? $this->hostTest . $path : $this->host . $path;
    }

}
