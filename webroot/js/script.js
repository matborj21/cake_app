const product_name = document.getElementById('name');
const product_unit = document.getElementById('unit');
const product_price = document.getElementById('price');
const product_date = document.getElementById('expiry');
const product_inventory = document.getElementById('inventory');




// $(document).on('submit', '#saveForm', function (e) {
//     e.preventDefault();
  
// });

$(function () {
$('#datetimepicker').datetimepicker(
   {
     format : 'L'
   }
);
});
$(document).ready(function() {
    $('#table_id').DataTable({
        'responsive': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            url: '/products/viewDataTable',
        },
        'columns': [{
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'unit'
            },
            {
                data: 'price'
            },
            {
                data: 'inventory'
            },
            {
                data: 'cost'
            },
            {
                data: 'expiry'
            },
            {
                data: 'button'
            },
        ],
    });
});


