# Contao 4 XING Bundle

This Contao 4 extension is still in development.


## Installation (en)

Installation in a Composer-based Contao 4.1 Installation

`composer require "bugbuster/contao-xing-bundle:1.0.*"`

Add in `app/AppKernel.php` following line at the end of the `$bundles` array.

`new BugBuster\XingBundle\BugBusterXingBundle(),`

Clears the cache and warms up an empty cache:

`app/console cache:clear --env=prod`

`app/console cache:warmup -e prod`

Installs bundles web assets under a public web directory

`app/console assets:install`

Call http://yourdomain/install.php , update the database.


## Installation (de)

Installation in einer Composer-basierten Contao 4.1 Installation

`composer require "bugbuster/contao-xing-bundle:1.0.*"`

In `app/AppKernel.php` folgende Zeile am Ende des `$bundles` Arrays hinzufügen.

`new BugBuster\XingBundle\BugBusterXingBundle(),`

Nun den Cache löschen und neu aufbauen:

`app/console cache:clear --env=prod`

`app/console cache:warmup -e prod`

Installieren des Bundle Web-Assets ins öffentliche `web/` Verzeichnis:

`app/console assets:install`

Aufruf http://yourdomain/install.php , Datenbank Update durchführen

Fertig.
