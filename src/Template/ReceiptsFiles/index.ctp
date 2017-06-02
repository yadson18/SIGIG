<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Receipts File'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="receiptsFiles index large-9 medium-8 columns content">
    <h3><?= __('Receipts Files') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_receipt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_file') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($receiptsFiles as $receiptsFile): ?>
            <tr>
                <td><?= $this->Number->format($receiptsFile->id_receipt) ?></td>
                <td><?= $this->Number->format($receiptsFile->id_file) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $receiptsFile->id_receipt]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $receiptsFile->id_receipt]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $receiptsFile->id_receipt], ['confirm' => __('Are you sure you want to delete # {0}?', $receiptsFile->id_receipt)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
