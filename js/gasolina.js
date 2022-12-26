var checkeds = [];
init()

function init() {
  optionsToastR();
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
      { data: 'seleccionar' }
    ]
  });
  renderChart(getDataChart(getLabelsChart()));
}

function optionsToastR() {
  toastr.options = {
    "closeButton": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
  }
}

const changeChk = (id) => {

  if ($(`#chkUnit${id}`).is(':checked')) {
    checkeds.push(id);
    renderChart(getDataChart(getLabelsChart(checkeds)));
  } else {
    checkeds.forEach(element => {
      if (element == id) {
        var index = checkeds.indexOf(element);
        checkeds.splice(index, 1);
      }
    });
    renderChart(getDataChart(getLabelsChart(checkeds)));
  }
}

function getDataChart(labels) {
  console.log("checkeds from getDataChart: " + labels.checkeds);
  data = {
    labels: labels.datos,
    datasets: [{
      label: 'My First Dataset',
      data: [20, 28, 39, 41, 55, 65, 90],
      fill: false,
      backgroundColor: 'rgba(255, 99, 132, 12)',
      borderColor: 'rgb(255, 99, 132)',
      borderWidth: 1
    }, {
      label: 'My Second Dataset',
      data: [12, 21, 33, 47, 58, 63, 79],
      fill: false,
      backgroundColor: 'rgba(255, 205, 86, 12)',
      borderColor: 'rgba(255, 205, 86, 12)',
      borderWidth: 1
    }, {
      label: 'My Third Dataset',
      data: [28, 43, 56, 69, 74, 79, 82],
      fill: false,
      backgroundColor: 'rgba(75, 192, 192, 12)',
      borderColor: 'rgba(75, 192, 192, 12)',
      borderWidth: 1
    }
    ]
  };
  return data;
}

function getLabelsChart(checkeds) {
  console.log(checkeds);
  labels = {
    datos: ["January", "Febrary", "March", "April", "May", "June", "July"],
    checkeds : checkeds
  };   
  //labels = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO"];
  return labels;
}


function renderChart(data) {
  if (checkeds.length > 0) {
    var canvas = document.getElementById('canvasChart');
    var linearChart = new Chart(canvas, {
      type: 'line',
      data: data,
      options: {
        indexAxis: 'y',
        scales: {
          x: {
            beginAtZero: true
          }
        },
        responsive: true,
        maintainAspectRatio: false
      }
    });
    linearChart.update();
  } else {    
    toastr["info"]("Seleccione una o mas unidad para graficarlas", "Seleccione una unidad");
  }
}