@extends('layouts.site')
@section('metaTitle')
@section('metaKey')
@section('metaDescription')
@section('canonicalUrl')
@section('content')


<div class="container">
  <div class="row mt20">
    <div class="col-md-6">
      <h1 class="main-head mt10">Events</h1>
    </div>

    <div class="col-md-6">
      <form class="form-inline my-2 my-lg-0 float-right">
        <label>Filter:  </label>
        <input id="eventDateFilter" name="eventDateFilter" type="text" class="form-control mr-sm-2">
        <input class="form-control mr-sm-2" type="text" id="searchBox" placeholder="Search">
        <button class="btn  badge btn-sm btn-danger clearFilter">Clear</button>
      </form>
    </div>
  </div>
  
  <div class="row eventDiv">
  </div>
  <div class="auto-load text-center mt20 mb20">
    <button class="btn btn-sm btn-primary loadMore">Load More</button>
  </div>
</div>
<!-- jQuery -->
<script src="{{ URL::asset('front/extras/jquery/jquery.min.js') }}"></script>
<script>
var ENDPOINT = "{{ url('/') }}";
var page = 1;

infinteLoadMore(page);

// LAZY LOADING START
$(".loadMore").click(function() {
        page++;
        infinteLoadMore(page);
});
$(".clearFilter").click(function() {
        page=1;
        $("#eventDateFilter").val("");
        $("#searchBox").val("");
        infinteLoadMore(page);
});

$("#searchBox").keyup(function(e){
    page=1;
    $(".eventDiv").empty();
    infinteLoadMore(page);
  
});


$("body").on('click','.applyBtn',function(e) {
    page=1;
    $(".eventDiv").empty();
    infinteLoadMore(page);
  
});

function infinteLoadMore(page) {
  let filterDate = $("#eventDateFilter").val();
  let searchKeyword     = $("#searchBox").val();

    $.ajax({
            url: ENDPOINT + "?page=" + page+"&searchKeyword="+searchKeyword+"&filterDate="+filterDate,
            datatype: "html",
            type: "get",
            beforeSend: function() {
                $("#loaderImage").removeClass("hide");
            },
            async: false,
        })
        .done(function(response) {
            if (response.length == 0 && page != 1) {
                $(".loadMore").hide();
                $("#loaderImage").addClass("hide");
                return;
            } else if (response.length == 0 && page == 1) {
                $(".eventDiv").empty();
                $(".eventDiv").append("<h4>No Data Found</h4>");
                $("#loaderImage").addClass("hide");
                return;
            }
            $(".eventDiv").append(response).show("slow");
            $("#loaderImage").addClass("hide");
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log("Server error occured");
        });
}
// LAZY LOADING END
</script>

@endsection