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

namespace KeyGenerator;

/**
 * KeyGenerator handles the ajax Request and provides the wizard HTML String
 */
class KeyGenerator extends \System{

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
			print $this->getKey();
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
		return strlen($strValue) ? $strValue : $this->getKey();
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

	/**
	 * This method generates the key and returns it
	 * @return String generated key
	 */
	private function getKey()
	{
		// set length delta
	    $intMinLength = strlen(\Input::getInstance()->post('minlength')) ? \Input::getInstance()->post('minlength') : 0;
		$intMaxLength = strlen(\Input::getInstance()->post('maxlength')) ? \Input::getInstance()->post('maxlength') : 32;
	    // generate key with default generator
	    $strKey = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, rand($intMinLength, $intMaxLength));
	    // HOOK: search for extern genenerator
		if (isset($GLOBALS['TL_HOOKS']['generateKey']) && is_array($GLOBALS['TL_HOOKS']['generateKey']))
		{
			foreach ($GLOBALS['TL_HOOKS']['generateKey'] as $callback)
			{
				$this->import($callback[0]);
				$strKey = $this->$callback[0]->$callback[1](\Input::getInstance()->post('name'), $intMinLength, $intMaxLength);
			}
		}
		return $strKey;
	}
}