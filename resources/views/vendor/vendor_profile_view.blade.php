@extends('vendor.vendor_dashboard')
@section('vendor')
    <script src="{{ asset('MyEdit/js/jquery.min.js') }}"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vendor User Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Vendor Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ !empty($vendorData->photo) ? asset('upload/vendor_images/'.$vendorData->photo) : asset('upload/no_image.jpg') }}" alt="Vendor" class="rounded-circle p-1 bg-primary img-fit" width="110">
                                    <div class="mt-3">
                                        <h4>{{ $vendorData->name }}</h4>
                                        <p class="text-secondary mb-1">{{ $vendorData->email }}</p>
                                        <p class="text-muted font-size-sm">{{ $vendorData->address }}</p>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                                        <span class="text-secondary">https://codervent.com</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                                        <span class="text-secondary">codervent</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('vendor.profile.store') }}" method="post" enctype="multipart/form-data">
                                    @method('post')
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">User Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" id="username" name="username" class="form-control" value="{{ $vendorData->username }}" disabled />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Shope Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" id="name" name="name" class="form-control" value="{{ $vendorData->name }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" id="email" name="email" class="form-control" value="{{ $vendorData->email }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" id="phone" name="phone" class="form-control" value="{{ $vendorData->phone }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" id="address" name="address" class="form-control" value="{{ $vendorData->address }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Join Date</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select class="form-select" name="vendor_join" aria-label="Default select example">
                                                <option selected="">Open this select menu</option>
                                                <option value="2020" {{ $vendorData->vendor_join == 2020 ? 'selected' : '' }}>2020</option>
                                                <option value="2021" {{ $vendorData->vendor_join == 2021 ? 'selected' : '' }}>2021</option>
                                                <option value="2022" {{ $vendorData->vendor_join == 2022 ? 'selected' : '' }}>2022</option>
                                                <option value="2023" {{ $vendorData->vendor_join == 2023 ? 'selected' : '' }}>2023</option>
                                                <option value="2024" {{ $vendorData->vendor_join == 2024 ? 'selected' : '' }}>2024</option>
                                                <option value="2025" {{ $vendorData->vendor_join == 2025 ? 'selected' : '' }}>2025</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Info</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea class="form-control" id="inputAddress2" name="vendor_short_info" placeholder="Vendor Info" rows="3">{{ $vendorData->vendor_short_info }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" id="image" name="photo" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ !empty($vendorData->photo) ? asset('upload/vendor_images/'.$vendorData->photo) : asset('upload/no_image.jpg') }}" alt="Vendor" class="img-fit" style="width: 100px; height: 100px;">
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
