 @extends('admin.layouts.app')

 @section('adminContent')
 <main>
     <div class="container-fluid px-4">
         <h2 class="mt-4">User Details</h2>
         <ol class="breadcrumb mb-4">
             <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
             <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
             <li class="breadcrumb-item active">{{ $user->name }}</li>
         </ol>

         <div class="card">
             <div class="card-body row">
                 <div class="col-md-1">
                     <img src="{{ asset('/backend/assets/img/user.png') }}" alt="User Image" style=" width: 100%;">
                 </div>
                 <div class="col-md-11 d-flex flex-column justify-content-between mt-md-0 mt-4">
                     <div>
                         <p class="mb-0"><b>Name:</b> {{ $user->name }}</p>
                         <p class="mb-0"><b>Email:</b> {{ $user->email }}</p>
                         <p class="mb-0"><b>Contact No:</b> +91 {{ $user->phone }}</p>
                         <p class="mb-0 text-capitalize"><b>Gender:</b> {{ $user->gender }}</p>
                         <p class="mb-0"><b>Registered At:</b> {{ $user->created_at->format('d M Y, h:i A') }}</p>
                         @if($user->email_verified_at !== null)
                         <p class="text-success font-bold">Verified</p>
                         @else
                         <p class="text-danger font-bold">Not verified!</p>
                         @endif
                     </div>
                     <div>
                         <a href="{{ route('admin.users') }}" class="btn btn-primary mt-3 btn-sm ">Back to Users</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </main>
 @endsection