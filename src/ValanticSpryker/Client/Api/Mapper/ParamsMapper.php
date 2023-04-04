<?php

namespace ValanticSpryker\Client\ZendeskClient\Api\Mapper;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\SendCatalogViaPostTransfer;
use ValanticSpryker\Client\ZenDesk\ZenDeskConfig;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Locale\LocaleClientInterface;


class ParamsMapper
{
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
    private const COMPANY_NAME_2_FIELD = 6799497457810;

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
     * @var \Pyz\Client\ZenDesk\ZenDeskConfig
     */
    private ZenDeskConfig $config;

    private GlossaryStorageClientInterface $glossaryStorageClient;

    private LocaleClientInterface $localeClient;

    /**
     * @param \Pyz\Client\ZenDesk\ZenDeskConfig $config
     * @param \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface $glossaryStorageClient
     * @param \Spryker\Client\Locale\LocaleClientInterface $localeClient
     */
    public function __construct(
        ZenDeskConfig $config,
        GlossaryStorageClientInterface $glossaryStorageClient,
        LocaleClientInterface $localeClient
    ) {
        $this->config = $config;
        $this->glossaryStorageClient = $glossaryStorageClient;
        $this->localeClient = $localeClient;
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return array
     */
    public function mapAddressTransferToRequestBody(AddressTransfer $addressTransfer): array
    {
        $bodyArray = [
            'ticket' =>
                [
                    'subject' => $this->config->getZenDeskSendAddressRequestSubject(),
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

                                'id' => self::COMPANY_NAME_2_FIELD,
                                'value' => $addressTransfer->getCompany2(),
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

        return $bodyArray;
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

        return $this->glossaryStorageClient->translate(
            sprintf('countries.iso.%s', $iso2Code),
            $this->localeClient->getCurrentLocale(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer
     *
     * @return array
     */
    public function mapSendCatalogViaPostTransferToRequestBody(SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer): array
    {
        $catalogsHtmlStringPerCompany = $this->buildCatalogsHtmlStringPerCompany($sendCatalogsViaPostTransfer);

        $tickets = [];
        foreach ($catalogsHtmlStringPerCompany as $company => $catalogsHtmlString) {
            $tickets[] = [
                'subject' => $this->config->getZendeskSendCatalogsRequestSubject(),
                'ticket_form_id' => '7824926208530',
                'comment' => [
                    'body' => $this->config->getZendeskSendCatalogsRequestSubject(),
                    'html_body' => $catalogsHtmlString,
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
                            'value' => '',
                        ],
                        [
                            'id' => self::COMPANY_NAME_FIELD,
                            'value' => $sendCatalogsViaPostTransfer->getName(),
                        ],
                        [
                            'id' => self::COMPANY_NAME_2_FIELD,
                            'value' => $sendCatalogsViaPostTransfer->getCompany(),
                        ],
                        [
                            'id' => self::POSITION_FIELD,
                            'value' => $sendCatalogsViaPostTransfer->getPosition() ?? '',
                        ],
                        [
                            'id' => self::PHONE_FIELD,
                            'value' => $sendCatalogsViaPostTransfer->getPhone(),
                        ],
                        [
                            'id' => self::ORGANIZATION_FIELD,
                            //Organization (objekt_plus,pflege_plus,textil_plus,service_plus,wibu_gruppe,illenseer)
                            'value' => $company,
                        ],
                        [
                            'id' => self::STREET_FIELD,
                            'value' => $sendCatalogsViaPostTransfer->getAddress(),
                        ],
                        [
                            'id' => self::HOUSE_NR_FIELD,
                            'value' => '',
                        ],
                        [
                            'id' => self::ZIPCODE_FIELD,
                            'value' => $sendCatalogsViaPostTransfer->getZip(),
                        ],
                        [
                            'id' => self::CITY_FIELD,
                            'value' => $sendCatalogsViaPostTransfer->getCity(),
                        ],
                        [
                            'id' => self::COUNTRY_FIELD,
                            'value' => $sendCatalogsViaPostTransfer->getCountry(),
                        ],
                    ],
                'requester' =>
                    [
                        'name' => $sendCatalogsViaPostTransfer->getName(),
                        'email' => $sendCatalogsViaPostTransfer->getEmail(),
                        'verified' => 'true',
                    ],

            ];
        }

        return ['tickets' => $tickets];
    }

    /**
     * @param \Generated\Shared\Transfer\SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer
     *
     * @return array
     */
    private function buildCatalogsHtmlStringPerCompany(SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer): array
    {
        $catalogsHtmlStringPerCompany = [];
        foreach ($sendCatalogsViaPostTransfer->getSelectedCatalogs() as $selectedCatalog) {
            if (!isset($catalogsHtmlStringPerCompany[$selectedCatalog->getSourceCompany()])) {
                $catalogsHtmlStringPerCompany[$selectedCatalog->getSourceCompany()] = 'Neue Katalogbestellung: <br/>';
            }

            $catalogName = sprintf('Katalog %s<br/>', $selectedCatalog->getAssetId());

            $catalogsHtmlStringPerCompany[$selectedCatalog->getSourceCompany()] .= $catalogName;
        }

        return $catalogsHtmlStringPerCompany;
    }
}

