<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Zones Controller
 *
 * @property \App\Model\Table\ZonesTable $Zones
 * @method \App\Model\Entity\Zone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZonesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $zones = $this->paginate($this->Zones);

        $this->set(compact('zones'));
    }

    /**
     * View method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $zone = $this->Zones->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('zone'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $zone = $this->Zones->newEmptyEntity();
        if ($this->request->is('post')) {
            $zone = $this->Zones->patchEntity($zone, $this->request->getData());
            if ($this->Zones->save($zone)) {
                $this->Flash->success(__('The zone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The zone could not be saved. Please, try again.'));
        }
        $this->set(compact('zone'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $zone = $this->Zones->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
           
            $zone = $this->Zones->patchEntity($zone, $this->request->getData());
            
            if ($this->Zones->save($zone)) {
                $this->Flash->success(__('The zone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The zone could not be saved. Please, try again.'));
        }
        $this->set(compact('zone'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $zone = $this->Zones->get($id);
        if ($this->Zones->delete($zone)) {
            $this->Flash->success(__('The zone has been deleted.'));
        } else {
            $this->Flash->error(__('The zone could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function addFromFile() {
        $zone = $this->Zones->newEmptyEntity();
        if ($this->request->is('post')) {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $zone = $this->Zones->newEmptyEntity();
                if ($row[0] == 'code') {
                    continue;
                }
                if (is_string($row[1])) {
                    $zoneAmount = str_replace(',', '.', $row[1]);
                } else {
                    $zoneAmount = $row[1];
                }
                if ($this->Zones->exists(['code' => $row[0]])) {
                    $this->Zones->updateAll(
                            ['zone_amount' => $zoneAmount], //fields to update
                            ['code' => $row[0]]  //condition
                    );
                } else {
                    $zone = $this->Zones->patchEntity($zone, ['code' => 
                        $row[0], 'zone_amount' => $zoneAmount]);
                    $this->Zones->save($zone);
                }
            }

            fclose($handle);
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('zone'));
    }

}