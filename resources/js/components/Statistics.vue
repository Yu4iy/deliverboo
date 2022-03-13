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
        orders: Array,
    },
    data(){
        return{
            chartData: {
                type: 'bar',
                data: {
                    datasets: [{
                       label: 'Total Sales €',
                       data: this.datas, 
                       backgroundColor: '#00ccbc',
                       borderColor: '#00ccbc',    
                    },
                    {
                       label: 'Orders',
                       data: this.orders, 
                       backgroundColor: '#08776e',
                       borderColor: '#08776e',    
                    }
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