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
                <h3 class="card-title">Add Employee</h3>
              </div>
              <!-- <form> -->
                <div class="card-body">
                  <form method="POST" action="{{route('employee.store')}}" id="create-employee-form" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                    </div>
                    @if ($errors->has('email'))
                        <strong class="text-danger">Email already used</strong>
                    @endif
                    <div class="form-group">
                      <label>Designation</label>
                      <select class="form-control select2" style="width: 100%;" name="designation" id="designation" required>
                          <option selected="selected" disabled>Please select Designation</option>
                         @foreach($designation as $des)
                          <option value="{{$des->id}}">{{$des->name}}</option>
                         @endforeach
                      </select>
                      </div>

                    <div class="form-group">
                      <label for="exampleInputFile">Photo</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="photo" name="photo">
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
                    <input type="submit" value="Submit" class="btn btn-success">
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

