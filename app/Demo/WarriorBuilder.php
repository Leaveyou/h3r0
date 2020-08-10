<?php declare(strict_types=1);


namespace Hero\Demo;


use BadMethodCallException;
use Hero\Game\Warrior;
use Hero\Tools\Chance;

class WarriorBuilder
{
	private ?int $minimumHealth = null;
	private ?int $maximumHealth = null;
	private ?int $minimumStrength = null;
	private ?int $maximumStrength = null;
	private ?int $minimumDefense = null;
	private ?int $maximumDefense = null;
	private ?int $minimumLuck = null;
	private ?int $maximumLuck = null;
	private ?int $minimumSpeed = null;
	private ?int $maximumSpeed = null;

	/**
	 * @param int $minimumHealth
	 * @return $this
	 */
	public function setMinimumHealth(int $minimumHealth): self
	{
		$this->minimumHealth = $minimumHealth;
		return $this;
	}

	/**
	 * @param int $maximumHealth
	 * @return $this
	 */
	public function setMaximumHealth(int $maximumHealth): self
	{
		$this->maximumHealth = $maximumHealth;
		return $this;
	}

	/**
	 * @param int $minimumStrength
	 * @return $this
	 */
	public function setMinimumStrength(int $minimumStrength): self
	{
		$this->minimumStrength = $minimumStrength;
		return $this;
	}

	/**
	 * @param int $maximumStrength
	 * @return $this
	 */
	public function setMaximumStrength(int $maximumStrength): self
	{
		$this->maximumStrength = $maximumStrength;
		return $this;
	}

	/**
	 * @param int $minimumDefense
	 * @return $this
	 */
	public function setMinimumDefense(int $minimumDefense): self
	{
		$this->minimumDefense = $minimumDefense;
		return $this;
	}

	/**
	 * @param int $maximumDefense
	 * @return $this
	 */
	public function setMaximumDefense(int $maximumDefense): self
	{
		$this->maximumDefense = $maximumDefense;
		return $this;
	}

	/**
	 * @param int $minimumLuck
	 * @return $this
	 */
	public function setMinimumLuck(int $minimumLuck): self
	{
		$this->minimumLuck = $minimumLuck;
		return $this;
	}

	/**
	 * @param int $maximumLuck
	 * @return $this
	 */
	public function setMaximumLuck(int $maximumLuck): self
	{
		$this->maximumLuck = $maximumLuck;
		return $this;
	}

	public function build(string $name): Warrior
	{
		$this->validate();
		$warrior = new Warrior(
			$name,
			rand($this->minimumHealth, $this->maximumHealth),
			rand($this->minimumStrength, $this->maximumStrength),
			rand($this->minimumDefense, $this->maximumDefense),
			rand($this->minimumSpeed, $this->maximumSpeed),
			new Chance(rand($this->minimumLuck, $this->maximumLuck)),
		);
		$this->reset();
		return $warrior;
	}

	/**
	 * @param int $minimumSpeed
	 * @return $this
	 */
	public function setMinimumSpeed(int $minimumSpeed): self
	{
		$this->minimumSpeed = $minimumSpeed;
		return $this;
	}

	/**
	 * @param int $maximumSpeed
	 * @return $this
	 */
	public function setMaximumSpeed(int $maximumSpeed): self
	{
		$this->maximumSpeed = $maximumSpeed;
		return $this;
	}

	private function reset()
	{
		$this->minimumHealth = null;
		$this->maximumHealth = null;
		$this->minimumStrength = null;
		$this->maximumStrength = null;
		$this->minimumDefense = null;
		$this->maximumDefense = null;
		$this->minimumLuck = null;
		$this->maximumLuck = null;
		$this->minimumSpeed = null;
		$this->maximumSpeed = null;
	}

	private function validate()
	{
		if (is_null($this->minimumHealth)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"minimumHealth\" to be set.", 0xCACA0);
		if (is_null($this->maximumHealth)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"maximumHealth\" to be set.", 0xCACA1);
		if (is_null($this->minimumStrength)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"minimumStrength\" to be set.", 0xCACA2);
		if (is_null($this->maximumStrength)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"maximumStrength\" to be set.", 0xCACA3);
		if (is_null($this->minimumDefense)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"minimumDefense\" to be set.", 0xCACA4);
		if (is_null($this->maximumDefense)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"maximumDefense\" to be set.", 0xCACA5);
		if (is_null($this->minimumLuck)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"minimumLuck\" to be set.", 0xCACA6);
		if (is_null($this->maximumLuck)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"maximumLuck\" to be set.", 0xCACA7);
		if (is_null($this->minimumSpeed)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"minimumSpeed\" to be set.", 0xCACA8);
		if (is_null($this->maximumSpeed)) throw new BadMethodCallException("Class " . __CLASS__ . " requires parameter \"maximumSpeed\" to be set.", 0xCACA9);
	}
}
