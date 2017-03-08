<?php
/**
  * @var \App\View\AppView $this
  */
?>


<div class="row">
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New Session</h4>
                </div>
                <div class="modal-body">
                    <?= $this->requestAction(
                    array('controller'=>'Sessions','action'=>'add')
                    ) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="sessions index columns content">
    <h3><?= __('Sessions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('description') ?></th>
            <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
            <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
            <th scope="col"><?= $this->Paginator->sort('client_id') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($sessions as $session): ?>
        <tr>
            <td><?= $this->Number->format($session->id) ?></td>
            <td><?= h($session->name) ?></td>
            <td><?= h($session->description) ?></td>
            <td><?= h($session->start_date) ?></td>
            <td><?= h($session->end_date) ?></td>
            <td><?= $session->has('client') ? $this->Html->link($session->client->name, ['controller' => 'Clients',
                'action' => 'view', $session->client->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $session->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $session->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $session->id], ['confirm' => __('Are you
                sure you want to delete # {0}?', $session->id)]) ?>
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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out
            of {{count}} total')]) ?></p>
    </div>
</div>
