@extends('admin.admin_dashboard')
@section('admin')
    <script src="{{ asset('MyEdit/js/jquery.min.js') }}"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Brand</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" action="{{ route('store.brand') }}" method="post" enctype="multipart/form-data">
                                    @method('post')
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required />
                                            @error('name')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" id="image" name="image" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ asset('upload/no_image.jpg') }}" alt="Admin" class="img-fit" style="width: 100px; height: 100px;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function (){--}}
{{--            $('#myForm').validate(function (){--}}
{{--                rules: {--}}
{{--                    brand_name: {--}}
{{--                        required: true;--}}
{{--                    }--}}
{{--                },--}}
{{--                messages:{--}}
{{--                    brand_name: {--}}
{{--                        required: 'Please Enter Brand';--}}
{{--                    }--}}
{{--                },--}}
{{--                errorElement: 'span',--}}
{{--                errorPlacement: function(error, element){--}}
{{--                    error.addClass('invalid-feedback')--}}
{{--                    element.closest('.form-group').append(error);--}}
{{--                },--}}
{{--                highlight: function(element, errorClass, validClass){--}}
{{--                    $(element).addClass('is-invalid');--}}
{{--                },--}}
{{--                unhighlight: function(element, errorClass, validClass) {--}}
{{--                    $(element).addClass('is-invalid');--}}
{{--                },--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <script type="text/javascript">
        $(document).ready(function (){
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
