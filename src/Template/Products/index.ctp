<div class="content">
    <table class="table table-striped table-hover display " id="table_id">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Product unit</th>
                <th>Product price</th>
                <th>Product inventory</th>
                <th>Product cost</th>
                <th>Product expiry</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>


        </tbody>
    </table>
</div>



<script>
$(document).on('click', '.deletebtn', function(e) {
    const id = $(this).attr('id');

    // const row_to_delete = $(this).parent().parent();
    if (confirm('are you sure you want to delete record?')) {
        $.ajax({
            type: "post",
            url: "<?= $this->Url->build(['action' => 'delete']) ?>",
            data: {
                id: id
            },
            // dataType: "html",                  
            success: function(data) {
                window.location.href = "<?php echo $this->Url->build(['action' => 'index']); ?>"
            }
        });

    }
    return false

});
</script>