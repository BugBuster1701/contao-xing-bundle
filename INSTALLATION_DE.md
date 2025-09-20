# Installation von Contao 4/5 XING Bundle

Es gibt zwei Arten der Installation.

* mit dem Contao-Manager, für die Contao Managed-Editon
* über die Kommandozeile, für die Contao Managed-Editon


## Installation über Contao-Manager

* Suche das Paket: `bugbuster/contao-xing-bundle`
* Installation der Erweiterung
* Datenbank Update durchführen


## Installation über die Kommandozeile

Installation in einer Composer-basierenden Contao 5.3+ Managed-Edition:

* `composer require "bugbuster/contao-xing-bundle"`
* `php bin/console contao:migrate`

(für Contao 5.6+ benutze "... contao-xing-bundle:^2.0")

(für Contao 5.4+ benutze "... contao-xing-bundle:^1.4")

(für Contao 5.3 benutze "... contao-xing-bundle:^1.3")

(für Contao 4.13 benutze "... contao-xing-bundle:^1.2")
