<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $product->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
    </ul>
</nav> -->
<div class="products form large-9 medium-8 columns content">
    <!-- <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Edit Product') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('unit');
            echo $this->Form->control('price');
            echo $this->Form->control('expiry', ['empty' => true]);
            echo $this->Form->control('inventory');
            echo $this->Form->control('cost');
            echo $this->Form->control('image');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?> -->

    <form class="form-horizontal" method="post" action="/products/edit/<?= $product->id ?>"
        enctype="multipart/form-data">
        <fieldset>
            <input type="hidden" name="_method" value="PUT" />
            <legend>Edit Product</legend>
            <div class=" form-group">
                <label for="name" class="col-lg-2 control-label">Product Name</label>
                <div class="col-lg-6 input-group ">
                    <input type="text" name="name" class=" form-control" id="name" placeholder="Product name"
                        value="<?= $product->name?>">
                </div>
            </div>
            <div class="form-group">
                <label for="unit" class="col-lg-2 control-label">Product Unit</label>
                <div class="col-lg-6 input-group ">
                    <input type="text" name="unit" class="form-control" id="unit" placeholder="Product Unit"
                        value="<?= $product->unit?>">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-lg-2 control-label">Product price</label>
                <div class="col-lg-6 input-group ">
                    <input type="text" name="price" class="form-control" id="price" placeholder="Product price"
                        value="<?= $product->price?>">
                </div>
            </div>
            <div class="form-group">
                <label for="expiry" class="col-lg-2 control-label">Product expiry</label>
                <div class='input-group col-lg-6 date' id='datetimepicker'>
                    <input type='text' name="expiry" class="form-control" value="<?= $product->expiry ?>" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inventory" class="col-lg-2 control-label">Product Inventory</label>
                <div class="col-lg-6 input-group ">
                    <input type="text" name="inventory" class="form-control" id="inventory"
                        placeholder="Product inventory" value="<?= $product->inventory?>">
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-lg-2 control-label">Product Image</label>
                <div class="col-lg-6 input-group ">
                    <span class="input-group-addon">
                        <span id="oldimage" value="<?= $product->image?>"><?= $product->image ?></span>
                    </span>
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
</div>