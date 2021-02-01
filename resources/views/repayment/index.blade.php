@if($repayments)
        <div class="row">
          <div class="col-md-4">
            <ul class="nav nav-pills nav-stacked" id="myTabs">
              <?php $i = 1; ?>
              @foreach($repayments as $key => $repayment)
                <li role="presentation" class="{{ $i==1 ? 'active' : '' }}">
                  <a href="#home{{$i}}" aria-controls="home{{$i}}" role="tab" data-toggle="tab">
                    <b class="btn btn-xs btn-warning" style="border-radius: 50%">{{$i}}</b> {{ $repayment->p_name }}</a>
                </li>
              <?php $i++ ?>
               @endforeach
            </ul>
          </div>
          <!-- Content -->
          <div class="col-md-8">
            <div class="tab-content">
              <?php $i = 1; ?>
               @foreach($repayments as $key => $repayment)
                  <div role="tabpanel" class="tab-pane {{ $i==1 ? 'active' : '' }}" id="home{{$i}}">
                      <h3 style="color: red;font-weight: bold;">{{ $repayment->p_name }}</h3><br>
                      {!! $repayment->p_content !!}
                      @if($repayment->p_avatar)
                          <img src="{{ pare_url_file($repayment->p_avatar) }}" style="width: 100%;height: 100px">
                      @endif
                  </div>
                  <?php $i++ ?>
                @endforeach
            </div>
          </div>
        </div>
@endif

