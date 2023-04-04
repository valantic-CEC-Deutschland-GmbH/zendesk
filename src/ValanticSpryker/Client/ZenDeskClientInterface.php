<?php
declare(strict_types = 1);

namespace ValanticSpryker\Client\ZendeskClient;

interface ZenDeskClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressAtransfer
     *
     * @return bool
     */
    public function sendAddressPersistRequest(AddressTransfer $addressAtransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer
     *
     * @return \Generated\Shared\Transfer\SendCatalogViaPostTransfer
     */
    public function sendCatalogsViaPost(SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer): SendCatalogViaPostTransfer;

}
