<?php

namespace Craue\ConfigBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Danilo Di Moia <zitter@gmail.com>
 * @copyright 2022 Danilo Di Moia
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
abstract class BaseSetting implements SettingInterface {

	/**
	 * @var integer
	 * @Assert\NotBlank
	 */
	protected $id;
	
	/**
	 * @var string
	 * @Assert\NotBlank
	 */
	protected $context;

	/**
	 * @var string
	 * @Assert\NotBlank
	 */
	protected $section;

	/**
	 * @var string
	 * @Assert\NotBlank
	 */
	protected $key;

	/**
	 * @var string|null
	 */
	protected $value;

	/**
	 * @var string|null
	 */
	protected $cast;

	/**
	 * @var boolean
	 */
	protected $active;

	/**
     * @OneToOne(targetEntity="BaseSetting")
     * @JoinColumn(name="setting_id", referencedColumnName="id")
     */
    private $setting;

	public function getId() {
		return $this->id;
	}

	public function setContext($context) {
		$this->context = $context;
	}

	public function getContext() {
		return $this->context;
	}
	
	public function setSection($section) {
		$this->section = $section;
	}

	public function getSection() {
		return $this->section;
	}

	public function setKey($key) {
		$this->key = $key;
	}

	public function getKey() {
		return $this->key;
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function getValue() {
		return $this->value;
	}

	public function getCast(): string
	{
		return $this->cast;
	}

	public function setCaste(string $cast) {
		$this->cast = $cast;
		return $this;
	}
	
	public function getActive(): bool
	{
		return $this->active;
	}

	public function setActive(bool $active) {
		$this->active = $active;
		return $this;
	}

	public function getSetting(): Setting
	{
		return $this->setting;
	}

	public function setSetting(Setting $setting) {
		$this->setting = $setting;
		return $this;
	}


	/**
	 * Creates a {@code SettingInterface}.
	 * @param string $section
	 * @param string|null $app
	 * @param string|null $value
	 * @return SettingInterface
	 */
	public static function create($context = 'fedale', $section = 'app', $key = null, $value = null, $cast = 'string', $active = true) {
		$setting = new static();
		$setting->setContext($context);
		$setting->setSection($section);
		$setting->setKey($key);
		$setting->setValue($value);
		$setting->setCast($cast);
		$setting->setActive($active);

		return $setting;
	}

}