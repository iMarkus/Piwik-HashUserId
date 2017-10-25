<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\HashUserId\Columns;

use Piwik\Cache;
use Piwik\DataTable;
use Piwik\DataTable\Map;
use Piwik\Metrics;
use Piwik\Piwik;
use Piwik\Plugin\Dimension\VisitDimension;
use Piwik\Plugin\Segment;
use Piwik\Plugins\VisitsSummary\API as VisitsSummaryApi;
use Piwik\Tracker\Request;
use Piwik\Tracker\Visitor;
use Piwik\Tracker\Action;
use Piwik\Config;

/**
 * UserId dimension.
 */
class UserId extends VisitDimension
{
    /**
     * @var string
     */
    protected $columnName = 'user_id';

    /**
     * @var string
     */
    protected $columnType = 'VARCHAR(200) NULL';

    /**
     * @param Request $request
     * @param Visitor $visitor
     * @param Action|null $action
     * @return mixed|false
     */
    public function onNewVisit(Request $request, Visitor $visitor, $action)
    {
      $uid = $visitor->getVisitorColumn('user_id');
      if(!empty($uid))
      {
        $salt = Config::getInstance()->General['salt'];
        $hash = substr(sha1($salt.$uid), 0, 16);
        $visitor->setVisitorColumn('user_id', $hash);
        return $hash;
      }
      return $uid;
    }

    /**
     * @param Request $request
     * @param Visitor $visitor
     * @param Action|null $action
     *
     * @return mixed|false
     */
    public function onExistingVisit(Request $request, Visitor $visitor, $action)
    {
      $uid = $visitor->getVisitorColumn('user_id');
      if(!empty($uid))
      {
        $salt = Config::getInstance()->General['salt'];
        $hash = substr(sha1($salt.$uid), 0, 16);
        $visitor->setVisitorColumn('user_id', $hash);
        return $hash;
      }
      return $uid;
    }
}