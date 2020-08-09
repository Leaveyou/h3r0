<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\Chance;

abstract class SkillChance
{
	private Chance $chance;
	private ?Monitor $monitor = null;

	/**
	 * MagicShield constructor.
	 * @param Chance $chance
	 */
	public function __construct(Chance $chance)
	{
		$this->chance = $chance;
	}

	public function roll()
	{
		return $this->chance->roll();
	}

	public function setMonitor(Monitor $monitor): self
	{
		$this->monitor = $monitor;
		return $this;
	}

	protected function monitor(string $message)
	{
		if (isset($this->monitor))
			$this->monitor->customMessage($message);
	}
}
