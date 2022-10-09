@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>MARKS</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
            </div>
        </div>
        @include('layouts.alert')
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-outline-primary btn-lg pull-right btn-modal" data-href="{{ route('mark.create') }}">ADD <i class="fa fa-plus"></i></button>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Maths</th>
                                <th>Science</th>
                                <th>History</th>
                                <th>Term</th>
                                <th>Total Marks</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marks as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->student->name ?? '--' }}</td>
                                    <td>{{ $item->maths }}</td>
                                    <td>{{ $item->science }}</td>
                                    <td>{{ $item->history }}</td>
                                    <td>{{ $item->term->name ?? '--' }}</td>
                                    <td>{{ $item->maths + $item->science + $item->history }}</td>
                                    <td>{{ date("M d Y h:i A", strtotime($item->created_at)) }}</td>
                                    <td>
                                        <button class="btn btn-outline-secondary btn-sm edit-btn-modal" data-href="{{ route('mark.edit', $item->id) }}"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-outline-danger btn-sm delete-btn-modal" onclick="deleteRecord({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#mark-delete-modal"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
    <div class="modal fade add_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>


{{-- Mark delete modal starts --}}
    <div class="modal fade text-left" id="mark-delete-modal" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel120"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">
                        Delete Student
                    </h5>
                    <button type="button" class="close"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ url('mark') }}" method="post" id="removeForm">
                    <div class="modal-body">
                        Are you sure you want to delete this record?
                    </div> 
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-danger ml-1"
                            >
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Delete</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- Mark delete modal ends --}}
@endsection
@section('scripts')
    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

<script>
    $(document).on('click', '.btn-modal', function() {
        $('div.add_modal').load($(this).data('href'), function() {
            $(this).modal('show');
            $(document).unbind('submit').on('submit', 'form#createForm', function(e){
                e.preventDefault();
                $(this).find('button[type="submit"]').attr('disabled', true);
                var data = $(this).serialize();
                $.ajax({
                    method: "post",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success:function(result){
                        if(result.success == true){
                            toastr.success(result.msg);
                            $('.save_button').removeAttr('disabled');
                            $('div.add_modal').modal('hide');
                            setTimeout(function () {
                                location.reload(true);
                            }, 1500);
                        }else{
                            toastr.error(result.msg);
                            $('div.add_modal').modal('hide');
                        }
                    }
                });
            });
        });
    });
</script>

<script>
    $(document).on('click', '.edit-btn-modal', function() {
        $('div.edit_modal').load($(this).data('href'), function() {
            $(this).modal('show');
            $(document).unbind('submit').on('submit', 'form#editForm', function(e){
                e.preventDefault();
                $(this).find('button[type="submit"]').attr('disabled', true);
                var data = $(this).serialize();
                $.ajax({
                    method: "post",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success:function(result){
                        if(result.success == true){
                            toastr.success(result.msg);
                            $('.save_button').removeAttr('disabled');
                            $('div.edit_modal').modal('hide');
                            setTimeout(function () {
                                location.reload(true);
                            }, 1500);
                        }else{
                            toastr.error(result.msg);
                            $('div.edit_modal').modal('hide');
                        }
                    }
                });
            });
        });
    });
</script>

<script>
    function deleteRecord(id){
        $(document).unbind('submit').on('submit', 'form#removeForm', function(e){
            e.preventDefault();
            $(this).find('button[type="submit"]').attr('disabled', true);
            $.ajax({
                method: "DELETE",
                url: $(this).attr("action")+'/'+id,
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success:function(result){
                    if(result.success == true){
                        $('#student-delete-modal').modal('hide');
                        toastr.success(result.msg);
                        setTimeout(function () {
                            location.reload(true);
                        }, 1500);
                    }else{
                        $('#student-delete-modal').modal('hide');
                        toastr.error(result.msg);
                        setTimeout(function () {
                            location.reload(true);
                        }, 1500);
                    }
                }
            });
        });
    }
</script>
    
@endsection

