@extends('layouts.layout')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Employee</h3>
          </div>
          <!-- <form> -->
            <div class="card-body">
              <form method="POST" action="{{route('employee.update', $employee->id)}}" id="create-student-form" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$employee->name}}" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name="email" id="email"  value="{{$employee->email}}" placeholder="Enter email" value="sumi@gmail.com" required>
                  @if ($errors->has('email'))
                      <strong class="text-danger">Email already used</strong>
                  @endif
                </div>
                <div class="form-group">
                  <label>Designation</label>
                  <select class="form-control select2" style="width: 100%;" name="designation" id="designation" required>
                      <option selected="selected" disabled>Please select Designation</option>
                     @foreach($designations as $designation)
                     <option value="{{$designation->id}}" {{ $designation->id == $employee->designation_id ? 'selected' : '' }}>{{$designation->name}}</option>

                     @endforeach
                  </select>
                  </div>
                  <img src="{{url('/images/'.$employee->photo)}}" style='width:50%;height: 180px;'>

                <div class="form-group">
                  <label for="exampleInputFile">Photo</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo" accept="image/jepg, image/png, image/jpg,image/gif,image/svg">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
                @if ($errors->has('photo'))
                      <strong class="text-danger">Select image with size max 5mb</strong>
                @endif
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="{{route('employee.index')}}" class="btn btn-primary">Cancel</a>
                <input type="submit"  value="Update" class="btn btn-success">
              </div>
            </form>
          <!-- </form> -->
        </div>

      </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection