 @extends('admin.layouts.app')

 @section('adminContent')
 <main>
     <div class="container-fluid px-4">
         <h2 class="mt-4">Charts</h2>
         <ol class="breadcrumb mb-4">
             <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
             <li class="breadcrumb-item active">Charts</li>
         </ol>

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
         <div class="row">
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-bar me-1"></i>
                         Pie Chart Example
                     </div>
                     <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                 </div>
             </div>
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-bar me-1"></i>
                         Doughnut Chart Example
                     </div>
                     <div class="card-body"><canvas id="myDoughnutChart" width="100%" height="40"></canvas></div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-pie me-1"></i>
                         Radar Chart Example
                     </div>
                     <div class="card-body">
                         <canvas id="myRadarChart" width="100%" height="40"></canvas>
                     </div>
                 </div>
             </div>
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-pie me-1"></i>
                         Polar Area Chart Example
                     </div>
                     <div class="card-body">
                         <canvas id="myPolarChart" width="100%" height="40"></canvas>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-pie me-1"></i>
                         Bubble Chart Example
                     </div>
                     <div class="card-body">
                         <canvas id="myBubbleChart" width="100%" height="40"></canvas>
                     </div>
                 </div>
             </div>
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-pie me-1"></i>
                         Scatter Chart Example
                     </div>
                     <div class="card-body">
                         <canvas id="myScatterChart" width="100%" height="40"></canvas>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-bar me-1"></i>
                         Line Chart Example
                     </div>
                     <div class="card-body">
                         <canvas id="myLineChart" width="100%" height="40"></canvas>
                     </div>
                 </div>
             </div>
             <div class="col-xl-6">
                 <div class="card mb-4">
                     <div class="card-header">
                         <i class="fas fa-chart-bar me-1"></i>
                         Horizontal Bar Chart Example
                     </div>
                     <div class="card-body">
                         <canvas id="myHorizontalBarChart" width="100%" height="40"></canvas>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </main>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
 <script src="{{ asset('/backend/assets/demo/chart-area-demo.js') }}"></script>
 <script src="{{ asset('/backend/assets/demo/chart-bar-demo.js') }}"></script>
 <script src="{{ asset('/backend/assets/demo/chart-pie-demo.js') }}"></script>
 <script src="{{ asset('/backend/assets/demo/chart-doughnut-demo.js') }}"></script>
 <script src="{{ asset('/backend/assets/demo/chart-radar-demo.js') }}"></script>
 <script src="{{ asset('/backend/assets/demo/chart-polar-demo.js') }}"></script>
 <script src="{{ asset('/backend/assets/demo/chart-bubble-demo.js') }}"></script>
 <script src="{{ asset('/backend/assets/demo/chart-scatter-demo.js') }}"></script>
 <script src="{{ asset('/backend/assets/demo/chart-line-demo.js') }}"></script>
 <script src="{{ asset('/backend/assets/demo/chart-horizontal-bar-demo.js') }}"></script>

 @endsection