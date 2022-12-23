init()

function init() {
    $("#tableUnits").dataTable().fnDestroy();

    parametros = {
        "param1": "param1"
    }

    tableUnits = $('#tableUnits').DataTable({
        
        "searching": false,
        "pageLength": 10,
        "responsive": true,
        "processing": false,
        "info": false,
        "lengthChange": false,
        "paging": false,

        "columnDefs": [
            {"className": "dt-center", "targets": "_all"}
        ],

        ajax: {
            url: '../controller/controllerGasolina.php?opcion=unitList',
            data: parametros,
            type: 'post'
        },
        columns: [
            { data: 'id' },
            { data: 'unidad'},
            { data: 'seleccionar'}
        ]
    });

    renderChart();    
}

const changeChk = (id) =>{

    if($(`#chkUnit${id}`).is(':checked')){
        alert("Se chekeo: " + id);
    }else{
        alert("Se deschekeo: " + id);
    }    
}

function renderChart() {

    
const labels = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO"];
const data = {
  labels: labels,
  datasets: [{
    axis: 'x',
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    fill: false,
    backgroundColor: [
      'rgba(255, 99, 132, 12)',
      'rgba(255, 159, 64, 12)',
      'rgba(255, 205, 86, 12)',
      'rgba(75, 192, 192, 12)',
      'rgba(54, 162, 235, 122)',
      'rgba(153, 102, 255, 12)',
      'rgba(201, 203, 207, 12)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};
    
    var canvas = document.getElementById('canvasChart');
    new Chart(canvas, {
        type: 'line',
        data: data,
        options: {
            indexAxis: 'y',
            scales: {
              x: {
                beginAtZero: true
              }
            }
        }
      });
}