<?php

declare(strict_types=1);

namespace NoobMCBG\CustomWarpUI\commands;

use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use NoobMCBG\CustomWarpUI\Forms;
use NoobMCBG\CustomWarpUI\CustomWarpUI;

class WarpCommands extends Command implements PluginOwned {

	private CustomWarpUI $plugin;

	public function __construct(CustomWarpUI $plugin){
		$this->plugin = $plugin;
		parent::__construct("warp", "Lệnh Để Mở Menu Dịch Chuyển", null, ["dichchuyen"]);
	}

	public function execute(CommandSender $sender, string $label, array $args){
        if($sender instanceof Player){
        	Forms::menuWarps($sender);
        }else{
        	$this->plugin->getLogger()->error("Please use command in-game");
        }
	}

	public function getOwningPlugin() : CustomWarpUI {
		return $this->plugin;
	}
}