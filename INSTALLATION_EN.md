# Installation of Contao 4/5 XING Bundle

There are two types of installation.

* with the Contao-Manager, for Contao Managed-Editon
* via the command line, for Contao Managed-Editon


## Installation with Contao-Manager

* search for package: `bugbuster/contao-xing-bundle`
* install the package
* update the database


## Installation via command line

Installation in a Composer-based Contao 5.2+ Managed-Edition:

* `composer require "bugbuster/contao-xing-bundle"`
* `php bin/console contao:migrate`

(for Contao 5.3 use "... contao-xing-bundle:^1.3")

(for Contao 4.13 use "... contao-xing-bundle:^1.2")
