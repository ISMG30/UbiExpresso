init()

function init() {

  optionsToastR();
  $("#tableUnits").dataTable().fnDestroy();
  $('#statistics').hide();
  $('#canvasChart').hide();

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
      { data: 'seleccionar' },
      { data: 'descargar' }
    ]
  });

  renderChart();
}
function optionsToastR() {
    toastr.options = {
      "closeButton": true,
      "positionClass": "toast-top-center",
      "preventDuplicates": false,
    }
  }

  const graphUnit = async (id) => {
    var title;
    var parametros;
    var dates = [];
    if ($('#dateCheckInicio').val()  == '' && $('#dateCheckFin').val() == '') {
      toastr["warning"]("Elija una fecha o un rango de fechas", "No se ha seleccionado una fecha");
      //alert("Elija una fecha o un rango de fechas");
      $('#canvasChart').hide();
    } else {
  
      if ($('#dateCheckInicio').val() != '' && $('#dateCheckFin').val() == '') {
        const responseC1 = await getLitersOneDate(id, $('#dateCheckInicio').val());
        const responseK1 = await getKmOneDate(id, $('#dateCheckInicio').val());
        if (responseC1 === 'error' || responseK1 === "error") {
          toastr["error"]("No se ecnontraron registros en la fecha seleccionada ", "Sin datos para graficar");
          $('#statistics').hide();
          $('#canvasChart').hide();
        } else {
          title = "Consumo de combustible del " + parseDate($('#dateCheckInicio').val());
          console.log("Combustible:");
          console.log(responseC1);
          console.log("Km:");
          console.log(responseK1);
          dates.push($('#dateCheckInicio').val());
          renderChart(getDataChart(responseC1, responseK1), getOptionsChart(title));
          loadStatistics(id, responseC1, responseK1,dates);
          $('#statistics').show();
        }
  
        parametros = {
          "idUnit": id,
          "date": $('#dateCheckInicio').val(),
          "option": "one"
        };
  
        loadTableGasRefill(parametros);
      }
  
      if ($('#dateCheckFin').val() != '' && $('#dateCheckInicio').val() == '') {
        const responseC2 = await getLitersOneDate(id, $('#dateCheckFin').val());
        const responseK2 = await getKmOneDate(id, $('#dateCheckFin').val());
        if (responseC2 === 'error' && responseK2 === 'error') {
          toastr["error"]("No se ecnontraron registros en la fecha seleccionada ", "Sin datos para graficar");
          $('#statistics').hide();
          $('#canvasChart').hide();
        } else {
          title = "Consumo de combustible del " + parseDate($('#dateCheckFin').val());
          console.log("Combustible:");
          console.log(responseC2);
          console.log("Km:");
          console.log(responseK2);
          dates.push($('#dateCheckFin').val());
          renderChart(getDataChart(responseC2, responseK2), getOptionsChart(title));
          loadStatistics(id, responseC2, responseK2,dates);
          $('#statistics').show();
        }
  
        parametros = {
          "idUnit": id,
          "date": $('#dateCheckFin').val(),
          "option": "one"
        };
        loadTableGasRefill(parametros);
      }
  
      if ($('#dateCheckInicio').val() != '' && $('#dateCheckFin').val() != '') {
        const responseC3 = await getLitersDatesBetween(id, $('#dateCheckInicio').val(), $('#dateCheckFin').val());
        const responseK3 = await getKmDatesBetween(id, $('#dateCheckInicio').val(), $('#dateCheckFin').val());
        if (responseC3 === 'error' && responseK3 === 'error') {
          toastr["error"]("No se ecnontraron registros en este rangpo de fecha ", "Sin datos para graficar");
          $('#statistics').hide();
          $('#canvasChart').hide();
        } else {
          title = "Consumo de combustible en el periodo del " + parseDate($('#dateCheckInicio').val()) +
            " al " + parseDate($('#dateCheckFin').val());
          console.log("Combustible:");
          console.log(responseC3);
          console.log("Km:");
          console.log(responseK3);
          dates.push($('#dateCheckInicio').val());
          dates.push($('#dateCheckFin').val());
          renderChart(getDataChart(responseC3, responseK3), getOptionsChart(title));
          loadStatistics(id, responseC3, responseK3,dates);
          $('#statistics').show();
        }
  
        parametros = {
          "idUnit": id,
          "dateStart": $('#dateCheckInicio').val(),
          "dateEnd": $('#dateCheckFin').val(),
          "option": "two"
        };
        loadTableGasRefill(parametros);
      }
  
    }
  }
  
  const loadTableGasRefill = (parametros) => {

    $("#table_gas_refill").dataTable().fnDestroy();
    tableGasRefill = $('#table_gas_refill').DataTable({
  
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
        url: '../controller/controllerGasolina.php?opcion=gasFillList',
        data: parametros,
        type: 'post'
      },
      columns: [
        { data: 'no' },
        { data: 'fecha' },
        { data: 'combustible'},
        { data: 'litros' },
        { data: 'costo' },
        { data: 'clitros' }
      ]
    });
  }

  const loadStatistics = async(id,liters,km,dates) => {
    var refills;
    var km_traveled;
    var liters_consumed = 0;
    var f = liters[0].litros;
    // var dateDay;
    //var con = await getGasCostDay(id, date)
    var div_txt_km_traveled = $('#txt_km_traveled').empty();
    var div_txt_liters_consumed =$('#txt_liters_consumed').empty();
    var dateDay;
    var date; 
    if(dates.length == 1){
        refills = await getGasRefillDate(id,dates[0]);
      }else{
        refills = await getGasRefillRange(id,dates[0],dates[1]);
      }
    //kilometraje 
    km_traveled = parseInt(km[km.length-1].km) - parseInt(km[0].km);

    var con = await gasCostDay(id,dateDay);

    var f = liters[0].fecha_combustible;
    var i = 0;
     
    for(i=0; i<liters.length; i++)
    {
      if(liters[i].check_combustible === 'inicio')
      {
        if(liters[i].fecha_combustible===con[i].fecha)
        {
           inicio = parseFloat(liters[i].litros)+ parseFloat(con[i].litros);
        }else{
          inicio =parseFloat(liters[i].litros);
        }
      }else{
         if(liters[i].check_combustible === 'fin')
         {
           fin = parseFloat(liters[i].litros);
         }
      }
      liters_consumed = (inicio- fin)
    }

    div_txt_km_traveled.append(`<label class="form-label text-uppercase fw-nomal fs-2">${km_traveled} km</label>`);
    div_txt_liters_consumed.append(`<label class="form-label text-uppercase fw-nomal fs-2">${liters_consumed} L</label>`)

  }
  const gasCostDay = async (id, dateDay) => {
    var dateDaysBeofre = getDaysSum(dateDay,-7);
    var dateDaysAfter = getDaysSum(dateDay,7);
    console.log('fecha anterior: ' + dateDaysBeofre);
    var before,after = "";
    var mDate;
    const range = await getRangeDates(id,dateDaysBeofre,dateDaysAfter);
    console.log(range);
    
   let i = 0;
    while(after === ""){
      if(parseMiliDate(range[i].fecha) <= parseMiliDate(dateDay)){
        before = range[i].fecha;
      }
      if(parseMiliDate(range[i].fecha) >= parseMiliDate(dateDay)){
        after = range[i].fecha;
      }
      i++;
    }
    const getDaysSum = (date, days) => {
        var dateP = new Date(`${date}T23:00:00-0600`);
        const options = {
          year: 'numeric',
          month: 'numeric',
          day: 'numeric'
        };
        dateP.setDate(dateP.getDate() + days);
        return formatDate(dateP.toLocaleString('es-mx',options));
      }
      
      const formatDate = (date) => {
        var dateN = date.split('/');
        return `${dateN[2]}-${dateN[1]}-${dateN[0]}`
      }
      
      const parseMiliDate = (date) => {
        const dateR = new Date(`${date}T23:00:00-0600`);
        return dateR.getTime();
      }
  
    if(after === before){
      mDate = after
    }else{
      mDate = before;
    }
  
    console.log(mDate);
    const cost = await getGasCostDay(id,mDate);    
    return cost;
  }

  const monedaMX = (importe) => {
    return new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(importe);
  }
  const parseDate = (fecha) => {
    var strDate = fecha.split('-');
    return strDate[2] + "-" + strDate[1] + "-" + strDate[0];
  }
  
  function getDataChart(liters, km) {
    var arrayLiters = [];
    var arrayKm = []
    var data;
    var COLORS_RGB = [
      'rgba(255, 99, 132, 0.9)',
      'rgba(36, 132, 234, 0.6)',
      'rgba(255, 205, 86, 0.9)'
    ];
    liters.forEach(element => {
      arrayLiters.push(element.litros);
    });
  
    km.forEach(element => {
      arrayKm.push(element.km);
    });
  
    console.log("Gas:" + arrayLiters);
    console.log("KM:" + arrayKm);
    color = COLORS_RGB[Math.floor(Math.random() * COLORS_RGB.length)];
    console.log(color);
    data = {
      labels: arrayLiters,
      datasets: [{
        data: arrayKm,
        label: liters[0].unidad,
        borderColor: color,
        fill: true,
        borderWidth: 3
      }]
    };
  
    return data;
  }
  
  function getOptionsChart(title) {
    const options = {
      indexAxis: 'x',
      scales: {
        x: {
          beginAtZero: true
        }
      },
      title: {
        display: true,
        text: title
      },
      responsive: true,
      maintainAspectRatio: false
    };
    return options;
  }
  


//Consultas a la base de datos
  const Prueba = async (id) =>{
    $('#dateCheckFin').val(); 
    var id= id;
    var inicioDate = $('#dateCheckInicio').val();
    var finDate= $('#dateCheckFin').val();
    var costo = $('#txt_travel_cost').val();
    if (inicioDate == '' && finDate == '') {
      toastr["warning"]("Elija una fecha o un rango de fechas", "No se ha seleccionado una fecha");
    }else{
      window.location.href=  "../views/dompdf.php?id="+id+"&startDate="+inicioDate+"&endDate="+finDate+"&costo="+costo;

    }
}

function getLitersDatesBetween(id, startDate, endDate) {
  const data = new URLSearchParams(`id=${id}&startDate=${startDate}&endDate=${endDate}`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('../controller/controllerGasolina.php?opcion=getLitersDatesBetween', options)
    .then(res => res.json())
    .then(data => data);
}

function getLitersOneDate(id, date) {
  const data = new URLSearchParams(`id=${id}&date=${date}`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('../controller/controllerGasolina.php?opcion=getLitersOneDate', options)
    .then(res => res.json())
    .then(data => data);
}

function getKmDatesBetween(id, startDate, endDate) {
  const data = new URLSearchParams(`id=${id}&startDate=${startDate}&endDate=${endDate}`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('../controller/controllerGasolina.php?opcion=getKmDatesBetween', options)
    .then(res => res.json())
    .then(data => data);
}

function getKmOneDate(id, date) {
  const data = new URLSearchParams(`id=${id}&date=${date}`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('../controller/controllerGasolina.php?opcion=getKmOneDate', options)
    .then(res => res.json())
    .then(data => data);
}

function getGasRefillDate(id,date){
  const data = new URLSearchParams(`idUnit=${id}&date=${date}&option=one`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('../controller/controllerGasolina.php?opcion=gasFillList', options)
    .then(res => res.json())
    .then(data => data);
}

function getGasRefillRange(id,dateStart,dateEnd){
  const data = new URLSearchParams(`idUnit=${id}&dateStart=${dateStart}&dateEnd=${dateEnd}&option=two`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('../controller/controllerGasolina.php?opcion=gasFillList', options)
    .then(res => res.json())
    .then(data => data);
}

function getRangeDates(id, dateStart, dateEnd){
  const data = new URLSearchParams(`idUnit=${id}&dateStart=${dateStart}&dateEnd=${dateEnd}`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('../controller/controllerGasolina.php?opcion=getRangeDates', options)
  .then(res => res.json())
  .then(data => data);
}

function getGasCostDay(id, date){
  const data = new URLSearchParams(`idUnit=${id}&date=${date}`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('../controller/controllerGasolina.php?opcion=getGasCostDay', options)
  .then(res => res.json())
  .then(data => data);
}

//Graficar
function renderChart(data, options) {
    $('#canvasChart').show();
    var ctx = document.getElementById('canvasChart').getContext('2d');
    if (window.chart) {
      window.chart.clear();
      window.chart.destroy();
    }
    window.chart = new Chart(document.getElementById("canvasChart"), {
      type: 'line',
      data: data,
      options: options
    });
  }