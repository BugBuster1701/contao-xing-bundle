<?php

declare(strict_types=1);

/*
 * This file is part of a BugBuster Contao Bundle.
 *
 * @copyright  Glen Langer 2024 <http://contao.ninja>
 * @author     Glen Langer (BugBuster)
 * @package    Contao Xing Bundle
 * @link       https://github.com/BugBuster1701/contao-xing-bundle
 *
 * @license    LGPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace BugBuster\XingBundle\Tests;

use BugBuster\XingBundle\BugBusterXingBundle;
use PHPUnit\Framework\TestCase;

class BugBusterXingBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new BugBusterXingBundle();

        $this->assertInstanceOf('BugBuster\XingBundle\BugBusterXingBundle', $bundle);
    }
}
