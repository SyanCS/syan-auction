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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $usersWallet->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usersWallet->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users Wallets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usersWallets form content">
            <?= $this->Form->create($usersWallet) ?>
            <fieldset>
                <legend><?= __('Edit Users Wallet') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('amount');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
