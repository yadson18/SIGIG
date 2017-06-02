<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Receipts File'), ['action' => 'edit', $receiptsFile->id_receipt]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Receipts File'), ['action' => 'delete', $receiptsFile->id_receipt], ['confirm' => __('Are you sure you want to delete # {0}?', $receiptsFile->id_receipt)]) ?> </li>
        <li><?= $this->Html->link(__('List Receipts Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Receipts File'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="receiptsFiles view large-9 medium-8 columns content">
    <h3><?= h($receiptsFile->id_receipt) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id Receipt') ?></th>
            <td><?= $this->Number->format($receiptsFile->id_receipt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id File') ?></th>
            <td><?= $this->Number->format($receiptsFile->id_file) ?></td>
        </tr>
    </table>
</div>
