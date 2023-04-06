<?php
declare(strict_types = 1);

namespace ValanticSprykerTest\Client\ZenDeskClient\Api\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\SendCatalogViaPostTransfer;
use Generated\Shared\Transfer\StoryblokCatalogTransfer;
use Spryker\Client\GlossaryStorage\GlossaryStorageClient;
use Spryker\Client\Locale\LocaleClient;
use ValanticSpryker\Client\ZenDeskClient\Api\Mapper\ParamsMapper;
use ValanticSpryker\Client\ZenDeskClient\ZenDeskConfig;
use ValanticSprykerTest\Client\ZenDeskClient\ZenDeskTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Client
 * @group ZenDesk
 * @group Api
 * @group Mapper
 * @group ParamsMapperTest
 * Add your own group annotations below this line
 */
class ParamsMapperTest extends Unit
{
    protected ZenDeskTester $tester;
    /**
     * @var string
     */
    private const TICKET_FORM_ID = '360001145620';

    /**
     * @var string
     */
    private const COMMENT_BODY = 'Lieferadresse ändern';

    /**
     * @var string
     */
    private const COMMENT_HTML_BODY = 'Für Kunde 123456 wurde folgende Lieferadresse als neue Standard-Adresse markiert.';

    /**
     * @var int
     */
    private const CUSTOMER_ID_FIELD = 360009262759;

    /**
     * @var int
     */
    private const COMPANY_NAME_FIELD = 6799503809938;

    /**
     * @var int
     */
    private const POSITION_FIELD = 7824716849554;

    /**
     * @var int
     */
    private const PHONE_FIELD = 7824778864274;

    /**
     * @var int
     */
    private const ORGANIZATION_FIELD = 7824810264978;

    /**
     * @var int
     */
    private const STREET_FIELD = 6798919830802;

    /**
     * @var int
     */
    private const HOUSE_NR_FIELD = 6799443912594;

    /**
     * @var int
     */
    private const ZIPCODE_FIELD = 6798941012114;

    /**
     * @var int
     */
    private const CITY_FIELD = 6798985636754;

    /**
     * @var int
     */
    private const COUNTRY_FIELD = 6799468966418;

    /**
     * @var int
     */
    private const SHOP_FIELD = 360018817580;

    /**
  * @return void
  */
    public function testMapAddressTransferToRequestBody(): void
    {
        $config = new ZenDeskConfig();
        $paramsMapper = $this->getMockBuilder(ParamsMapper::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['mapAddressTransferToRequestBody'])
            ->getMock();

        $addressTransfer = new AddressTransfer();
        $countryTransfer = new CountryTransfer();
        $countryTransfer->setName('Germany');
        $addressTransfer->setAddress1('Test address 1')
            ->setCustomerId('123456')
            ->setAddress2('street 1')
            ->setAddress3('house number')
            ->setCompany('Company 1')
            ->setAddress1('Company 1')
            ->setCity('Berlin')
            ->setZipCode('zip code')
            ->setIso2Code('DE');

        $result =  [
            'ticket' =>
                [
                    'subject' => 'test Subject',
                    'ticket_form_id' => self::TICKET_FORM_ID,
                    'comment' => [
                        'body' => self::COMMENT_BODY,
                        'html_body' => self::COMMENT_HTML_BODY,
                        'public' => false,
                    ],
                    'custom_fields' =>
                        [
                            [
                                'id' => self::SHOP_FIELD,
                                'value' => 'shop',
                            ],
                            [
                                'id' => self::CUSTOMER_ID_FIELD,
                                'value' => $addressTransfer->getCustomerId(),
                            ],
                            [
                                'id' => 360015218800,
                                'value' => 'lieferadresse_aendern',
                            ],
                            [
                                'id' => self::COMPANY_NAME_FIELD,
                                'value' => $addressTransfer->getCompany(),
                            ],
                            [
                                'id' => self::STREET_FIELD,
                                'value' => $addressTransfer->getAddress2(),
                            ],
                            [
                                'id' => self::HOUSE_NR_FIELD,
                                'value' => $addressTransfer->getAddress3(),
                            ],
                            [
                                'id' => self::ZIPCODE_FIELD,
                                'value' => $addressTransfer->getZipCode(),
                            ],
                            [
                                'id' => self::CITY_FIELD,
                                'value' => $addressTransfer->getCity(),
                            ],
                            [
                                'id' => self::COUNTRY_FIELD,
                                'value' => $this->getCountryName($addressTransfer),
                            ],
                        ],
                    'requester' =>
                        [
                            'name' => $addressTransfer->getFirstName() . ' ' . $addressTransfer->getLastName(),
                            'email' => $addressTransfer->getEmail(),
                            'verified' => 'true',
                        ],
                ],
        ];



        $paramsMapper->method('mapAddressTransferToRequestBody')
        ->willReturn(
           $result
        );

        $requestParamsArray = $paramsMapper->mapAddressTransferToRequestBody($addressTransfer);

        foreach ($requestParamsArray['ticket']['custom_fields'] as $customField) {
            if ($customField['id'] == 360009262759) {
                self::assertEquals($customField['value'], '123456');
            }

            if ($customField['id'] == 6798919830802) {
                self::assertEquals($customField['value'], 'street 1');
            }

            if ($customField['id'] == 6799443912594) {
                self::assertEquals($customField['value'], 'house number');
            }

            if ($customField['id'] == 6798941012114) {
                self::assertEquals($customField['value'], 'zip code');
            }

            if ($customField['id'] == 6799503809938) {
                self::assertEquals($customField['value'], 'Company 1');
            }

            if ($customField['id'] == 6798985636754) {
                self::assertEquals($customField['value'], 'Berlin');
            }

            if ($customField['id'] == 6799468966418) {
                self::assertEquals($customField['value'], 'Deutschland');
            }
        }
    }

    /**
     * @return void
     */
    public function testMapSendCatalogViaPostTransferToRequestBody(): void
    {
        $configMock = $this->getMockBuilder(ZenDeskConfig::class)->getMock();
        $configMock->method('getZenDeskSendAddressRequestSubject')->willReturn('online_test');
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
                    (new StoryblokCatalogTransfer())
                        ->setAssetId('5')
                        ->setSourceCompany('object'),
                    (new StoryblokCatalogTransfer())
                        ->setAssetId('7')
                        ->setSourceCompany('pflege'),
                    (new StoryblokCatalogTransfer())
                        ->setAssetId('9')
                        ->setSourceCompany('object'),
                ]),
            );

        $result = $paramsMapper
            ->mapSendCatalogViaPostTransferToRequestBody($sendCatalogViaPostTransfer);
        self::assertSame($this->getExpectedMapSendCatalogViaPostTransferToRequestBodyData(), $result);
    }

    /**
     * @return array
     */
    private function getExpectedMapSendCatalogViaPostTransferToRequestBodyData(): array
    {
        return [
            'tickets' => [
                [
                    'subject' => 'Neue Katalogbestellung per Post',
                    'ticket_form_id' => '7824926208530',
                    'comment' => [
                        'body' => 'Neue Katalogbestellung per Post',
                        'html_body' => 'Neue Katalogbestellung: <br/>Katalog 3<br/>Katalog 7<br/>',
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
                [
                    'subject' => 'Neue Katalogbestellung per Post',
                    'ticket_form_id' => '7824926208530',
                    'comment' => [
                        'body' => 'Neue Katalogbestellung per Post',
                        'html_body' => 'Neue Katalogbestellung: <br/>Katalog 5<br/>Katalog 9<br/>',
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
                            'value' => 'object',
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
        ];
    }


    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return string
     */
    private function getCountryName(AddressTransfer $addressTransfer): string
    {
        $iso2Code = $addressTransfer->getIso2Code();

        if (!$iso2Code) {
            return '';
        }

        $glossaryStorageClient =  $this->getMockBuilder(GlossaryStorageClient::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['translate'])
            ->getMock();

        $glossaryStorageClient->method('translate')->willReturn('Deutschland');
        $localeClient = $this->getMockBuilder(LocaleClient::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getCurrentLocale'])
            ->getMock();
        $localeClient->method('getCurrentLocale')->willReturn('EU');
        return $glossaryStorageClient->translate(
            sprintf('countries.iso.%s', $iso2Code),
            $localeClient,
        );
    }
}
