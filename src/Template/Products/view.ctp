<div class="panel panel-success">
    <div class="panel-heading">
        <?= h($product->name) ?>
    </div>
    <div class="panel-body">
        <div class="media">
            <div class="media-left col-lg-6 ">

                <img class="media-object" src="/img/default.png" alt="default image no image uploaded">

            </div>
            <div class="media-body">
                <h4 class="media-heading">Media heading</h4>
                <table class="vertical-table">
                    <tr>
                        <th scope="row"><?= __('Name') ?></th>
                        <td><?= h($product->name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Unit') ?></th>
                        <td><?= h($product->unit) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Image') ?></th>
                        <td><?= h($product->image) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($product->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Price') ?></th>
                        <td><?= $this->Number->format($product->price) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Inventory') ?></th>
                        <td><?= $this->Number->format($product->inventory) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Cost') ?></th>
                        <td><?= $this->Number->format($product->cost) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Expiry') ?></th>
                        <td><?= h($product->expiry) ?></td>
                    </tr>
                </table>

            </div>
        </div>

    </div>
    <div class="panel-footer">
        <a class="btn btn-default btn-xs" href="/products">Back</a>
        <a class="btn btn-primary  btn-xs" id=<?= $product->id ?>>Edit</a>
        <a class="btn btn-danger  btn-xs" id=<?= $product->id ?>>Delete</a>
    </div>
</div>