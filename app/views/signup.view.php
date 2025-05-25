<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">

      <?php
  if (isset($errors)) {


      foreach ($errors as $error) {
          echo '<div class="alert alert-danger" role="alert">'. $error .'</div>';
      }
  }
      ?>
    <form method="post">
      <div class="mb-3">
        <label  for="exampleInputEmail1" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        
      </div>
      <div class="mb-3">
        <label for="college-name" class="form-label">College name</label>
        <input  autocomplete="off" list="colleges" name="college_name" type="text" class="form-control" id="college-name">
        <datalist id="colleges">
          
          
          <?php
      foreach ($colleges as $college) {
          echo "<option value='$college'></option>";
      }
      ?>
          </datalist>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
    </html>