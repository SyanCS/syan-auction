<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\I18n\Time;

class TestAutoBidsCommand extends Command
{

	protected $modelClass = 'Bids';

    public function execute(Arguments $args, ConsoleIo $io)
    {
    	$teste = $this->Bids->getItemHighestBid(4);
        dump($teste->amount);
        exit;
    }
}