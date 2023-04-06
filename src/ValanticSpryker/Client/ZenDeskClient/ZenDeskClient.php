<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\ZenDeskClient;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\SendCatalogViaPostTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \ValanticSpryker\Client\ZenDeskClient\ZenDeskFactory getFactory()
 */
class ZenDeskClient extends AbstractClient implements ZenDeskClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addresstransfer
     *
     * @return bool
     */
    public function sendAddressPersistRequest(AddressTransfer $addresstransfer): bool
    {
        return $this->getFactory()->getZenDeskServiceAdapter()->sendCustomerAddress($addresstransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer
     *
     * @return \Generated\Shared\Transfer\SendCatalogViaPostTransfer
     */
    public function sendCatalogsViaPost(SendCatalogViaPostTransfer $sendCatalogsViaPostTransfer): SendCatalogViaPostTransfer
    {
        return $this->getFactory()
            ->getZenDeskServiceAdapter()
            ->sendCatalogs($sendCatalogsViaPostTransfer);
    }
}
