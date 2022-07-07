<?php 
  
    $this->Form->templates([
            'inputGroupContainer' => '<div class="form-group{{required}}"> {{content}} <span class="help">{{help}}</span></div>',
            'input' => '<input type="{{type}}" name="{{name}}" class="form-control form-control-danger" {{attrs}}/>',
            'inputContainerError' => '<div class="form-group has-danger {{type}}{{required}}">{{content}}{{error}}</div>',
            'error' => '<div class="text-danger">{{content}}</div>'
        ]);
?>


<div class="container">
    <div class="row">
        <form action="/products/csvimport" id="csv_import" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="csv_file" class="col-lg-2 control-label">Upload CSV File</label>
                <div class="col-lg-4 inputGroupContainer">
                    <input type="file" name="csv_file" class="form-control" id="csv_file" accept=".csv"
                        placeholder="Import CSV File">

                </div>
                <div class="col-lg-4 inputGroupContainer">
                    <button id="importcsv" type="submit" class="submit btn btn-primary btn-sm">Upload</button>
                </div>
            </div>
        </form>
    </div>

    <form id="form" class="form-horizontal" method="post" action="/products/add" enctype="multipart/form-data"
        role="form" data-toggle="validator">
        <fieldset>
            <legend>New Product</legend>


            <div class=" form-group">
                <label for="name" class="col-lg-2 control-label">Product Name</label>
                <div class="col-lg-6 inputGroupContainer">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Product name"
                        data-error="Please Enter product name"
                        value='<?=  isset($product->name) ? $product->name: '' ?>'>
                </div>
            </div>
            <div class="form-group">
                <label for="unit" class="col-lg-2 control-label">Product Unit</label>
                <div class="col-lg-6 inputGroupContainer">
                    <input type="text" name="unit" class="form-control" id="unit" placeholder="Product Unit"
                        value='<?=  isset($product->unit) ? $product->unit: '' ?>'>
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-lg-2 control-label">Product price</label>
                <div class="col-lg-6 inputGroupContainer ">
                    <input type="text" name="price" class="form-control" id="price" placeholder="Product price"
                        value='<?=  isset($product->price) ? $product->price: '' ?>'>
                </div>
            </div>
            <div class="form-group">
                <label for="expiry" class="col-lg-2 control-label">Product expiry</label>
                <div class='inputGroupContainer col-lg-6 date'>
                    <div class="input-group" id='datetimepicker'>
                        <input type='text' name="expiry" id="expiry" class="form-control" />
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inventory" class="col-lg-2 control-label">Product Inventory</label>
                <div class="col-lg-6 inputGroupContainer ">
                    <input type="text" name="inventory" class="form-control" id="inventory"
                        placeholder="Product Inventory"
                        value='<?=  isset($product->inventory) ? $product->inventory: '' ?>'>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-lg-2 control-label">Product Image</label>
                <div class="col-lg-6 inputGroupContainer">
                    <input type="file" name="image" class="form-control" id="image" placeholder="Product image">
                </div>
            </div>
            <hr>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a class="btn btn-default" href="/products">Cancel</a>
                    <button id="save-product" type="submit" class="submit btn btn-primary">Save</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>