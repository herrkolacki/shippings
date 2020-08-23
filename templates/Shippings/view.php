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
            <?= $this->Html->link(__('Edit Shipping'), ['action' => 'edit', $shipping->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Shipping'), ['action' => 'delete', $shipping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shipping->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Shippings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Shipping'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="shippings view content">
            <h3><?= h($shipping->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Postcode') ?></th>
                    <td><?= h($shipping->postcode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Zone') ?></th>
                    <td><?= $shipping->has('zone') ? $this->Html->link($shipping->zone->id, ['controller' => 'Zones', 'action' => 'view', $shipping->zone->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($shipping->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Order Amount') ?></th>
                    <td><?= $this->Number->format($shipping->total_order_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Shipping Order Amount') ?></th>
                    <td><?= $this->Number->format($shipping->shipping_order_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($shipping->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($shipping->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Long Product') ?></th>
                    <td><?= $shipping->long_product ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
