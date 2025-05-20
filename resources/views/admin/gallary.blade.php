<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="container-fluid">
        <h3 class="mb-4">Gallery</h3>

        <!-- Gallery Grid -->
        <div class="row mb-4">
          @foreach ($gallary as $item)
            <div class="col-md-4 mb-3">
              <div class="card">
                <img src="{{ asset('gallary/' . $item->image) }}" alt="Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                  <a class="btn btn-danger btn-sm" href="{{ route('gallery.delete', $item->id) }}">Delete Image</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Upload Form -->
        <form action="{{ url('/upload_gallary') }}" method="POST" enctype="multipart/form-data" class="mb-5">
          @csrf
          <div class="row align-items-center">
            <!-- Centered file input -->
            <div class="col-md-6 text-center mx-auto mb-3">
              <input type="file" name="image" class="form-control" required>
            </div>

            <!-- Left aligned button -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Add Image</button>
            </div>
          </div>
        </form>

      </div>
    </div>

    @include('admin.footer')
  </body>
</html>
