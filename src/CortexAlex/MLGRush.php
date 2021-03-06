<?php

namespace CortexAlex;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\Item\item;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\EntityDamageByEntityEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;

class MLGRush extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getLogger()->info("§cMLG§fRush §aActiver");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$name = $player->getName();
		foreach($this->getServer()->getOnlinePlayers() as $p);
		$event->setJoinMessage("");
		$p->sendPopup("§8[§a+§8] $name");
		$player->setHealth(20);
		$player->setFood(20);
		//sound kommt noch
		$player->getInventory()->clearAll();
		$player->getInventory()->getItem(0, Item::get(276, 0, 1)->setCustomName("§6Challenger"));
		$player->getinventory()->getitem(1, Item::get(144, 0, 1)->setCustomName("§6Stats"));
		$player->getInventory()->getItem(8, Item::get(54, 0, 1)->setCustomName("§6Avantages"));
		$player->getInventory()->getItem(9, Item::get(64, 0, 1)->setCustomName("§cRetour au lobby"));
		$this->getServer()->loadLevel("MLGLobby");
		$player->teleport($this->getServer()->getLevelByName("MLGLobby")->getSafeSpawn());
	}

	public function onQuit(PlayerQuitEvent $event) {
		$player = $event->getPlayer();
		$name = $player->getName();
		foreach($this->getServer()->getOnlinePlayers() as $p);
		$event->setMessage("");
		$p->sendPopup("§8[§c-§8] $name");
	}

	public function onHit(EntityDamageByEntityEvent $event) {
		$player = $event->getPlayer();
		$name = $player->getName();
		$item = $event->getItem();
		if($item->getId() === "276") {
			$causa = $player->getLastDamageCause();
			$killer = $causa->getDamager();
			$kname = $killer->getName();
			$name = $player->getName();
			$killer->sendMessage("§aVous avez §2$name §aConteste!");
			$player->sendMessage("§aVous etiez de §2$kname §aConteste!");
		}
	}
}