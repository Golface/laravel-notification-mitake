<?php


namespace NotificationChannels\Mitake;

use GuzzleHttp\Client;
use GuzzleHttp;
use NotificationChannels\Mitake\Exceptions\CouldNotSendNotification;

class Mitake
{
    /**
     * Mitake API base URL.
     *
     * @var string
     */
    private $baseUrl = 'https://smsapi.mitake.com.tw/api/mtk/SmSend';

    protected $username;

    protected $password;

    /**
     * API HTTP client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    protected $serviceUrl;

    /**
     * Mitake constructor.
     * @param $username
     * @param $password
     * @param Client $httpClient
     * @param string $serviceUrl
     */
    public function __construct($username, $password, Client $httpClient, $serviceUrl)
    {
        $this->username = $username;
        $this->password = $password;
        $this->httpClient = $httpClient;
        $this->setServiceUrl($serviceUrl);
    }

    /**
     * Send sms message.
     *
     * <code>
     * $params = [
     *   'dstaddr' => '',
     *   'smbody'  => '',
     * ];
     * </code>
     *
     * @link https://sms.mitake.com.tw/common/header/download.jsp#
     *
     * @param array $params
     * @return mixed
     */
    public function send(array $params)
    {
        return $this->request($params);
    }

    /**
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function request(array $params)
    {
        $endPointUrl = $this->https ? $this->baseHttpsUrl : $this->baseHttpUrl;

        try {
            $formParams = [
                'username' => $this->username,
                'password' => $this->password,
                'dstaddr' => $params['dstaddr'],
                'smbody' => urlencode($params['smbody'])
            ];
            if (isset($params['vldtime'])) {
                $formParams["vldtime"] = $params['vldtime'];
            }
            if (isset($params['clientid'])) {
                $formParams['clientid'] = $params['clientid'];
            }

            $response = $this->httpClient->request(
                'POST',
                $endPointUrl,
                [
                    GuzzleHttp\RequestOptions::HEADERS => [
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ],
                    GuzzleHttp\RequestOptions::FORM_PARAMS => $formParams
                ]
            );

            return $response->getBody()->getContents();
        } catch (GuzzleHttp\Exception\GuzzleException $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        } catch (\Throwable $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }

    /**
     * @param $serviceUrl
     */
    private function setServiceUrl($serviceUrl)
    {
        $serviceUrl = isset($serviceUrl) ? $serviceUrl : $this->baseUrl;

        $this->serviceUrl = $serviceUrl . '?CharsetURL=UTF-8';
    }
}
