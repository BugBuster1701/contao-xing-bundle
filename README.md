# Contao 4 XING Bundle

This Contao 4 extension is still in development.


## Installation (en)

Installation in a Composer-based Contao 4.1 Installation

`composer require "bugbuster/contao-xing-bundle:1.0.*"`

Add in `app/AppKernel.php` following line at the end of the `$bundles` array.

`new BugBuster\XingBundle\BugBusterXingBundle(),`

Clear the cache and rebuild:

`app/console cache:clear --env=prod`

`app/console cache:warmup -e prod`

Call http://yourdomain/install.php , update the database.


## Installation (de)

Installation in einer Composer-basierten Contao 4.1 Installation

`composer require "bugbuster/contao-xing-bundle:1.0.*"`

In `app/AppKernel.php` folgende Zeile am Ende des `$bundles` Arrays hinzufügen.

`new BugBuster\XingBundle\BugBusterXingBundle(),`

Nun den Cache löschen und neu aufbauen:

`app/console cache:clear --env=prod`

`app/console cache:warmup -e prod`

Aufruf http://yourdomain/install.php , Datenbank Update durchführen

Fertig.
