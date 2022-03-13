<template>
    <div class="test">
        <canvas id="statistics"></canvas>
    </div>
</template>

<script>
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);
export default {
    name: 'Statistics',
    props: {
        datas: Array,
        labels: Array,
    },
    data(){
        return{
            chartData: {
                type: 'bar',
                data: {
                    datasets: [{
                       label: 'Total Sales',
                       data: this.datas, 
                       backgroundColor: '#00ccbc',
                       borderColor: '#00ccbc',    
                    }
                    /* {
                       label: 'Orders',
                       data: [10, 20, 30, 40, 40, 60, 30, 20, 40, 20, 30, 20, 10], 
                       backgroundColor: '#00cc',
                       borderColor: '#00cc',    
                    } */
                    ],
                    labels: this.labels,
                }
            }
        }
    },
    mounted() {
    const ctx = document.getElementById('statistics');
    new Chart(ctx, this.chartData);
    console.log(this.salesData, this.labels)
  }
}
</script>

<style scoped lang="scss">

</style>