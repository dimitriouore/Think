<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Αρχική</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles/home.css">
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <img class="mr-3 rounded-circle" src="{{$data->user_image}}" alt="photo">
      <a class="navbar-brand">{{$data->name}} {{$data->surname}}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="homepage">Αρχική<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="settings">Ρυθμίσεις</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout">Αποσύνδεση</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="jumbotron jumbotron-fluid">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h1 class="display-4">Welcome aboard</h1>
              <p class="lead">Think is a small social media project.
                <br> Feel free to use it and keep in mind <br>delete is NOT an option!
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-1">
          <!-- KENO -->
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Τι σκέφτεσαι;</h5>
              <form action="{{route('save-posts')}}" method="post">
                @csrf
                <textarea maxlength="210" rows="5" cols="60" spellcheck="true" class="form-control" name="text" contenteditable></textarea>
                <br>
                <button type="submit" class="btn btn-sm btn-outline-primary ml-auto">Δημοσίευση</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">News Feed</h5>
            <br>
            @foreach ($allPosts as $allPost)
            <div class="media">
              <div class="media-body">
                <p class="mt-0">{{$allPost->name}} {{$allPost->surname}}</p>
                <p>{{ $allPost->post }}</p>
                <p class="media-body username">{{ '@'.$allPost->username}}
                <p class="media-body time">{{ $allPost->created_at}}
                </p>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Οι σκέψεις μου</h5>
            <br>
            @foreach ($posts as $post)
            <div class="media">
              <div class="media-body">
                <p class="mt-0">{{$data->name}} {{$data->surname}}</p>
                <p>{{ $post->post }}</p>
                <form action="{{ route('delete.post', ['id' => $post->id]) }}" method="POST">
                  @csrf
                  <button type="submit" class="delete">
                  <img class="image-delete" src="system_images/delete.svg" >
                </button>
                </form>
                <p class="media-body time">{{ $post->created_at}}</p>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>