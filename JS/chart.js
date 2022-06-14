function displayChart(d){

    var x = 27 //plot prev 28 days
    var y = 0  //set to labels array
    labels = [];
    values = [];
    while (x >= 0){
        labels[y] = d.data[x].date; //access values from api data, assign to corresponding variables
        values[y] = d.data[x].newCases;
        x = x - 1;
        y = y + 1;
    }

      data = {
        labels: labels,
        datasets: [{
          label: 'COVID-19 Case Tracker (Number of Cases Reported each Day',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          borderWidth: '3',
          data: values,
        }]
      };
    
      const config = {
        type: 'line',
        data: data,
        options: {}
      };

      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );


      options = {
        responsive: true,
        maintainAspectRatio: false 
      }


}

function getData(){ //fetch data from gov.uk open data api endpoint
    const endpoint = 'https://api.coronavirus.data.gov.uk/v1/data?filters=areaType=nation;areaName=england&structure={%22date%22:%22date%22,%22newCases%22:%22newCasesByPublishDate%22}'

    fetch(endpoint).then(response => response.json()).then(dataset => {
        console.log(dataset.data[0].date);
        console.log(dataset);

        displayChart(dataset); //call displaychart, passing the data fetched from api


    })
    
}

getData();

