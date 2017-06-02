<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $receiptsFile->id_receipt],
                ['confirm' => __('Are you sure you want to delete # {0}?', $receiptsFile->id_receipt)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Receipts Files'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="receiptsFiles form large-9 medium-8 columns content">
    <?= $this->Form->create($receiptsFile) ?>
    <fieldset>
        <legend><?= __('Edit Receipts File') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
