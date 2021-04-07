<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('stylecontainer/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stylecontainer/datatable.css') }}">


    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script type="text/javascript">
        var BASE_URL = "{{ url('/') }}";
    </script>

    <title> @yield('title') </title>
</head>

<body>
    <div class="dashbord-wrapper">
        @include('adminlayouts.header')
        <div class="dashbord-container">
            @include('adminlayouts.sidebar')
            <div class="right-content">
                <div class="dashboard-title">
                    <h1 class="title">@yield('dashboardtitle') </h1>
                </div>
                        {{-- dashboard all content is --}}
                        @yield('content')
                        {{-- content end --}}

                <div class="stratent-img">
                    <img src="{{ asset('stylecontainer/images/logo@1x 1.png') }}">
                </div>
            </div>

        </div>
    </div>
    <!-- jquery for toggle sidebar -->
    <script>
                $('.link').click(function(){
                    $('.link').removeClass("active");
                    $(this).addClass("active");
                });

          $(document).ready(function(){
             $(".toggle").click(function(){
             $("#sidebar").toggle("3000");
          });
        }); 
         function logout() {
            Swal.fire({
              icon: 'info',
              title : 'Do you really want to logout?',
              showCancelButton: true,
              preConfirm: (login) => {
                    document.getElementById("logout-form").submit()
              }
            });
          }   

      
    </script>
</body>

</html>
