<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AutoBidsItem $autoBidsItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Auto Bids Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="autoBidsItems form content">
            <?= $this->Form->create($autoBidsItem) ?>
            <fieldset>
                <legend><?= __('Add Auto Bids Item') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('item_id', ['options' => $auctionItems]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
