<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <!-- <b>Version</b> 2.4.0 -->
  </div>
  <strong>Copyright &copy; {{date('Y')}}-{{date('Y')+1}} All rights
  reserved.</strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane" id="control-sidebar-home-tab">
      <h3 class="control-sidebar-heading">Recent Activity</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

              <p>Will be 23 on April 24th</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-user bg-yellow"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

              <p>New phone +1(800)555-1234</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

              <p>nora@example.com</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-file-code-o bg-green"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

              <p>Execution time 5 seconds</p>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

      <h3 class="control-sidebar-heading">Tasks Progress</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Custom Template Design
              <span class="label label-danger pull-right">70%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Update Resume
              <span class="label label-success pull-right">95%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Laravel Integration
              <span class="label label-warning pull-right">50%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Back End Framework
              <span class="label label-primary pull-right">68%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

    </div>
    <!-- /.tab-pane -->
    <!-- Stats tab content -->
    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
    <!-- /.tab-pane -->
    <!-- Settings tab content -->
    <div class="tab-pane" id="control-sidebar-settings-tab">
      <form method="post">
        <h3 class="control-sidebar-heading">General Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Report panel usage
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Some information about this general settings option
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Other sets of options are available
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Allow the user to show his name in blog posts
          </p>
        </div>
        <!-- /.form-group -->

        <h3 class="control-sidebar-heading">Chat Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Show me as online
            <input type="checkbox" class="pull-right" checked>
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Turn off notifications
            <input type="checkbox" class="pull-right">
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Delete chat history
            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
          </label>
        </div>
        <!-- /.form-group -->
      </form>
    </div>
    <!-- /.tab-pane -->
  </div>
</aside>
<!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 <script src="{{ asset("/admin_lte/bower_components/jquery/dist/jquery.min.js") }}"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="{{ asset("/admin_lte/bower_components/jquery-ui/jquery-ui.min.js") }}"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

 <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset("/admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<!-- Morris.js charts -->
<!--<script src="{{ asset("/admin_lte/bower_components/raphael/raphael.min.js") }}"></script>-->
<!--<script src="{{ asset("/admin_lte/bower_components/morris.js/morris.min.js") }}"></script>-->
<!-- Sparkline -->
<script src="{{ asset("/admin_lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js") }}"></script>
<!-- jvectormap -->
<script src="{{ asset("/admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js") }}"></script>
<script src="{{ asset("/admin_lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js") }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("/admin_lte/bower_components/jquery-knob/dist/jquery.knob.min.js") }}"></script>
<!-- daterangepicker -->
<script src="{{ asset("/admin_lte/bower_components/moment/min/moment.min.js") }}"></script>
<script src="{{ asset("/admin_lte/bower_components/bootstrap-daterangepicker/daterangepicker.js") }}"></script>
<!-- datepicker -->
<script src="{{ asset("/admin_lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset("/admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>

<!-- DataTables -->
<script src="{{ asset("/admin_lte/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("/admin_lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>

<!-- Slimscroll -->
<script src="{{ asset("/admin_lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset("/admin_lte/bower_components/fastclick/lib/fastclick.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("/admin_lte/dist/js/adminlte.min.js") }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="{{ asset("/admin_lte/dist/js/pages/dashboard.js") }}"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("/admin_lte/dist/js/demo.js") }}"></script>

<!-- Validation JS -->
<script src="{{ asset("/admin_lte/dist/js/jquery.validationEngine.min.js") }}"></script>

<script src="{{ asset("/admin_lte/dist/js/jquery.validationEngine-en.js") }}"></script>

<!-- Select2 -->
<script src="{{ asset("/admin_lte/bower_components/select2/dist/js/select2.full.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("/admin_lte/plugins/icheck-1.0.3/icheck.js") }}"></script>

<!-- CK Editor -->
<script src="{{ asset("/admin_lte/bower_components/ckeditor/ckeditor.js") }}"></script>
<script src="{{ asset("/admin_lte/ckfinder/ckfinder.js") }}"></script>
<script type="text/javascript">
$(function () {
  CKFinder.setupCKEditor( null, '{{ asset("/admin_lte/ckfinder/") }}' );
  /*CKEDITOR.on( 'dialogDefinition', function( ev )
  {
        // Take the dialog name and its definition from the event
        // data.
        var dialogName = ev.data.name;
        var dialogDefinition = ev.data.definition;

        // Check if the definition is from the dialog we're
        // interested on (the Link and Image dialog).
        if ( dialogName == 'image' )
        {
        // remove Upload tab
        dialogDefinition.removeContents( 'Upload' );
      }
  });*/
});
</script>
<script type="text/javascript">
/*CKEDITOR.editorConfig = function( config ) {
  config.toolbarGroups = [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
    { name: 'forms', groups: [ 'forms' ] },
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
    { name: 'links', groups: [ 'links' ] },
    { name: 'insert', groups: [ 'insert' ] },
    { name: 'styles', groups: [ 'styles' ] },
    { name: 'colors', groups: [ 'colors' ] },
    { name: 'tools', groups: [ 'tools' ] },
    { name: 'others', groups: [ 'others' ] },
    { name: 'about', groups: [ 'about' ] }
  ];

  config.removeButtons = 'Form,Checkbox,Radio,TextField,Textarea,Button,Select,ImageButton,HiddenField,Templates,NewPage,Strike,Subscript,Superscript,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Flash,Table,Smiley,SpecialChar,PageBreak,Iframe,Maximize,ShowBlocks,About,Preview';
};
CKEDITOR.replace( 'ckeditor1',
                        {
                            toolbar : 'Basic', 
                            uiColor : '#9AB8F3'
                        });*/
/*CKEDITOR.config.toolbar = [
   ['Styles','Format','Font','FontSize'],
   '/',
   ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
   '/',
   ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
   ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
] ;*/
</script>
<script type="text/javascript">
/*var toolbarGroups1 = [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
    { name: 'forms', groups: [ 'forms' ] },
    '/',
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
    { name: 'links', groups: [ 'links' ] },
    { name: 'insert', groups: [ 'insert' ] },
    '/',
    { name: 'styles', groups: [ 'styles' ] },
    { name: 'colors', groups: [ 'colors' ] },
    { name: 'tools', groups: [ 'tools' ] },
    { name: 'others', groups: [ 'others' ] },
    { name: 'about', groups: [ 'about' ] }
];
var toolbarGroups = [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
    //{ name: 'forms', groups: [ 'forms' ] },
    { name: 'basicstyles', groups: [ 'basicstyles' ] },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'align' ] },
    { name: 'links', groups: [ 'links' ] },
    { name: 'insert', groups: [ 'insert' ] },
    { name: 'styles', groups: [ 'styles' ] },
    { name: 'colors', groups: [ 'colors' ] },
    { name: 'tools', groups: [ 'tools' ] },
    //{ name: 'others', groups: [ 'others' ] }
];

CKEDITOR.replace( 'ckeditor_custom',{
  /*toolbar: [{ name: 'document', items : [ 'Source','Preview' ] },
            { name: 'basicstyles', items : [ 'Bold','Italic' ] },
            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
            { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
            
            { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
            { name: 'insert', items :[ 'Image','HorizontalRule','Iframe' ] },
            { name: 'links', items : [ 'Link','Unlink' ] },
            { name: 'tools', items : [ 'Maximize' ] }
],*/
/*  extraPlugins: 'imageuploader',
  // uiColor : '#9AB8F3',
  toolbarGroups,
});*/
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>

<script type="text/javascript">

  function filter_array(test_array) {
    var index = -1,
    arr_length = test_array ? test_array.length : 0,
    resIndex = -1,
    result = [];

    while (++index < arr_length) {
      var value = test_array[index];

      if (value) {
        result[++resIndex] = value;
      }
    }

    return result;
  }


  jQuery(".formvalidation").validationEngine('attach', {

    relative: true,

    overflownDIV:"#divOverflown",

    promptPosition:"topLeft"

  });

  if($(".module_name").length>0)
  {
    $(".module_name").blur(function(){
      if($(".module_slug").val().trim()=="")
      {
        var slug_array = $(".module_name").val().trim().replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ').toLowerCase().split(" ");
        slug_array = filter_array(slug_array);

        $(".module_slug").val(slug_array.join("-"));
      }
    });
  }
  if($(".module_slug").length>0)
  {
    $(".module_slug").blur(function(){
      if($(".module_slug").val().trim()=="")
      {
        var slug_array = $(".module_name").val().trim().replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ').toLowerCase().split(" ");
        slug_array = filter_array(slug_array);

        $(".module_slug").val(slug_array.join("-"));
      }
      else
      {
        var slug_array = $(".module_slug").val().trim().replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ').toLowerCase().split(" ");
        slug_array = filter_array(slug_array);

        $(".module_slug").val(slug_array.join("-"));

      }
    });
  }

  $(function(){
    $(".select2").select2();

    if($(".datepicker").length>0)
    {
      $(".datepicker").datepicker({
        todayHighlight:true,
        format:'mm/dd/yyyy',
        autoclose:true
      });
    }

    $('.from_date').datepicker({
// weekStart: 1,
// startDate: '01/01/2012',
// endDate: FromEndDate,
        endDate: '+0D',
        todayHighlight:true,
        format:'mm/dd/yyyy',
        autoclose: true
    }).on('changeDate', function (selected) {
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.to_date').datepicker('setStartDate', startDate);
    });
    $('.to_date').datepicker({
        // weekStart: 1,
        // startDate: startDate,
        endDate: '+0D',
        todayHighlight:true,
        format:'mm/dd/yyyy',
        autoclose: true,
        // maxDate : '+1D',
    }).on('changeDate', function (selected) {
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('.from_date').datepicker('setEndDate', FromEndDate);
    });

  });

</script>

<script type="text/javascript">
 $(document).ready(function () { 
    $(".custom_phone").keyup(function (e) { 
      var value = $(".custom_phone").val(); 
    if (e.key.match(/[0-9]/) == null) { 
      value = value.replace(e.key, ""); 
      $(".custom_phone").val(value); 
      return; 
    } 
 
    if (value.length == 3) { 
      $(".custom_phone").val(value + "-") 
    } 
    if (value.length == 7) { 
      $(".custom_phone").val(value + "-") 
    } 
  }); 
}); 
</script>

@yield('more-scripts')

<style type="text/css">
table.dataTable thead .sorting::after, table.dataTable thead .sorting_asc::after, table.dataTable thead .sorting_desc::after, table.dataTable thead .sorting_asc_disabled::after, table.dataTable thead .sorting_desc_disabled::after{
  top: 0px;
  right: -20px;
}
table.dataTable thead a{
  display: block;
  width: calc(100% - 20px);
  color: #333;
  min-width: 30px;
}
</style>

</body>
</html>