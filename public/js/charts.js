const categoriesCanvas = document.getElementById('categories').getContext('2d');

const categoriesConfig = {
  type: 'bar',

  data: {
    labels: categoryChartLabels,
    datasets: [
      {
        label: 'Income',
        data: categoryIncomeData,
        backgroundColor: [
          'rgba(75, 192, 192, 0.7)',
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',
        ],
        borderWidth: 1
      },
      {
        label: 'Expenses',
        data: categoryExpenseData,
        backgroundColor: [
          'rgba(255, 99, 132, 0.7)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
        ],
        borderWidth: 1
      },
      {
        label: 'Netto',
        data: categoryNettoData,
        backgroundColor: [
          'rgba(54, 162, 235, 0.7)',
        ],
        borderColor: [
          'rgba(54, 162, 235, 1)',
        ],
        borderWidth: 1
      }
    ]
  },

  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          // Include a euro sign in the ticks
          callback: function (value, index, ticks) {
            return '€' + value;
          }
        }
      }
    },
    plugins: {
      title: {
        display: true,
        text: 'Income and Expenses per category year to date'
      }
    }
  }
};

const categoriesChart = new Chart(categoriesCanvas, categoriesConfig);
// ---------------------------------

const yearsCanvas = document.getElementById('years').getContext('2d');

const yearsConfig = {
  type: 'bar',

  data: {
    labels: yearsChartLabels,
    datasets: [
      {
        label: 'Income',
        data: yearsIncomeData,
        backgroundColor: [
          'rgba(75, 192, 192, 0.7)',
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',
        ],
        borderWidth: 1
      },
      {
        label: 'Expenses',
        data: yearsExpenseData,
        backgroundColor: [
          'rgba(255, 99, 132, 0.7)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
        ],
        borderWidth: 1
      },
      {
        label: 'Netto',
        data: yearsNettoData,
        backgroundColor: [
          'rgba(54, 162, 235, 0.7)',
        ],
        borderColor: [
          'rgba(54, 162, 235, 1)',
        ],
        borderWidth: 1
      }
    ]
  },

  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          // Include a euro sign in the ticks
          callback: function (value, index, ticks) {
            return '€' + value;
          }
        }
      }
    },
    plugins: {
      title: {
        display: true,
        text: 'Income and Expenses per year'
      }
    }
  }
};

const yearsChart = new Chart(yearsCanvas, yearsConfig);
// --------------------

const monthsCanvas = document.getElementById('months').getContext('2d');

const monthsConfig = {
  type: 'bar',

  data: {
    labels: monthChartLabels,
    datasets: [
      {
        label: 'Income',
        data: monthIncomeData,
        backgroundColor: [
          'rgba(75, 192, 192, 10.7',
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',
        ],
        borderWidth: 1
      },
      {
        label: 'Expenses',
        data: monthExpenseData,
        backgroundColor: [
          'rgba(255, 99, 132, 0.7)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
        ],
        borderWidth: 1
      },
      {
        label: 'Netto',
        data: monthNettoData,
        backgroundColor: [
          'rgba(54, 162, 235, 0.7)',
        ],
        borderColor: [
          'rgba(54, 162, 235, 1)',
        ],
        borderWidth: 1
      }
    ]
  },

  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          // Include a euro sign in the ticks
          callback: function (value, index, ticks) {
            return '€' + value;
          }
        }
      }
    },
    plugins: {
      title: {
        display: true,
        text: 'Income and Expenses per month'
      }
    }
  }
};

const monthsChart = new Chart(monthsCanvas, monthsConfig);
