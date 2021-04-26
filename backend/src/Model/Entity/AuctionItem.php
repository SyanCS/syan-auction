<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AuctionItem Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $descr
 * @property string $image
 * @property string $minimum_bid
 * @property \Cake\I18n\FrozenTime $ending
 * @property string $status
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 */
class AuctionItem extends Entity
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
        'name' => true,
        'descr' => true,
        'image' => true,
        'minimum_bid' => true,
        'ending' => true,
        'status' => true,
        'modified' => true,
        'created' => true,
    ];
}
