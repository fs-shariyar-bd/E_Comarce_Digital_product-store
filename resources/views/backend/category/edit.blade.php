@extends('backend.master')
@section('content')
    @section('title')
    Edit Category
    @endsection

                        <div class="container-fluid  dashboard-content">
                            <!-- ============================================================== -->
                             <!-- basic form  -->
                             <!-- ============================================================== -->
                                <div class="row">
                                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                     <div class="page-header">
                                       <h2 class="pageheader-title">Edit Category </h2>
                                      <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                                      <div class="page-breadcrumb">
                                      <nav aria-label="breadcrumb">
                                      <ol class="breadcrumb">
                                         <li class="breadcrumb-item"><a href="{{ route('dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                                         <li class="breadcrumb-item"><a href="{{ route('category.index')}}" class="breadcrumb-link">Category Tables</a></li>
                                         <li class="breadcrumb-item active" aria-current="page">Update Category</li>
                                     </ol>
                                       </nav>
                                     </div>
                                 </div>
                               </div>
                             </div>
                               <div class="row">
                             <div class="col-xl-12">

                                  <div class="card">
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

                                   @if($errors->any())
                                      <div class="alert alert-danger">
                                          <ul class="mb-0">
                                              @foreach($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                              @endforeach
                                          </ul>
                                      </div>
                                   @endif

                                     <h5 class="card-header"><i class="fas fa-sync-alt"  style="margin-right:8px;"></i><span>Update Category</span></h5>
                                     <div class="card-body">

                                         <form action="{{ route('category.update', $category->id) }}" method="post">
                                             @csrf
                                             @method('PUT')
                                             <div class="form-group">
                                                 <label for="inputText3" class="col-form-label">Category Name</label>
                                                 <input id="inputText3" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}">
                                                 @error('name')
                                                     <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                             </div>
                                             <div class="form-group">
                                                 <label for="inputText4" class="col-form-label">Order</label>
                                                 <input id="inputText4" type="number" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ $category->order ?? 0 }}">
                                                 @error('order')
                                                     <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                             </div>
                                             <div class="form-group">
                                                 <label for="inputText5" class="col-form-label">Status</label>
                                             <select class="form-control" name="status" id="inputText5">

                                                   <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                                   <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                              </select>
                                         </div>
                                                 <div class="form-group text-right">
                                                 <input name="submit" type="submit" value="submit" class="btn btn-primary">
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <!-- ============================================================== -->
                         <!-- end basic form  -->
                         <!-- ============================================================== -->
    @endsection




 <div class="container-fluid  dashboard-content">
                        <!-- ============================================================== -->
                         <!-- basic form  -->
                         <!-- ============================================================== -->
                                <div class="row">
                                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                     <div class="page-header">
                                       <h2 class="pageheader-title">Add Category </h2>
                                      <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                                      <div class="page-breadcrumb">
                                      <nav aria-label="breadcrumb">
                                      <ol class="breadcrumb">
                                         <li class="breadcrumb-item"><a href="{{ route('dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                                         <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Category</a></li>
                                         <li class="breadcrumb-item"><a href="{{ route('category.index')}}" class="breadcrumb-link">Category Tables</a></li>

                                         <li class="breadcrumb-item active" aria-current="page">Update Category</li>
                                     </ol>
                                       </nav>
                                     </div>
                                 </div>
                               </div>
                             </div>
                               <div class="row">
                             <div class="col-xl-12">

                                  <div class="card">
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

                                   @if($errors->any())
                                      <div class="alert alert-danger">
                                          <ul class="mb-0">
                                              @foreach($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                              @endforeach
                                          </ul>
                                      </div>
                                   @endif


                                     <h5 class="card-header"><i class="fas fa-sync-alt"  style="margin-right:8px;"></i><span>Update Category</span></h5>
                                     <div class="card-body">

                                         <form action="{{ route('category.update', $category->id) }}" method="post">
                                             @csrf
                                             @method('PUT')
                                             <div class="form-group">
                                                 <label for="inputText3" class="col-form-label">Name</label>
                                                 <input id="inputText3" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}">
                                                 @error('name')
                                                     <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                             </div>
                                             <div class="form-group">
                                                 <label for="inputText4">Order</label>
                                                 <input id="inputText4" type="text" placeholder="Category Order" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ $category->order }}">
                                                 @error('order')
                                                     <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                            </div>
                                              <div class="form-group">
                                                    <label for="inputText5">Status</label>
                                             <select class="form-control" name="status" id="inputText5">

                                                   <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                                   <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                              </select>
                                         </div>
                                                 <div class="form-group text-right">
                                                 <input name="submit" type="submit" value="submit" class="btn btn-primary">
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <!-- ============================================================== -->
                         <!-- end basic form  -->
                         <!-- ============================================================== -->
  @endsection
