var checkeds = [];
init()

async function init() {
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
  renderChart(await getDataChart(checkeds));
}

function optionsToastR() {
  toastr.options = {
    "closeButton": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
  }
}

const changeChk = async (id) => {

  if ($(`#chkUnit${id}`).is(':checked')) {
    checkeds.push(id);
    renderChart(await getDataChart(checkeds));
  } else {
    checkeds.forEach(element => {
      if (element == id) {
        var index = checkeds.indexOf(element);
        checkeds.splice(index, 1);
      }
    });
    renderChart(await getDataChart(checkeds));
  }
}

async function getDataChart(checkeds) {  
  var liters = [];
  var km = [];
  var titles = [];
  const units = await getUnits();
  var dataS = [];
  var dataA = [];

  console.log(checkeds)
  checkeds.forEach(chk => {
    units.forEach(unit => {
      if (unit.id === chk) {
        liters.push(unit.combustible);
        km.push(unit.kilometraje)
        titles.push(unit.unidad);
      }
    });
  });
  console.log(liters);
  console.log(km);
  console.log(titles);

  for(i = 0; i < checkeds.length ; i++){
    dataA.push(parseInt(km[i]));
    dataS.push({
      label: titles[i],
      data: dataA,
      fill: false,
      backgroundColor: 'rgba(255, 99, 132, 12)',
    });
    console.log(dataS);
  }



  dataF = {
    labels: liters,
    datasets: dataS
  };


  // data = {
  //   labels: labels.datos,
  //   datasets: [{
  //     label: 'My First Dataset',
  //     data: [20, 28, 39, 41, 55, 65, 90],
  //     fill: false,
  //     backgroundColor: 'rgba(255, 99, 132, 12)',
  //     borderColor: 'rgb(255, 99, 132)',
  //     borderWidth: 1
  //   }, {
  //     label: 'My Second Dataset',
  //     data: [12, 21, 33, 47, 58, 63, 79],
  //     fill: false,
  //     backgroundColor: 'rgba(255, 205, 86, 12)',
  //     borderColor: 'rgba(255, 205, 86, 12)',
  //     borderWidth: 1
  //   }, {
  //     label: 'My Third Dataset',
  //     data: [28, 43, 56, 69, 74, 79, 82],
  //     fill: false,
  //     backgroundColor: 'rgba(75, 192, 192, 12)',
  //     borderColor: 'rgba(75, 192, 192, 12)',
  //     borderWidth: 1
  //   }
  //   ]
  // };
  return dataF;
}

async function getLabelsChart(checkeds) {
  console.log(checkeds);
  var liters = []; 
  
  const units = await getUnits();

  units.forEach(ele => {
    liters.push(ele.combustible);
  });
  console.log(liters);
  labels = {
    datos: liters,
    checkeds : checkeds
  };
  console.log(labels);
  //labels = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO"];
  return liters;
}

function getUnits(){
  return fetch("../controller/test.php")
  .then(res =>res.json())
  .then(data => data);
}


function renderChart(data) {
  if (checkeds.length > 0) {
    var canvas = document.getElementById('canvasChart');
    var linearChart = new Chart(canvas, {
      type: 'bar',
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
    var canvas = document.getElementById('canvasChart');
    var context = canvas.getContext('2d');
    context.clearRect(0, 0, canvas.width, canvas.height);
    toastr["info"]("Seleccione una o mas unidad para graficarlas", "Seleccione una unidad");
  }
}