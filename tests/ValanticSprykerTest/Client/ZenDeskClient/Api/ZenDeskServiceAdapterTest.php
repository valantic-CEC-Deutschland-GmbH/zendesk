<?php
declare(strict_types = 1);

namespace PyzTest\Client\ZenDesk\Api;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\SendCatalogViaPostTransfer;
use Generated\Shared\Transfer\StoryblokCatalogTransfer;
use PyzTest\Client\ZenDesk\ZenDeskTester;
use Spryker\Client\GlossaryStorage\GlossaryStorageClient;
use Spryker\Client\Locale\LocaleClient;
use ValanticSpryker\Client\ZenDeskClient\Api\Mapper\ParamsMapper;
use ValanticSpryker\Client\ZenDeskClient\Api\ZenDeskApi;
use ValanticSpryker\Client\ZenDeskClient\Api\ZenDeskServiceAdapter;
use ValanticSpryker\Client\ZenDeskClient\ZenDeskConfig;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Client
 * @group ZenDesk
 * @group Api
 * @group ZenDeskServiceAdapterTest
 * Add your own group annotations below this line
 */
class ZenDeskServiceAdapterTest extends Unit
{
    protected ZenDeskTester $tester;

    /**
     * @return void
     */
    public function testShould(): void
    {
        //$this->tester->setConfig(ZenDeskConstants::ZENDESK_IS_TEST_MODE, false);

        //$this->setConfig('ZENDESK_CONSTANTS:IS_TEST_MODE', false);

        $mock = $this->getMockBuilder(ZenDeskApi::class)->disableOriginalConstructor()->getMock();
        $mock
            ->expects(self::once())
            ->method('request')
            ->with(
                'https://wibu-gruppe.zendesk.com/api/v2/tickets/create_many',
                [
                    'tickets' => [
                        [
                            'subject' => 'Neue Katalogbestellung per Post',
                            'ticket_form_id' => '7824926208530',
                            'comment' => [
                                'body' => 'Neue Katalogbestellung per Post',
                                'html_body' => 'Neue Katalogbestellung: <br/>Katalog 3<br/>',
                                'public' => false,
                            ],
                            'custom_fields' => [
                                [
                                    'id' => 360018817580,
                                    'value' => 'shop',
                                ],
                                [
                                    'id' => 360009262759,
                                    'value' => '',
                                ],
                                [
                                    'id' => 6799503809938,
                                    'value' => 'Rob Brady',
                                ],
                                /*[
                                    'id' => 6799497457810,
                                    'value' => 'Acme GMBH',
                                ],*/
                                [
                                    'id' => 7824716849554,
                                    'value' => '',
                                ],
                                [
                                    'id' => 7824778864274,
                                    'value' => '12345678',
                                ],
                                [
                                    'id' => 7824810264978,
                                    'value' => 'pflege',
                                ],
                                [
                                    'id' => 6798919830802,
                                    'value' => 'Hob str. 15',
                                ],
                                [
                                    'id' => 6799443912594,
                                    'value' => '',
                                ],
                                [
                                    'id' => 6798941012114,
                                    'value' => '54678',
                                ],
                                [
                                    'id' => 6798985636754,
                                    'value' => 'Berlin',
                                ],
                                [
                                    'id' => 6799468966418,
                                    'value' => 'Germany',
                                ],
                            ],
                            'requester' =>
                                [
                                    'name' => 'Rob Brady',
                                    'email' => 'test@test.com',
                                    'verified' => 'true',
                                ],
                        ],
                    ],
                ],
            )
            ->willReturn(true);

        $config = new ZenDeskConfig();
        $configMock = $this->getMockBuilder(ZenDeskConfig::class)->getMock();
        $configMock->method('getZenDeskSendAddressRequestSubject')->willReturn('wibu_online_2022_test');
        $configMock->method('getZendeskMultipleTicketsApiUrl')->willReturn('https://wibu-gruppe.zendesk.com/api/v2/tickets/create_many');
        $configMock->method('getZendeskSendCatalogsRequestSubject')->willReturn('Neue Katalogbestellung per Post');

        $glossaryStorageClientMock = $this->getMockBuilder(GlossaryStorageClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $localeClientMock = $this->getMockBuilder(LocaleClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $paramsMapper = new ParamsMapper(
            $configMock,
            $glossaryStorageClientMock,
            $localeClientMock
        );



        $adapter = new ZenDeskServiceAdapter(
            $mock,
            $paramsMapper,
            /*new ParamsMapper(
                $config,
                $this->tester->getLocator()->glossaryStorage()->client(),
                $this->tester->getLocator()->locale()->client(),
            ),*/
            $configMock,
        );

        $sendCatalogViaPostTransfer = new SendCatalogViaPostTransfer();
        $sendCatalogViaPostTransfer
            ->setName('Rob Brady')
            ->setEmail('test@test.com')
            ->setPhone('12345678')
            ->setCompany('Acme GMBH')
            ->setCity('Berlin')
            ->setAddress('Hob str. 15')
            ->setCountry('Germany')
            ->setZip('54678')
            ->setSelectedCatalogs(
                new ArrayObject([
                    (new StoryblokCatalogTransfer())
                        ->setAssetId('3')
                        ->setSourceCompany('pflege'),
                ]),
            );

        $adapter->sendCatalogs($sendCatalogViaPostTransfer);
    }
}
