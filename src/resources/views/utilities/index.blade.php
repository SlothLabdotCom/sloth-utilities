<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex" />
    <title>Sloth Utilities</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <section>
        <div class="container-fluid p-5">
            <div class="text-center mt-5 mb-5">
                <img src="https://sloth-lab.com/ss-02.png" style="width:180px" />
            </div>

            <div class="row text-center mb-2">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <a href="{{ route('utilities.pull', config('ziplock.token')) }}"><button type="button" class="btn btn-dark btn-lg btn-block" data-toggle="tooltip" data-placement="bottom" title="Git pull, Composer install and Artisan migrate">Git Pull</button></a>
                </div>
                <div class="col-md-5">
                    <a href="{{ route('utilities.migrate', config('ziplock.token')) }}"><button type="button" class="btn btn-outline-dark btn-lg btn-block" data-toggle="tooltip" data-placement="bottom" title="Migrate fresh and Seed">Migrate fresh</button></a>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row text-center mb-2">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <a href="{{ route('utilities.seed', config('ziplock.token')) }}"><button type="button" class="btn btn-outline-danger btn-lg btn-block" data-toggle="tooltip" data-placement="bottom" title="Seed database without migration">Seed Database</button></a>
                </div>
                <div class="col-md-5">
                    <a href="{{ route('utilities.autoload', config('ziplock.token')) }}"><button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="tooltip" data-placement="bottom" title="Dump Autoload">Composer Autoload</button></a>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row text-center mb-2">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <a href="{{ route('utilities.optimize', config('ziplock.token')) }}"><button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="tooltip" data-placement="bottom" title="Optimize the project">Clear Cache</button></a>
                </div>
                <div class="col-md-5">
                    @if(file_exists(base_path("storage/lock.dat")))
                        <a href="{{ route('switch.revive', config('ziplock.token')) }}"><button type="button" class="btn btn-outline-success btn-lg btn-block" data-toggle="tooltip" data-placement="bottom" title="Revives the project">Revive</button></a>
                    @else
                        <a href="{{ route('switch.kill', config('ziplock.token')) }}"><button type="button" class="btn btn-outline-secondary btn-lg btn-block" data-toggle="tooltip" data-placement="bottom" title="Kills the project">Kill</button></a>
                    @endif
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row text-center mt-5">
                <div class="col-md-12"><p>Copyright &copy; {{ date('Y') }} Sloth Utilities</p><p>Proudly crafted by <a href="https://sloth-lab.com" target="_blank">Sloth-Lab S.A.R.L</a></p></div>
            </div>

        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>
