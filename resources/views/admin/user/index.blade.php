@include('admin.header')

@include('admin.sidebar')
@php
$user_status_array = unserialize(User_Status_Array);
@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Users <!--<button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('/admin/user/export') }}'" title="Export Active User">Export</button>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Users</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    @if($errors->any())   
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
      @foreach ($errors->all() as $error)
      {{ $error }}<br>
      @endforeach
    </div>
    @endif

   @if (session()->has('delete_success'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    User has been deleted successfully.
  </div>
  @endif
   @if (session()->has('status_success'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    User Status is updated successfully.
  </div>
  @endif
   @if (session()->has('message'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    {{ Session::get('message') }}
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

        <table id="example1" class="table table-bordered table-hover dataTable">
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

          @if ($users->count() > 0)
           @foreach($users as $user)

           <tr>
            @foreach($column_array as $key => $value)
              
              @if ($key=='first_name')
                <td>{!! $user->$key.' '.$user->last_name !!}</td>
              @elseif ($key=='created_at')              
                <td>{!! date_convert($user->$key,3) !!}</td>
              @elseif ($key=='status')              
                <td>{!! $user_status_array[$user->$key] !!}</td>
              @elseif($key=='last_login')
                <td>{!! date_convert($user->$key, 4) !!}</td>
              @else
                <td>{{ $user->$key }}</td>
              @endif

              
            @endforeach

            <td>
              @if( $user->role_id=='3')
              <!--<a href="{{ url('/admin/user/view/'.$user->id) }}" title="View"><i class="fa fa-fw fa-eye"></i></a>-->
              @endif
              <a href="{{ url('/admin/user/edit/'.$user->id) }}" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
              <a href="{{ url('/admin/user/delete/'.$user->id) }}" onclick="return confirm('Are you sure?');" title="Delete"><i class="fa fa-fw fa-close"></i></a>
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

      <!--{{ $users->links() }}-->

      {{$users->appends(request()->input())->links()}}

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


@section('more-scripts')

<script type="text/javascript">


</script>

@stop


@include('admin.footer')

