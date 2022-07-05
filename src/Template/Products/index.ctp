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
                    <?php echo $this->Html->link('View', ['action' => 'view', $product->id], ['class' => 'btn btn-default']) ?>
                    <a class="btn btn-primary editBtn" id=<?= $product->id ?>>Edit</a>
                    <a class="btn btn-danger delete" id=<?= $product->id ?>>Delete</a>
                </td>
            </tr> <?php endforeach; ?>
        </tbody>
    </table>
</div>