<script>
    if({{ Auth::check() }}){
        window.location.replace('{{route('home')}}');
    }
</script>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="blog for everyone.">
    <meta name="keywords" content="blog">
    <meta charset="UTF-8">
    <title>مدونة مطلق الضبيب</title>
    <link rel="stylesheet" href="assets/css/linearicons.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body style="background: #cec2b2">
<div class="oz-body-wrap">
    <header class="default-header">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <div class="logo"></div>
                    <div class="main-menubar d-flex align-items-center">
                        <nav class="hide" style="font-family: 'zarid-regular';">
                            <a href="{{route('login')}}" style="font-size:20px">تسجيل الدخول</a>
                            <a href="{{route('register')}}" style="font-size:20px">التسجيل</a>
                        </nav>
                        <div class="menu-bar"><span class="lnr lnr-menu"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="banner-area relative">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-center">
                <div class="banner-left col-lg-6">
                    <img class="d-flex mx-auto img-fluid" src="../../img/imac.png" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="story-content" style="font-family: 'zarid-regular'">

                        <h1>مدونة امنه  <span class="sp-1">للجميع</span><br>
                            Safe and <span class="sp-2">Secure</span></h1>
                        <a href="{{route('register')}}" style="font-size:20px" class="genric-btn info circle arrow">تسجيل<span class="lnr lnr-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="assets/js/vendor/bootstrap.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
