@extends('layouts.layout')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">            
          </div>
          
        <div class="card">
          <div class="card-header">
            @if(session()->has('success'))
              
              <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <div>Profile updated successfully</div>
              </div>
              @endif
              @if(session()->has('deleted'))
              
              <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <div>Profile deleted successfully</div>
              </div>
              @endif
            <div class="row">
              <div class="col-md-10">
                <h3 class="card-title">Employee Details</h3>
              </div>
              <div class="col-md-2">
                <a href="{{route('employee.create')}}" class="btn btn-primary">Add Employee</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Emp ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
              </thead>
              <tbody>
              @forelse($employees as $employee)
                <tr>
                  <td>{{$employee->id}}</td>
                  <td>{{$employee->name}}
                  </td>
                  <td>{{$employee->email}}</td>
                  <td> {{$employee->designation->name}}</td>
                  <td><a href="{{route('employee.edit',$employee->id)}}" class="btn btn-primary">Edit</a></td>
                  <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$employee->id}})">Delete</button></td></td>
                </tr>                  
                @empty
                <tr>
                    <td colspan="6"><center>No Data For Listing</center></td>
                 </tr>                      
                @endforelse
              </tbody>
             
            </table>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="deleteModal">
                <form method="POST" action="" id="delete-form"> 
                        @method('DELETE')
                        @csrf    
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Delete Employee</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <p>Are You Sure Want To Delete ?</p>
                        </div>
                        <div class="modal-footer">
                         
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" onclick="formSubmit()">Delete</button>
                        </div>
                      </div>
                  </div>
                </form>
             </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
@endsection
@section('scripts')
<!-- DataTables  & Plugins -->

<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  function deleteData(id)
    {
        var employee_id = id;
        var url = '{{ route("employee.destroy", ":id") }}';
        url = url.replace(':id', employee_id);
        jQuery("#delete-form").attr('action', url);
        
    }
</script>
@endsection