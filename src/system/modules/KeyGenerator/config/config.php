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

$GLOBALS['TL_HOOKS']['executePreActions'][] = array('\KeyGenerator', 'generateKey');