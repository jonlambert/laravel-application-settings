<?php namespace Jonlambert\ApplicationSettings\Repositories;

use Jonlambert\ApplicationSettings\Setting;

interface SettingsRepositoryInterface {

	/**
	 * Saves the setting in whatever format required.
	 *
	 * @param Setting $setting
	 * @return mixed
	 */
	public function save(Setting $setting);

	/**
	 * Fetches the setting from the persistence layer.
	 *
	 * @param Setting $setting
	 * @return mixed
	 */
	public function find(Setting $setting);

	public function load(Setting $setting);
} 