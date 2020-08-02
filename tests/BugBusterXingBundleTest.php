<?php

/*
 * @copyright  Glen Langer 2008..2020<http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 * @package    Xing
 * @license    LGPL-3.0-or-later
 * @see	       https://github.com/BugBuster1701/contao-xing-bundle
 */

namespace BugBuster\XingBundle\Tests;

use BugBuster\XingBundle\BugBusterXingBundle;
use PHPUnit\Framework\TestCase;

class BugBusterXingBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new BugBusterXingBundle();

        $this->assertInstanceOf('BugBuster\XingBundle\BugBusterXingBundle', $bundle);
    }
}
