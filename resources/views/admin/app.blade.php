<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="icon" type="image/png" href="{{ asset('admin_asset/uploads/favicon.png')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

<title>Admin Panel</title>
  @include('admin.components.head')
</head>

<body>
<div id="app">
    <div class="main-wrapper">

        @include('admin.components.navbar')


        <div class="main-sidebar">
          @include('admin.components.sidebar')
        </div>

        <div class="main-content">
          @yield('content')
        </div>

    </div>
</div>

@include('admin.components.script_footer')

</body>
<script>
    $('#frmaddproduct').submit(function (e) {

        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "Post",
            url: '{{route("product.store")}}',
            data: formData,

            success: function (result) {

                if (result.status == "sucess") {
                    //for rederict
                    window.location.href = '{{ route("product.show") }}';

                    // $('#frmLogin')[0].reset();
                    // $('.hello').remove();
                    // $('#sucess_mgs').html(result.msg);
                }

                },

                contentType: false,
                processData: false

             });
            }
        );
    </script>
    <script>
        $('#editproduct').submit(function (e) {

            e.preventDefault();
            var formData = new FormData(this);
            var id= $("#pid").val()

            var url = '{{ route("product.update", ":id") }}';
            url = url.replace(':id', id);


            $.ajax({
                type: "POST",
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,

                success: function (result) {

                    if (result.status == "sucess") {
                        //for rederict
                        window.location.href = '{{ route("product.show") }}';

                        // $('#frmLogin')[0].reset();
                        // $('.hello').remove();
                        // $('#sucess_mgs').html(result.msg);
                    }

                    },

                    contentType: false,
                    processData: false

                 });
                }
            );
        </script>
</html>
