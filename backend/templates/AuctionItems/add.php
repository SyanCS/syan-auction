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
            <?= $this->Html->link(__('List Auction Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="auctionItems form content">
            <?= $this->Form->create($auctionItem) ?>
            <fieldset>
                <legend><?= __('Add Auction Item') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('descr');
                    echo $this->Form->control('image');
                    echo $this->Form->control('minimum_bid');
                    echo $this->Form->control('ending');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
