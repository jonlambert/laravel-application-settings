<?php namespace Jonlambert\ApplicationSettings\Repositories;


use DB;
use Jonlambert\ApplicationSettings\Setting;

class DbSettingsRepository implements SettingsRepositoryInterface {

	/**
	 *
	 */
	public function __construct()
	{

	}

	/**
	 * Saves the setting in whatever format required.
	 *
	 * @param Setting $setting
	 * @return mixed
	 */
	public function save(Setting $setting)
	{
		if ($this->find($setting))
		{
			$this->update($setting);
		} else {
			$this->insert($setting);
		}
	}

	/**
	 * Find a key value
	 *
	 * @param Setting $setting
	 * @return mixed
	 */
	public function find(Setting $setting)
	{
		return DB::table('application_settings')->where('option_key', '=', $setting->key)->first();
	}

	public function load(Setting $setting)
	{
		$setting->value = $this->find($setting)->option_value;
		return $setting;
	}

	/**
	 * Update the setting entry in the database.
	 *
	 * @param Setting $setting
	 */
	private function update(Setting $setting)
	{
		DB::table('application_settings')->where('option_key', '=', $setting->key)->update([
			'option_value' => $setting->value
		]);
	}

	/**
	 * Insert the setting entry into the database.
	 *
	 * @param Setting $setting
	 */
	private function insert(Setting $setting)
	{
		DB::table('application_settings')->insert([
			'option_key'     => $setting->key,
			'option_value'   => $setting->value
		]);
	}
}