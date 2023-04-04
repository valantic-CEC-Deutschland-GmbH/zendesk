<?php

namespace ValanticSpryker\Client\Api\Mapper;

use ArrayObject;
use Codeception\TestCase\Test;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\SendCatalogViaPostTransfer;
use Generated\Shared\Transfer\StoryblokCatalogTransfer;
use ValanticSpryker\Client\ZenDesk\Api\Mapper\ParamsMapper;
use ValanticSpryker\Client\ZenDesk\ZenDeskConfig;
use ValanticSpryker\Shared\ZenDesk\ZenDeskConstants;
use ValanticSpryker\Client\ZenDesk\ZenDeskTester;

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
class ParamsMapperTest extends Test
{
    protected ZenDeskTester $tester;

    /**
     * @return void
     */
    public function testMapAddressTransferToRequestBody(): void
    {
        $this->tester->setConfig(ZenDeskConstants::ZENDESK_IS_TEST_MODE, true);
        $config = new ZenDeskConfig();

        $paramsMapper = new ParamsMapper(
            $config,
            $this->tester->getLocator()->glossaryStorage()->client(),
            $this->tester->getLocator()->locale()->client(),
        );
        $addressTransfer = new AddressTransfer();
        $countryTransfer = new CountryTransfer();
        $countryTransfer->setName('Germany');
        $addressTransfer->setAddress1('Test address 1')
            ->setCustomerId('123456')
            ->setAddress2('street 1')
            ->setAddress3('house number')
            ->setCompany('Company 1')
            ->setAddress1('Company 1')
            ->setCompany2('Company 2')
            ->setCity('Berlin')
            ->setZipCode('zip code')
            ->setIso2Code('DE');
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

            if ($customField['id'] == 6799497457810) {
                self::assertEquals($customField['value'], 'Company 2');
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
        $this->tester->setConfig(ZenDeskConstants::ZENDESK_IS_TEST_MODE, false);
        $config = new ZenDeskConfig();

        $paramsMapper = new ParamsMapper(
            $config,
            $this->tester->getLocator()->glossaryStorage()->client(),
            $this->tester->getLocator()->locale()->client(),
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
                            'id' => 6799497457810,
                            'value' => 'Acme GMBH',
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
                            'id' => 6799497457810,
                            'value' => 'Acme GMBH',
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
}

