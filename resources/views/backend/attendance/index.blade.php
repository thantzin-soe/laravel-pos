@extends('admin_layouts.admin_dashboard')

@section('styles')
<link rel="stylesheet" href="{{asset('backend/assets/css/attend.css')}}">
<style>
   .switch-toggle{
      width: auto;
   }
   .switch-toggle label:not(.disabled){
   cursor: pointer;
   }
   .switch-candy a{
      border: 1px solid #333;
      border-radius: 3px;
      background-color: white;
      background-image: -webkit-linear-gradient(top,rgba(255, 255, 255, 0.2), transparent);
      background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), transparent);
   }
   .switch-toggle.switch-candy, .switch-light.switch-candy > span{
      background-color: #5a6268;
      border-radius: 3px;
      box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.2);
   }
</style>
@endsection

@section('content')

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
<div class="content">
   <!-- Start Content-->
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <h4>
                        {{-- <a href="" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i> Employee Attendance List</a> --}}
                     </h4>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title --> 
      <div class="row">
         <div class="col-12">
            <div class="card">

               <div class="card-body">
                  <form action="{{ route('attendances.save') }}" method="post" id="myForm">
                     @csrf
                     <div class="form-group col-md-4">
                        <label for="date" class="control-label">Attendance Date</label>
                        <input type="date" name="date" id="date" class="checkdate form-control form-control-sm singledatepicker mt-2 mb-2" placeholder="Attendance Date" autocomplete="off">
                     </div>
                     <table class="table sm table-bordered table-striped dt-responsive attendance_datatable" style="width: 100%">
                        <thead>
                           <tr>
                              <th rowspan="2" class="text-center" style="vertical-align: middle">No</th>
                              <th rowspan="2" class="text-center" style="vertical-align: middle">Name</th>
                              <th rowspan="2" class="text-center" style="vertical-align: middle">Image</th>
                              <th colspan="3" class="text-center" style="vertical-align: middle">Attendance Status</th>
                           </tr>
                           <tr>
                              <th class="text-center btn absent_all" style="display: table-cell;background-color:#114190">Absent</th>
                              <th class="text-center btn present_all" style="display: table-cell;background-color:#114190">Present</th>
                              <th class="text-center btn leave_all" style="display: table-cell;background-color:#114190">Leave</th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                     <button type="submit" class="btn btn-success btn-sm"> Submit </button>
                  </form>
               </div>
               <!-- end card body-->
               
            </div>
            <!-- end card -->
         </div>
         <!-- end col-->
      </div>
      <!-- end row-->
   </div>
   <!-- container -->
</div>
<!-- content -->

@endsection

@section('scripts')
<script type="text/javascript">
   $(document).on('click','.present',function(){
      $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
   });
   $(document).on('click','.leave',function(){
      $(this).parents('tr').find('.datetime').css('pointer-events','').css('background-color','white').css('color','#495057');
   });
   $(document).on('click','.absent',function(){
      $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
   });

   const dateControl = document.querySelector('#date');
   const date = new Date();
   dateControl.value = date.toISOString().substr(0, 10);
</script>
<script type="text/javascript">
   $(document).on('click','.present_all',function(){
      $("input[value=Present]").prop('checked',true);
      $('.datetime').css('ponter-events','none').css('background-color','#dee2e6').css('color','#495057');
   });
   $(document).on('click','.leave_all',function(){
      $("input[value=Leave]").prop('checked',true);
      $('.datetime').css('ponter-events','').css('background-color','white').css('color','#495057');
   });
   $(document).on('click','.absent_all',function(){
      $("input[value=Absent]").prop('checked',true);
      $('.datetime').css('ponter-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
   });

   $(document).on('click','.absent_all',function(){
      $("input[value=Absent]").prop('checked',true);
      $('.datetime').css('ponter-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
   });

</script>

<script type="text/javascript">
    $('.attendance_datatable').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $(".dataTables_wrapper .row:last-of-type").addClass("mt-3");
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('attendances.index') }}",
        columns: [
            {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'name', name: 'name', orderable: false},
            {data: 'image', name: 'image', orderable: false, 'searchable': false},
            {data: 'status', name: 'status', orderable: false, 'searchable': false},
        ],
        createdRow: function(row, data, dataIndex){
            $(row).attr('id', "div " + data.id);
            $(row).attr('class', "text-center");
            $(row).append("<input type='hidden' name='employee_id[]'' value='" + data.id + "' class='employee_id'>");

            // Add COLSPAN attribute
            $('td:eq(3)', row).attr('colspan', 3);
        },
        initComplete: function(settings, json) {
            $('.attendance_datatable thead th.absent_all').removeAttr("style");
            $('.attendance_datatable thead th.absent_all').css("display", "table-cell").css("background-color", "#114190");    
        }
    });

    

    $("#date").on("change", function(e){
        let date = new Date(e.target.value).toISOString().split('T')[0];
                
        if($.fn.DataTable.isDataTable('.attendance_datatable'))
        {
            $('.attendance_datatable').DataTable().destroy();
        }

        $('.attendance_datatable').DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                $(".dataTables_wrapper .row:last-of-type").addClass("mt-3");
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('attendances.index') }}?date=" + date,
            columns: [
                {data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                {data: 'name', name: 'name', orderable: false},
                {data: 'image', name: 'image', orderable: false, 'searchable': false},
                {data: 'status', name: 'status', orderable: false, 'searchable': false},
            ],
            createdRow: function(row, data, dataIndex){
                $(row).attr('id', "div " + data.id);
                $(row).attr('class', "text-center");
                $(row).append("<input type='hidden' name='employee_id[]'' value='" + data.id + "' class='employee_id'>");

                // Add COLSPAN attribute
                $('td:eq(3)', row).attr('colspan', 3);
            },
            initComplete: function(settings, json) {
                $('.attendance_datatable thead th.present_all').removeAttr("style");
                $('.attendance_datatable thead th.present_all').css("display", "table-cell").css("background-color", "#114190");    
            }
        });
    });
</script>
@endsection