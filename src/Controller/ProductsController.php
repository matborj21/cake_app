<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;

class ProductsController extends AppController
{
  
      public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $products = $this->Paginator->paginate($this->Products->find());
        // $newdate = date("Y-m-d", strtotime($products['expiry']));
        // $newdate = $myDateTime->format('Y-m-d');
        // var_dump($products);
        // exit;
        $this->set(compact('products'));
        
    }


    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        $this->set('product', $product);
    }


    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $data =  $this->request->data;
            $data['cost'] = $data['price'] * $data['inventory'];
            $data['expiry'] = date("Y-m-d H:i:s");

            
            $product = $this->Products->patchEntity($product, $data);
            
          
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }


    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}