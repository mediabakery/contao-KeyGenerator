<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package KeyGenerator
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Mediabakery',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Mediabakery\KeyGenerator\KeyGenerator' => 'system/modules/KeyGenerator/classes/KeyGenerator.php',
	'Mediabakery\KeyGenerator\KeyProvider' => 'system/modules/KeyGenerator/classes/KeyProvider.php',
));
