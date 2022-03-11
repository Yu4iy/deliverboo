console.log('wow');

const year = document.querySelector('.year');
const month = document.querySelector('.month');

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
    
    let data = {
        labels: labels,
        datasets: [{
            label: 'Statistica anno: ',
            backgroundColor: '#00ccbc',
            borderColor: '#00ccbc',
            data: [0, 10, 5, 2, 20, 30, 40],
        }]
    };
    
    const config = {
        type: 'bar',
        data: data,
        options: {}
    };
    
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
});

month.addEventListener('click', function () {
    console.log('ciaoo');

    const labels = [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12',
        '13',
        '14',
        '15',
        '16',
        '17',
        '18',
        '19',
        '20',
        '21',
        '22',
        '23',
        '24',
        '25',
        '26',
        '27',
        '28',
        '29',
        '30',
        '31',
    ];
    
    const data = {
        labels: labels,
        datasets: [{
            label: 'Statistiche di questo mese',
            backgroundColor: '#00ccbc',
            borderColor: '#00ccbc',
            data: [0, 10, 5, 2, 20, 30, 40],
        }]
    };
    
    const config = {
        type: 'bar',
        data: data,
        options: {}
    };
    
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
});