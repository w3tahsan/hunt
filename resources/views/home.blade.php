@extends('backend.layout.layouts');

@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Last 7 Days Orders</h3>
        </div>
        <div class="card-body">
             <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Last 7 Days Sales Amount</h3>
        </div>
        <div class="card-body">
             <canvas id="aaa"></canvas>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
  const ctx = document.getElementById('myChart');
  var labels =  {{ Js::from($after_explode_labels) }};
  var orders =  {{ Js::from($after_explode_data) }};

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Number of Orders',
        data: orders,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<script>
  const aaa = document.getElementById('aaa');
  var labels2 =  {{ Js::from($after_explode_sales_labels) }};
  var sales =  {{ Js::from($after_explode_sales_data) }};

  new Chart(aaa , {
    type: 'doughnut',
    data: {
      labels: labels2,
      datasets: [{
        label: 'Number of Orders',
        data: sales,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endsection
