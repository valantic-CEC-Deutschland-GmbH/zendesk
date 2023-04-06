<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\ZenDeskClient\Api;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\SendCatalogViaPostTransfer;
use ValanticSpryker\Client\ZenDeskClient\Api\Mapper\ParamsMapper;
use ValanticSpryker\Client\ZenDeskClient\ZenDeskConfig;

class ZenDeskServiceAdapter
{
    private ZenDeskApi $zendeskApi;

    private ParamsMapper $paramsMapper;

    private ZenDeskConfig $config;

    /**
     * @param \ValanticSpryker\Client\ZenDeskClient\Api\ZenDeskApi $zenDeskApi
     * @param \ValanticSpryker\Client\ZenDeskClient\Api\Mapper\ParamsMapper $paramsMapper
     * @param \ValanticSpryker\Client\ZenDeskClient\ZenDeskConfig $config
     */
    public function __construct(
        ZenDeskApi $zenDeskApi,
        ParamsMapper $paramsMapper,
        ZenDeskConfig $config
    ) {
        $this->zendeskApi = $zenDeskApi;
        $this->paramsMapper = $paramsMapper;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return bool
     */
    public function sendCustomerAddress(AddressTransfer $addressTransfer): bool
    {
        $requestBodyArray = $this->paramsMapper->mapAddressTransferToRequestBody($addressTransfer);

        return $this->zendeskApi->request(
            $this->config->getZenDeskSingleTicketApiUrl(),
            $requestBodyArray,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer
     *
     * @return \Generated\Shared\Transfer\SendCatalogViaPostTransfer
     */
    public function sendCatalogs(SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer): SendCatalogViaPostTransfer
    {
        $body = $this
            ->paramsMapper
            ->mapSendCatalogViaPostTransferToRequestBody($sendCatalogsViaPostTransfer);

        $isSuccess = $this->zendeskApi->request(
            $this->config->getZendeskMultipleTicketsApiUrl(),
            $body,
        );

        $sendCatalogsViaPostTransfer->setIsSuccess($isSuccess);

        return $sendCatalogsViaPostTransfer;
    }
}
