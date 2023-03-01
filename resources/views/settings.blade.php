<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Προφίλ</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/settings.css">

</head>

<body>
  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <img class="mr-3 rounded-circle" src="{{$data->user_image}}" alt="Photo">
      <a class="navbar-brand">{{$data->name}} {{$data->surname}}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigationbar"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="homepage">Αρχική</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="settings">Ρυθμίσεις<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout">Αποσύνδεση</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Jumbotron -->
  <div class="jumbotron">
    <div class="container">

      
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif

      <div class="row">
        <div class="col-md-6">
          <h5>Αλλαγή κωδικού πρόσβασης</h5>
          <form action="{{route('change-password')}}" method="post">
          @csrf
          <div class="form-group">
              <label for="password">Παλιός κωδικός:</label>
              <input type="password" class="form-control" name="oldPassword" required>
            </div>
            <div class="form-group">
              <label for="password">Νέος κωδικός:</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-primary ml-auto">Υποβολή</button>
          </form>
          <br>
          <h5>Φωτογραφία χρήστη</h5>
          <span style="color: red;">@error('image'){{$message}} @enderror</span>
          <form method="post" action="{{ route('image-upload') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image">
            <button type="submit" class="btn btn-sm btn-outline-primary ml-auto" style="width:auto; height:31.4px;">Upload Image</button>
          </form>

        </div>

        <div class="col-md-6">
          <h5>Αλλαγή email</h5>
          <form action="{{route('change-email')}}" method="post">
          @csrf
            <div class="form-group">
              <label for="email">Νέο Email: </label>
              <span style="color: red;">@error('email'){{$message}} @enderror</span>
              <input type="email" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-primary ml-auto ">Υποβολή</button>
          </form>
          <br>

          <h5>Αλλαγή username</h5>
          <form action="{{route('change-username')}}" method="post">
          @csrf
            <div class="form-group">
              <label for="username">Νέο Username: </label>
              <span style="color: red;">@error('username'){{$message}} @enderror</span>
              <input type="username" class="form-control" name="username" required>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-primary ml-auto ">Υποβολή</button>
          </form>
          <br>
        </div>

        <div class="col-md-6" style="margin-top:25px;">
        
        </div>
      </div>
    </div>
  </div>
</body>
</html>