@if(count($world_leading_brands) > 0)
<section aria-label="section" class="pt40 pb40 text-light" data-bgcolor="#111111">
  <div class="container">
    <h3 class="mb-4">{{ __('messages.in_collaboration_with') }}</h3>
  </div>
  <div class="wow fadeInRight d-flex">
    <div class="de-marquee-list">
      <div class="d-item">
        @foreach($world_leading_brands as $world_leading_brand)
        <span class="d-item-txt">
          <a href="{{ $world_leading_brand->link }}" target="_blank">
            {{ $world_leading_brand->title }}
            <!-- <img 
              src = "/back/img/world-leading-brands/{{ $world_leading_brand->image }}"
              width = "40px"
            /> -->
        </a>
        </span>
          <span class="d-item-display">
            <i class="d-item-dot"></i>
          </span>
        @endforeach
        @foreach($world_leading_brands as $world_leading_brand)
        <span class="d-item-txt">
          <a href="{{ $world_leading_brand->link }}" target="_blank">
          {{ $world_leading_brand->title }}
            <!-- <img 
              src = "/back/img/world-leading-brands/{{ $world_leading_brand->image }}"
              width = "40px"
            /> -->
        </a>
        </span>
          <span class="d-item-display">
            <i class="d-item-dot"></i>
          </span>
        @endforeach
        </div>
    </div>

    <div class="de-marquee-list">
      <div class="d-item">
      @foreach($world_leading_brands as $world_leading_brand)
        <span class="d-item-txt">
          <a href="{{ $world_leading_brand->link }}" target="_blank">
          {{ $world_leading_brand->title }}
            <!-- <img 
              src = "/back/img/world-leading-brands/{{ $world_leading_brand->image }}"
              width = "40px"
            /> -->
        </a>
        </span>
          <span class="d-item-display">
            <i class="d-item-dot"></i>
          </span>
        @endforeach
        @foreach($world_leading_brands as $world_leading_brand)
        <span class="d-item-txt">
          <a href="{{ $world_leading_brand->link }}" target="_blank">
          {{ $world_leading_brand->title }}
            <!-- <img 
              src = "/back/img/world-leading-brands/{{ $world_leading_brand->image }}"
              width = "40px"
            /> -->
        </a>
        </span>
          <span class="d-item-display">
            <i class="d-item-dot"></i>
          </span>
        @endforeach
        </div>
    </div>
  </div>
</section>
@endif