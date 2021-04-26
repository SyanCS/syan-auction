<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bid Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $item_id
 * @property string $amount
 * @property bool|null $auto_bid
 * @property bool $current_bid
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\AuctionItem $auction_item
 */
class Bid extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'item_id' => true,
        'amount' => true,
        'auto_bid' => true,
        'current_bid' => true,
        'created' => true,
        'user' => true,
        'auction_item' => true,
    ];
}
