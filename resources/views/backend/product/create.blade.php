 @extends('backend.master')
 @section('content')
    @section('title')
        Add Product
    @endsection

                     <div class="container-fluid  dashboard-content">
                        <!-- ============================================================== -->
                        <!--                       basic form                               -->
                        <!-- ============================================================== -->
                               <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="page-header">
                                      <h2 class="pageheader-title">Add Product </h2>
                                     <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                                     <div class="page-breadcrumb">
                                     <nav aria-label="breadcrumb">
                                     <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Product</a></li>
                                         <li class="breadcrumb-item"><a href="{{ route('product.index')}}" class="breadcrumb-link">Product Tables</a></li>


                                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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


                                    <h5 class="card-header"><i class="fas fa-dolly"  style="margin-right: 8px"></i><span>Add New Product</span></h5>
                                    <div class="card-body">

                                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                            <div class="form-group col-6">
                                                <label for="inputText3" class="col-form-label">Name</label>
                                                <input id="inputText3" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Product Name">
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                              <div class="form-group col-6">
                                                <label for="inputText3" class="col-form-label">Short Description</label>
                                                <textarea id="inputText3" class="form-control @error('short_description') is-invalid @enderror" name="short_description"></textarea>
                                                @error('short_description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                              <div class="form-group col-6">
                                                <label for="inputText3" class="col-form-label">Description</label>
                                                <textarea id="inputText3" class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                              </div>


                                              <div class="form-group col-6">
                                                <label for="inputText3" class="col-form-label">Product Details</label>
                                                <textarea id="inputText3" class="form-control @error('product_details') is-invalid @enderror" name="product_details"></textarea>
                                                @error('product_details')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="inputText4">Quantity</label>
                                                <input id="inputText4" type="number"  class="form-control @error('quantity') is-invalid @enderror" name="quantity">

                                              @error('quantity')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                             </div>


                                              <div class="form-group col-6">
                                                <label for="inputText4">price</label>
                                                <input id="inputText4" type="number" step="any"  class="form-control @error('price') is-invalid @enderror" name="price">

                                                 @error('price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                  @enderror
                                             </div>

                                         <div class="form-group col-6">
                                                <label for="inputText4">Discount (%)</label>
                                                <input id="inputText4" type="number" step="0.01"  class="form-control @error('discount') is-invalid @enderror" name="discount">

                                              @error('discount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                             </div>



                                               <div class="form-group col-6">
                                                <label for="inputText3" class="col-form-label">Delivery Policy</label>
                                                <input id="inputText3" type="text" class="form-control @error('delivery_policy') is-invalid @enderror" name="delivery_policy">
                                                @error('delivery_policy')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                              <div class="form-group col-6">
                                                <label for="inputText3" class="col-form-label">Return Policy</label>
                                                <input id="inputText3" type="text" class="form-control @error('return_policy') is-invalid @enderror" name="return_policy">
                                                @error('return_policy')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group col-6">
                                                <label for="inputText3" class="col-form-label">Product Image</label>
                                                <input id="inputText3" name="images[]" type="file" multiple class="form-control">
                                                @error('image')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            <div class="form-group col-6">
                                                <label for="inputText4">Order</label>
                                                <input id="inputText4" type="number" placeholder="Product Order" class="form-control @error('order') is-invalid @enderror" name="order">

                                              @error('order')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                             </div>

                                         <div class="form-group col-6">
                                        <label for="category">Category</label>
                                            <select class="form-control" name="category_id" id="category">
                                                <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                               <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                             </select>
                                        </div>


                                         <div class="form-group col-6">
                                        <label for="sub_category">Sub Category</label>
                                            <select class="form-control" name="sub_category_id" id="sub_category">
                                                <option value="">Select Sub Category</option>
                                             </select>
                                        </div>


                                       <div class="form-group col-6">
                                        <label for="inputText5">Status</label>
                                            <select class="form-control" name="status" id="inputText6">
                                                 <option value="1">Active</option>
                                                  <option value="0">Inactive</option>
                                             </select>
                                        </div>


                                           <div class="form-group text-right col-12" >
                                            <input name="Submit" type="Submit" value="Submit" class="btn btn-primary">
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

 @push('body-scripts')
  <script>
    $(document).ready(function(){

 $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

        $("#category").on('change', function(){
    var category_id =$("#category").val();


  $.ajax({
           data:{category_id : category_id},
           url:"{{route('product.sub-category')}}",
           type: "POST",
           dataType: 'json',
           success: function(data) {
          var html = '';
           $.each(data.sub_categories , function(index, val) {
           html +=" <option value="+val.id+">"+val.name+"</option>"
           });
      $("#sub_category").html(html);

           },
           error:function(data) {
            console.log('Error:',data);
            $('#saveBtn').html('Save Changes');
           }

 });


        });
    });

  </script>

 @endpush
