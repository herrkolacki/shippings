<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Zone $zone
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $zone->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $zone->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Zones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="zones form content">
            <?= $this->Form->create($zone) ?>
            <fieldset>
                <legend><?= __('Edit Zone') ?></legend>
                <?php
                    echo $this->Form->control('code');
                    echo $this->Form->control('zone_amount');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
