// var checkeds = [];
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

// async function init() {
//   typeChart = 'Gasolina';
//   optionsToastR();
//   $("#tableUnits").dataTable().fnDestroy();

//   parametros = {
//     "param1": "param1"
//   }

//   tableUnits = $('#tableUnits').DataTable({

//     "searching": false,
//     "pageLength": 10,
//     "responsive": true,
//     "processing": false,
//     "info": false,
//     "lengthChange": false,
//     "paging": false,

//     "columnDefs": [
//       { "className": "dt-center", "targets": "_all" }
//     ],

//     ajax: {
//       url: '../controller/controllerGasolina.php?opcion=unitList',
//       data: parametros,
//       type: 'post'
//     },
//     columns: [
//       { data: 'id' },
//       { data: 'unidad' },
//       { data: 'seleccionar' }
//     ]
//   });
//   renderChart(await getDataChart(checkeds, typeChart));
// }

function optionsToastR() {
  toastr.options = {
    "closeButton": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
  }
}

// const changeChk = async (id) => {

//   if ($(`#chkUnit${id}`).is(':checked')) {
//     checkeds.push(id);
//     renderChart(await getDataChart(checkeds, typeChart));
//   } else {
//     checkeds.forEach(element => {
//       if (element == id) {
//         var index = checkeds.indexOf(element);
//         checkeds.splice(index, 1);
//       }
//     });
//     renderChart(await getDataChart(checkeds, typeChart));
//   }
// }
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
      const responseCR2 = await getRangeDates(id, $('#dateCheckInicio').val(), $('#dateCheckFin').val());
      const responseK1 = await getKmOneDate(id, $('#dateCheckInicio').val());
      if (responseC1 === 'error' || responseK1 === "error") {
        toastr["error"]("No se encontraron registros en la fecha seleccionada ", "Sin datos para graficar");
        $('#statistics').hide();
        $('#canvasChart').hide();
      } else {
        title = "Consumo de combustible del " + parseDate($('#dateCheckInicio').val());
        console.log("Combustible:");
        console.log(responseC1);
        console.log("Km:");
        console.log(responseK1);
        dates.push($('#dateCheckInicio').val());
        renderChart(getDataChart(responseC1, responseK1, responseCR2), getOptionsChart(title));
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
      const responseCR2 = await getRangeDates(id, $('#dateCheckInicio').val(), $('#dateCheckFin').val());
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
        renderChart(getDataChart(responseC2, responseK2, responseCR2), getOptionsChart(title));
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
      const responseCR2 = await getRangeDates(id, $('#dateCheckInicio').val(), $('#dateCheckFin').val());
      const responseK3 = await getKmDatesBetween(id, $('#dateCheckInicio').val(), $('#dateCheckFin').val());
      if (responseC3 === 'error' && responseK3 === 'error') {
        toastr["error"]("No se ecnontraron registros en este rango de fecha ", "Sin datos para graficar");
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
        renderChart(getDataChart(responseC3, responseK3, responseCR2), getOptionsChart(title));
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


const   loadStatistics = async (id,liters,km,dates) => {
  var refills;
  var km_traveled;
  var total_constt = 0;
  var liters_consumed =0;
  var div_txt_km_traveled = $('#txt_km_traveled').empty();
  var div_txt_liters_consumed = $('#txt_liters_consumed').empty();
  var div_txt_liters_consumedf = $('#txt_liters_consumedf').empty();
  if(dates.length == 1){
    refills = await getGasRefillDate(id,dates[0]);
  }else{
    refills = await getGasRefillRange(id,dates[0],dates[1]);
  }
  var inicioDate = $('#dateCheckInicio').val();
  var finDate = $('#dateCheckFin').val();
  var recargac = await getRangeDates(id,inicioDate,finDate);
 var   rec = await getRecargaComb1(id, inicioDate );
 var   rec = await getRecargaComb1(id, finDate );

   
  console.log(refills.aaData);

  km_traveled = parseInt(km[km.length-1].km) - parseInt(km[0].km);
  
  var fechac
  var oresta=0;
  var inicio;
  var fin;
  var litros_total=0;
  let arrayrecar = [];
  var arrayi =[];
  var arraycom = [];
  
  fechac=liters[0].fecha_combustible;
  //fechar = recargac[l].fecha; 
  for(var i= 0; i<liters.length; i++){
    fechac=liters[i].fecha_combustible;
    if(fechac === fechac){
    if(liters[i].check_combustible=== 'inicio'){
      inicio= parseFloat(liters[i].litros);
      i++;
    }
    if(liters[i].check_combustible === 'fin'){

      fin = parseFloat(liters[i].litros);
      i++;
    }
  }
  oresta = inicio - fin
  
  }

  for(var u=0; u<recargac.length; u++ )
  { 
    let recarg  = recargac[u].litros;
     arrayrecar.push(recarg);
  }
  let total=0;
  for(var  j = 0; j < arrayrecar.length; j++) {
    total += parseFloat(arrayrecar[j]);
    console.log(total);
  }

  litros_total =  (oresta + total); //Litros de combustible 
  
  
  var litrosrc
  var arraylitros = [];

  for(var j=0; j<recargac.length; j++)
  {
     litrosrc = recargac[j].costol;
     arraylitros.push (litrosrc);
  }
   var costore;
  for(let i = 0; i < arraylitros.length; i++) 
  {costore=arraylitros[i];
  console.log(costore);
 }

  var costol ;
 

 for(var u=0; u<liters.length; u++)
 {
    for(var l=0; l<recargac.length; l++)
    {
      if(liters[u].fecha_combustible === recargac[l].fecha )
    {
       costol= costore * litros_total 
    }
  }
 }

 let arraycostol = [];
 var litrot
 let arrayli = [];
 for(var o=0; o<recargac.length; o++)
  {
     for(var p=0 ; p<liters.length; p++)
     {
        if(liters[p].fecha_combustible === recargac[o].fecha)
        {
          var litro;
          litro = recargac[o].costol;
          litrot = recargac[o].litros;
        }
     }
     arraycostol.push(litro);
     arrayli.push(litrot);
  }
  for(var i =0; i<arraycostol.length; i++)
  {
      var t = arraycostol[i];
  }
  
  /*let fecha = "";
  let fechapivote = "";
  let recarga = 0;
  let cantidadInicial = 0;
  let cantidadFinal = 0;
  let arrayTotales = [];
  
  for (var i = 0; i < varr.length; i++) {
    fecha = '2023-01-01';
    //si la fecha son iguales se suma la recarga
    if (fecha == varr[i].fecha) {
      if (i == 0) {
        cantidadInicial = varr[i].RecargaInicial + recarga;
        cantidadFinal = varr[i].RecargaFinal;
        //operacion 
        let litros = cantidadInicial - cantidadFinal;
        //se guarda el resultado en el array
        arrayTotales.push(litros);
      }else{
        cantidadInicial = varr[i-1].RecargaFinal;
        cantidadFinal = varr[i].RecargaFinal;
        let litros = cantidadInicial -cantidadFinal;
        arrayTotales.push(litros);
      }
    } else {
      //se reinicia la fecha y la recarga
      fecha = varr[i].fecha;
      recarga = varr[i].recarga;
      if (i == 0) {
        cantidadInicial = varr[i].RecargaInicial + recarga;
        cantidadFinal = varr[i].RecargaFinal;
        //operacion 
        let litros = cantidadInicial -cantidadFinal;
        //se guarda el resultado en el array
        arrayTotales.push(litros);
      }else{
        cantidadInicial = varr[i-1].RecargaFinal;
        cantidadFinal = varr[i].RecargaFinal;
        let litros = cantidadInicial - cantidadFinal;
        arrayTotales.push(litros);
      }
    }
  }*/
      
     /*let fechas = liters[0].fecha_combustible;
     let fechapivote = "";
     let recarga = 0;
     let cantidadInicial = 0;
     let cantidadFinal = 0;
     let arrayTotales = [];
   
     /*for(var q= 0; q<liters.length; q++)
     {
        if(fechas === liters[q].fecha_combustible)
        {
          if(q == 0)
          {
             if(liters[q].check_combustible == 'inicio')
             {
               cantidadInicial = parseFloat(liters[q].litros) + parseFloat(recargac[0].litros) ;
             }else{
               cantidadFinal = parseFloat(liters[q].litros);
             }
             let litross = cantidadInicial - cantidadFinal;
             arrayTotales.push(litross);
          }else{
            if(liters[q].check_combustible == 'inicio')
            {
              cantidadInicial = parseFloat(liters[q - 1].litros);
            }else{
              cantidadFinal = parseFloat(liters[q].litros);
            }
           
            let litross = cantidadInicial - cantidadFinal ;
             arrayTotales.push(litross);
          }
        }else{
          fechas  = liters[q].fecha_combustible;
          for(var f=0; f<recargac.length; f++){

             recarga = recargac[f].litros;
          }
        if(q ==  0)
        {
           if(liters[q].check_combustible == 'inicio')
             {
               cantidadInicial = parseFloat(liters[q].litros) + parseFloat(recarga) ; 
             }else{
               cantidadFinal = parseFloat(liters[q].litros);
             }
             let   litross = cantidadInicial - cantidadFinal;
             arrayTotales.push(litross);

        }else{
          if(liters[q].check_combustible == 'inicio')
          {
            cantidadInicial = parseFloat(liters[q - 1].litros);
          }else{
            cantidadFinal = parseFloat(liters[q].litros);
          }
          
          let litross = cantidadInicial - cantidadFinal;
           arrayTotales.push(litross);
        }
      }
     }
     var sum =0;
     for(var f=0; f<arrayTotales.length; f++)
     {
        sum =  arrayTotales[f] * recargac[0].costol;
     }*/
     
    /* for(var q=0; q<liters.length-1; q++)
     {
       if(fechas === liters[q].fecha_combustible)
        {
          //cantidadInicial = parseFloat(liters[q].litros) + parseFloat(recargac[0].litros);
          if(liters[q].fecha_combustible === recargac[0].fecha)
          {
            cantidadInicial = parseFloat(liters[q].litros) + parseFloat(recargac[0].litros);
            cantidadFinal =  parseFloat(liters[q + 1 ].litros);
            let   litross = cantidadInicial - cantidadFinal;
            arrayTotales.push(litross);
          }else{
            cantidadInicial = parseFloat(liters[q].litros);
            cantidadFinal =  parseFloat(liters[q + 1 ].litros);
            let   litross = cantidadInicial - cantidadFinal;
            arrayTotales.push(litross);
          }
        }
     }*/
     /*var fecha, fechass
     
      for(var p=0; p<liters.length-1; p++)
      {
        if(fechas === liters[p].fecha_combustible)
        { 
          if(p == 0)
           {  
              cantidadInicial = parseFloat(liters[p].litros) + parseFloat(arrayli[0]) ;
              cantidadFinal = parseFloat(liters[p+1].litros);
              let litross = cantidadInicial - cantidadFinal * parseFloat(recargac[0].costol);
              arrayTotales.push(litross);
              
           }else{
              cantidadInicial = parseFloat(liters[p].litros);
              cantidadFinal = parseFloat(liters[p+1].litros);
              let litross = cantidadInicial - cantidadFinal* parseFloat(recargac[0].costol);
              arrayTotales.push(litross);
           } 
        } else{
          fechas = liters[p].fecha_combustible
          recarga = arrayli[0];
          if(p == 0)
            {
              cantidadInicial = parseFloat(liters[p].litros) + parseFloat(arrayli[0]);
              cantidadFinal = parseFloat(liters[p+1].litros);
              let litross = cantidadInicial - cantidadFinal * parseFloat(recargac[0].costol);
              arrayTotales.push(litross);
            }else{
                cantidadInicial = parseFloat(liters[p].litros);
                cantidadFinal = parseFloat(liters[p+1].litros);
                let litross = cantidadInicial - cantidadFinal * parseFloat(recargac[0].costol)  ;
                arrayTotales.push(litross);
            }
       }
      }
*/
  div_txt_km_traveled.append(`<label class="form-label text-uppercase fw-nomal fs-2">${km_traveled} km</label>`);
  div_txt_liters_consumed.append(`<label class="form-label text-uppercase fw-nomal fs-2">${litros_total.toFixed(2)} L</label>`);  
  div_txt_liters_consumedf.append(`<label class="form-label text-uppercase fw-nomal fs-2">${monedaMX(costol)} </label>`);  
      console.log(litros_total);
}


const gasCostDay = async (id, dateDay) => {
  var dateDaysBeofre = getDaysSum(dateDay,-7);
  var dateDaysAfter = getDaysSum(dateDay,7);
  console.log('fecha anterior: ' + dateDaysBeofre);
  var before,after = "";
  var mDate;
  const range = await getRangeDates(id,dateDaysBeofre,dateDaysAfter);
  console.log(range);
  
  // for(let i = 0; i < range.length; i++){
  //   if(parseMiliDate(dateDay) <= parseMiliDate(range[i].fecha)){
  //     before = range[i].fecha;
  //   }
  // }
  // console.log(before);
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

  if(after === before){
    mDate = after
  }else{
    mDate = before;
  }

  console.log(mDate);
  const cost = await getGasCostDay(id,mDate);    
  return cost;
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

const monedaMX = (importe) => {
  return new Intl.NumberFormat('es-MX', {
      style: 'currency',
      currency: 'MXN',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
  }).format(importe);
}

/*const loadTableGasRefill = (parametros) => {

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
}*/

const parseDate = (fecha) => {
  var strDate = fecha.split('-');
  return strDate[2] + "-" + strDate[1] + "-" + strDate[0];
}

function getDataChart(liters, km, Rliters) {
  var arrayLiters = [];
  var arrayKm = []
  var data;
  var COLORS_RGB = [
    'rgba(255, 99, 132, 0.9)',
    'rgba(36, 132, 234, 0.6)',
    'rgba(255, 205, 86, 0.9)'
  ];
  var inicio =0;
  var fin;
  var fe = liters[0].fecha_combustible;
  var ferecarg;
  var recarg;
  var fechas;

  km.forEach(element => {
    arrayKm.push(element.km); 
  });
 
  //for(var j=0; j<Rliters.length-1; j++){
    // ferecarg = Rliters[0].fecha;
     //recarg = Rliters[0].litros;
   /* for(var i= 0; i<liters.length; i++){
      fechac=liters[i].fecha_combustible;
      if(fechac === fechac)
      { 
        if(liters[i].check_combustible === 'inicio')
        {
          if(fechac === Rliters[0].fecha)
          {
            inicio= (parseFloat(liters[i].litros) + parseFloat( Rliters[0].litros));
            i++;
          }else
          {
            inicio= (parseFloat(liters[i].litros));
            i++
          }
        }
      }
    if(liters[i].check_combustible === 'inicio'){
  
      inicio = parseFloat(liters[i].litros);
      i++;
    }else{
      fin = parseFloat(liters[i].litros);
    }
    //arrayLiters.push(inicio, fin);
  }*/

  for (var i =0; i<liters.length; i++)
  {
     fechas = liters[i].fecha_combustible
     if(fechas === liters[i].fecha_combustible)
     {
        if(liters[i].check_combustible === 'inicio')
        {
          inicio = (parseFloat(liters[i].litros));
          i++;
        }else{
          fin = (parseFloat(liters[i].litros));
          i++;
        }
        arrayLiters.push(inicio, fin)
     }
     
  }

  
//}
    
        
  console.log("KM:" + arrayKm);
  console.log("Gas:" + arrayLiters);
 
  color = COLORS_RGB[Math.floor(Math.random() * COLORS_RGB.length)];
  console.log(color);
  data = {
    labels: arrayKm,
    datasets: [{
      data: arrayLiters,
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

// async function getDataChart(checkeds, type) {
//   var COLORS_RGBA = [
//     'rgba(255, 99, 132, 0.6)',
//     'rgba(36, 132, 234, 0.6)',
//     'rgba(255, 205, 86, 0.6)',
//     'rgba(75, 192, 192, 0.6)',
//     'rgba(54, 162, 235, 0.6)',
//     'rgba(153, 102, 255, 0.6)',
//     'rgba(201, 203, 207, 0.6)'
//   ];

//   var BORDER_COLOR_RGBA = [
//     'rgb(255, 99, 132)',
//     'rgb(36, 132, 234)',
//     'rgb(255, 205, 86)',
//     'rgb(75, 192, 192)',
//     'rgb(54, 162, 235)',
//     'rgb(153, 102, 255)',
//     'rgb(201, 203, 207)'
//   ]

//   var COLORS_RGB = [
//     'rgb(240, 8, 8)',
//     'rgb(226, 204, 14)',
//     'rgb(14, 168, 226)',
//     'rgb(43, 205, 24)',
//     'rgb(134, 24, 205),',
//     'rgb(7, 18, 244)',
//     'rgb(232, 115, 18)',
//     'rgb(107, 40, 10)',
//     'rgb(0,0,0)'
//   ]
//   var liters = [];
//   var km = [];
//   var titles = [];
//   const units = await getUnits();
//   console.log(units);
//   var dataS = [];
//   var dataF = [];
//   var dataA = [];
//   var colors = [];
//   var borders = [];


//   console.log(checkeds)
//   checkeds.forEach(chk => {
//     units.forEach(unit => {
//       if (unit.id === chk) {
//         liters.push(parseInt(unit.combustible));
//         km.push(parseInt(unit.kilometraje))
//         titles.push(unit.unidad);
//       }
//     });
//   });
//   console.log(liters);
//   console.log(km);
//   console.log(titles);

//   for (i = 0; i < checkeds.length; i++) {
//     colors.push(COLORS_RGBA[i]);
//   }

//   for (k = 0; k < checkeds.length; k++) {
//     borders.push(BORDER_COLOR_RGBA[k]);
//   }


//   // for(i = 0; i < checkeds.length ; i++){
//   //   dataA.push({
//   //     x: parseInt(liters[i]),
//   //     y: parseInt(km[i]),
//   //     r: 15
//   //   });
//   //   dataS.push({
//   //     label: titles[i],
//   //     data: dataA,
//   //   });
//   //   console.log(dataS);
//   // }

//   switch (type) {
//     case 'Gasolina':

//       dataS.push({
//         label: 'Litros de gasolina por unidad',
//         data: liters,
//         backgroundColor: colors,
//         borderColor: borders,
//         borderWidth: 1
//       });
//       break;

//     case 'Km':
//       dataS.push({
//         label: 'Kilometraje por unidad',
//         data: km,
//         backgroundColor: colors,
//         borderColor: borders,
//         borderWidth: 1
//       });
//       break;
//     default:
//       break;
//   }

//   dataF = {
//     labels: titles,
//     datasets: dataS
//   };

//   console.log("DataF:");
//   console.log(dataF);


//   // data = {
//   //   labels: labels.datos,
//   //   datasets: [{
//   //     label: 'My First Dataset',
//   //     data: [20, 28, 39, 41, 55, 65, 90],
//   //     fill: false,
//   //     backgroundColor: 'rgba(255, 99, 132, 12)',
//   //     borderColor: 'rgb(255, 99, 132)',
//   //     borderWidth: 1
//   //   }, {
//   //     label: 'My Second Dataset',
//   //     data: [12, 21, 33, 47, 58, 63, 79],
//   //     fill: false,
//   //     backgroundColor: 'rgba(255, 205, 86, 12)',
//   //     borderColor: 'rgba(255, 205, 86, 12)',
//   //     borderWidth: 1
//   //   }, {
//   //     label: 'My Third Dataset',
//   //     data: [28, 43, 56, 69, 74, 79, 82],
//   //     fill: false,
//   //     backgroundColor: 'rgba(75, 192, 192, 12)',
//   //     borderColor: 'rgba(75, 192, 192, 12)',
//   //     borderWidth: 1
//   //   }
//   //   ]
//   // };
//   return dataF;
// }

// async function getLabelsChart(checkeds) {
//   console.log(checkeds);
//   var liters = [];

//   const units = await getUnits();

//   units.forEach(ele => {
//     liters.push(ele.combustible);
//   });
//   console.log(liters);
//   labels = {
//     datos: liters,
//     checkeds: checkeds
//   };
//   console.log(labels);
//   //labels = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO"];
//   return liters;
// }

// async function gasolina() {
//   $('#pestañaGas').removeClass('nav-link');
//   $('#pestañaGas').addClass('nav-link active');
//   $('#pestañaKilometros').removeClass('nav-link active');
//   $('#pestañaKilometros').addClass('nav-link');
//   typeChart = "Gasolina";
//   renderChart(await getDataChart(checkeds, typeChart));
// }

// async function kilometraje() {
//   $('#pestañaKilometros').removeClass('nav-link');
//   $('#pestañaKilometros').addClass('nav-link active');
//   $('#pestañaGas').removeClass('nav-link active');
//   $('#pestañaGas').addClass('nav-link');
//   typeChart = "Km";
//   renderChart(await getDataChart(checkeds, typeChart));
// }

// function getUnits() {
//   return fetch("../controller/test.php") //../Panel.php?opcion=4
//     .then(res => res.json())
//     .then(data => data);
// }
const Prueba = async (id) =>{
    $('#dateCheckFin').val(); 
   
    var id= id;
    var inicioDate = $('#dateCheckInicio').val();
    var finDate= $('#dateCheckFin').val();
    var costo= $('#dateCheckFin').val();
    const responseC = await getLitersOneDate(id, inicioDate);
    const responseK = await getKmOneDate(id, inicioDate);
    if(inicioDate == '' && finDate == '')
    {
      toastr["warning"]("Elija una fecha o un rango de fechas", "No se ha seleccionado una fecha");
    }else{
       if(responseC == 'error' || responseK == 'error'){
        toastr["error"]("No se encontraron registros en la fecha seleccionada ", "Sin datos para descargar el PDF");
       }
        else{
          window.location.href=  "../views/dompdf.php?id="+id+"&startDate="+inicioDate+"&endDate="+finDate+"&costo="+costo;
        }
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
function getRecargaComb1(id, date ){
  const data = new URLSearchParams(`id=${id}&date=${date}`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('../controller/controllerGasolina.php?opcion=getRecargaComb1', options)
  .then(res => res.json())
  .then(data => data);
}

// // function renderChart(data) {
// //   if (checkeds.length > 0) {
// //     var canvas = document.getElementById('canvasChart');
// //     var linearChart = new Chart(canvas, {
// //       type: 'bar',
// //       data: data,
// //       options: {
// //         scales: {
// //           y: {
// //             beginAtZero: true
// //           }
// //         },
// //         responsive: true,
// //         maintainAspectRatio: false
// //       }
// //     });
// //     linearChart.update();
// //   } else {
// //     var canvas = document.getElementById('canvasChart');
// //     var context = canvas.getContext('2d');
// //     context.clearRect(0, 0, canvas.width, canvas.height);
// //     toastr["info"]("Seleccione una o mas unidad para graficarlas", "Seleccione una unidad");
// //   }
// // }

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
    options: options, scales:{xAxes: [{scaleLabel: {labelString: 'Kilomeraje'}}], yAxes:[{scaleLabel:{labelString:'Combustible'}}]},
    plugins: { 
      datalabels:{
        display: true,
        align: 'top',
        offset: 5,
        labels: {
          title:{
            color: 'rgb(0,0,0)',
            borderRadius: 20,
            backgroundColor: 'rgb(135,206,253)',
            font: {
              size: 5,
            },
          },
        }
      }
    }
    
    
  });
}

const download = async (id) =>{
  var dates=[];
  const imagenLink = document.createElement('a');
  const canvas = document.getElementById('canvasChart');
  imagenLink.download =id,dates,'.png';
  imagenLink.href =canvas.toDataURL('image/png',1);
  imagenLink.click(); 
}

