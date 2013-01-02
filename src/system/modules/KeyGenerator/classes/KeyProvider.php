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
 * KeyProvider
 */
class KeyProvider extends \System{

	/**
	 * returns a key
	 * @param  String $strFieldname fieldname
	 * @param  int $intLength    length of the key
	 * @return String               generated key
	 */
	public static function getKey($strFieldname, $intLength)
	{
		// HOOK: search for extern genenerator
		if (isset($GLOBALS['TL_HOOKS']['generateKey']) && is_array($GLOBALS['TL_HOOKS']['generateKey']))
		{
			foreach ($GLOBALS['TL_HOOKS']['generateKey'] as $callback)
			{
				$strKey = $callback[0]::$callback[1]($strFieldname, $intLength);
				if ($strKey) return $strKey;
			}
		}

		// Default Key Generator
		$strCharPool = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789');
		$intPoolLength = strlen($strCharPool);

		// if the length is not set, we will generate a key with 40 chars
		if (strlen($intLength)) $intLength = 40;

		$strKey = '';
		for ($i = 0; $i < $intLength; $i++)
		{
            $strKey .= substr($strCharPool,rand(0,$intPoolLength),1);
		}
		return $strKey;
	}
}