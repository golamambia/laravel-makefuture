@include('admin.header')

@include('admin.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pages
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pages</li>
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
      Page has been deleted successfully.
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

                @if ($pages->count() > 0)
                @foreach($pages as $page)

                <tr>
                  @foreach($column_array as $key => $value)

                  <td>{{ $page->$key }}</td>

                  @endforeach

                  <td>
                    <a href="{{ url('/admin/page/edit/'.$page->id) }}" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                    @if($page->id>10)
                    <a href="{{ url('/admin/page/delete/'.$page->id) }}" onclick="return confirm('Are you sure?');" title="Delete"><i class="fa fa-fw fa-close"></i></a>
                    @endif
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

            <!--{{ $pages->links() }}-->

            {{$pages->appends(request()->input())->links()}}

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
