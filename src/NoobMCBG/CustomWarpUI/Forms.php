<?php

declare(strict_types=1);

namespace NoobMCBG\CustomWarpUI;

use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use NoobMCBG\CustomWarpUI\CustomWarpUI;

class Forms {

	public static function menuWarps(Player $player){
		$instance = CustomWarpUI::getInstance();
		$form = new SimpleForm(function(Player $player, $data) use ($instance) {
			if($data == null){
				return true;
			}
			if($data == 0){
				return true;
			}
			if($instance->getWarp()->exists($data)){
				$ex = explode(" ", $instance->getWarp()->get($data)["position"]);
			    $x = (int)$ex[0];
			    $y = (int)$ex[1];
			    $z = (int)$ex[2];
			    $world = $instance->getServer()->getWorldManager()->getWorldByName($ex[3]);
			    if(!$instance->getServer()->getWorldManager()->isWorldGenerated($ex[3])){
			    	$player->sendMessage("§l§c•§e Lỗi ! Thế Giới Của khu Warp Này Không Tồn Tại, Hãy Báo Cho Admin Lỗi Này !");
			    	return true;
			    }
			    $position = new \pocketmine\world\Position($x, $y, $z, $world);
			    $player->teleport($position);
			    $player->sendMessage($instance->getWarp()->get($data)["msg-teleport"]);
			}
		});
       	 	$form->setTitle("§l§6♦§2 Menu Dịch Chuyển §6♦");
        	$form->addButton("§l§3•§2 Thoát Menu §3•");
        	for($i = 1;$i <= 30;$i++){
        		if($instance->getWarp()->exists($i)){
        	    	$form->addButton($instance->getWarp()->get($i)["button"], 1, $instance->getWarp()->get($i)["icon"]);
        		}
        	}
        	$form->sendToPlayer($player);
	}
}
