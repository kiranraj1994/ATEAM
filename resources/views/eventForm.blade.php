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
        action="@if ($id == '') {{ route('add-event-form') }} @else {{ route('update-event-form', $id) }} @endif"
        class="form-horizontal" id="eventForm" method="post" enctype="multipart/form-data">

        <div class="card">
            <div class="card-header card-header-sticky">
                <h3 class="card-title" style="font-size: 1.6em">Add Event
                <div class="card-tools float-right">
                    <button type="submit" name="add" class="btn btn-info btn-sm btn-badge">Save <i
                            class="fa fa-check"></i></button>
                    |
                    <a href="{{ url('dashboard') }}" class="btn btn-warning btn-sm btn-badge"><i
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
                            <label for="eventTitle" class="col-sm-2 col-form-label">Event Title<span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input id="eventTitle" value="{{ $eventTitle }}"
                                    name="eventTitle" type="text"
                                    class="form-control">
                                <span class="text-danger error-text eventTitle_err"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eventDescription" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-6">
                                <textarea id="eventDescription" 
                                    name="eventDescription"
                                    class="form-control">{{ $eventDescription }}</textarea>
                                <span class="text-danger error-text eventDescription_err"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eventDate" class="col-sm-2 col-form-label">Event Date<span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input id="eventDate" value="{{ $eventDate }}"
                                    name="eventDate" type="text"
                                    class="form-control">
                                <span class="text-danger error-text eventDate_err"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-sm-2 col-form-label">Location<span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input id="location" value="{{ $location }}"
                                    name="location" type="text"
                                    class="form-control">
                                <span class="text-danger error-text location_err"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-6">
                                <textarea id="address" 
                                    name="address"
                                    class="form-control">{{ $address }}</textarea>
                                <span class="text-danger error-text address_err"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                {{-- Image Section Start --}}
                                <div class="row imageSection">
                                    <div class="col-md-2">
                                    <label for="featuredImage" class="col-form-label">Featured Image</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="btn btn-sm btn-info" for="featuredImage">Upload File</label>
                                        <input id="featuredImage" name="featuredImage" type="file" class="form-control hide image"
                                            aria-required="true" aria-invalid="false">
                                        <span class="text-danger error-text featuredImage_err"></span>
                                    </div>
                
                                    <div class="col-md-8 previewBox">
                                        @if ($featuredImage!='')
                                            <img src="{{ asset('storage/media/' . $featuredImage) }}"
                                                class="preview-image-before-upload image" width="300px" />
                                        @else
                                            <img src="{{ asset('storage/media/placeholder.png') }}"
                                                class="preview-image-before-upload image" width="100px" />
                                        @endif
                                    </div>
                                </div>
                                {{-- Image Section END --}}
                            </div>
                        </div>

                    </div>
                    
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ $id }}" />
                        @if ($id != '')
                            <p class="text-right"><small><strong>Last Updated On:
                                        {{ $updated_at }}</strong></small></p>
                            <script>
                               
                            </script>
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