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
                type: 'line',
                data: {
                    datasets: [{
                       label: 'Sales',
                       data: this.datas, 
                       backgroundColor: 'rgb(255, 99, 132)',
                       borderColor: 'rgb(255, 99, 132)',    
                    }],
                    labels: this.labels,
                }
            }
        }
    },
    mounted() {
    const ctx = document.getElementById('statistics');
    new Chart(ctx, this.chartData);
  }
}
</script>

<style scoped lang="scss">

</style>