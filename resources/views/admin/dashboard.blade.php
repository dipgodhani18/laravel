 @extends('admin.layouts.app')

 @section('adminContent')

 <main>
     <div class="container-fluid px-4">
         <h2 class="mt-4">Dashboard</h2>
         <ol class="breadcrumb mb-4">
             <li class="breadcrumb-item active">Dashboard</li>
         </ol>
         <div class="row">
             <div class="col-xl-3 col-md-6">
                 <div class="card bg-primary text-white mb-4">
                     <div class="card-body">Total Users <br> <b>{{ $totalUsers }}</b></div>
                     <div class="card-footer d-flex align-items-center justify-content-between">
                         <a class="small text-decoration-none text-white stretched-link"
                             href="{{route('admin.users')}}">View Details</a>
                         <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3 col-md-6">
                 <div class="card bg-warning text-white mb-4">
                     <div class="card-body">Non Verified users <br> <b>{{ $verifiedUsers }}</b></div>
                     <div class="card-footer d-flex align-items-center justify-content-between">
                         <a class="small text-decoration-none text-white stretched-link"
                             href="{{route('admin.pages.unverified_users')}}">View
                             Details</a>
                         <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3 col-md-6">
                 <div class="card bg-success text-white mb-4">
                     <div class="card-body">Active Users <br> <b>{{ $activeUsers }}</b> </div>
                     <div class="card-footer d-flex align-items-center justify-content-between">
                         <a class="small text-decoration-none text-white stretched-link"
                             href="{{route('admin.pages.active_users')}}">View
                             Details</a>
                         <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3 col-md-6">
                 <div class="card bg-danger text-white mb-4">
                     <div class="card-body">Blocked Users <br> <b>{{ $blockedUsers }}</b></div>
                     <div class="card-footer d-flex align-items-center justify-content-between">
                         <a class="small text-decoration-none text-white stretched-link"
                             href="{{route('admin.pages.blocked_users')}}">View
                             Details</a>
                         <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-area me-1"></i>
                         Area Chart Example
                     </div>
                     <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                 </div>
             </div>
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-bar me-1"></i>
                         Bar Chart Example
                     </div>
                     <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                 </div>
             </div>
         </div>

     </div>
 </main>


 @endsection

 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
 <!-- area chart -->
 <script>
     Chart.defaults.global.defaultFontFamily =
         '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
     Chart.defaults.global.defaultFontColor = "#292b2c";

     fetch("http://127.0.0.1:8000/api/admin/dashboard/users")
         .then((res) => res.json())
         .then((data) => {
             var ctx = document.getElementById("myAreaChart");
             new Chart(ctx, {
                 type: "line",
                 data: {
                     labels: data.chartLabels,
                     datasets: [{
                         label: "Users",
                         lineTension: 0.3,
                         backgroundColor: "rgba(2,117,216,0.2)",
                         borderColor: "rgba(2,117,216,1)",
                         pointRadius: 5,
                         pointBackgroundColor: "rgba(2,117,216,1)",
                         pointBorderColor: "rgba(255,255,255,0.8)",
                         pointHoverRadius: 5,
                         pointHoverBackgroundColor: "rgba(2,117,216,1)",
                         pointHitRadius: 50,
                         pointBorderWidth: 2,
                         data: data.chartData,
                     }, ],
                 },
                 options: {
                     scales: {
                         xAxes: [{
                             time: {
                                 unit: "date",
                             },
                             gridLines: {
                                 display: false,
                             },
                             ticks: {
                                 maxTicksLimit: 7,
                             },
                         }, ],
                         yAxes: [{
                             ticks: {
                                 min: 0,
                                 max: 50,
                                 maxTicksLimit: 7,
                             },
                             gridLines: {
                                 color: "rgba(0, 0, 0, .125)",
                             },
                         }, ],
                     },
                     legend: {
                         display: false,
                     },
                 },
             });
         });
 </script>
 <!-- bar chart -->
 <script>
     Chart.defaults.global.defaultFontFamily =
         '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
     Chart.defaults.global.defaultFontColor = '#292b2c';

     fetch("http://127.0.0.1:8000/api/admin/dashboard/users_monthly")
         .then((res) => res.json())
         .then((data) => {

             var ctx = document.getElementById("myBarChart");
             new Chart(ctx, {
                 type: 'bar',
                 data: {
                     labels: data.chartLabels,
                     datasets: [{
                         label: "Users",
                         backgroundColor: "rgba(2,117,216,1)",
                         borderColor: "rgba(2,117,216,1)",
                         data: data.chartData,
                     }],
                 },
                 options: {
                     scales: {
                         xAxes: [{
                             time: {
                                 unit: 'month'
                             },
                             gridLines: {
                                 display: false
                             },
                             ticks: {
                                 maxTicksLimit: 7
                             }
                         }],
                         yAxes: [{
                             ticks: {
                                 min: 0,
                                 max: 50,
                                 maxTicksLimit: 7
                             },
                             gridLines: {
                                 display: true
                             }
                         }],
                     },
                     legend: {
                         display: false
                     }
                 }
             });
         })
 </script>