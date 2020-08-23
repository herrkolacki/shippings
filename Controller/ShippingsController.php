<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Shippings Controller
 *
 * @property \App\Model\Table\ShippingsTable $Shippings
 * @method \App\Model\Entity\Shipping[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShippingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Zones'],
        ];
        $shippings = $this->paginate($this->Shippings);

        $this->set(compact('shippings'));
    }

    /**
     * View method
     *
     * @param string|null $id Shipping id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shipping = $this->Shippings->get($id, [
            'contain' => ['Zones'],
        ]);

        $this->set(compact('shipping'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       $shipping = $this->Shippings->newEmptyEntity();
        if ($this->request->is('post')) {
            $shipping = $this->Shippings->patchEntity($shipping, $this->request->getData());
            $zone = substr($this->request->getData()['postcode'], 0, 2);
            $zone = $this->Shippings->Zones->find('all', ['conditions' => 
                ['code'=> $zone], 'fields' => ['zone_amount', 'id']])->first();
           
            $shipping->shipping_order_amount = 100;
            //total shipping price from zone
            if($zone){
                $shipping->shipping_order_amount += $zone->zone_amount;
                $shipping->zone_id = $zone->id;
            }
            //total shipping price if produkt is long
            if($this->request->getData()['long_product']){
                $shipping->shipping_order_amount += 1995;
            }
            //total shipping price total order amount greater than 12500
            if($shipping->total_order_amount > 12500){
                $shipping->shipping_order_amount -= $shipping->shipping_order_amount * 0.05;
            }
          
            if ($this->Shippings->save($shipping)) {
                $this->Flash->success(__('The shipping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipping could not be saved. Check zones and please, try again '));
        }
        $zones = $this->Shippings->Zones->find('list', ['limit' => 200]);
        $this->set(compact('shipping'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shipping id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shipping = $this->Shippings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shipping = $this->Shippings->patchEntity($shipping, $this->request->getData());
            if ($this->Shippings->save($shipping)) {
                $this->Flash->success(__('The shipping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipping could not be saved. Please, try again.'));
        }
        $zones = $this->Shippings->Zones->find('list', ['limit' => 200]);
        $this->set(compact('shipping', 'zones'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shipping id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shipping = $this->Shippings->get($id);
        if ($this->Shippings->delete($shipping)) {
            $this->Flash->success(__('The shipping has been deleted.'));
        } else {
            $this->Flash->error(__('The shipping could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
