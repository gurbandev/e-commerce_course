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
                    <form action="{{ route('store.product') }}" method="Post" enctype="multipart/form-data">
                        @method('Post')
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label @error('name') is-invalid @enderror" required>Product Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               placeholder="Enter product name">
                                        @error('name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label @error('tags') is-invalid @enderror">Product Tags</label>
                                        <input type="text" name="tags" class="form-control visually-hidden"
                                               data-role="tagsinput" value="new product,top product">
                                        @error('tags')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label @error('size') is-invalid @enderror">Product Size</label>
                                        <input type="text" name="size" class="form-control visually-hidden"
                                               data-role="tagsinput" value="Small,Medium,Large">
                                        @error('size')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label @error('color') is-invalid @enderror">Product Color</label>
                                        <input type="text" name="color" class="form-control visually-hidden"
                                               data-role="tagsinput" value="Red,Green,Blue">
                                        @error('color')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="short_descp" class="form-label @error('short_descp') is-invalid @enderror" required>Short Description</label>
                                        <textarea class="form-control" name="short_descp" id="short_descp"
                                                  rows="3"></textarea>
                                        @error('short_descp')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="long_descp" class="form-label @error('long_descp') is-invalid @enderror">Long Description</label>
                                        <textarea class="form-control" name="long_descp" id="mytextarea"></textarea>
                                        @error('long_descp')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="text-center">
                                            <img src="" id="mainThmb" class="img-fluid my-2">
                                        </div>
                                        <div>
                                            <label for="formFile" class="form-label">Main Thambnail</label>
                                            <input type="file" name="thambnail" class="form-control @error('thambnail') is-invalid @enderror" id="formFile"
                                                   onchange="mainThamUrl(this)" required>
                                            @error('thambnail')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row justify-content-center my-2 mt-4" id="preview_img">

                                        </div>
                                        <label for="formFile" class="form-label">Multiple Image</label>
                                        <input type="file" class="form-control" name="multi_img[]" id="multiImg" multiple required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputPrice" class="form-label">Price</label>
                                            <input type="text" name="price" class="form-control" id="inputPrice" placeholder="00.00" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                            <input type="text" name="discount_price" class="form-control" id="inputCompareatprice" placeholder="00.00" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="code" class="form-control" id="inputCostPerPrice" placeholder="0000" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="qty" class="form-control" id="inputStarPoints" placeholder="00.00" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="brand" class="form-label">Product Brand</label>
                                            <select class="form-select" name="brand_id" id="brand" required>
                                                <option></option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="category" class="form-label">Product Category</label>
                                            <select class="form-select" name="category_id" id="category" required>
                                                <option></option>
                                                 @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="category" class="form-label">Product Subcategory</label>
                                            <select class="form-select" name="subcategory_id" id="subcategory" required>
                                                <option></option>

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
                                                <input type="checkbox" class="form-check-input" name="hot_deals" value="1" id="hot_deals">
                                                <label class="form-check-label" for="hot_deals">Hot deals</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="featured" value="1" id="featured">
                                                <label class="form-check-label" for="featured">Featured</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="special_offer" value="1" id="special_offer">
                                                <label class="form-check-label" for="special_offer">Special Offer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="special_deals" value="1" id="special_deals">
                                                <label class="form-check-label" for="special_deals">Special Deals</label>
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

