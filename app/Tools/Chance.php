<?php declare(strict_types=1);


namespace Hero\Tools;


use InvalidArgumentException;

class Chance
{
	private int $percent;

	/**
	 * Chance constructor.
	 * @param int $percent
	 */
	public function __construct(int $percent)
	{
		if ($percent < 0 || $percent > 100) throw new InvalidArgumentException("Can only use numbers [0,100] as chance values!");
		$this->percent = $percent;
	}

	public function roll(): bool {
		return (rand(0,99) < $this->percent);
	}

	/**
	 * Compare with another object and return:
	 * -1 if smaller than it
	 * 0 if equal to it
	 * 1 if larger than it
	 * @param Chance $b
	 * @return int
	 */
	public function compare(Chance $b): int {
		return $this->percent <=> $b->percent;
	}
}