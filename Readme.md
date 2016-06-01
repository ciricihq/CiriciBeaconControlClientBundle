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

## Configuration

Add the next parameters to `parameters.yml`:

```yml
    beacon_control_s2s_api_id: <your beacon-control oauth api id>
    beacon_control_s2s_api_secret: <your beacon-control oauth api secret>
    beacon_control_s2s_admin_email: <your beacon-control admin email>
    beacon_control_s2s_admin_password: <your beacon-control admin password>
    beacon_control_s2s_api_base_url: <your beacon-control api base-url>
```

Enjoy!
