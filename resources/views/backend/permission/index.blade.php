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
                                    <a href="{{ route('permissions.create') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Permission</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">All Permission</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table dt-responsive nowrap w-100 category_datatable" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Group Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $key = $permissions->perPage() * ($permissions->currentPage() - 1);
                                    @endphp
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->group_name }}</td>
                                            <td>
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light"><i class="fa-solid fa-pencil"></i></a>
                                                <form class="permission-delete-{{ $permission->id }}" style="display:inline" method="POST" action="{{ route('permissions.destroy', $permission->id) }}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button id="delete" data-form="permission-delete-{{ $permission->id }}" type="submit" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $permissions->links() }}
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            
        </div> <!-- container -->

    </div> <!-- content -->
@endsection

{{-- @section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.category_datatable').DataTable({
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
                ajax: "{{ route('categories.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name', orderable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
      });
</script>
@endsection --}}