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
            <h3 class="card-title" style="font-size: 1.6em">Your Events</h3>
            <div class="card-tools">
                <a href="{{ url('add-event') }}" class="btn btn-success badge">Add <small><i
                            class="right fa fa-plus"></i></small></a>
                | <a onClick="multiTaskOperation('Delete',this)" data-taskurl="{{ url('event-multitask') }}"
                    data-original-title="Delete the selected records? " class="btn btn-danger badge">Delete <small><i
                            class="right fa fa-trash"></i></small></a>
                | <a onClick="multiTaskOperation('Activate',this)" data-taskurl="{{ url('event-multitask') }}"
                    data-original-title="Activate the selected records? " class="btn btn-info badge">Activate <small><i
                            class="right fa fa-check"></i></small></a>
                | <a onClick="multiTaskOperation('Block',this)" data-taskurl="{{ url('event-multitask') }}"
                    data-original-title="Block the selected records? " class="btn btn-warning badge">Block <small><i
                            class="right fa fa-ban"></i></small></a>

            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="example1" class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                    <tr>
                        <th width="5%">ID</th>
                        <th><i class="fa fa-image"></i></th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>No.Of Guests</th>
                        <th>Created @</th>
                        <th class="text-center">Action</th>
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
            ajax: "{{ route('userEventList') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'img'
                },
                {
                    data: 'eventTitle'
                },
                {
                    data: 'location'
                },
                {
                    data: 'date'
                },
                {
                    data: 'noOfGuest'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'action'
                },
                {
                    data: 'check'
                },
            ],
            columnDefs: [{
                    className: 'text-center',
                    targets: [1, 5,6,7,8]
                },
                {
                    orderable: false,
                    targets: [1,4,5,7,8]
                },

            ],
            
        });
    });
</script>

@endsection