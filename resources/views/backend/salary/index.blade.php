@extends('admin_layouts.admin_dashboard')

@section('content')
	<div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">
                                    <input type="month" class="form-control" id="month" name="month">
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">All Pay Salary</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table dt-responsive nowrap w-100 employee_datatable" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Salary</th>
                                        <th>Advance</th>
                                        <th>Due</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            
        </div> <!-- container -->

    </div> <!-- content -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            const monthControl = document.querySelector('#month');
            const date = new Date();
            const month = ("0" + (date.getMonth())).slice(-2);
            const year = date.getFullYear();
            monthControl.value = `${year}-${month}`;
            monthControl.max = `${year}-${month}`;

            $('.employee_datatable').DataTable({
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
                ajax: "{{ route('salaries.index') }}",
                columns: [
                    { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'name', name: 'name', orderable: false},
                    {data: 'month', name: 'month', orderable: false},
                    {data: 'salary', name: 'salary', orderable: false},
                    {
                        data: 'advance_salary.advance_salary', 
                        name: 'advance_salary'
                    },
                    {data: 'due_salary', name: 'due_salary'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $("#month").on("change", function(e){
                let date = new Date(e.target.value);
                let year = date.getFullYear();
                let month = date.toLocaleString('default', { month: 'long' });
                
                if($.fn.DataTable.isDataTable('.employee_datatable'))
                {
                    $('.employee_datatable').DataTable().destroy();
                }

                $('.employee_datatable').DataTable({
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
                    ajax: "{{ route('salaries.index') }}?month=" + month + "&year=" + year,
                    columns: [
                        { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                        {data: 'image', name: 'image', orderable: false, searchable: false},
                        {data: 'name', name: 'name', orderable: false},
                        {data: 'month', name: 'month', orderable: false},
                        {data: 'salary', name: 'salary', orderable: false},
                        {
                            data: 'advance_salary.advance_salary', 
                            name: 'advance_salary.advance_salary',
                            orderable: false, 
                            searchable: false
                        },
                        {data: 'due_salary', name: 'due_salary'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });
      });
</script>
@endsection