<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bid[]|\Cake\Collection\CollectionInterface $bids
 */
?>
<div class="bids index content">
    <?= $this->Html->link(__('New Bid'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Bids') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('item_id') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('current_bid') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bids as $bid): ?>
                <tr>
                    <td><?= $this->Number->format($bid->id) ?></td>
                    <td><?= $bid->has('user') ? $this->Html->link($bid->user->name, ['controller' => 'Users', 'action' => 'view', $bid->user->id]) : '' ?></td>
                    <td><?= $bid->has('auction_item') ? $this->Html->link($bid->auction_item->name, ['controller' => 'AuctionItems', 'action' => 'view', $bid->auction_item->id]) : '' ?></td>
                    <td><?= $this->Number->format($bid->amount) ?></td>
                    <td><?= h($bid->current_bid) ?></td>
                    <td><?= h($bid->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $bid->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bid->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bid->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bid->id)]) ?>
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
