@extends('layouts.site')
@section('metaTitle')
@section('metaKey')
@section('metaDescription')
@section('canonicalUrl')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.6em">Invited Users To - {{ $eventTitle }} </h3>
            <div class="card-tools">
                <a href="{{ url('add-inviteUser').'/'.$id }}" class="btn btn-success badge">Invite Users <small><i
                            class="right fa fa-plus"></i></small></a>
                | <a onClick="multiTaskOperation('Delete',this)" data-taskurl="{{ url('inviteUser-multitask') }}"
                    data-original-title="Delete the selected records? " class="btn btn-danger badge">Delete <small><i
                            class="right fa fa-trash"></i></small></a>
                | <a class="btn btn-primary badge" href="{{ url('/dashboard') }}"> <small><i
                    class="right fa fa-angle-left"></i></small> Back </a>

            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="example1" class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Email Id</th>
                        <th>Invited On</th>
                        <th class="table-checkbox text-center align-middle" width="4%"><input type="checkbox"
                                class="group-checkable" data-set="#example1 .checkboxes" /></th>

                    </tr>
                    </tr>
                </thead>
            </table>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    $(function() {
        $('#example1').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    "url": "{{ route('ajaxinviteUserList') }}",
                    "data": function(data) {
                        data.eventId = "{{ $decid }}";
                    }
                },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'userEmail'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'check'
                },
            ],
            columnDefs: [{
                    className: 'text-center',
                    targets: [1, 2,3]
                },
                {
                    orderable: false,
                    targets: [3]
                },

            ],
            
        });
    });
</script>

@endsection