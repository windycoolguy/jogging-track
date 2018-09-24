<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="./dist/umd/vue-ctk-date-time-picker.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Raleway'>
    <link rel='stylesheet prefetch' href='http://weloveiconfonts.com/api/?family=fontawesome'>

    <title>Laravel Vue - Socialite</title>
    <link rel="stylesheet" type="text/css" href="{{mix('css/app.css')}}">
</head>
<body>
<div id="root">
</div>
<script type="text/javascript" src="{{mix('js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- <script src="./dist/umd/vue-ctk-date-time-picker.min.js" charset="utf-8"></script> -->
<!-- <script type="text/javascript">
  $(".form_datetime").datetimepicker({
    format: "dd MM yyyy - hh:ii"
  });
</script>
 -->
<script type="text/x-template" id="modal-template">
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">

            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">

            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</script>
</body>
</html>
