<?php

//
// Open Web Analytics - An Open Source Web Analytics Framework
//
// Copyright 2006 Peter Adams. All rights reserved.
//
// Licensed under GPL v2.0 http://www.gnu.org/copyleft/gpl.html
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//
// $Id$
//

/**
 * Session Entity
 * 
 * @author      Peter Adams <peter@openwebanalytics.com>
 * @copyright   Copyright &copy; 2006 Peter Adams <peter@openwebanalytics.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GPL v2.0
 * @category    owa
 * @package     owa
 * @version		$Revision$	      
 * @since		owa 1.0.0
 */

class owa_session extends owa_entity {
	
	function __construct() {
	
		// table name
		$this->setTableName('session');
		$this->setSummaryLevel(1);
		
		// properties
		$this->properties['id'] = new owa_dbColumn;
		$this->properties['id']->setDataType(OWA_DTD_BIGINT);
		$this->properties['id']->setPrimaryKey();
		
		$visitor_id = new owa_dbColumn('visitor_id', OWA_DTD_BIGINT);
		$visitor_id->setForeignKey('base.visitor');
		$this->setProperty($visitor_id);
		
		$ts =  new owa_dbColumn;
		$ts->setName('timestamp');
		$ts->setDataType(OWA_DTD_BIGINT);
		$ts->setIndex();
		$this->setProperty($ts);
		
		$yyyymmdd =  new owa_dbColumn;
		$yyyymmdd->setName('yyyymmdd');
		$yyyymmdd->setDataType(OWA_DTD_INT);
		$yyyymmdd->setIndex();
		$this->setProperty($yyyymmdd);
		
		$this->properties['user_name'] = new owa_dbColumn;
		$this->properties['user_name']->setDataType(OWA_DTD_VARCHAR255);
		$this->properties['user_email'] = new owa_dbColumn;
		$this->properties['user_email']->setDataType(OWA_DTD_VARCHAR255);
		$this->properties['year'] = new owa_dbColumn;
		$this->properties['year']->setDataType(OWA_DTD_INT);
		$this->properties['month'] = new owa_dbColumn;
		$this->properties['month']->setDataType(OWA_DTD_INT);
		$this->properties['day'] = new owa_dbColumn;
		$this->properties['day']->setDataType(OWA_DTD_TINYINT2);
		$this->properties['dayofweek'] = new owa_dbColumn;
		$this->properties['dayofweek']->setDataType(OWA_DTD_VARCHAR10);
		$this->properties['dayofyear'] = new owa_dbColumn;
		$this->properties['dayofyear']->setDataType(OWA_DTD_INT);
		$this->properties['weekofyear'] = new owa_dbColumn;
		$this->properties['weekofyear']->setDataType(OWA_DTD_INT);
		$this->properties['hour'] = new owa_dbColumn;
		$this->properties['hour']->setDataType(OWA_DTD_TINYINT2);
		$this->properties['minute'] = new owa_dbColumn;
		$this->properties['minute']->setDataType(OWA_DTD_TINYINT2);
		$this->properties['last_req'] = new owa_dbColumn;
		$this->properties['last_req']->setDataType(OWA_DTD_BIGINT);
		$this->properties['num_pageviews'] = new owa_dbColumn;
		$this->properties['num_pageviews']->setDataType(OWA_DTD_INT);
		$this->properties['num_comments'] = new owa_dbColumn;
		$this->properties['num_comments']->setDataType(OWA_DTD_INT);
		$this->properties['is_repeat_visitor'] = new owa_dbColumn;
		$this->properties['is_repeat_visitor']->setDataType(OWA_DTD_TINYINT);
		
		$is_bounce =  new owa_dbColumn;
		$is_bounce->setName('is_bounce');
		$is_bounce->setDataType(OWA_DTD_TINYINT);
		$this->setProperty($is_bounce);
		
		$this->properties['is_new_visitor'] = new owa_dbColumn;
		$this->properties['is_new_visitor']->setDataType(OWA_DTD_TINYINT);
		$this->properties['prior_session_lastreq'] = new owa_dbColumn;
		$this->properties['prior_session_lastreq']->setDataType(OWA_DTD_BIGINT);
		
		$prior_session_id = new owa_dbColumn('prior_session_id', OWA_DTD_BIGINT);
		$this->setProperty($prior_session_id);
		
		$this->properties['time_sinse_priorsession'] = new owa_dbColumn;
		$this->properties['time_sinse_priorsession']->setDataType(OWA_DTD_INT);
		$this->properties['prior_session_year'] = new owa_dbColumn;
		$this->properties['prior_session_year']->setDataType(OWA_DTD_TINYINT4);
		$this->properties['prior_session_month'] = new owa_dbColumn;
		$this->properties['prior_session_month']->setDataType(OWA_DTD_VARCHAR255);
		$this->properties['prior_session_day'] = new owa_dbColumn;
		$this->properties['prior_session_day']->setDataType(OWA_DTD_TINYINT2);
		$this->properties['prior_session_dayofweek'] = new owa_dbColumn;
		$this->properties['prior_session_dayofweek']->setDataType(OWA_DTD_INT);
		$this->properties['prior_session_hour'] = new owa_dbColumn;
		$this->properties['prior_session_hour']->setDataType(OWA_DTD_TINYINT2);
		$this->properties['prior_session_minute'] = new owa_dbColumn;
		$this->properties['prior_session_minute']->setDataType(OWA_DTD_TINYINT2);
		$this->properties['days_since_prior_session'] = new owa_dbColumn;
		$this->properties['days_since_prior_session']->setDataType(OWA_DTD_INT);
		$this->properties['days_since_first_session'] = new owa_dbColumn;
		$this->properties['days_since_first_session']->setDataType(OWA_DTD_INT);
		$this->properties['os'] = new owa_dbColumn;
		$this->properties['os']->setDataType(OWA_DTD_VARCHAR255);
		
		// wrong data type
		$os_id = new owa_dbColumn('os_id', OWA_DTD_VARCHAR255);
		$os_id->setForeignKey('base.os');
		$this->setProperty($os_id);
		
		// wrong data type
		$ua_id = new owa_dbColumn('ua_id', OWA_DTD_VARCHAR255);
		$ua_id->setForeignKey('base.ua');
		$this->setProperty($ua_id);
		
		$first_page_id = new owa_dbColumn('first_page_id', OWA_DTD_BIGINT);
		$first_page_id->setForeignKey('base.document');
		$this->setProperty($first_page_id);
		
		$last_page_id = new owa_dbColumn('last_page_id', OWA_DTD_BIGINT);
		$last_page_id->setForeignKey('base.document');
		$this->setProperty($last_page_id);
		
		$referer_id = new owa_dbColumn('referer_id', OWA_DTD_BIGINT);
		$referer_id->setForeignKey('base.referer');
		$this->setProperty($referer_id);
		
		$referring_search_term_id = new owa_dbColumn('referring_search_term_id', OWA_DTD_BIGINT);
		$referring_search_term_id->setForeignKey('base.search_term_dim');
		$this->setProperty($referring_search_term_id);
		
		$ip_address = new owa_dbColumn('ip_address', OWA_DTD_VARCHAR255);
		$this->setProperty($ip_address);
		
		$this->properties['host'] = new owa_dbColumn;
		$this->properties['host']->setDataType(OWA_DTD_VARCHAR255);
		
		// wrong data type
		$host_id = new owa_dbColumn('host_id', OWA_DTD_VARCHAR255);
		$host_id->setForeignKey('base.host');
		$this->setProperty($host_id);
		
		$this->properties['source'] = new owa_dbColumn;
		$this->properties['source']->setDataType(OWA_DTD_VARCHAR255);
		$this->properties['city'] = new owa_dbColumn;
		$this->properties['city']->setDataType(OWA_DTD_VARCHAR255);
		$this->properties['country'] = new owa_dbColumn;
		$this->properties['country']->setDataType(OWA_DTD_VARCHAR255);
		$this->properties['site'] = new owa_dbColumn;
		$this->properties['site']->setDataType(OWA_DTD_VARCHAR255);
		
		$site_id = new owa_dbColumn('site_id', OWA_DTD_VARCHAR255);
		$site_id->setForeignKey('base.site', 'site_id');
		$this->setProperty($site_id);
		
		$nps = new owa_dbColumn('num_prior_sessions', OWA_DTD_INT);
		$this->setProperty($nps);
		
		$this->properties['is_robot'] = new owa_dbColumn;
		$this->properties['is_robot']->setDataType(OWA_DTD_TINYINT);
		$this->properties['is_browser'] = new owa_dbColumn;
		$this->properties['is_browser']->setDataType(OWA_DTD_TINYINT);
		$this->properties['is_feedreader'] = new owa_dbColumn;
		$this->properties['is_feedreader']->setDataType(OWA_DTD_TINYINT);
	}
}

?>