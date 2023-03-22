//var checkeds = [];
//var typeChart;
init()

function init() {

  optionsToastR();
  $("#tableUnits2").dataTable().fnDestroy();
  $('#statistics').hide();
  $('#canvasChart').hide();

  parametros = {
    "param1": "param1"
  }

  tableUnits = $('#tableUnits2').DataTable({

    "searching": false,
    "pageLength": 10,
    "responsive": true,
    "processing": false,
    "info": false,
    "lengthChange": false,
    "paging": false,

    "columnDefs": [
      { "className": "dt-center", "targets": "_all" }
    ],

    ajax: {
      url: '../controller/controllerGasolina.php?opcion=unitList',
      data: parametros,
      type: 'post'
    },
    columns: [
      { data: 'id' },
      { data: 'unidad' },
      // { data: 'seleccionar'}
    ]
  });

  renderChart();

}

