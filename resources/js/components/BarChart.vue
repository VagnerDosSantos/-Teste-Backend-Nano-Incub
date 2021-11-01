<template>
  <div class="example">
    <apexcharts
      width="100%"
      height="350"
      type="bar"
      :options="chartOptions"
      :series="series"
    ></apexcharts>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";

export default {
  name: "Chart",
  components: {
    apexcharts: VueApexCharts,
  },
  methods: {
    gerarMeses: function () {
      let totalMeses = 12;
      let mesAtual = new Date().getMonth() + 1;
      let mesesRestantes = totalMeses - mesAtual;

      const meses = Array.from({ length: totalMeses }, (e, i) => {
        return new Date(null, i - mesesRestantes + 1, null).toLocaleDateString(
          "pt-br",
          {
            month: "long",
          }
        );
      });
      return meses;
    },
  },
  data: function () {
    return {
      series: [
        {
          name: "",
          data: [],
        },
      ],
      chartOptions: {
        chart: {
          type: "bar",
          height: 350,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"],
        },
        xaxis: {
          categories: this.gerarMeses(),
        },
        yaxis: {
          labels: {
            show: true,
            formatter: (val) => {
              return val.toLocaleString("pt-BR");
            },
          },
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "R$ " + val.toLocaleString("pt-BR");
            },
          },
        },
      },
    };
  },
  beforeMount: function () {
    axios.get("movimentacao/ultimasMovimentacoes").then((response) => {
      this._data.series = JSON.parse(JSON.stringify(response.data));
    });
  },
};
</script>
