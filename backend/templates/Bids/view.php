<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bid $bid
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Bid'), ['action' => 'edit', $bid->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Bid'), ['action' => 'delete', $bid->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bid->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Bids'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Bid'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bids view content">
            <h3><?= h($bid->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $bid->has('user') ? $this->Html->link($bid->user->name, ['controller' => 'Users', 'action' => 'view', $bid->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Auction Item') ?></th>
                    <td><?= $bid->has('auction_item') ? $this->Html->link($bid->auction_item->name, ['controller' => 'AuctionItems', 'action' => 'view', $bid->auction_item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($bid->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($bid->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($bid->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Current Bid') ?></th>
                    <td><?= $bid->current_bid ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
