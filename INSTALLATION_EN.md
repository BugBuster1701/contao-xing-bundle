# Installation of Contao 4 XING Bundle

There are two types of installation.

* with the Contao-Manager, only for Contao Managed-Editon
* via the command line, for Contao Standard-Edition and Managed-Editon


## Installation with Contao-Manager

* search for package: `bugbuster/contao-xing-bundle`
* install the package
* Click on "Install Tool"
* Login and update the database


## Installation via command line

### Installation for Contao Managed-Edition

Installation in a Composer-based Contao 4.3+ Managed-Edition:

* `composer require "bugbuster/contao-xing-bundle"`
* Call http://yourdomain/contao/install
* Login and update the database


### Installation for Contao Standard-Edition

Installation in a Composer-based Contao 4.3+ Standard-Edition

* `composer require "bugbuster/contao-xing-bundle"`

Add in `app/AppKernel.php` following line at the end of the `$bundles` array.

`new BugBuster\XingBundle\BugBusterXingBundle(),`

Clears the cache and warms up an empty cache:

* `bin/console cache:clear --env=prod --no-warmup`
* `bin/console cache:warmup --env=prod`
* Call http://yourdomain/contao/install
* Login and update the database

