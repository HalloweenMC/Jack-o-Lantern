<?php

/*                                                                             __
 *                                                                           _|  |_
 *  ____            _        _   __  __ _                  __  __ ____      |_    _|
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \    __ |__|  
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) | _|  |_  
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ |_    _|
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|      |__|   
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine++ Team
 * @link http://pm-plus-plus.tk/
*/

namespace pocketmine\entity;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\Player;
use pocketmine\network\Network;
use pocketmine\item\Item as Dr;

class Slime extends Monster{
	const NETWORK_ID = 37;
	public $width = 1;
	public $length = 1.5;
	public $height = 1.5;

	public function getName(){
		return "Slime";
	}

	 public function spawnTo(Player $player){
		$pk = new AddEntityPacket();
		$pk->eid = $this->getId();
		$pk->type = Slime::NETWORK_ID;
		$pk->x = $this->x;
		$pk->y = $this->y;
		$pk->z = $this->z;
		$pk->speedX = $this->motionX;
		$pk->speedY = $this->motionY;
		$pk->speedZ = $this->motionZ;
		$pk->yaw = $this->yaw;
		$pk->pitch = $this->pitch;
		$pk->metadata = $this->dataProperties;
		$player->dataPacket($pk);

		parent::spawnTo($player);
	}


	public function getDrops(){
		$drops = [];
		$rand = mt_rand(0, 5);
		if($rand){
			$drops[] = Dr::get(Dr::SLIMEBALL, 0, $rand);
		}
		return $drops;
	}
}