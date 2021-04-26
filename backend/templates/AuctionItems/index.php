<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuctionItem[]|\Cake\Collection\CollectionInterface $auctionItems
 */
?>
<div class="auctionItems index content">
    <?= $this->Html->link(__('New Auction Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Auction Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('image') ?></th>
                    <th><?= $this->Paginator->sort('minimum_bid') ?></th>
                    <th><?= $this->Paginator->sort('ending') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($auctionItems as $auctionItem): ?>
                <tr>
                    <td><?= $this->Number->format($auctionItem->id) ?></td>
                    <td><?= h($auctionItem->name) ?></td>
                    <td><?= h($auctionItem->image) ?></td>
                    <td><?= $this->Number->format($auctionItem->minimum_bid) ?></td>
                    <td><?= h($auctionItem->ending) ?></td>
                    <td><?= h($auctionItem->modified) ?></td>
                    <td><?= h($auctionItem->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $auctionItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $auctionItem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $auctionItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $auctionItem->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
