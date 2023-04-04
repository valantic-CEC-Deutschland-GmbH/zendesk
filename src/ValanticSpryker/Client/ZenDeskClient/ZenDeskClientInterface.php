<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\ZenDeskClient;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\SendCatalogViaPostTransfer;

interface ZenDeskClientInterface
{
    /**
     * Specification:
     * - Sends address request to Zendesk
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AddressTransfer $addresstransfer
     *
     * @return bool
     */
    public function sendAddressPersistRequest(AddressTransfer $addresstransfer): bool;

    /**
     * Specification:
     * - Sends catalog request via post
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer
     *
     * @return \Generated\Shared\Transfer\SendCatalogViaPostTransfer
     */
    public function sendCatalogsViaPost(SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer): SendCatalogViaPostTransfer;
}
