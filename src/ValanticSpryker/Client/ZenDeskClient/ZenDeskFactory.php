<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\ZenDeskClient;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Locale\LocaleClientInterface;
use ValanticSpryker\Client\ZenDeskClient\Api\Mapper\ParamsMapper;
use ValanticSpryker\Client\ZenDeskClient\Api\ZenDeskApi;
use ValanticSpryker\Client\ZenDeskClient\Api\ZenDeskServiceAdapter;

/**
 * @method \ValanticSpryker\Client\ZenDeskClient\ZenDeskConfig getConfig()
 */
class ZenDeskFactory extends AbstractFactory
{
    /**
     * @return \ValanticSpryker\Client\ZenDeskClient\Api\ZenDeskServiceAdapter
     */
    public function getZenDeskServiceAdapter(): ZenDeskServiceAdapter
    {
        return new ZenDeskServiceAdapter(
            $this->createZenDeskApi(),
            $this->createParamsMapper(),
            $this->getConfig(),
        );
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getGuzzleClient(): Client
    {
        return $this->getProvidedDependency(ZenDeskDependencyProvider::GUZZLE_CLIENT);
    }

    /**
     * @return \ValanticSpryker\Client\ZenDeskClient\Api\ZenDeskApi
     */
    public function createZenDeskApi(): ZenDeskApi
    {
        return new ZenDeskApi(
            $this->getGuzzleClient(),
            $this->getLogger(),
            $this->getConfig(),
        );
    }

    /**
     * @return \ValanticSpryker\Client\ZenDeskClient\Api\Mapper\ParamsMapper
     */
    public function createParamsMapper(): ParamsMapper
    {
        return new ParamsMapper(
            $this->getConfig(),
            $this->getGlossaryStorageClient(),
            $this->getLocaleClient(),
        );
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    private function getLogger(): LoggerInterface
    {
        return $this->getProvidedDependency(ZenDeskDependencyProvider::LOGGER);
    }

    /**
     * @return \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface
     */
    private function getGlossaryStorageClient(): GlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(ZenDeskDependencyProvider::GLOSSARY_STORAGE_CLIENT);
    }

    /**
     * @return \Spryker\Client\Locale\LocaleClientInterface
     */
    private function getLocaleClient(): LocaleClientInterface
    {
        return $this->getProvidedDependency(ZenDeskDependencyProvider::LOCALE_CLIENT);
    }
}
