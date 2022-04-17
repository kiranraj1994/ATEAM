@extends('layouts.site')
@section('metaTitle')
@section('metaKey')
@section('metaDescription')
@section('canonicalUrl')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->
    <form
        action="@if ($id == '') {{ route('add-inviteUser-form') }} @else {{ route('update-inviteUser-form', $id) }} @endif"
        class="form-horizontal" id="eventForm" method="post" enctype="multipart/form-data">

        <div class="card">
            <div class="card-header card-header-sticky">
                <h3 class="card-title" style="font-size: 1.6em">Invite Users To - {{ $eventTitle }}
                <div class="card-tools float-right">
                    <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Invite <i
                            class="fa fa-check"></i></button>
                    |
                    <a href="{{ url('inviteUser').'/'.$eventId }}" class="btn btn-warning btn-sm btn-badge"><i
                            class="right fa fa-angle-left"></i> Back </a>
                </div>
            </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card card-info">
                    @csrf
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="userEmail" class="col-sm-2 col-form-label">User Email Id<span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input id="userEmail" value="{{ $userEmail }}"
                                    name="userEmail" type="text"
                                    class="form-control">
                                <span class="text-danger error-text userEmail_err"></span>
                            </div>
                        </div>
                        <small>* add mutiple emails by comma separated</small>
                        <input type="hidden" name="eventId" value="{{ $eventId }}"
                      
                      
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ $id }}" />
                        @if ($id != '')
                            <p class="text-right"><small><strong>Last Updated On:
                                        {{ $updated_at }}</strong></small></p>
                        @endif
                    </div>
                    <!-- /.card-footer -->

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </form>
</div>

@endsection