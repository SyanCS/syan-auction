<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersWallet $usersWallet
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Users Wallet'), ['action' => 'edit', $usersWallet->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Users Wallet'), ['action' => 'delete', $usersWallet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersWallet->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users Wallets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Users Wallet'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usersWallets view content">
            <h3><?= h($usersWallet->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $usersWallet->has('user') ? $this->Html->link($usersWallet->user->name, ['controller' => 'Users', 'action' => 'view', $usersWallet->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($usersWallet->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($usersWallet->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($usersWallet->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($usersWallet->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
