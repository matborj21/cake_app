<div class="panel panel-success">
    <div class="panel-heading">
        <h5> Produc information</h5>
    </div>
    <div class="panel-body">

        <div class="col-lg-6 ">

            <img class="media-object"
                src="/img/uploads/<?= ($product->image == null) ? "default.png" : $product->image ?>"
                alt="default image no image uploaded">

        </div>

        <h3 class="product-title"><?= h($product->name) ?></h3>

        <ul class="nav nav-product">
            <li><strong>Unit : </strong><?= h($product->unit) ?></li>
            <li><strong>Price : </strong> <?= $this->Number->precision($product->price, 2) ?></li>
            <li><strong>Inventory : </strong> <?= $this->Number->format($product->inventory) ?></li>
            <li><strong>Product Cost : </strong> <?= $this->Number->precision($product->cost, 2) ?></li>
            <li><strong>Expiry date : </strong> <?= h(date('Y-m-d', strtotime($product->expiry))) ?></li>
        </ul>


    </div>

</div>
<div class="panel-footer">
    <a class="btn btn-default btn-xs" href="/products">Back</a>
    <a class="btn btn-primary  btn-xs" href="/products/edit/<?= $product->id ?>">Edit</a>
    <a class="btn btn-danger  btn-xs" href="/products/delete/<?= $product->id ?>">Delete</a>
</div>
</div>