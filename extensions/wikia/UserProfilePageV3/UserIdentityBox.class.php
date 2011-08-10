<?php

class UserIdentityBox {
	/**
	 * Used in User Profile Page extension; 
	 * It's a kind of category of rows stored in page_wikia_props table 
	 * -- it's a value of propname column;
	 * If a data row from this table has this field set to 10 it means that
	 * in props value you should get an unserialized array of wikis' ids.
	 * 
	 * @var integer
	 */
	const PAGE_WIKIA_PROPS_PROPNAME = 10;
	const USER_PROPERTIES_PREFIX = 'UserProfilePagesV3_';
	const USER_EDITED_MASTHEAD_PROPERTY = 'UserProfilePagesV3_mastheadEdited_';
	const USER_FIRST_MASTHEAD_EDIT_DATE_PROPERTY = 'UserProfilePagesV3_mastheadEditDate_';
	const USER_MASTHEAD_EDITS_WIKIS = 'UserProfilePagesV3_mastheadEditsWikis_';
	
	private $user = null;
	private $app = null;
	private $title = null;
	private $topWikisLimit = 5;
	
	/**
	 * @param WikiaApp $app wikia appliacation object
	 * @param User $user core user object
	 * @param integer $topWikisLimit limit of top wikis
	 */
	public function __construct(WikiaApp $app, User $user, $topWikisLimit) {
		$this->app = $app;
		$this->user = $user;
		$this->topWikisLimit = $topWikisLimit;
		
		if( is_null($this->app->wg->Title) ) {
			$this->app->wg->Title = $this->user->getUserPage();
		}
		
		$this->title = $this->app->wg->Title;
	}
	
	/**
	 * Creates an array with user's data
	 * 
	 * @param boolean $isThisForEdit a flag which inform data is being recived for edit
	 * 
	 * @return array
	 * 
	 * @author Andrzej 'nAndy' Łukaszewski
	 */
	public function setData($isEdit = false) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		$userName = $this->user->getName();
		$userId = $this->user->getId();
		
		$data = array();
		
		//this data is always the same -- on each wiki
		$data['id'] = $userId;
		$data['name'] = $userName;
		$data['avatar'] = F::build( 'AvatarService', array( $userName, 150 ), 'getAvatarUrl' );
		
		if( $this->user->isAnon() ) {
		//if user doesn't exist
			$this->getEmptyData($data);
			$data['edits'] = 0;
			$data['showZeroStates'] = $this->checkIfDisplayZeroStates($data);
			$data['name'] = $this->app->wf->Msg('user-identity-box-wikia-contributor');
			$data['realName'] = $userName;
		} else {
			$userStatsService = F::build('UserStatsService', array($userId));
			$userStats = $userStatsService->getStats();
			
			$iEdits = $userStats['edits'];
			$iEdits = $data['edits'] = is_null($iEdits) ? 0 : intval($iEdits);
			
			//data depends on which wiki it is displayed
			$data['registration'] = $userStats['date'];
			
			$wikiId = $this->app->wg->CityId;
			$hasUserEditedMastheadBefore = $this->hasUserEditedMastheadBefore($wikiId);
			
			$data['userPage'] = $this->user->getUserPage()->getFullURL();
			
			//data from user_properties table
			if( !$hasUserEditedMastheadBefore ) {
				if( $isEdit || $iEdits > 0 ) {
					$this->getDefaultData($data);
				} else {
					$this->getEmptyData($data);
				}
			} else {
				$this->getDefaultData($data);
			}
			
			$firstMastheadEditDate = $this->user->getOption(self::USER_FIRST_MASTHEAD_EDIT_DATE_PROPERTY.$wikiId.'_'.$userId);
			if( is_null($data['registration']) && !is_null($firstMastheadEditDate) ) {
			//if user hasn't edited anything on this wiki before
			//we're getting the first edit masthead date
				$data['registration'] = $firstMastheadEditDate;
			} else if( !is_null($data['registration']) && !is_null($firstMastheadEditDate) ) {
			//if we've got both dates we're getting the lowest (the earliest)
				$data['registration'] = (intval($data['registration']) < intval($firstMastheadEditDate)) ? $data['registration'] : $firstMastheadEditDate;
			}
			
			//other data operations
			$this->getUserGroup($data);
			
			$birthdate = ( isset($data['birthday']) ? $data['birthday'] : '');
			$birthdate = explode('-', $birthdate);
			if( !empty($birthdate[0]) && !empty($birthdate[1]) ) {
				$data['birthday'] = array('month' => $birthdate[0], 'day' => ltrim($birthdate[1], '0'));
			} else {
				$data['birthday'] = '';
			}
			
			$data['showZeroStates'] = $this->checkIfDisplayZeroStates($data);
		}
		

		$this->app->wf->ProfileOut( __METHOD__ );
		return $data;
	}
	
	/**
	 * @brief Gets global data from table user_properties
	 * 
	 * @param array $data reference to an array object
	 * 
	 * @return void
	 */
	private function getDefaultData(&$data) {
		$memcData = $this->app->wg->Memc->get($this->getMemcUserIdentityDataKey());
		if( empty($memcData) ) {
			foreach(array('location', 'occupation', 'gender', 'birthday', 'website', 'twitter', 'fbPage') as $key) {
				if( !in_array($key, array('gender', 'birthday')) ) {
					$data[$key] = $this->user->getOption($key);
				} else {
					$data[$key] = $this->user->getOption(self::USER_PROPERTIES_PREFIX.$key);
				}
			}
			
			$data['realName'] = $this->user->getRealName();
			
			$this->saveMemcUserIdentityData($data);
		} else {
			$data = array_merge_recursive($data, $memcData);
		}
		$data['topWikis'] = $this->getTopWikis();
	}
	
	/**
	 * @brief Returns string with key to memcached; requires $this->user field being instance of User
	 * 
	 * @return string
	 */
	private function getMemcUserIdentityDataKey() {
		return 'user-identity-box-data0-'.$this->user->getId();
	}

	/**
	 * @brief Returns string with key to memcached; requires $this->user field being instance of User
	 * 
	 * @return string
	 */
	
	private function getMemcMastheadEditsWikisKey() {
		return 'user-identity-box-data-masthead-edits0'.$this->user->getId();
	}
	
	
	/**
	 * @brief Sets empty data for a particular wiki
	 * 
	 * @param array $data reference to an array object
	 * 
	 * @return void
	 */
	private function getEmptyData(&$data) {
		foreach(array('location', 'occupation', 'gender', 'birthday', 'website', 'twitter', 'fbPage') as $key) {
			$data[$key] = "";
		}
		
		$data['realName'] = "";
		$data['topWikis'] = array();
	}
	
	private function hasUserEditedMastheadBefore($wikiId) {
		return $this->user->getOption(self::USER_EDITED_MASTHEAD_PROPERTY.$wikiId);
	}
	
	/**
	 * Saves user data
	 * 
	 * @param object $data an user data
	 * 
	 * @return true
	 */
	public function saveUserData($data) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		$changed = false;
		$wikiId = $this->app->wg->CityId;
		
		foreach(array('location', 'occupation', 'birthday', 'gender', 'website', 'avatar', 'twitter', 'fbPage') as $option) {
			if( isset($data->$option) ) {
				$data->$option = str_replace('*', '&asterix;', $data->$option);
				$data->$option = $this->app->wg->Parser->parse($data->$option, $this->user->getUserPage(), new ParserOptions($this->user))->getText();
				$data->$option = str_replace('&amp;asterix;', '*', $data->$option);
				$data->$option = trim( strip_tags($data->$option) );
				
				//if( in_array($option, array('gender', 'birthday')) ) { -- just an example how can it be used later
				if( $option === 'gender' ) {
					$this->user->setOption(self::USER_PROPERTIES_PREFIX.$option, $data->$option);
				} else {
					$this->user->setOption($option, $data->$option);
				}
				
				$changed = true;
			}
		}
		
		if( isset($data->month) && isset($data->day) ) {
			$this->user->setOption(self::USER_PROPERTIES_PREFIX.'birthday', $data->month.'-'.$data->day);
			$changed = true;
		}
		
		if( isset($data->name) ) {
			$this->user->setRealName($data->name);
			$changed = true;
		}
		
		$wikiId = $this->app->wg->CityId;
		if( !$this->hasUserEditedMastheadBefore($wikiId) ) {
			$this->user->setOption(self::USER_EDITED_MASTHEAD_PROPERTY.$wikiId, true);
			$this->user->setOption(self::USER_FIRST_MASTHEAD_EDIT_DATE_PROPERTY.$wikiId, date('YmdHis'));

			$this->addTopWiki($wikiId);
			$changed = true;
		}
		
		if( true === $changed ) {
			$this->user->saveSettings();
			$this->saveMemcUserIdentityData($data);
			
			// Log
			$log = WF::build( 'LogPage', array( 'usermasthead' ) );
			$log->addEntry( '', Title::newFromText($this->user->getName(), NS_USER), $this->app->wf->Msg('usermasthead-log-message'), array() );  
			
			$this->app->wf->ProfileOut( __METHOD__ );
			return true;
		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return false;
	}
	
	/**
	 * @brief Filters given parameter and saves in memcached new array which is returned
	 * 
	 * @param object|array $data user identity box data 
	 * 
	 * @return array
	 */
	private function saveMemcUserIdentityData($data) {
		foreach(array('location', 'occupation', 'gender', 'birthday', 'website', 'twitter', 'fbPage', 'realName', 'topWikis') as $property) {
			if( is_object($data) && isset($data->$property) ) {
				$memcData[$property] = $data->$property;
			}
			
			if( is_array($data) && isset($data[$property]) ) {
				$memcData[$property] = $data[$property];
			}
		}
		
		if( is_object($data) ) {
			if( isset($data->month) && isset($data->day) ) {
				$memcData['birthday'] = $data->month.'-'.$data->day;
			}
			
			if( isset($data->birthday) ) {
				$memcData['birthday'] = $data->birthday;
			}
		}
		
		if( is_array($data) ) {
			if( isset($data['month']) && isset($data['day']) ) {
				$memcData['birthday'] = $data['month'].'-'.$data['day'];
			}
			
			if( isset($data['birthday']) ) {
				$memcData['birthday'] = $data['birthday'];
			}
		}
		
		if( !isset($memcData['realName']) && is_object($data) && isset($data->name) ) {
			$memcData['realName'] = $data->name;
		}
		
		//if any of properties isn't set then set it to null
		foreach(array('location', 'occupation', 'gender', 'birthday', 'website', 'twitter', 'fbPage', 'realName') as $property) {
			if( !isset($memcData[$property]) ) {
				$memcData[$property] = null;
			}
		}
		$this->app->wg->Memc->set($this->getMemcUserIdentityDataKey(), $memcData);
				
		return $memcData;
	}
	
	/**
	 * Gets DB object
	 * 
	 * @return array
	 * 
	 * @author Andrzej 'nAndy' Łukaszewski
	 */
	private function getDb($type = DB_SLAVE) {
		return $this->app->wf->GetDB($type, array(), $this->app->wg->SharedDB);
	}
	
	/**
	 * Gets user group and additionaly sets other user's data (blocked, founder)
	 * 
	 * @param array reference to user data array
	 * 
	 * @author Andrzej 'nAndy' Łukaszewski
	 */
	private function getUserGroup(&$data) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		$isBlocked = $this->user->getBlockId();
		
		if( empty($isBlocked) ) {
			$data['blocked'] = false;
			
			if( true !== $this->isFounder() ) {
				$group = $this->getUserGroups($this->user);
				if( false !== $group ) {
					$data['group'] = $this->app->wf->Msg('user-identity-box-group-'.$group);
				} else {
					$data['group'] = '';
				}
			} else {
				$data['group'] = $this->app->wf->Msg('user-identity-box-group-founder');
			}
		} else {
			$data['group'] = $this->app->wf->Msg('user-identity-box-group-blocked');
		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
	}
	
	/**
	 * @brief Returns false if any of "important" fields is not empty -- then it means not to display zero states
	 * 
	 * @param array reference to user data array
	 * 
	 * @author Andrzej 'nAndy' Łukaszewski
	 */
	public function checkIfDisplayZeroStates($data) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		$result = true;
		
		$fieldsToCheck = array('location', 'occupation', 'birthday', 'gender', 'website', 'twitter', 'topWikis');
		
		foreach($data as $property => $value) {
			if( in_array($property, $fieldsToCheck) && !empty($value) ) {
				$result = false;
				break;
			}
		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return $result;
	}
	
	/**
	 * @brief Gets string with user most important group
	 * 
	 * @return string | false
	 * 
	 * @author Andrzej 'nAndy' Łukaszewski
	 */
	private function getUserGroups() {
		$this->app->wf->ProfileIn( __METHOD__ );
		$userGroup = '';
		
		$userGroups = $this->user->getEffectiveGroups();
		foreach($userGroups as $group) {
			//most important -- admin
			if( $group == 'sysop') {
				$userGroup = 'sysop';
				break;
			}
			
			//less important
			if( $group == 'staff') {
				$userGroup = 'staff';
				break;
			}
			
			if( $group == 'chatmoderator') {
				$userGroup = 'chatmoderator';
				break;
			}
		}
		
		if( empty($userGroup) ) {
		//just a member
			$this->app->wf->ProfileOut( __METHOD__ );
			return false;
		} else {
			$this->app->wf->ProfileOut( __METHOD__ );
			return $userGroup;
		}
	}
	
	/**
	 * @brief Gets top wikis from DB for devboxes from method UserIdentityBox::getTestData()
	 */
	public function getTopWikisFromDb($limit = null) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		if( is_null($limit) ) {
			$limit = $this->topWikisLimit;
		}
		
		if( $this->app->wg->DevelEnvironment ) {
		//devboxes uses the same database as production
		//to avoid strange behavior we set test data on devboxes
			$wikis = $this->getTestData($limit);
		} else {
			$where = array( 'user_id' => $this->user->getId() );
			$where[] = 'edits > 0';
			
			$hiddenTopWikis = $this->getHiddenTopWikis();
			if( count($hiddenTopWikis) ) {
				$where[] = 'wiki_id NOT IN ('.join(',', $hiddenTopWikis).')';
			}
			
			$dbs = $this->app->wf->GetDB(DB_SLAVE, array(), $this->app->wg->StatsDB);
			$res = $dbs->select(
				array( 'specials.events_local_users' ),
				array( 'wiki_id', 'edits' ),
				$where,
				__METHOD__,
				array(
					'ORDER BY' => 'edits DESC',
					'LIMIT' => $limit
				)
			);
			
			$wikis = array();
			while( $row = $dbs->fetchObject($res) ) {
				$wikiId = $row->wiki_id;
				$editCount = $row->edits;
				$wikiName = F::build('WikiFactory', array('wgSitename', $wikiId), 'getVarValueByName');
				$wikiUrl = F::build('WikiFactory', array('wgServer', $wikiId), 'getVarValueByName');
				$wikiUrl = $wikiUrl.'?redirect=no';
				
				$wikis[$wikiId] = array( 'id' => $wikiId, 'wikiName' => $wikiName, 'wikiUrl' => $wikiUrl, 'edits' => $editCount);
			}
		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return $wikis;
	}
	
	/**
	 * @brief Gets top wiki from memc filters them and returns
	 */
	public function getTopWikis($refreshHidden = false) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		if( $refreshHidden === true ) {
			$this->clearHiddenTopWikis();
		}
		
		$wikis = array_merge( $this->getTopWikisFromDb(), $this->getEditsWikis());
		
		
		
		foreach($wikis as $wikiId => $wiki) {
			if( $this->isTopWikiHidden($wiki['id']) ) {
				unset($wikis[$key]);
			}
		}

		
		//doesn't seem right on devbox -- need to check on preview
//		$favWikisAmount = count($wikis);
//		if( $favWikisAmount < $this->topWikisLimit ) {
//			$limit = $this->topWikisLimit - $favWikisAmount;
//			$wikis = array_merge_recursive($wikis, $this->getTopWikisFromDb($limit));
//		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return $this->sortTopWikis($wikis);
	}
	
	/**
	 * @brief Sorts top (fav) wikis by edits and cuts if there are more than default amount of top wikis
	 * 
	 * @param array $topWikis
	 * 
	 * @return array
	 */
	protected function sortTopWikis($topWikis) {
		if( !empty($topWikis) ) {
			$editcounts = array();
			
			foreach($topWikis as $key => $row) {
				if( isset($row['edits']) ) {
					$editcounts[$key] = $row['edits'];
				} else {
					unset($topWikis[$key]);
				}
			}
			
			if( !empty($editcounts) ) array_multisort($editcounts, SORT_DESC, $topWikis);
			
			return array_slice($topWikis, 0, $this->topWikisLimit, true);
		}
		
		return $topWikis;
	}
	
	/**
	 * @brief Adds to memchached top wikis new wiki
	 * 
	 * @param integer $wikiId wiki id
	 * 
	 * @return void
	 */
	public function addTopWiki($wikiId) {
		$memcData = $this->app->wg->Memc->get($this->getMemcUserIdentityDataKey());
		$memcData['topWikis'] = empty($memcData['topWikis']) ? array() : $memcData['topWikis'];
		
		if(empty($memcData['topWikis'])) {
			$memcData['topWikis'] = $this->getTopWikis();
		}
		
		$wikiName = F::build('WikiFactory', array('wgSitename', $wikiId), 'getVarValueByName');
		$wikiUrl = F::build('WikiFactory', array('wgServer', $wikiId), 'getVarValueByName');
		$wikiUrl = $wikiUrl.'?redirect=no';
		
		$userStatsService = F::build('UserStatsService', array($this->app->wg->User->getId()) );
		$userStats = $userStatsService->getStats();
		
		//adding new wiki to topWikis in cache
		$wiki = array('id' => $wikiId, 'wikiName' => $wikiName, 'wikiUrl' => $wikiUrl, 'edits' => $userStats['edits'] + 1);
	
		$memcData['topWikis'][] = $wiki; 		
		$this->storeEditsWikis($wikiId, $wiki );
		$memcData['topWikis'] = $this->sortTopWikis($memcData['topWikis'] );
		
		//saving cache only if there is other data than topWikis
		if( count($memcData) > 1 ) {
			$this->app->wg->Memc->set( $this->getMemcUserIdentityDataKey(), $memcData );	
		}
	}
	
	private function storeEditsWikis($wikiId, $wiki) {
		//getting array of masthead edits wikis
		$mastheadEditsWikis = $this->app->wg->Memc->get( $this->getMemcMastheadEditsWikisKey(), array());
		if( !is_array($mastheadEditsWikis) ) {
			$mastheadEditsWikis = array();
		}	
			
		$mastheadEditsWikis[$wikiId] = $wiki;
		$this->app->wg->Memc->set( $this->getMemcMastheadEditsWikisKey(), $mastheadEditsWikis);

		return $mastheadEditsWikis;
	}
	
	private function getEditsWikis() {
		$mastheadEditsWikis = $this->app->wg->Memc->get( $this->getMemcMastheadEditsWikisKey(), null);
		$mastheadEditsWikis = is_array($mastheadEditsWikis) ? $mastheadEditsWikis: array();
		return $mastheadEditsWikis;
	}
	
	/**
	 * @brief Gets memcache id for hidden wikis
	 */
	private function getMemcHiddenWikisId() {
		return 'user-identity-box-data-top-hidden-wikis-'.$this->user->getId();
	}
	
	/**
	 * @brief Clears hidden wikis: the field of this class, DB and memcached data
	 */
	private function clearHiddenTopWikis() {
		$hiddenWikis = array();
		$this->updateHiddenInDb( $this->app->wf->GetDB(DB_MASTER, array(), $this->app->wg->ExternalSharedDB), $hiddenWikis );
		$this->app->wg->Memc->set($this->getMemcHiddenWikisId(), $hiddenWikis);
		
		//resets top wikis
		$memcData = $this->app->wg->Memc->get($this->getMemcUserIdentityDataKey());
		$memcData['topWikis'] = $this->getTopWikisFromDb();
		$this->saveMemcUserIdentityData($memcData);
	}
	
	/**
	 * @brief Gets test data for devboxes
	 * 
	 * @return array
	 */
	private function getTestData($limit) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		$wikis = array(
			1890 => 5,
			4036 => 35,
			177 => 12,
			831 => 60,
			5687 => 3,
			509 => 20,
		); //test data
		
		foreach( $wikis as $wikiId => $editCount ) {
			if( !$this->isTopWikiHidden($wikiId) && ($wikiId != $this->app->wg->CityId) ) {
				$wikiName = F::build('WikiFactory', array('wgSitename', $wikiId), 'getVarValueByName');
				$wikiUrl = F::build('WikiFactory', array('wgServer', $wikiId), 'getVarValueByName');
				$wikiUrl = $wikiUrl.'?redirect=no';
				
				$wikis[$wikiId] = array( 'id' => $wikiId, 'wikiName' => $wikiName, 'wikiUrl' => $wikiUrl, 'edits' => $editCount );
			} else {
				unset($wikis[$wikiId]);
			}
		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return array_slice($wikis, 0, $limit, true);
	}
	
	/**
	 * @brief Gets hidden top wikis
	 * 
	 * @return array
	 * 
	 * @author Andrzej 'nAndy' Łukaszewski
	 */
	private function getHiddenTopWikis() {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		$hiddenWikis = $this->app->wg->Memc->get( $this->getMemcHiddenWikisId() );
		
		if( empty($hiddenWikis) ) {
			$dbs = $this->app->wf->GetDB( DB_SLAVE, array(), $this->app->wg->ExternalSharedDB);
			$hiddenWikis = $this->getHiddenFromDb($dbs);
			$this->app->wg->Memc->set($this->getMemcHiddenWikisId(), $hiddenWikis);
		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return $hiddenWikis;
	}
	
	/**
	 * @brief adds hidden top wiki; code from UPP2
	 * 
	 * @return array
	 * 
	 * @author Andrzej 'nAndy' Łukaszewski
	 */
	public function hideWiki($wikiId) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		if( !$this->isTopWikiHidden($wikiId) ) {
			$hiddenWikis = $this->getHiddenTopWikis();
			$hiddenWikis[] = $wikiId;
			$this->updateHiddenInDb($this->app->wf->GetDB(DB_MASTER, array(), $this->app->wg->ExternalSharedDB), $hiddenWikis);
			$this->app->wg->Memc->set($this->getMemcHiddenWikisId(), $hiddenWikis);
			
			$memcData = $this->app->wg->Memc->get($this->getMemcUserIdentityDataKey());
			$memcData['topWikis'] = empty($memcData['topWikis']) ? array() : $memcData['topWikis'];
			$this->saveMemcUserIdentityData($memcData);
		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return true;
	}
	
	/**
	 * @brief auxiliary method for getting hidden pages/wikis from db
	 * @author ADi
	 */
	private function getHiddenFromDb( $dbHandler ) {
		$this->app->wf->ProfileIn( __METHOD__ );
		$result = false;
		
		if ( !$this->user->isAnon() ) {
			$row = $dbHandler->selectRow(
				array( 'page_wikia_props' ),
				array( 'props' ),
				array( 'page_id' => $this->user->getId() , 'propname' => self::PAGE_WIKIA_PROPS_PROPNAME ),
				__METHOD__,
				array()
			);
			
			if( !empty($row) ) {
				$result = unserialize( $row->props );
			}
			
			$result = empty($result) ? array() : $result;
		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return $result;
	}
	
	/**
	 * auxiliary method for updating hidden pages in db
	 * @author ADi
	 */
	private function updateHiddenInDb($dbHandler, $data) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		$dbHandler->replace(
			'page_wikia_props',
			null,
			array('page_id' => $this->user->getId(), 'propname' => 10, 'props' => serialize($data)),
			__METHOD__
		);
		$dbHandler->commit();
		
		$this->app->wf->ProfileOut( __METHOD__ );
	}
	
	/**
	 * @brief Checks whenever wiki is in hidden wikis; code from UPP2
	 * 
	 * @param integer $wikiId id of wiki which we want to be chacked
	 * 
	 * @return boolean
	 */
	public function isTopWikiHidden( $wikiId ) {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		$out = ( in_array($wikiId, $this->getHiddenTopWikis() ) ? true : false );
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return $out;
	}
	
	/**
	 * Checks if user is the founder
	 * 
	 * @return boolean
	 * 
	 * @author Andrzej 'nAndy' Łukaszewski
	 */
	private function isFounder() {
		$this->app->wf->ProfileIn( __METHOD__ );
		
		$wiki = F::build('WikiFactory', array($this->app->wg->CityId), 'getWikiById');
		
		if( intval($wiki->city_founding_user) === $this->user->GetId() ) {
			$this->app->wf->ProfileOut( __METHOD__ );
			return true;
		}
		
		$this->app->wf->ProfileOut( __METHOD__ );
		return false;
	}
	
}

?>