@if(count($team_members) > 0)
<section id="team" class="team">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="section-title" data-aos="fade-right">
              <h2>{{ __('messages.team') }}</h2>
              <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem.</p> -->
            </div>
          </div>
          <div class="col-lg-8">
            <div class="row">
            @foreach($team_members as $team_member)
              <div class="col-lg-6 mb-4">
                <div class="member" data-aos="zoom-in" data-aos-delay="100">
                  <div class="pic"><img alt="Image" src="/front/assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>{{ $team_member->name }} {{ $team_member->surname }}</h4>
                    <span>{{ $team_member->position }}</span>
                    <!-- <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p> -->
                    <div class="social">
                      <!-- <a aria-label="link" href=""><i class="ri-twitter-fill"></i></a>
                      <a aria-label="link" href=""><i class="ri-facebook-fill"></i></a>
                      <a aria-label="link" href=""><i class="ri-instagram-fill"></i></a> -->
                      <a aria-label="linkedin" href="{{ $team_member->linkedin }}"> <i class="ri-linkedin-box-fill"></i> </a>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
</section>
@endif