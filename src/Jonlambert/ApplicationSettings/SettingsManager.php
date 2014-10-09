<?php  namespace Jonlambert\ApplicationSettings;
use App;
use Illuminate\Contracts\Config\Config;
use Jonlambert\ApplicationSettings\Repositories\DbSettingsRepository;
use Jonlambert\ApplicationSettings\SettingValidationException;
use SebastianBergmann\Exporter\Exception;

class SettingsManager {

	protected $settings = [];

	/**
	 * @var Config
	 */
	private $config;
	/**
	 * @var DbSettingsRepository
	 */
	private $repository;

	/**
	 * @param Config $config
	 * @param DbSettingsRepository $repository
	 */
	public function __construct(Config $config, DbSettingsRepository $repository)
	{
		$this->config = $config;
		$this->repository = $repository;

		$this->loadSettings();
	}

	public function get($key)
	{
		$setting = $this->getSetting($key);

		$setting = $this->repository->load($setting);

		return $setting->value;
	}

	/**
	 * Sets the value of the setting.
	 *
	 * @param $key
	 * @param $value
	 * @return $this
	 * @throws SettingValidationException
	 */
	public function set($key, $value)
	{
		$setting = $this->getSetting($key);

		$setting->validate();

		$setting->value = $value;

		$this->repository->save($setting);

		return $this;
	}

	/**
	 * Fetch the Setting object.
	 *
	 * @param $key
	 * @return Setting
	 */
	public function getSetting($key)
	{
		return $this->settings[$key];
	}

	/**
	 * Load and instantiate the settings.
	 */
	private function loadSettings()
	{
		foreach ($this->getSettingClasses() as $settingClass)
		{
			$setting = App::make($settingClass);

			$this->settings[$setting->key] = $setting;
		}
	}

	/**
	 * Returns the array of classes as defined in jonlambert/application-settings/config/settings.php
	 *
	 * @return mixed
	 */
	private function getSettingClasses()
	{
		return $this->config->get("application-settings::settings.settings");
	}
} 