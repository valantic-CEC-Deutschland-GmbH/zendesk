<?php

declare(strict_types = 1);

use Spryker\Shared\Kernel\KernelConstants;
use Spryker\Shared\Propel\PropelConstants;
use Spryker\Zed\Propel\PropelConfig;
use ValanticSpryker\Shared\Zendesk\ZenDeskConstants;

$config[KernelConstants::ENABLE_CONTAINER_OVERRIDING] = true;
$config[KernelConstants::PROJECT_NAMESPACE] = 'Pyz';
$config[KernelConstants::PROJECT_NAMESPACES] = [
    'Pyz',
];
$config[KernelConstants::CORE_NAMESPACES] = [
    'Spryker',
    'ValanticSpryker',
];

$config[PropelConstants::ZED_DB_ENGINE]
    = strtolower(getenv('SPRYKER_DB_ENGINE') ?: '') ?: PropelConfig::DB_ENGINE_MYSQL;
$config[PropelConstants::ZED_DB_HOST] = getenv('SPRYKER_DB_HOST');
$config[PropelConstants::ZED_DB_PORT] = getenv('SPRYKER_DB_PORT');
$config[PropelConstants::ZED_DB_USERNAME] = getenv('SPRYKER_DB_USERNAME');
$config[PropelConstants::ZED_DB_PASSWORD] = getenv('SPRYKER_DB_PASSWORD');
$config[PropelConstants::ZED_DB_DATABASE] = getenv('SPRYKER_DB_DATABASE');
$config[PropelConstants::USE_SUDO_TO_MANAGE_DATABASE] = false;

$config[ZenDeskConstants::ZENDESK_BASE_API_URL] = 'https://wibu-gruppe.zendesk.com/api/v2';
$config[ZenDeskConstants::ZENDESK_SINGLE_TICKET_API_URL] = $config[ZenDeskConstants::ZENDESK_BASE_API_URL] . '/tickets';
$config[ZenDeskConstants::ZENDESK_MULTIPLE_TICKETS_API_URL] = $config[ZenDeskConstants::ZENDESK_BASE_API_URL] . '/tickets/create_many';
$config[ZenDeskConstants::ZENDESK_USERNAME] = getenv('ZENDESK_USERNAME') ?: '';
$config[ZenDeskConstants::ZENDESK_PASSWORD] = getenv('ZENDESK_PASSWORD') ?: '';
$config[ZenDeskConstants::ZENDESK_IS_TEST_MODE] = true;
