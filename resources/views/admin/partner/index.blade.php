@include('admin.header')

@include('admin.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Partners
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Partners</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

   @if (session()->has('delete_success'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    Partner has been deleted successfully.
  </div>
  @endif
   @if (session()->has('status_success'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    Partner Status is updated successfully.
  </div>
  @endif
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
       <div class="box-header">
        <h3 class="box-title">&nbsp;</h3>
        <div class="box-tools">
          <form action="">
            <div class="input-group input-group-sm" style="width: 150px;">

              <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="{{ $search }}">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>

            </div>
          </form>
        </div>

      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">

        <table id="example2" class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
              @foreach($column_array as $key => $value)
              <th>
                <a href="{{ $sorting_array[$key]['sorting_url'] }}" class="{{ $sorting_array[$key]['sorting_class'] }}">{{$value}}</a>
              </th>
              @endforeach
              <th>
                Action
              </th>
            </tr>
          </thead>
          <tbody>

          @if ($partners->count() > 0)
           @foreach($partners as $partner)

           <tr>
            @foreach($column_array as $key => $value)

              @if ($key=='created_at')              
                <td>{!! date_convert($partner->$key,3) !!}</td>
              @elseif ($key=='image') 
                <td>@if($partner->image && File::exists(public_path('uploads/'.$partner->image)) ) <img src="{{ asset('/uploads/'.$partner->image) }}" style="max-width: 200px;">@endif</td>
              @else
                <td>{{ $partner->$key }}</td>
              @endif

            @endforeach

            <td>
              <a href="{{ url('/admin/partner/edit/'.$partner->id) }}" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
              <a href="{{ url('/admin/partner/status/'.$partner->id.'/'.$partner->status) }}" title="Status"><i class="fa fa-fw fa-lightbulb-o {{$partner->status!=1?'inactive':''}}"></i></a>
              <a href="{{ url('/admin/partner/delete/'.$partner->id) }}" onclick="return confirm('Are you sure?');" title="Delete"><i class="fa fa-fw fa-close"></i></a>
            </td>

          </tr>
          @endforeach

          @else

          <tr>
            <td colspan="<?php echo count($column_array)+1;?>" align="middle">No Data Found</td>
          </tr>

          @endif
        </tbody>

      </table>

      <!--{{ $partners->links() }}-->

      {{$partners->appends(request()->input())->links()}}

          <!--{{ Request::query('orderby') }}<br>
          {{ Request()->orderby }}<br>
          {{ app('request')->input('orderby') }}-->

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->


@include('admin.footer')
