<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order App</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    
  @if(session('success'))
      <div class="alert alert-success" role="alert">
        <strong>Success!</strong> {{ session('success') }}
      </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
      <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> {{ session('error') }}
      </div>
    @endif
  </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
