<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AutoBidsItem $autoBidsItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Auto Bids Item'), ['action' => 'edit', $autoBidsItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Auto Bids Item'), ['action' => 'delete', $autoBidsItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $autoBidsItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Auto Bids Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Auto Bids Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="autoBidsItems view content">
            <h3><?= h($autoBidsItem->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $autoBidsItem->has('user') ? $this->Html->link($autoBidsItem->user->name, ['controller' => 'Users', 'action' => 'view', $autoBidsItem->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Auction Item') ?></th>
                    <td><?= $autoBidsItem->has('auction_item') ? $this->Html->link($autoBidsItem->auction_item->name, ['controller' => 'AuctionItems', 'action' => 'view', $autoBidsItem->auction_item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($autoBidsItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($autoBidsItem->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
