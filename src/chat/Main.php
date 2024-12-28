<?php

namespace chat;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerChat(PlayerChatEvent $event): void
    {
        $event->cancel();
        $player = $event->getPlayer();
        $name = $player->getNameTag();
        $message = $event->getMessage();
        $config = $this->getConfig();
        $tamplate = $config->get("chat_template", "<player> : <message>");
        $tamplate = str_replace("<player>", $name, $tamplate);
        $tamplate = str_replace("<message>", $message, $tamplate);
        foreach ($this->getServer()->getOnlinePlayers() as $onlinePlayer) {
            $onlinePlayer->sendMessage($tamplate);
        }
    }
}
