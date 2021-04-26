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
            <?= $this->Html->link(__('List Bids'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bids form content">
            <?= $this->Form->create($bid) ?>
            <fieldset>
                <legend><?= __('Add Bid') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('item_id', ['options' => $auctionItems]);
                    echo $this->Form->control('amount');
                    echo $this->Form->control('current_bid');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
