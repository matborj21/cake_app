<div class="content">
    <table class="table table-striped table-hover display " id="table_id">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Product unit</th>
                <th>Product price</th>
                <th>Product expiry</th>
                <th>Product inventory</th>
                <th>Product cost</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach($products as $product) : ?>

            <tr>
                <td><?= $this->Number->format($product->id) ?>
                </td>
                <td><?= h($product->name)?></td>
                <td><?= h($product->unit)?></td>
                <td><?= h($product->price)?></td>
                <td><?= h(date("Y-m-d", strtotime($product->expiry)))?></td>
                <td><?= h($product->inventory)?></td>
                <td><?= h($product->cost)?></td>
                <td>

                    <a class='btn btn-default btn-sm' href="/products/view/<?= $product->id?>">View</a>
                    <a class='btn btn-primary btn-sm' href="/products/edit/<?= $product->id?>">Edit</a>
                    <a class='btn btn-danger btn-sm' href="/products/delete/<?= $product->id?>">Delete</a>

                </td>
            </tr> <?php endforeach; ?>
        </tbody>
    </table>
</div>