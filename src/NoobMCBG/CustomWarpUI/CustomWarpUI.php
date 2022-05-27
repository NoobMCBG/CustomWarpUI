<?php

declare(strict_types=1);

namespace NoobMCBG\CustomWarpUI;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use NoobMCBG\CustomWarpUI\commands\WarpCommands;

class CustomWarpUI extends PluginBase implements Listener {

	public static $instance;

	public static function getInstance() : self {
		return self::$instance;
	}

	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveResource("warp.yml");
		$this->warp = new Config($this->getDataFolder() . "warp.yml", Config::YAML);
		$this->getServer()->getCommandMap()->register("/warp", new WarpCommands($this));
		self::$instance = $this;
	}

	public function getWarp(){
		return $this->warp;
	}

	public function onDisable() : void {
		$this->warp->save();
	}
}