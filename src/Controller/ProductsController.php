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
        $products = $this->Products->find(); //$this->Paginator->paginate();
        $this->set(compact('products'));
    }


    public function view($id = null)
    {
        $product = $this->Products->get($id);

        $this->set('product', $product);
    }


    public function add()
    {
        $product = $this->Products->newEntity();
        
        if ($this->request->is('post')) {

            $data =  $this->request->data;
             // debug($data);
            // exit;
            $product['name'] = $data['name'];
            $product['unit'] = $data['unit'];
            $product['price'] = $data['price'];
            $product['inventory'] = $data['inventory'];
            $product['cost'] = $data['price'] * $data['inventory'];
            $product['expiry'] = date("Y-m-d H:i:s", strtotime( $data['expiry']));
             
          
               //upload image
            if(!$data['image']['name']){
                $filename = null;
            }else {
                if(!empty($data['image']['name'])) {
                $filename = $data['image']['name'];
               
                $uploadPath = WWW_ROOT.'/img/uploads/';
                $uploadFile  = $uploadPath.$filename;

                    if((move_uploaded_file($data['image']['tmp_name'], $uploadFile))) {
                          $product['image'] = $filename;
                        
                    }
                 }
            } 
             
            //getting all data save to variable

            $product['image'] = !isset($filename) ? null : $filename;
            // $product['image'] = "test";
                // debug($product);
                //  exit;
            // // $product = $this->Products->patchEntity($product, $data);
           
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
        $product = $this->Products->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
           $data =  $this->request->data;
             // debug($data);
            // exit;
          
            $data['cost'] = $data['price'] * $data['inventory'];
            $data['expiry'] = date("Y-m-d H:i:s", strtotime( $data['expiry']));
             
          
               //upload image
            if(!$data['image']['name']){
                $filename = null;
            }else {
                if(!empty($data['image']['name'])) {
                $filename = $data['image']['name'];
               
                $uploadPath = WWW_ROOT.'/img/uploads/';
                $uploadFile  = $uploadPath.$filename;

                    if((move_uploaded_file($data['image']['tmp_name'], $uploadFile))) {
                          $data['image'] = $filename;
                        
                    }
                 }
            } 
             
            //getting all data save to variable

            $data['image'] = !isset($filename) ? null : $filename;


            $product = $this->Products->patchEntity($product, $data);
            // debug($product);
            // exit;
            

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