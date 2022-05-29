<?php

namespace viskaraze\HealFeed;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    public function onEnable(): void
    {
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->config = $this->getConfig()->getAll();
        $this->saveResource("config.yml");
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $commandname = $command->getName();

        if ($commandname === "feed") {
            $sender->getHungerManager()->setFood(20);
            $sender->getHungerManager()->setSaturation(20);
            $sender->sendMessage($this->getConfig()->get("message-feed"));
            }
        if ($commandname === "heal") {
            $sender->setHealth($sender->getMaxHealth());
            $sender->sendMessage($this->getConfig()->get("message-heal"));
        }
        return true;
    }
}