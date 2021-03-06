<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login/Logout animation concept</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans'>

<link href={{asset('css/login.css')}} rel="stylesheet" type="text/css">
 
</head>

<body>
  <div class="cont">
  <div class="demo">
    <div class="login">
      <div class="login__check"></div>
      <div class="login__form">
        @foreach($errors->all() as $error)
            <div class="errorHandler alert alert-danger" style="font-size: 14px;color: rgb(181, 3, 3);">
                {!!$error!!}
            </div>
        @endforeach
         {!!  Form::open(array('url'=>'user/signin','method'=>'POST'))  !!}

         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" class="login__input name" placeholder="Email" name='email'/>
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name= 
          'password' class="login__input pass" placeholder="Password"/>
        </div>
        <button type="submit" class="login__submit">Sign in</button>
        <!-- <p class="login__signup">Don't have an account? &nbsp;<a>Sign up</a></p> -->
         {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src={{asset('js/index.js')}}></script>

</body>
</html>
