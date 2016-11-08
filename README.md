# Contao 4 XING Bundle


[![Latest Stable Version](https://poser.pugx.org/bugbuster/contao-xing-bundle/v/stable.svg)](https://packagist.org/packages/bugbuster/contao-xing-bundle) [![Total Downloads](https://poser.pugx.org/bugbuster/contao-xing-bundle/downloads.svg)](https://packagist.org/packages/bugbuster/contao-xing-bundle) [![Latest Unstable Version](https://poser.pugx.org/bugbuster/contao-xing-bundle/v/unstable.svg)](https://packagist.org/packages/bugbuster/contao-xing-bundle) [![License](https://poser.pugx.org/bugbuster/contao-xing-bundle/license.svg)](https://packagist.org/packages/bugbuster/contao-xing-bundle)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d95002f6-9ba5-4b5f-8c2a-5d2f3ffbfe84/small.png)](https://insight.sensiolabs.com/projects/d95002f6-9ba5-4b5f-8c2a-5d2f3ffbfe84)


## About
Adding XING banner as a module, with categories.


## Installation (en)

Installation in a Composer-based Contao 4.2 Installation

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

Installation in einer Composer-basierten Contao 4.2 Installation

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
