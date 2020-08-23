<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shipping[]|\Cake\Collection\CollectionInterface $shippings
 */
?>
<div class="shippings index content">
    <?= $this->Html->link(__('New Shipping'), ['action' => 'add'], 
            ['class' => 'button float-right', 'style' => 'margin-left: 1.0rem']) ?>
    <?= $this->Html->link(__('Zones'), '/zones', ['class' => 'button float-right']) ?>
    <h3><?= __('Shippings') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('postcode') ?></th>
                    <th><?= $this->Paginator->sort('total_order_amount') ?></th>
                    <th><?= $this->Paginator->sort('shipping_order_amount') ?></th>
                    <th><?= $this->Paginator->sort('long_product') ?></th>
                    <th><?= $this->Paginator->sort('zone_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shippings as $shipping): ?>
                <tr>
                    <td><?= $this->Number->format($shipping->id) ?></td>
                    <td><?= h($shipping->postcode) ?></td>
                    <td><?= $this->Number->format($shipping->total_order_amount) ?></td>
                    <td><?= $this->Number->format($shipping->shipping_order_amount) ?></td>
                    <td><?= h($shipping->long_product) ?></td>
                    <td><?= $shipping->has('zone') ? $this->Html->link($shipping->zone->id, ['controller' => 'Zones', 'action' => 'view', $shipping->zone->id]) : '' ?></td>
                    <td><?= h($shipping->created) ?></td>
                    <td><?= h($shipping->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $shipping->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $shipping->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shipping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shipping->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
