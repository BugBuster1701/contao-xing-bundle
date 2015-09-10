# Contao 4 XING Bundle

This Contao 4 extension is still in development.

## Installation (vorläufig)

In das Contao Installationsverzeichnis wechseln, ein Verzeichnis anlegen:

```bash
mkdir vendor/bugbuster
```

Kopiere das Verzeichnis `xing_contao_bundle` nach `vendor/bugbuster`.
Damit muss existieren: `vendor/bugbuster/xing_contao_bundle/`

In `vendor/composer/autoload_psr4.php`
Zeile am Ende hinzufügen, ein Komma am Ende der alten letzten Zeile nicht vergessen

```php
'BugBuster\\XingBundle\\' => array($vendorDir . '/bugbuster/xing_contao_bundle/src')
```

Symbolischen Link anlegen für das öffentliche Verzeichnis:

```bash
cd web/bundles/
ln -s ../../vendor/bugbuster/xing_contao_bundle/src/Resources/public/ contaoxing
cd ../..
```

Auruf http://yourdomain/install.php , Datenbank Update durchführen

Fertig.
