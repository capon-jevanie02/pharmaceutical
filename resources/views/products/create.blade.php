@extends('dashboard.admin')

@section('content')
<br>
<br>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                   
                       
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                          </div>

                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Description</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                          </div>

                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                          </div>

                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                          </div>

                          
                        <div class="mt-2">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                  
@endsection
