<?php
declare(strict_types = 1);

namespace ValanticSpryker\Client\ZendeskClient\Api;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Psr\Log\LoggerInterface;
use Pyz\Client\ZenDesk\ZenDeskConfig;

class ZenDeskApi
{
    private Client $guzzleClient;

    private LoggerInterface $logger;

    private ZenDeskConfig $config;

    /**
     * @param \GuzzleHttp\Client $guzzleClient
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Pyz\Client\ZenDesk\ZenDeskConfig $config
     */
    public function __construct(
        Client $guzzleClient,
        LoggerInterface $logger,
        ZenDeskConfig $config
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->logger = $logger;
        $this->config = $config;
    }

    /**
     * @param string $endpoint
     * @param array $requestBodyArray
     *
     * @return bool
     */
    public function request(string $endpoint, array $requestBodyArray): bool
    {
        $options = [
            'body' => json_encode($requestBodyArray),
            'auth' => [$this->config->getZenDeskUsername(), $this->config->getZenDeskPassword()],
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        ];

        try {
            $result = $this->guzzleClient->post($endpoint, $options);

            $contents = $result->getBody()->getContents();
            if (trim($contents) === '') {
                $this->logger->error(
                    'ZENDESK_API_EMPTY_RESPONSE',
                    [
                        'requestUrl' => $endpoint,
                        'requestBody' => json_encode($requestBodyArray),
                    ],
                );

                return false;
            }
            try {
                $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException $jsonException) {
                $this->logger->error(
                    'ZENDESK_API_JSON_EXCEPTION_RESPONSE',
                    [
                        'requestUrl' => $endpoint,
                        'requestBody' => json_encode($requestBodyArray),
                        'exception' => $jsonException,
                    ],
                );

                return false;
            }
        } catch (GuzzleException $e) {
            $this->logger->error(
                'ERROR_ZENDESK_API',
                [
                    'message' => $e->getMessage(),
                    'exception' => $e->getTraceAsString(),
                    'requestUrl' => $endpoint,
                    'requestBody' => json_encode($requestBodyArray),
                ],
            );

            return false;
        }

        return true;
    }
}


