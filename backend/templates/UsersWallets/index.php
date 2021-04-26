<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersWallet[]|\Cake\Collection\CollectionInterface $usersWallets
 */
?>
<div class="usersWallets index content">
    <?= $this->Html->link(__('New Users Wallet'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users Wallets') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersWallets as $usersWallet): ?>
                <tr>
                    <td><?= $this->Number->format($usersWallet->id) ?></td>
                    <td><?= $usersWallet->has('user') ? $this->Html->link($usersWallet->user->name, ['controller' => 'Users', 'action' => 'view', $usersWallet->user->id]) : '' ?></td>
                    <td><?= $this->Number->format($usersWallet->amount) ?></td>
                    <td><?= h($usersWallet->modified) ?></td>
                    <td><?= h($usersWallet->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $usersWallet->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersWallet->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersWallet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersWallet->id)]) ?>
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
