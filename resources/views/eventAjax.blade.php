@forelse ($events as $eventsItem)
<div class="col-md-6 mt10">
    <div class="shadow-box">
      <div class="detail-box animated fadeInUp">
        <div class="row">
          <div class="col-md-3">
            <a href="#"><img src="{{ asset('storage/media/' . $eventsItem->featuredImage) }}" alt="" class="img-responsive radius"></a>
          </div>
          <div class="col-md-9">
            <h2>
              <span class="location"><i class="fa fa-map-marker"></i> {{ $eventsItem->location }} </span> 
              <a href=""> {{ $eventsItem->eventTitle }} </a> 
            </h2>
            <p>{{ $eventsItem->eventDescription }}</p>
            <small><i class="fa fa-map"></i> {{ $eventsItem->address }}</small>
            <br/>
            <small><i class="fa fa-user"></i> Posted By: {{ $eventsItem->getUser->name }}</small>
            <br/>
            <small><i class="fa fa-user"></i> Invited Guests:  {{ count($eventsItem->getGuest) }}</small>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="" class="btn view-all"><i class="fa fa-calendar"></i> {{ dateFormatDMY($eventsItem->startDate) }} to {{ dateFormatDMY($eventsItem->endDate) }}  </a>
            </div>
        </div>
      </div>
    </div>
  </div>
@empty
    
@endforelse
