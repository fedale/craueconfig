<?php

namespace Craue\ConfigBundle\Entity;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2022 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
interface SettingInterface {

	function setSection($section);
	function getSection();

	function setKey($key);
	function getKey();

}
