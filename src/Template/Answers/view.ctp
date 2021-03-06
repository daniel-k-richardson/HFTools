<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Answer $answer
  */
?>
    <h3><?= h($answer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $answer->has('question') ? $this->Html->link($answer->question->id, ['controller' => 'Questions', 'action' => 'view', $answer->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Answer Text') ?></th>
            <td><?= h($answer->answer_text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($answer->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Observations') ?></h4>
        <?php if (!empty($answer->observations)): ?>
        <table class="wide-table" cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Observer Id') ?></th>
                <th scope="col"><?= __('Participant Id') ?></th>
                <th scope="col"><?= __('Run Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($answer->observations as $observations): ?>
            <tr>
                <td><?= h($observations->id) ?></td>
                <td><?= h($observations->observer_id) ?></td>
                <td><?= h($observations->participant_id) ?></td>
                <td><?= h($observations->run_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<span class="glyphicon glyphicon-info-sign"></span>'), ['controller' => 'Observations', 'action' => 'view', $observations->id]) ?>
                    <?= $this->Html->link(__('<span class="glyphicon glyphicon-pencil"></span>'), ['controller' => 'Observations', 'action' => 'edit', $observations->id]) ?>
                    <?= $this->Form->postLink(__('<span class="glyphicon glyphicon-trash"></span>'), ['controller' => 'Observations', 'action' => 'delete', $observations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $observations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
