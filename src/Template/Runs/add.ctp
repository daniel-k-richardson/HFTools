<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div>
    <?= $this->Form->create($run) ?>
    <fieldset>
        <legend><?= __('Add Run') ?></legend>
        <?php
            echo $this->Form->control('session_id', ['option' => $sessions]);
//            echo $this->Form->control('run_date');
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
