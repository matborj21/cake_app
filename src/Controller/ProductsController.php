<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

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
        $products = $this->Products->find('all', [
            'order' => ['Products.id' => 'DESC']
        ]);//$this->Paginator->paginate();
        
        $products['draw'] = $_POST['draw'];
        $products['id'] = isset($_POST['id']) ? $_POST['id'] : "";
        $products['name'] = isset($_POST['name']) ? $_POST['name'] : "";
        $products['limit'] = $_POST['length'];
        $products['start'] = $_POST['start'];
        $products['order_column'] = $_POST['order'][0]['column'];
        $products['order'] = $_POST['order'][0]['dir'];
        $products['search'] = $_POST['search']['value'];
        // echo json_encode($products);
        $this->set(compact('products'));
    }


    public function view($id = null)
    {
        $product = $this->Products->get($id);

        $this->set('product', $product);
    }


    public function add()
    {

        if($this->request->is('post')){
            $data =  $this->request->getData();
            
            // debug($data);
            // exit;
            $product['name'] = $data['name'];
            $product['unit'] = $data['unit'];
            $product['price'] = $data['price'];
            $product['inventory'] = $data['inventory'];
            $data['cost'] = floatval($data['price']) * floatval($data['inventory']);
            $product['expiry'] = date("Y-m-d H:i:s", strtotime( $data['expiry']));
             
          
               //upload image
            if(!$data['image']['name']){
                $filename = null;
            }else {
                if(!empty($data['image']['name'])) {
                //getting file name
                $filename = $data['image']['name'];
                //setting upload file path
                $uploadPath = WWW_ROOT.'/img/uploads/';
                //creating path for upload
                $uploadFile  = $uploadPath.$filename;

                    if((move_uploaded_file($data['image']['tmp_name'], $uploadFile))) {
                          //after upload put into entiy the filename
                          $data['image'] = $filename;
                    }
                 }
                 $data['image'] = !isset($filename) ? null : $filename;
            } 
            // null if no uploaded file will style to default.png(image)
            
         
                
            // $product = $this->Products->patchEntity($product, $data);
               $product = $this->Products->newEntity($data);
            // var_dump($product);
            //         exit;
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
           $this->set(compact('product'));
        }
         
    }


    public function edit($id = null)
    {
        $product = $this->Products->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
           $data =  $this->request->getData();
            //  debug($data);
            // exit;
          
            $data['cost'] = $data['price'] * $data['inventory'];
            $expiry = Time::parse($data['expiry']);
            $product['expiry'] = $expiry->i18nFormat('yyyy-MM-dd HH:mm:ss');
            // $oldImage =  $data['oldimage'];


               //upload image
                if(!empty($data['image']['name'])) {
                    $filename = $data['image']['name'];
                    $uploadPath = WWW_ROOT.'/img/uploads/';
                    $uploadFile  = $uploadPath.$filename;

                        if((move_uploaded_file($data['image']['tmp_name'], $uploadFile))) {
                            $data['image'] = $filename;
                        }
                 }
                 else{
					$filename =  $product->image ;
				}
         
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


    public function csvimport()
    {
        
        if ($this->request->is('post')) {
           $postData = $this->request->getData();

           if(!empty($postData['csv_file']['name'])){

            
               $row = 1;
               if (($handle = fopen($postData['csv_file']['tmp_name'], "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                         
                        
                        if(!empty($row != 1)){
                            

                                $result[] = array(
                                    'name' => $data[0],
                                    'unit' => $data[1],
                                    'price' => $data[2],
                                    'inventory' => $data[3],
                                     $expiry = Time::parse($data[4]),
                                    'expiry' => $expiry->i18nFormat('yyyy-MM-dd HH:mm:ss'),
                                    // 'expiry'=> date("Y-m-d H:i:s", strtotime( $data[4])),
                                     'cost' => floatval($data[3]) * floatval($data[2])
                                );
                
                           
                            }
                             $row++; 

                        }

                         $product = $this->Products->newEntities($result);
                         if($this->Products->saveMany($product)){
                                $this->Flash->success(__('The product has been deleted.'));
                            } else {
                                $this->Flash->error(__('The product could not be deleted. Please, try again.'));
                            }
        
                        }
                  fclose($handle);
                  return $this->redirect(['action' => 'index']);
           }
        }
    }

    public function exportcsv()
    {
       
        // $this->response->download('export.csv');
        $this->setResponse($this->getResponse()->withDownload('export.csv'));
		$data = $this->Products->find('all');
        $data->selectAllExcept($this->Products, ['image']);
        $data->toArray();
        
		$_serialize = 'data';
   		$this->set(compact('data', '_serialize'));
		$this->viewBuilder()->className('CsvView.Csv');
		return;
   
    }
    
}