# zendesk

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.0-8892BF.svg)](https://php.net/)
[![coverage report](https://gitlab.nxs360.com/packages/php/spryker/example-package/badges/master/pipeline.svg)](https://gitlab.nxs360.com/packages/php/spryker/example-package/-/pipelines?page=1&scope=all&ref=master)
[![coverage report](https://gitlab.nxs360.com/packages/php/spryker/example-package/badges/master/coverage.svg)](https://packages.gitlab-pages.nxs360.com/php/spryker/example-package)

# Description
 - Adds ZenDesk client to spryker

## Integration

### Add composer registry
```
composer config repositories.gitlab.nxs360.com/461 '{"type": "composer", "url": "https://gitlab.nxs360.com/api/v4/group/461/-/packages/composer/packages.json"}'
```

### Add Gitlab domain
```
composer config gitlab-domains gitlab.nxs360.com
```

### Authentication
Go to Gitlab and create a personal access token. Then create an **auth.json** file:
```
composer config gitlab-token.gitlab.nxs360.com <personal_access_token>
```

Make sure to add **auth.json** to your **.gitignore**.

### Install package
```
composer req valantic-spryker/zendesk
