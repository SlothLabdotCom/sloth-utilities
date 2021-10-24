<!DOCTYPE html>
<html class="no-js">

<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" href="{{ asset('sloth-assets/images/apple-touch-icon.png') }}">
    <link rel=" stylesheet" href="{{ asset('sloth-assets/css/vendor.css') }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;523;600;700;800&amp;family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('sloth-assets/css/errors.css') }}">
</head>

<body>
    <div id="app" class="error-page-2">

        <div class="container">
            <div class="image-bg"
                style="background-image: url('{{ asset('sloth-assets/images/realistic-cartoon-haloween-witch-bg.png') }}');">
                <img src="{{ asset('sloth-assets/images/sloth-404.png') }}" class="error-img"
                    alt="Error illustration">
            </div>
            <div class="content">
                <h1 class="error-heading">Oops!</h1>
                <h4 class="error-text">
                    The page you are looking for does not exist.
                </h4>
            </div>
        </div>
    </div>
</body>

</html>
