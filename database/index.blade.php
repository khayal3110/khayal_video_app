@extends('layouts.admin')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users List</h1>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4 position-relative">

                <div class="search-form p-4">
                    <form method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" id="keyword" name="keyword" value="{{ $keyword }}" placeholder="Type here..." />
                            <button type="submit" class="btn btn-primary seacrh-btn input-group-text px-3 rounded-0">Search</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="table-responsive">
                    <table class="table mb-0 table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-uppercase">id</th>
                                <th class="text-uppercase">Name</th>
                                <th class="text-uppercase">Username</th>
                                <th class="text-uppercase">Email</th>
                                <th class="text-uppercase">Phone</th>
                                <th class="text-uppercase">credit</th>
                                <th class="text-uppercase">Role</th>
                                <th class="text-uppercase">Register Date</th>
                                <th class="text-uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($users))
                            @foreach($users as $key => $value)
                            <tr>
                                <td class="text-capitalize">{{ $value->id }}</td>
                                <td class="text-capitalize">{{ $value->first_name }} {{ $value->last_name }}</td>
                                <td>{{ $value->username }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $value->credit }}</td>
                                @if($value->status==0)
                                <td class="text-capitalize"><span class="badge bg-info">{{ $value->role}}</span></td>
                                @elseif($value->status=='completed')
                                <td class="text-capitalize"><span class="badge bg-success">Customer</span></td>     
                                @endif
                                <td>{{ date('l jS \of F Y h:i:s A', strtotime($value->created_at)) }}</td>
                                
                                <td>
                                    {{-- <div class="dropdown">
                                        <button type="button" class="p-0 btn btn-primary dropdown-btn" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu py-0" style="min-width:100px">
                                            <li><a class="dropdown-item px-2" href="{{ route('edit-user', [$value->id]) }}">Edit</a></li>
                                            <li><a class="dropdown-item delete-btn  px-2" data-id="{{ $value->id }}" href="javascript:;">Delete</a></li>
                                            <li>
                                                <a href="javascript:;" class="assign_affiliate dropdown-item asign-btn px-2 text-capitalize" data-bs-toggle="modal" data-bs-target="#exampleModal" data-user="{{ $value->id }}">asign affilate</a>
                                            </li>
                                        </ul>
                                    </div> --}}
                                    <div class="d-flex">
                                        <a class="btn btn-success me-1" href="{{ route('edit-user', [$value->id]) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger delete-btn  me-1" data-id="{{ $value->id }}" href="javascript:;">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a href="javascript:;" class="assign_affiliate btn btn-info text-capitalize" data-bs-toggle="modal" data-bs-target="#exampleModal" data-user="{{ $value->id }}">
                                            <span class="fa fa-users" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Assign Affiliate"></span>
                                        </a>
                                        <a href="javascript:;" data-user="{{ $value->id }}" class="credit-btn btn btn-success text-capitalize credit" data-bs-toggle="modal" data-bs-target="#exModals">
                                            <i class="fa fa-credit-card"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" style="text-align: center;"> Records not found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $users->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel">Assign Affiliate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:;" method="post" id="affiliate_form">
                <div class="modal-body">
                    <input name="user_id" id="affiliate_user_id" type="hidden"/>
                    <input class="form-control" id="affiliate" name="affiliate" type="number" required/>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <button type="button" class="btn py-2 btn-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn py-2 btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add Credit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:;" method="post" id="credit_form">
                <div class="modal-body">
                    <input type="hidden" name="id" id="credit_user_id"/>
                    <input class="form-control" id="credit" name="credit" type="number" required/>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <button type="button" class="btn py-2 btn-primary text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn py-2 btn-primary text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('body').on('click', '.delete-btn', function(){
            var id = $(this).data('id');
            swal("Are You want To Delete", {
                dangerMode: true,
                buttons: true,
            }).then(function (result) {
                if (result == true) {
                    var ajaxurl = base_url+'/user/delete';
                    $('.ajax-loader').show();
                    var request = $.ajax({
                        url: ajaxurl,
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        },
                        data: {id:id},
                        dataType: "json"
                    });
                    request.done(function(response) {
                    $('.ajax-loader').hide();
                        if(response.sts == false){
                            toastr["error"](response.msg);
                        } 
                        else{
                            window.location.reload();
                        }
                    });
                    request.fail(function(jqXHR, textStatus) {
                        $('.ajax-loader').hide();
                        var error = JSON.parse(jqXHR.responseText);
                        if(error.message == 'Unauthenticated.'){
                            setTimeout(function() {  window.location.href = base_url+'/login'; }, 2000); 
                        }
                        toastr["error"](error.message);

                    }); 
                }
            });
        });

        $(document).on('click', '.assign_affiliate ', function(e){
            $('#affiliate_user_id').val($(this).data('user'));
            console.log($(this).data('user'));
        })

        $(document).on('submit', '#affiliate_form', function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $('.ajax-loader').show();
            var request = $.ajax({
                url: base_url+'/api/assign-affiliate',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType:false,
                processData:false,
                dataType: "json"
            }).done(function(response) {
                console.log(response);
                $('.ajax-loader').hide();
                if(response.sts == false){
                    toastr["error"](response.msg);
                }else{
                    toastr["success"](response.msg);
                    $('#exampleModal').modal('hide');
                    window.location.reload();
                }
            }).fail(function(jqXHR, textStatus) {
                $('.ajax-loader').hide();
                var error = JSON.parse(jqXHR.responseText);
                toastr["error"](error.message);
            }); 
        })
    });


    $(document).on('click', '.credit-btn ', function(e){
        $('#credit_user_id').val($(this).data('user'));
    })
    
    $(document).on('submit', '#credit_form', function(e){
        e.preventDefault();
        let formData = new FormData(this);
        var request = $.ajax({
            url: base_url+'/admin/assign-credit',
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType:false,
            processData:false,
            dataType: "json"
        }).done(function(res) {
            if(res.sts == false){
                toastr["error"](res.msg);
            }else{
                toastr["success"](res.msg);
                $('#exModals').modal('hide');
                window.location.reload();
            }
        }).fail(function(jqXHR, textStatus) {
            $('.ajax-loader').hide();
            var error = JSON.parse(jqXHR.responseText);
            toastr["error"](error.message);
        }); 
    });
</script>
@endsection