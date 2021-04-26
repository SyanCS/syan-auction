<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AutoBid $autoBid
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Auto Bid'), ['action' => 'edit', $autoBid->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Auto Bid'), ['action' => 'delete', $autoBid->id], ['confirm' => __('Are you sure you want to delete # {0}?', $autoBid->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Auto Bids'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Auto Bid'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="autoBids view content">
            <h3><?= h($autoBid->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $autoBid->has('user') ? $this->Html->link($autoBid->user->name, ['controller' => 'Users', 'action' => 'view', $autoBid->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($autoBid->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($autoBid->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($autoBid->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
