<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuctionItem $auctionItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Auction Item'), ['action' => 'edit', $auctionItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Auction Item'), ['action' => 'delete', $auctionItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $auctionItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Auction Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Auction Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="auctionItems view content">
            <h3><?= h($auctionItem->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($auctionItem->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= h($auctionItem->image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($auctionItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Minimum Bid') ?></th>
                    <td><?= $this->Number->format($auctionItem->minimum_bid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ending') ?></th>
                    <td><?= h($auctionItem->ending) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($auctionItem->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($auctionItem->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descr') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($auctionItem->descr)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
