# CiriciBeaconControlClientBundle

This bundle connects to BeaconControl api's to perform various actions

The documentation of the API can be found here: https://beaconcontrol.io/dev/backend/api_docs/index.html

## Install

Require the bundle using composer:

```bash
composer require ciricihq/cirici-beacon-control-client-bundle:dev-master
```

Add it to `AppKernel.php`:

```php
        $bundles = [
            ...
            new Cirici\BeaconControlClientBundle\CiriciBeaconControlClientBundle(),
            ...
        ]
```

Configure the BeaconControl API endpoint for GuzzleBundle:

```yml
guzzle:
    clients:
        beacon_contol_s2s:
            base_url: "%beacon_control_s2s_api_base_url%"
```

Enjoy!
