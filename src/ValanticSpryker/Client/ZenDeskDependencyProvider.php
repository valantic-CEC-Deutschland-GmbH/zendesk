<?php
declare(strict_types = 1);

namespace ValanticSpryker\Client\ZendeskClient;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Shared\Log\LoggerFactory;

class ZenDeskDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const GUZZLE_CLIENT = 'GUZZLE_CLIENT';

    /**
     * @var string
     */
    public const LOGGER = 'LOGGER';

    /**
     * @var string
     */
    public const GLOSSARY_STORAGE_CLIENT = 'GLOSSARY_STORAGE_CLIENT';

    /**
     * @var string
     */
    public const LOCALE_CLIENT = 'LOCALE_CLIENT';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addGuzzleClient($container);
        $container = $this->addLogger($container);
        $container = $this->addGlossaryStorageClient($container);
        $container = $this->addLocaleClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addGuzzleClient(Container $container): Container
    {
        $container->set(
            self::GUZZLE_CLIENT,
            static function (): Client {
                return new Client();
            },
        );

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addLogger(Container $container): Container
    {
        $container->set(
            self::LOGGER,
            static function (): LoggerInterface {
                return LoggerFactory::getInstance();
            },
        );

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addGlossaryStorageClient(Container $container): Container
    {
        $container->set(
            self::GLOSSARY_STORAGE_CLIENT,
            static function (Container $container): GlossaryStorageClientInterface {
                return $container->getLocator()->glossaryStorage()->client();
            },
        );

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addLocaleClient(Container $container): Container
    {
        $container->set(
            self::LOCALE_CLIENT,
            static function (Container $container): LocaleClientInterface {
                return $container->getLocator()->locale()->client();
            },
        );

        return $container;
    }
}
