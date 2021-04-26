<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\I18n\Time;

class EndAuctionsCommand extends Command
{

	protected $modelClass = 'AuctionItems';

    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
    	$currDateTime = date("Y-m-d H:i:s");

        $auctions = $this->AuctionItems->find('all')
        ->where(['status'=>'ACTIVE', 'ending <=' => $currDateTime]);

        foreach ($auctions as $key => $auction) {
        	$auction->status = 'EXPIRED';
        	$this->AuctionItems->save($auction);
        }

        return null;
    }
}