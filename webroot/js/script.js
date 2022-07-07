const product_name = document.getElementById('name');
const product_unit = document.getElementById('unit');
const product_price = document.getElementById('price');
const product_date = document.getElementById('expiry');
const product_inventory = document.getElementById('inventory');




// $(document).on('submit', '#saveForm', function (e) {
//     e.preventDefault();
  
// });

$(function () {
$('#datetimepicker').datetimepicker();
});

$(document).ready( function () {
    $('#table_id').DataTable({
        'responsive': true,
        'processing': true,
        'serverSide': true,
        'serverMethod' : 'post',
        'ajax': {
            url: '/products/index',
           
            
        },
        'columns': [
            { data: 'name' },
            { data: 'unit' },
            { data: 'price' },
            { data: 'inventory' },
            { data: 'cost' },
            { data: 'expiry' },
        ],
    });
} );



// inmport CSV File

// $(document).on('submit', '#csv_import', function(e) {
//     e.preventDefault();
    
//     $.ajax({
//         url: '/products/csvimport',
//         method: 'POST',
//         data: new FormData($this),
//         dataType: 'json',
//         contentType: false,
//         cache: false,
//         proccessData: false,
//         success: function(jsonData){

//         }
//     });
// });