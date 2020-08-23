<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shipping $shipping
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $shipping->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $shipping->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Shippings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="shippings form content">
            <?= $this->Form->create($shipping) ?>
            <fieldset>
                <legend><?= __('Edit Shipping') ?></legend>
                <?php
                    echo $this->Form->control('postcode');
                    echo $this->Form->control('total_order_amount');
                    echo $this->Form->control('long_product');
                    //echo $this->Form->control('zone_id', ['options' => $zones]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
