# TYPO3 CMS Base Distribution

Get going quickly with TYPO3 CMS.

## Prerequisites

* PHP 7.4
* [Composer](https://getcomposer.org/download/)
* [DDEV](https://ddev.com) || [DDEV Documentation](https://ddev.readthedocs.io)

## Quickstart

* Clone this project: `git clone ...`
* Check DDEV config in `.ddev/config.yaml` / run `ddev config` to change values
* `ddev start`
* `ddev composer install`

### Setup TYPO3

To start an interactive installation, you can do so by executing the following
command and then follow the wizard:

```bash
composer exec typo3cms install:setup
```

**OR**

```bash
ddev typo3cms install:setup \
    --admin-user-name=admin \
    --admin-password=password \
    --web-server-config=apache
````

**OR**

### Setup unattended (optional)

If you're a more advanced user, you might want to leverage the unattended installation.
To do this, you need to execute the following command and substitute the arguments
with your own environment configuration.


## License

GPL-2.0 or later
