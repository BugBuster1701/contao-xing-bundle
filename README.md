# Contao 4 XING Bundle

This Contao 4 extension is still in development.

## Installation (vorläufig)

Download ZIP: https://github.com/BugBuster1701/contao-xing-bundle/archive/develop.zip,
auspacken und das Verzeichnis `contao-xing-bundle-develop` umbenennen nach `contao-xing-bundle`.

In das Contao 4 Installationsverzeichnis wechseln, im Verzeichnis `vendor` ein Verzeichnis `bugbuster` anlegen:

```bash
mkdir vendor/bugbuster
```

Kopiere das umbenannte Verzeichnis `contao-xing-bundle` nach `vendor/bugbuster`.
Damit muss existieren: `vendor/bugbuster/contao-xing-bundle/`

In `vendor/composer/autoload_psr4.php`
Zeile am Ende hinzufügen, ein Komma am Ende der alten letzten Zeile nicht vergessen.

```php
'BugBuster\\XingBundle\\' => array($vendorDir . '/bugbuster/contao-xing-bundle/src')
```

In `app/AppKernel.php` 
Zeile am Ende des $bundle Arrays hinzufügen.

```php
new BugBuster\XingBundle\BugBusterXingBundle(),
```

Symbolischen Link anlegen für das öffentliche Verzeichnis:

```bash
cd web/bundles/
ln -s ../../vendor/bugbuster/contao-xing-bundle/src/Resources/public/ contaoxing
cd ../..
```

Aufruf http://yourdomain/install.php , Datenbank Update durchführen

Fertig.
