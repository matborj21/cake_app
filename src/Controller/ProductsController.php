<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Query;
use LDAP\Result;

class ProductsController extends AppController
{
  
      public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
       
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
            $data['expiry'] = Time::parseDate($data['expiry'], 'Y-M-d');
        
           
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
        $product['expiry'] = date("m/d/Y", strtotime( $product['expiry']));
        // debug($product);
        // exit;
        if ($this->request->is(['patch', 'post', 'put'])) {
           $data =  $this->request->getData();
            //  debug($data);
            // exit;
          
            $data['cost'] = $data['price'] * $data['inventory'];
            $data['expiry'] =Time::parseDate($data['expiry'], 'Y-M-d');


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

    public function delete()
    {
        $this->request->is(['post', 'delete']);
        $id = $this->request->getData();
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
        $item = $this->loadModel('Products');
        
        if ($this->request->is('post')) {
           $postData = $this->request->getData();

           if(!empty($postData['csv_file']['name'])){

            
               $row = 1;
               if (($handle = fopen($postData['csv_file']['tmp_name'], "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                         
                        if(!empty($row != 1)){
                                      
                            $check = $item->CheckIfExist($data[0]); // check if name is already in the database
                            
                            
                               if($check == 0 ){ // if the name is already in the database it will not include on array variable
                                 $result[] = array(
                                    'name' => $data[0],
                                    'unit' => $data[1],
                                    'price' => $data[2],
                                    'inventory' => $data[3],
                                    'expiry' =>Time::parseDate($data[4], 'Y-M-d'),
                                     'cost' => floatval($data[3]) * floatval($data[2])
                                );
                               }
                               else {
                                    $this->Flash->error(__('The product could not be save. duplicate record found.'));
                               }
                               
                            }
                             $row++;
                        }

                        debug($result);
                        exit;
                             
                         $product = $this->Products->newEntities($result);
                        
                          
                        
                         if($this->Products->saveMany($product)){
                                            $this->Flash->success(__('The product has been save.'));
                                        }
                                        else{
                                     
                                     $this->Flash->error(__('The product could not be save. duplicate record found.'));
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
        $_header = ['ID', 'PRODUCT NAME', 'PRODUCT UNIT', 'PRODUCT PRICE', 'PRODUCT EXPIRY', 'PRODUCT INVENTORY', 'PRODUCT COST'];
   		$this->set(compact('data', '_header', '_serialize'));
		$this->viewBuilder()->setClassName('CsvView.Csv');
		return;
   
    }

    
    public function viewDataTable()
    {
         $requestData = $this->request->getData();
         $starts = $requestData['start'];
         $length = $requestData['length'];
         $columnIndex = $requestData['order'][0]['column']; // Column index
         $columnName = $requestData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $requestData['order'][0]['dir']; // asc or desc
       
        //  debug($columnSortOrder);
        //  exit;
         
       
        $searchValue = $requestData['search']['value'];
        $searchCondition = '';
            if ( $searchValue != '')
            {
            $searchCondition = array (
                                'name LIKE' => "%" . $searchValue . "%",
                                'unit LIKE' => "%" . $searchValue . "%",
                                'price LIKE' => "%" . $searchValue . "%",
                                'inventory LIKE' => "%" . $searchValue . "%",
                                'cost LIKE' => "%" . $searchValue . "%",
                                'expiry LIKE' => "%" . $searchValue . "%",
                            );
            }
        $where = [
            '1' => '1', // WHERE 1=1 clause is merely a convention adopted by some developers to make working with their SQL statements a little easier
            'or' => $searchCondition,
        ];


        $order = [
           
        ];

        $products = $this->Products->find()
          ->where($where, ['id' => 'string'])
          ->limit($length)
          ->order([ $columnName  => $columnSortOrder])
          ->offset($starts);


        $data = []; 
        foreach($products as $row) {
            $nestedData = [];
            $nestedData = $row;

            $nestedData['id'] = $row['id'];
            $nestedData['name'] = $row['name'];
            $nestedData['unit'] = $row['unit'];
            $nestedData['price'] = $row['price'];
            $nestedData['inventory'] = $row['inventory'];
            $nestedData['cost'] = $row['cost'];
            $nestedData['expiry'] = (!empty($row['expiry'])) ? date('Y-m-d',strtotime($row['expiry'])) : '';
            $nestedData['button'] = "<a class='btn btn-default btn-xs' href='/products/view/{$row['id']}'>View</a>
                                     <a class='btn btn-primary btn-xs' href='/products/edit/{$row['id']}'>Edit</a>
                                     <a class='btn btn-danger btn-xs deletebtn' id='{$row['id']}'>Delete</a>";
             $data[] = $nestedData;

        }

        $totalData = $products->count();

        
        $json_data = array(
        "draw" => intval( $requestData['draw'] ),
        "recordsTotal" => intval( $totalData ),
        "recordsFiltered" => intval( $totalData ),
        "data" => $data
         

        );
        echo json_encode($json_data);
        exit;
    }
}