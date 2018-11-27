<?php

namespace RedCraftPE\RedSkyBlock\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

use RedCraftPE\RedSkyBlock\SkyBlock;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Add;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Ban;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Create;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\CreateWorld;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Delete;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Help;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Hunger;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Info;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Kick;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Lock;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Members;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Name;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Rank;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Reload;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Remove;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Reset;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\SetWorld;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Teleport;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Top;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\Unlock;
use RedCraftPE\RedSkyBlock\Commands\SubCommands\VoidClass;

class Island {

  private static $instance;

  private $add;
  private $ban;
  private $create;
  private $createWorld;
  private $delete;
  private $help;
  private $hunger;
  private $info;
  private $kick;
  private $lock;
  private $members;
  private $name;
  private $rank;
  private $reload;
  private $remove;
  private $reset;
  private $setWorld;
  private $teleport;
  private $top;
  private $unlock;
  private $void;

  public function __construct($plugin) {

    self::$instance = $this;

    $this->plugin = $plugin;

    $this->add = new Add();
    $this->ban = new Ban();
    $this->create = new Create();
    $this->createWorld = new CreateWorld($this->plugin);
    $this->delete = new Delete();
    $this->help = new Help();
    $this->hunger = new Hunger();
    $this->info = new Info();
    $this->kick = new Kick();
    $this->lock = new Lock();
    $this->members = new Members();
    $this->name = new Name();
    $this->rank = new Rank();
    $this->reload = new Reload();
    $this->remove = new Remove();
    $this->reset = new Reset();
    $this->setWorld = new SetWorld();
    $this->teleport = new Teleport();
    $this->top = new Top();
    $this->unlock = new Unlock();
    $this->void = new VoidClass();
  }
  public function onIslandCommand(CommandSender $sender, Command $command, string $label, array $args): bool {

    if ($sender->hasPermission("skyblock.is")) {

      if (!$args) {

        return $this->help->onHelpCommand($sender, $args);
      } else {

        switch (strtolower($args[0])) {

          case "add":

            return $this->add->onAddCommand($sender, $args);
          break;
          case "ban":

            return $this->ban->onBanCommand($sender);
          break;
          case "create":

            return $this->create->onCreateCommand($sender);
          break;
          case "cw":
          case "createworld":

            return $this->createWorld->onCreateWorldCommand($sender, $args);
          break;
          case "delete":

            return $this->delete->onDeleteCommand($sender);
          break;
          case "help":

            return $this->help->onHelpCommand($sender, $args);
          break;
          case "hunger":

            return $this->hunger->onHungerCommand($sender, $args);
          break;
          case "info":

            return $this->info->onInfoCommand($sender, $args);
          break;
          case "expel":
          case "kick":

            return $this->kick->onKickCommand($sender, $args);
          break;
          case "close":
          case "lock":

            return $this->lock->onLockCommand($sender);
          break;
          case "members":

            return $this->members->onMembersCommand($sender);
          break;
          case "rename":
          case "name":

            return $this->name->onNameCommand($sender, $args);
          break;
          case "rank":

            return $this->rank->onRankCommand($sender);
          break;
          case "load":
          case "reload":

            return $this->reload->onReloadCommand($sender);
          break;
          case "remove":

            return $this->remove->onRemoveCommand($sender, $args);
          break;
          case "restart":
          case "reset":

            return $this->reset->onResetCommand($sender);
          break;
          case "sw":
          case "setworld":

            return $this->setWorld->onSetWorldCommand($sender);
          break;
          case "spawn":
          case "goto":
          case "go":
          case "tp":
          case "teleport":

            return $this->teleport->onTeleportCommand($sender, $args);
          break;
          case "lb":
          case "leaderboard":
          case "top":

            return $this->top->onTopCommand($sender);
          break;
          case "open":
          case "unlock":

            return $this->unlock->onUnlockCommand($sender);
          break;
          case "void":

            return $this->void->onVoidCommand($sender, $args);
          break;
        }
        return false;
      }
    } else {

      $sender->sendMessage(TextFormat::RED . "You do not have the proper permissions to run this command.");
      return true;
    }
  }
}