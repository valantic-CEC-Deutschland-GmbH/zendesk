<?php
declare(strict_types = 1);

namespace ValanticSpryker\Client\ZendeskClient;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use ValanticSpryker\Client\ZenDesk\Api\Mapper\ParamsMapper;
use ValanticSpryker\Client\ZenDesk\Api\ZenDeskApi;
use ValanticSpryker\Client\ZenDesk\Api\ZenDeskServiceAdapter;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Locale\LocaleClientInterface;

/**
 * @method \Pyz\Client\ZenDesk\ZenDeskConfig getConfig()
 */
class ZenDeskFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\ZenDesk\Api\ZenDeskServiceAdapter
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
     * @return \Pyz\Client\ZenDesk\Api\ZenDeskApi
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
     * @return \Pyz\Client\ZenDesk\Api\Mapper\ParamsMapper
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


