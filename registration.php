<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="Registration.css" />
  </head>
  <body>
    
      <div class="container">
        <div class="row" style="width: 100%"> 
          <form class="text-center" method='post' action='user_registration.php' style="margin : auto; width:70%">
          <h1>Registeration Form</h1>
          <label><b> First name</b></label>
          <input
            type="text"
            name="Fullname"
            placeholder="Fullname"
            maxlength="100"
            required
          />
          <label for="email"><b>Email</b></label>
          <input
            type="text"
            placeholder="Enter Email"
            name="email"
            required
            maxlength="50"
            required
          />
          <label for="psw"><b>Password</b></label>
          <input
            type="password"
            placeholder="Enter Password"
            name="password"
            required
            maxlength="50"
            required
          />
           
          <button type="submit" class="registerbtn">Register</button>
          <br />
          Already have an account?
          <a href="login.php" style="color: white"> Login Here.. </a>
        </form>
        </div>
      </div>
    
  </body>
</html>
