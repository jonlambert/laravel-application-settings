<?php namespace Jonlambert\ApplicationSettings;
use Jonlambert\ApplicationSettings\SettingValidationException;
use Validator;
use Jonlambert\ApplicationSettings\Repositories\DbSettingsRepository;

class Setting {

	/**
	 * @var string The key to access the setting's value. Eg. $settingsManager->get('test').
	 */
	public $key;

	public $value;

	public $default;

	public $rules = [];

	/**
	 * @var DbSettingsRepository
	 */
	private $repository;

	function __construct(DbSettingsRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * This method calculates any custom validation for the setting.
	 *
	 * @throws SettingValidationException
	 * @return boolean
	 */
	public function validate()
	{

		/** @var \Illuminate\Validation\Validator $validator */
		$validator = Validator::make([
			'value' => $this->value,
		], ['value' => $this->rules]);


		if ($validator->fails())
		{
			throw new SettingValidationException($validator->getMessageBag());
		}
	}

} 