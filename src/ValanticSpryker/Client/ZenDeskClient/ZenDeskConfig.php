<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\ZenDeskClient;

use Spryker\Client\Kernel\AbstractBundleConfig;
use ValanticSpryker\Shared\Zendesk\ZenDeskConstants;

class ZenDeskConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    private const TEST_MODE_SUBJECT = 'wibu_online_2022_test';

    /**
     * @var string
     */
    private const SEND_CATALOGS_REQUEST_SUBJECT = 'Neue Katalogbestellung per Post';

    /**
     * @var string
     */
    private const SEND_ADDRESS_REQUEST_SUBJECT = 'Zukünftige Lieferadresse ändern';

    /**
     * @return string
     */
    public function getZenDeskSingleTicketApiUrl(): string
    {
        return $this->get(ZenDeskConstants::ZENDESK_SINGLE_TICKET_API_URL);
    }

    /**
     * @return string
     */
    public function getZenDeskUsername(): string
    {
        return $this->get(ZenDeskConstants::ZENDESK_USERNAME);
    }

    /**
     * @return string
     */
    public function getZenDeskPassword(): string
    {
        return $this->get(ZenDeskConstants::ZENDESK_PASSWORD);
    }

    /**
     * @return string
     */
    public function getZenDeskSendAddressRequestSubject(): string
    {
        if ($this->isTestMode()) {
            return self::TEST_MODE_SUBJECT;
        }

        return self::SEND_ADDRESS_REQUEST_SUBJECT;
    }

    /**
     * @return string
     */
    public function getZendeskSendCatalogsRequestSubject(): string
    {
        if ($this->isTestMode()) {
            return self::TEST_MODE_SUBJECT;
        }

        return self::SEND_CATALOGS_REQUEST_SUBJECT;
    }

    /**
     * @return string
     */
    public function getZendeskMultipleTicketsApiUrl(): string
    {
        return $this->get(ZenDeskConstants::ZENDESK_MULTIPLE_TICKETS_API_URL);
    }

    /**
     * @return bool
     */
    private function isTestMode(): bool
    {
        return $this->get(ZenDeskConstants::ZENDESK_IS_TEST_MODE);
    }
}
