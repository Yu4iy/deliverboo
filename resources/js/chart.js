console.log('wow');

const year = document.querySelector('.year');
const month = document.querySelector('.month');
const day = document.querySelector('.day');

year.addEventListener('click', function() {
    console.log('ciao');

    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];
    
    const data = {
        labels: labels,
        datasets: [{
            label: 'My First dataset',
            backgroundColor: '#00ccbc',
            borderColor: '#00ccbc',
            data: [0, 10, 5, 2, 20, 30, 40],
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
})