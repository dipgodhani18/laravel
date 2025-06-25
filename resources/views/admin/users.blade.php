 @extends('admin.layouts.app')

 @section('adminContent')

 <main>
     <div class="container-fluid px-4">
         <h2 class="mt-4">Users</h2>
         <ol class="breadcrumb mb-4">
             <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
             <li class="breadcrumb-item active">Users</li>
         </ol>
         <div class="card mb-4">
             <div class="card-header">
                 <i class="fas fa-table me-1"></i>
                 Users Table
             </div>
             <div class="card-body">
                 <table id="datatablesSimple">
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Status</th>
                             <th>Registered At</th>
                             <th>Actions</th>
                         </tr>
                     </thead>
                     <tfoot>
                         <tr>
                             <th>ID</th>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Status</th>
                             <th>Registered At</th>
                             <th>Actions</th>
                         </tr>
                     </tfoot>
                     <tbody>
                         @foreach($users as $user)
                         <tr>
                             <td>{{ $user->id }}</td>
                             <td>{{ $user->name }}</td>
                             <td>{{ $user->email }}</td>
                             @if($user->email_verified_at !== null)
                             <td>

                                 <div class="text-success font-bold">
                                     Verified
                                 </div>

                             </td>
                             @else
                             <td class="text-center">-</td>
                             @endif

                             <td>{{ $user->created_at->format('d-m-Y') }}</td>
                             <td>
                                 <div>
                                     <a href="{{ route('admin.users_details', $user->id) }}"
                                         class="btn btn-sm btn-primary">View</a>
                                     @if($user->status == 0)
                                     <a href="{{ route('admin.user.status', $user->id) }}"
                                         class="btn btn-sm btn-danger">Block</a>
                                     @else
                                     <a href="{{ route('admin.user.status', $user->id) }}"
                                         class="btn btn-sm btn-success">Unblock</a>
                                     @endif
                                 </div>
                             </td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </main>
 @endsection