<form class="form-horizontal" method="post" action="/products/add" enctype="multipart/form-data">
    <fieldset>
        <legend>New Product</legend>
        <div class=" form-group">
            <label for="name" class="col-lg-2 control-label">Product Name</label>
            <div class="col-lg-6 input-group ">
                <input type="text" name="name" class=" form-control" id="name" placeholder="Product name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="unit" class="col-lg-2 control-label">Product Unit</label>
            <div class="col-lg-6 input-group ">
                <input type="text" name="unit" class="form-control" id="unit" placeholder="Product Unit" required>
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-lg-2 control-label">Product price</label>
            <div class="col-lg-6 input-group ">
                <input type="text" name="price" class="form-control" id="price" placeholder="Product price" required>
            </div>
        </div>
        <div class="form-group">
            <label for="expiry" class="col-lg-2 control-label">Product expiry</label>
            <div class='input-group col-lg-6 date' id='datetimepicker'>
                <input type='text' name="expiry" id="expiry" class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="inventory" class="col-lg-2 control-label">Product Inventory</label>
            <div class="col-lg-6 input-group ">
                <input type="text" name="inventory" class="form-control" id="inventory" placeholder="Product Inventory"
                    required>
            </div>
        </div>
        <div class="form-group">
            <label for="image" class="col-lg-2 control-label">Product Image</label>
            <div class="col-lg-6 input-group ">
                <input type="file" name="image" class="form-control" id="image" placeholder="Product image">
            </div>
        </div>


        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <a class="btn btn-default" href="/products">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </fieldset>
</form>