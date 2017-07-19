<div class="row">
    <!-- ./col -->
    <div class="col-sm-3">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <h3 id="count-user">0</h3>

          <p>Users</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="{{ route('admin.access.user.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-sm-3">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3 id="count-inquiry">0</h3>

          <p>Enquiries</p>
        </div>
        <div class="icon">
          <i class="fa fa-envelope"></i>
        </div>
        <a href="{{ route('admin.inquiry.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-sm-3">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3 id="count-product">0</h3>

          <p>Products</p>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-bag"></i>
        </div>
        <a href="{{ route('admin.product.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-sm-3">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3 id="count-project">0</h3>

          <p>Projects</p>
        </div>
        <div class="icon">
          <i class="fa fa-product-hunt"></i>
        </div>
        <a href="{{ route('admin.project.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    
    <!-- ./col -->
  </div>

@section('after-scripts')
    <script type="text/javascript" src="{{ asset('js/plugin/jquery.countto.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#count-user'      ).countTo({from: 0, to: '{{ $widget['users'        ] }}' });
            $('#count-inquiry').countTo({from: 0, to: '{{ $widget['inquiry'   ] }}' });
            $('#count-product').countTo({from: 0, to: '{{ $widget['product'   ] }}' });
            $('#count-project'  ).countTo({from: 0, to: '{{ $widget['project'       ] }}' });
        });
    </script>
@append
