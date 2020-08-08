<?php declare(strict_types=1);


namespace Hero\Game;


interface Defender
{
	public function defend(int $attack);
}