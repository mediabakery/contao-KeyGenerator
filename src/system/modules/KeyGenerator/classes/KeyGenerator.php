<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package   KeyGenerator
 * @author    Sebastian Tilch
 * @license   LGPL
 * @copyright Sebastian Tilch 2012
 */

namespace Mediabakery\KeyGenerator;

/**
 * KeyGenerator handles the ajax Request and provides the wizard HTML String
 */
class KeyGenerator extends \Backend{

	/**
	 * This method generates a key if the action is "generateKey"
	 * @param  String $strAction The trigger action
	 */
	public function generateKey($strAction)
	{
		if ($strAction == 'generateKey')
	    {
			// return generated key
			header("Content-Type: text/plain");
			print KeyProvider::getKey(\Input::getInstance()->post('name'), \Input::getInstance()->post('maxlength'));
			exit;
	    }
	}

	/**
	 * This method replace the key with a new generated one if it is not set and returns it
	 * @param String         $strValue current field value
	 * @param \DataContainer $dc       DataContainer
	 */
	public function setKeyIfEmpty($strValue, \DataContainer $dc)
	{
		if (strlen($strValue))
			return $strValue;

		$this->loadDataContainer($dc->table);
		$intLength = $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['maxlength'];

		return KeyProvider::getKey($dc->field, $intLength);
	}

	/**
	 * This method returns the wizard HTML String and inserts some JS to the header and body of the site
	 * @return String HTML String
	 */
	public function getWizard()
	{
		$GLOBALS['TL_JAVASCRIPT']['KeyGenerator'] = 'system/modules/KeyGenerator/html/scripts/KeyGenerator.js';
		$GLOBALS['TL_MOOTOOLS']['KeyGenerator'] = '<script>var REQUEST_TOKEN="' . REQUEST_TOKEN . '"</script>';
		return 	'<img src="system/modules/KeyGenerator/html/media/icon.gif" width="20" height="20" style="vertical-align:-6px;cursor:pointer" class="keygenerator" title="' . $GLOBALS['TL_LANG']['MSC']['keygenerator'] . '">';
	}
<<<<<<< HEAD
=======

	/**
	 * This method generates the key and returns it
	 * @return String generated key
	 */
	private function getKey()
	{
		// set length 
		$intLength = strlen(\Input::getInstance()->post('maxlength')) ? \Input::getInstance()->post('maxlength') : 32;
	    
	    // HOOK: search for extern genenerator
		if (isset($GLOBALS['TL_HOOKS']['generateKey']) && is_array($GLOBALS['TL_HOOKS']['generateKey']))
		{
			foreach ($GLOBALS['TL_HOOKS']['generateKey'] as $callback)
			{
				$this->import($callback[0]);
				$strKey = $this->$callback[0]->$callback[1](\Input::getInstance()->post('name'), $intLength);
				if ($strKey) return $strKey;
			}
		}
		// generate key with default generator
		$strKey = '';
		for ($i=0; $i<$intLength; $i++)
		{
			$strKey .= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1);
		}

		return str_shuffle($strKey);
	}

>>>>>>> 31d101c36cc750601a579f01ce61643f8802bc7b
}