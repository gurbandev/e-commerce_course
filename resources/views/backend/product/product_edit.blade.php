@extends('admin.admin_dashboard')
@section('title', 'Product add')
@section('admin')
    <script src="{{ asset('MyEdit/js/jquery.min.js') }}"></script>

    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Product Manage</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Product</h5>
                <hr/>
                <div class="form-body mt-4">
                    <form action="{{ route('update.product', $item->id) }}" method="Post" enctype="multipart/form-data">
                        @method('Put')
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label @error('name') is-invalid @enderror" required>Product Name</label>
                                        <input type="text" class="form-control" value="{{ $item->name }}" name="name" id="name"
                                               placeholder="Enter product name">
                                        @error('name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label @error('tags') is-invalid @enderror">Product Tags</label>
                                        <input type="text" value="{{ $item->tags }}"  name="tags" class="form-control visually-hidden"
                                               data-role="tagsinput">
                                        @error('tags')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label @error('size') is-invalid @enderror">Product Size</label>
                                        <input type="text" value="{{ $item->size }}" name="size" class="form-control visually-hidden"
                                               data-role="tagsinput">
                                        @error('size')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label @error('color') is-invalid @enderror">Product Color</label>
                                        <input type="text" value="{{ $item->color }}" name="color" class="form-control visually-hidden"
                                               data-role="tagsinput">
                                        @error('color')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="short_descp" class="form-label @error('short_descp') is-invalid @enderror" required>Short Description</label>
                                        <textarea class="form-control" name="short_descp" id="short_descp"
                                                  rows="3">{{ $item->short_descp }}</textarea>
                                        @error('short_descp')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="long_descp" class="form-label @error('long_descp') is-invalid @enderror">Long Description</label>
                                        <textarea class="form-control" name="long_descp" id="mytextarea">{!! $item->long_descp !!}</textarea>
                                        @error('long_descp')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputPrice" class="form-label">Price</label>
                                            <input type="text" value="{{ $item->selling_price }}" name="price" class="form-control" id="inputPrice" placeholder="00.00" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                            <input type="text" value="{{ $item->discount_price }}" name="discount_price" class="form-control" id="inputCompareatprice" placeholder="00.00" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" value="{{ $item->code }}" name="code" class="form-control" id="inputCostPerPrice" placeholder="0000" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" value="{{ $item->qty }}" name="qty" class="form-control" id="inputStarPoints" placeholder="00.00" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="brand" class="form-label">Product Brand</label>
                                            <select class="form-select" name="brand_id" id="brand" required>
                                                <option></option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $item->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="category" class="form-label">Product Category</label>
                                            <select class="form-select" name="category_id" id="category" required>
                                                <option></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="category" class="form-label">Product SubCategory</label>
                                            <select class="form-select" name="subcategory_id" id="subcategory" required>
                                                <option></option>
                                                @foreach($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" {{ $item->category_id == $subcategory->category_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Select Vendor</label>
                                            <select class="form-select" id="inputCollection">
                                                <option></option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Product Tags</label>
                                            <input type="text" class="form-control" id="inputProductTags" placeholder="Enter Product Tags">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" {{ $item->hot_deals ? 'checked' : '' }} name="hot_deals" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">Hot deals</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" {{ $item->featured ? 'checked' : '' }} name="featured" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">Featured</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" {{ $item->special_offer ? 'checked' : '' }} name="special_offer" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" {{ $item->special_deals ? 'checked' : '' }} name="special_deals" value="1" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">Special Deals</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Save Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>


    <form action="{{ route('update.product.thambnail', $item->id) }}" method="Post" enctype="multipart/form-data">
        @method('Put')
        @csrf

        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Update Main Image Thambnail</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Chose Thambnail Image</label>
                        <div class="mb-3">
                            <img src="{{ asset($item->thambnail) }}" alt="" style="width: 100px; height: 100px;">
                        </div>
                        <input name="thambnail" class="form-control" type="file" id="formFile">
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>


    <div class="card">
        <div class="card-body">
            <table class="table mb-0 table-striped">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Image</th>
                    <th scope="col">Change Image</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <form action="{{ route('update.product.MultiImage', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("Put")

                    <tbody>
                    @foreach($multi_imgs as $key => $item)
                        <tr>
                            <th>{{ $key+1 }}</th>
                            <td><img src="{{ asset($item->photo_name) }}" alt="" style="height: 70px; width: 90px;"></td>
                            <td><input type="file" class="form-group" name="multi_img[{{$item->id}}]"> </td>
                            <td>
                                <button class="btn btn-primary" type="submit">Update Image</button>
                                <a href="#" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </form>
            </table>
        </div>
    </div>


    <script>

        function mainThamUrl(input){
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>


    <script>

        $(document).ready(function(){
            $('#multiImg').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });

    </script>

    <script>

        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function(){
                var category_id = $(this).val();
                if (category_id){
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success:function (data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>')
                            });
                        }
                    });
                }else{
                    alert('danger');
                    console.log('hello')
                }
            })
        })

    </script>

@endsection

