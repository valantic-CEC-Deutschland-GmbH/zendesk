<?php
declare(strict_types = 1);

namespace ValanticSpryker\Client\ZendeskClient;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\SendCatalogViaPostTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \ValanticSpryker\Client\ZenDesk\ZenDeskFactory getFactory()
 */
class ZenDeskClient extends AbstractClient implements ZenDeskClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressAtransfer
     *
     * @return bool
     */
    public function sendAddressPersistRequest(AddressTransfer $addressAtransfer): bool
    {
        return $this->getFactory()->getZenDeskServiceAdapter()->sendCustomerAddress($addressAtransfer);
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
