<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="row">

    <div class="col-md-8">
        <h2>Observation Results</h2>
<!--        <p>On --><?php //echo h($results['run']['run_date'])?><!-- <strong>--><?//= h($results['participant']['name']) ?><!--</strong>-->
<!--        made an observation of <strong>--><?php //echo h($results['participant']['observer']) ?><!--</strong>'s-->
<!--        performance with the following results.</p>-->
        <h4><?php echo "The observer was: " . h($results['participant']['name']) ?></h4>
        <h4><?php echo "The participant being observed was: " . h($results['participant']['observer']) ?></h4>
<!--        <h4>--><?php //echo "<strong>The observer was: </strong>" . h($results['participant']['name']) ?><!--</h4>-->
<!--        <h4>--><?php //echo "<strong>The participant being observed was: </strong>" . h($results['participant']['observer']) ?><!--</h4>-->
    </div>

    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">Run Details</div>
            <div class="panel-body">
<!--                <table>-->
<!--                    <tr><th>Name:       </th>   <td>--><?php //echo h($results['run']['name']) ?><!--</td></tr>-->
<!--                    <tr><th>Description:</th>   <td>--><?php //echo h($results['run']['description']) ?><!--</td></tr>-->
<!--                    <tr><th>Date:       </th>   <td>--><?php //echo h($results['run']['run_date']) ?><!--</td></tr>-->
<!--                </table>-->
                <strong>Name:</strong>      <?php echo h($results['run']['name']) ?><br>
                <strong>Description:</strong>       <?php echo h($results['run']['description']) ?><br>
                <strong>Date:</strong>      <?php echo h($results['run']['run_date']) ?>
            </div>
        </div>
    </div>

</div>



<div class="panel panel-info">
    <div class="panel-heading">
        <h4>Tool: <?= h($results['questionnaire']['name']) ?></h4>
    </div>
    <div class="panel-body">
        <h4><?= h($results['questionnaire']['description']) ?></h4><br>
        <?php foreach($results['questionnaire']['sections'] as $sections): ?>
            <table style="width: 100%" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="2"><strong>Section title:</strong> <?= h($sections['name']) ?></th>
                    </tr>
                    <!-- Added this so that if description isn't added this won't be displayed -->
                    <?php if($sections['description'] != ''): ?>
                        <th colspan="2">
                            <strong>Description of section:</strong> <?= h($sections['description']) ?>
                        </th>
                    <?php endif; ?>
                </thead>
                <tbody>
                <?php foreach($sections[0]['questions'] as $questions): ?>
                    <tr>
                        <td><?=  h($questions['question_text']) ?></td>
                        <td><?= h($questions['answer_text']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>
</div>
