<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit File'), ['action' => 'edit', $file->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Receipts'), ['controller' => 'Receipts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Receipt'), ['controller' => 'Receipts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="files view large-9 medium-8 columns content">
    <h3><?= h($file->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($file->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Src') ?></th>
            <td><?= h($file->src) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($file->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receipt Id') ?></th>
            <td><?= $this->Number->format($file->receipt_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Receipts') ?></h4>
        <?php if (!empty($file->receipts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('ReceiptType') ?></th>
                <th scope="col"><?= __('Payment') ?></th>
                <th scope="col"><?= __('Send') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Aproved') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($file->receipts as $receipts): ?>
            <tr>
                <td><?= h($receipts->id) ?></td>
                <td><?= h($receipts->receiptType) ?></td>
                <td><?= h($receipts->payment) ?></td>
                <td><?= h($receipts->send) ?></td>
                <td><?= h($receipts->user_id) ?></td>
                <td><?= h($receipts->aproved) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Receipts', 'action' => 'view', $receipts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Receipts', 'action' => 'edit', $receipts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Receipts', 'action' => 'delete', $receipts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $receipts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
