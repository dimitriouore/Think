<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Σύνδεση</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>

<body>

<div class="container">
  <form class="form-signin" action="{{route('login-user')}}" method="post">

    @csrf

    <h2>Σύνδεση</h2>
        
    <i class="bi bi-person-fill"></i><label for="inputUsername" class="sr-only">Όνομα χρήστη:</label>
    <input type="text" name="username" class="form-control" required="" autofocus=""><br>
    <label for="inputPassword" class="sr-only">Κωδικός πρόσβασης:</label>
    <input type="password" name="password" class="form-control" required=""><br>
         
    <button class="btn btn-sm btn-outline-primary ml-auto">Σύνδεση</button>
    <a href="register">Δεν έχετε λογαριασμό? Εγγραφείτε</a>
    <br><br>
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif

  </form>
</div>

</body>

</html>