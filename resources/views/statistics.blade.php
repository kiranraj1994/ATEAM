@extends('layouts.site')
@section('metaTitle')
@section('metaKey')
@section('metaDescription')
@section('canonicalUrl')
@section('content')


<div class="container">
  <div class="row mt20">
    <div class="col-md-12">
      <h1 class="main-head mt10">Statistics</h1>
    </div>

    <div class="col-md-6">
        <table class="table table-bordered table-sripped">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>User Name</th>
                    <th>Event Count</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $userItem)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$userItem->name}}</td>
                    <td>{{$userItem->get_event_count}}</td>
                </tr>
                @empty
                    
                @endforelse
                
            </tbody>
        </table>
    </div>

    <div class="col-md-6">
        <table class="table table-bordered table-sripped">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>User Name</th>
                    <th>Average Events</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $userItem)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$userItem->name}}</td>
                    <td>{{round((($userItem->get_event_count / $totalEvents) * 100),2)}} %</td>
                </tr>
                @empty
                    
                @endforelse
                
            </tbody>
        </table>
    </div>


  </div>
  
</div>


@endsection