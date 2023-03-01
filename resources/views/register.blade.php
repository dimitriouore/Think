<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Εγγραφή</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/register.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>

<body>


<div class="container">
  <form class="form-signin" action="{{route('registration')}}" method="post">

  
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    <?php redirect('login') ?>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif
    @csrf

    <h2>Εγγραφή</h2>
        
    <label for="inputName" class="sr-only">Όνομα:</label>
    <input type="text" class="form-control" autofocus="" name="name" value="{{old('name')}}" required><br>

    <label for="inputSurname" class="sr-only">Επώνυμο:</label>
    <input type="text" class="form-control" name="surname" value="{{old('surname')}}" required><br>
    
    <label for="inputEmail" class="sr-only">Email: </label> <span style="color: red;">@error('email'){{$message}} @enderror</span>
    <input type="email" class="form-control" name="email" value="{{old('email')}}" required><br>

    <label for="inputUsername" class="sr-only">Username: </label> <span style="color: red;">@error('username'){{$message}} @enderror</span>
    <input type="text" class="form-control" name="username" value="{{old('username')}}" required><br>

    <label for="inputPassword" class="sr-only">Password:</label> <span style="color: red;">@error('password'){{$message}} @enderror</span>
    <input type="password" class="form-control" name="password" required><br>

    <button class="btn btn-sm btn-outline-primary ml-auto">Εγγραφή</button>
    <a href="login">Είστε μέλος? Συνδεθείτε</a>
    <br><br>

  </form>
</div>


</body>

</html>