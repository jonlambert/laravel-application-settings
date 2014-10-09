<?php
use Illuminate\Foundation\Testing\AssertionsTrait;
use Jonlambert\ApplicationSettings\Setting;
use \Jonlambert\ApplicationSettings\SettingsManager;
use Jonlambert\ApplicationSettings\SettingsManager as SettingsManagerTwo;

/**
 * User: Jon
 * Date: 18/09/2014
 * Time: 17:48
 */

class SettingsManagerTest extends PHPUnit_Framework_TestCase {

	use AssertionsTrait;

	/**
	 *
	 */
	public function testInstantiation()
	{
		$settingsManager = new Setting();
	}
}
 