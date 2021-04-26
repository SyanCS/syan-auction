<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AutoBidsItem[]|\Cake\Collection\CollectionInterface $autoBidsItems
 */
?>
<div class="autoBidsItems index content">
    <?= $this->Html->link(__('New Auto Bids Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Auto Bids Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('item_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autoBidsItems as $autoBidsItem): ?>
                <tr>
                    <td><?= $this->Number->format($autoBidsItem->id) ?></td>
                    <td><?= $autoBidsItem->has('user') ? $this->Html->link($autoBidsItem->user->name, ['controller' => 'Users', 'action' => 'view', $autoBidsItem->user->id]) : '' ?></td>
                    <td><?= $autoBidsItem->has('auction_item') ? $this->Html->link($autoBidsItem->auction_item->name, ['controller' => 'AuctionItems', 'action' => 'view', $autoBidsItem->auction_item->id]) : '' ?></td>
                    <td><?= h($autoBidsItem->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $autoBidsItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $autoBidsItem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $autoBidsItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $autoBidsItem->id)]) ?>
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
