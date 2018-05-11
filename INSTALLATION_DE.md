# Installation von Contao 4 XING Bundle

Es gibt zwei Arten der Installation.

* mit dem Contao-Manager, nur für die Contao Managed-Editon
* über die Kommandozeile, für Contao Standard-Edition und Managed-Editon


## Installation über Contao-Manager

* Suche das Paket: `bugbuster/contao-xing-bundle`
* Installation der Erweiterung
* Klick auf "Install Tool"
* Anmelden und Datenbank Update durchführen


## Installation über die Kommandozeile

### Installation in einer Contao Managed-Edition

Installation in einer Composer-basierenden Contao 4.3+ Managed-Edition:

* `composer require "bugbuster/contao-xing-bundle"`
* Aufruf https://deinedomain/contao/install
* Datenbank Update durchführen


### Installation in einer Contao Standard-Edition

Installation in einer Composer-basierenden Contao 4.3+ Standard-Edition:

* `composer require "bugbuster/contao-xing-bundle"`

Einfügen in `app/AppKernel.php` folgende Zeile am Ende des Array `$bundles`:

`new BugBuster\XingBundle\BugBusterXingBundle(),`

Cache leeren und neu anlegen lassen:

* `bin/console cache:clear --env=prod --no-warmup`
* `bin/console cache:warmup --env=prod`
* Aufruf https://deinedomain/contao/install
* Datenbank Update durchführen
