<?php

class WallDisabledHooksHelper {
	const wallEnableVarName = 'wgEnableWallExt';
	const wallCopyFollowFlag = 'wgWallCopyFollowsHasBeenFiredBefore';
	
	/** @brief Allows to edit or not archived talk pages and its subpages
	 * 
	 * @author Andrzej 'nAndy' Łukaszewski
	 * 
	 * @return boolean true -- because it's a hook
	 */
	public function onAfterEditPermissionErrors($permErrors, $title, $removeArray) {
		$app = F::App();

		if( empty($app->wg->EnableWallExt) && 
			($title->getNamespace() == NS_USER_WALL 
			|| $title->getNamespace() == NS_USER_WALL_MESSAGE
			|| $title->getNamespace() == NS_USER_WALL_MESSAGE_GREETING
		)) {
			$permErrors[] = array(
				0 => 'protectedpagetext',
				1 => 'archived'
			);
		}
		
		return true;
	}
}
