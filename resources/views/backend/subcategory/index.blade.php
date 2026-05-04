@extends('backend.master')
@section('content')
    @section('title')
    SubCategory List
    @endsection


                        <div class="container-fluid  dashboard-content">
                            <!-- ============================================================== -->
                            <!-- pageheader -->
                            <!-- ============================================================== -->
                              <div class="row">
                                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                      <div class="page-header">
                                          <h2 class="pageheader-title">SubCategory Tables </h2>
                                          <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                                          <div class="page-breadcrumb">
                                              <nav aria-label="breadcrumb">
                                                  <ol class="breadcrumb">
                                                      <li class="breadcrumb-item"><a href="{{ route('dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                                                      <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">SubCategory</a></li>
                                                      <li class="breadcrumb-item active" aria-current="page">SubCategory Tables</li>
                                                  </ol>
                                              </nav>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                         <!-- ============================================================== -->
                         <!-- end pageheader -->
                         <!-- ============================================================== -->



                       <div class="row">
                           <!-- ============================================================== -->
                           <!-- bordered table -->
                           <!-- ============================================================== -->
                            <div class="col-12">
                                <div class="card table-card">
                                        @if(Session::has('success'))
                                            <div class="alert alert-success">
                                                {{ Session::get('success') }}
                                            </div>
                                        @endif
                                        @if(Session::has('error'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('error') }}
                                            </div>
                                        @endif
                                    <div class="row">
                                        <div class="col-6">
                                              <h5 class="card-header"><i class="fas fa-clipboard-list" style="margin-right:8px;"></i><span>SubCategory list</span></h5>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="{{ route('subcategory.create')}}" class="btn btn-primary float-right mt-2 mr-2"><i class="fas fa-cart-plus" style="margin-right:8px"></i>Add SubCategory</a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Order</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subCategories as $row)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration}}</th>
                                                    <td> {{ $row->name }}</td>
                                                    <td> {{ $row->category->name ?? 'N/A' }}</td>
                                                    <td> {{ $row->order }}</td>
                                                    <td><span class="badge badge-{{ $row->status == 1 ? 'Active' : 'Inactive'}} "> {{ $row->status == 1 ? 'Active' : 'Inactive' }}</span></td>

                                                    <td class="action-btns">
                                                        <a href="{{ route('subcategory.edit', $row->id) }}" class="btn btn-info"> <i class="fas fa-edit" style="margin-right: 8px"></i><span>Edit</span></a>
                                                        <a href="{{ route('subcategory.delete', $row->id) }}" onclick="return confirm('Are you sure you want to delete this subcategory?')" class="btn btn-warning"><i class="far fa-trash-alt"  style="margin-right: 8px"></i><span>Delete</span></a>
                                                    </td>
                                                </tr>
                                                 @endforeach
                                            </tbody>

                                        </table>
                                         {{ $subCategories->links() }}
                                    </div>
                                </div>
                               </div>
                         <!-- ============================================================== -->
                         <!-- end bordered table -->
                         <!-- ============================================================== -->
                         </div>
        </div>
    @endsection





                       <div class="container-fluid  dashboard-content">
                           <!-- ============================================================== -->
                           <!-- pageheader -->
                           <!-- ============================================================== -->
                             <div class="row">
                                 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                     <div class="page-header">
                                         <h2 class="pageheader-title">SubCategory Tables </h2>
                                         <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                                         <div class="page-breadcrumb">
                                             <nav aria-label="breadcrumb">
                                                 <ol class="breadcrumb">
                                                     <li class="breadcrumb-item"><a href="{{ route('dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                                                     <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">SubCategory</a></li>
                                                     <li class="breadcrumb-item active" aria-current="page">SubCategory Tables</li>
                                                 </ol>
                                             </nav>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                        <!-- ============================================================== -->
                        <!-- end pageheader -->
                        <!-- ============================================================== -->





                      <div class="row">
                          <!-- ============================================================== -->
                          <!-- bordered table -->
                          <!-- ============================================================== -->
                           <div class="col-12">
                               <div class="card table-card">
                                       @if(Session::has('success'))
                                           <div class="alert alert-success">
                                               {{ Session::get('success') }}
                                           </div>
                                       @endif
                                       @if(Session::has('error'))
                                           <div class="alert alert-danger">
                                               {{ Session::get('error') }}
                                           </div>
                                       @endif
                                   <div class="row">
                                       <div class="col-6">
                                             <h5 class="card-header"><i class="fas fa-clipboard-list" style="margin-right:8px;"></i><span>SubCategory list</span></h5>
                                       </div>
                                       <div class="col-6 text-right">
                                           <a href="{{ route('subcategory.create')}}" class="btn btn-primary float-right mt-2 mr-2"><i class="fas fa-cart-plus" style="margin-right:8px"></i>Add SubCategory</a>
                                       </div>
                                   </div>

                                   <div class="card-body">
                                       <table class="table table-bordered">
                                           <thead>
                                               <tr>
                                                   <th scope="col">#</th>
                                                   <th scope="col">Category</th>
                                                   <th scope="col">Name</th>
                                                   <th scope="col">Status</th>
                                                   <th scope="col">Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               @foreach ($subCategories as $row)
                                               <tr>
                                                   <th scope="row">{{ $loop->iteration}}</th>
                                                   <td> {{ $row->category->name }}</td>
                                                   <td> {{ $row->name }}</td>
                                                   <td><span class="badge badge-{{ $row->status == 1 ? 'Active' : 'Inactive' }} "> {{ $row->status == 1 ? 'Active' : 'Inactive' }}</span></td>

                                                   <td class="action-btns">
                                                       <a href="{{ route('subcategory.edit', $row->id) }}" class="btn btn-info"> <i class="fas fa-edit" style="margin-right: 8px"></i><span>Edit</span></a>
                                                       <a href="{{ route('subcategory.delete', $row->id) }}" onclick="return confirm('Are you sure you want to delete this subCategory?')" class="btn btn-warning"><i class="far fa-trash-alt"  style="margin-right: 8px"></i><span>Delete</span></a>
                                                   </td>
                                               </tr>
                                                @endforeach
                                           </tbody>

                                       </table>
                                        {{ $subCategories->links() }}
                                   </div>
                               </div>
                              </div>
                        <!-- ============================================================== -->
                        <!-- end bordered table -->
                        <!-- ============================================================== -->
                        </div>
        </div>
    @endsection