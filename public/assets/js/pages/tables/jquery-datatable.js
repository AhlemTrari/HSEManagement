$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        exportOptions: {
            columns: [1,2]
         },
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    });
});