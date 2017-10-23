<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\HashUserId;

use Piwik\Common;
use Piwik\Container\StaticContainer;
use Psr\Log\LoggerInterface;
use Piwik\Plugin;
use Exception;

class HashUserId extends \Piwik\Plugin
{
    public function activate()
    {
		$logger = StaticContainer::get('Psr\Log\LoggerInterface');
		$logger->info('Plugin HashUserId activated');
    }

    public function deactivate()
    {
        $logger = StaticContainer::get('Psr\Log\LoggerInterface');
        $logger->info('Plugin HashUserId deactivated.');
    }
}