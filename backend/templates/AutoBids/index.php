<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AutoBid[]|\Cake\Collection\CollectionInterface $autoBids
 */
?>
<div class="autoBids index content">
    <?= $this->Html->link(__('New Auto Bid'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Auto Bids') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autoBids as $autoBid): ?>
                <tr>
                    <td><?= $this->Number->format($autoBid->id) ?></td>
                    <td><?= $autoBid->has('user') ? $this->Html->link($autoBid->user->name, ['controller' => 'Users', 'action' => 'view', $autoBid->user->id]) : '' ?></td>
                    <td><?= $this->Number->format($autoBid->amount) ?></td>
                    <td><?= h($autoBid->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $autoBid->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $autoBid->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $autoBid->id], ['confirm' => __('Are you sure you want to delete # {0}?', $autoBid->id)]) ?>
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
