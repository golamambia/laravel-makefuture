@include('admin.header')

@include('admin.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      News
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">News</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

   @if (session()->has('delete_success'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    News has been deleted successfully.
  </div>
  @endif
   @if (session()->has('status_success'))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Success</h4>
    News Status is updated successfully.
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

          @if ($news->count() > 0)
           @foreach($news as $new)

           <tr>
            @foreach($column_array as $key => $value)

              @if ($key=='created_at')              
                <td>{!! date_convert($new->$key,3) !!}</td>
              @else
                <td>{{ $new->$key }}</td>
              @endif

            @endforeach

            <td>
              <a href="{{ url('/admin/news/edit/'.$new->id) }}" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
              <a href="{{ url('/admin/news/status/'.$new->id.'/'.$new->status) }}" title="Status"><i class="fa fa-fw fa-lightbulb-o {{$new->status!=1?'inactive':''}}"></i></a>
              <a href="{{ url('/admin/news/delete/'.$new->id) }}" onclick="return confirm('Are you sure?');" title="Delete"><i class="fa fa-fw fa-close"></i></a>
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

      <!--{{ $news->links() }}-->

      {{$news->appends(request()->input())->links()}}

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
