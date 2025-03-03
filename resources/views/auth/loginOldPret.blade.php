<!doctype html>
<html lang="en">

<head>
    <title>Login 04</title>
    @vite('resources/js/app.js')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- google font -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <!-- bootstrap -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha256-9qU3v3+wYFFzKd6rzwqF7XaAnRGkT8t+Kl2U7rO7Z7usZqT2Jl+HlQbhQ7dp0GWr0veE7L8ME5xPe6i0MK5T/g=="
        crossorigin="anonymous" />
    <!-- Theme Styles -->
    <link href="/assets/css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="/assets/css/pages/login.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="/assets/img/logoCFPT--clr" />
    <style>
        /* Styles pour le div après le div du container */
        .container>div:last-child {
            position: absolute;
            top: 100px;
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Sing in  Form -->

        <div class="container ">
            <div class=" border"
                style="width: 50%; height: 83%; background: rgba(255, 255, 255, 0.80); box-shadow: -2px 5px 22.899999618530273px -2px #595353; border-radius: 16px; backdrop-filter: blur(29.50px)">


                <div class=""
                    style="border-radius: 16px; width: 364px; height: 350px; left: 67px; top: 235px; position: absolute; background:rgba(255, 255, 255, 0.80);">


                    <div class="">
                        <h2 class="form-title mt-2"
                            style=" text-align: center; color: #505050;font-family:  text-transform: uppercase; letter-spacing: 3.20px; word-wrap: break-word">
                            Connexion</h2>
                        {{-- <user-login></user-login> --}}
                        <form action="votre_action.php" method="post" id="login-form">

                            <div class="form-floating mb-2 mt-4" style="margin-left: 9%;">

                                <input v-model="form.matricule" type="email" class="form-control ml-6"
                                    id="floatingInput" placeholder="name@example.com"
                                    style="width: 88%; background: rgba(245, 241, 241, 0.66); box-shadow: -2px 5px 10.899999618530273px -2px #595353; border-radius: 16px; backdrop-filter: blur(29.50px)">
                                <label for="floatingInput"><i class="fa fa-user"></i> Matricule</label>

                            </div>

                            <div class="form-floating mt-4 " style="margin-left: 9%;">
                                <input v-model="form.password" type="password" class="form-control"
                                    id="floatingPassword" placeholder="Password"
                                    style="width: 88%; background: rgba(245, 241, 241, 0.66); box-shadow: -2px 5px 10.899999618530273px -2px #595353; border-radius: 16px; backdrop-filter: blur(29.50px)">
                                <button
                                    class=" btn-outline-secondary border-0 position-absolute top-50 end-0 translate-middle-y"
                                    type="button" id="togglePassword " style="margin-right: 15%;">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <label for="floatingPassword"><i class="fa fa-lock"></i> Password

                                </label>
                            </div>
                            <div style="width: 205px; height: 52px; left: 79px; top: 250px; position: absolute">
                                <div
                                    style="width: 205px; height: 52px; left: 0px; top: 0px; position: absolute;
							background: linear-gradient(9deg, #9181F4 0%, #5038ED 100%); box-shadow: 0px 8px 21px rgba(0, 0, 0, 0.16); border-radius: 16px">
                                </div>
                                <a @click.prevent="verification()" href=""
                                    style="text-align:center; text-decoration:none; left:20%; top: 8px; position: absolute; color: white; font-size: 24px; font-family: Poppins; font-weight: 700; word-wrap: break-word">
                                    Se connecter</a>
                            </div>
                        </form>

                    </div>

                </div>
                <div
                    style="width: 268px; height: 60px; left: 115px; top: 70px; position: absolute; text-align: center; color: #5038ED; font-size: 37px; font-family: Poppins; font-weight: 700; line-height: 18px; letter-spacing: 1.11px; word-wrap: break-word">
                    CFPT-Digital</div>
                <div style="width: 638px; height: 808px; left: 461px; top: 0px; position: absolute">
                    <div class="border-color-none"
                        style="box-shadow: -2px 5px 22.899999618530273px -2px #595353; 
						   border-radius: 0 16px 16px 0; 
						   border: 0px solid linear-gradient(218deg, #9181F4 0%, #5038ED 100%);
						   backdrop-filter: blur(29.50px); 
						   width: 585px; 
						   margin-top: 45px; 
						   height: 784px; 
						   left: 53px; 
						   top: -45px; 
						   position: absolute; 
						   background: linear-gradient(218deg, #9181F4 0%, #5038ED 100%)">
                    </div>

                    <img style="width: 585px; height: 784px; left: 53px; top: 0px; position: absolute; opacity: 0.13"
                        src="/assets/auth/images/fond.jpg" />
                    <img style="width: 555px; height: 539px; left: 10%; top: 125px; position: absolute"
                        src="/assets/auth/images/logo2.png" />
                    <div
                        style="width: 365px; height: 29px; left: 182px; top: 729px; position: absolute; color: white; font-size: 16px; font-family: Poppins; font-style: italic; font-weight: 700; letter-spacing: 1.28px; word-wrap: break-word">
                        ‘’Excellence au service de l’industrie’’</div>
                </div>
                <div style="width: 155.28px; height: 21.21px; left: 171px; top: 737px; position: absolute">
                    <div style="width: 155.28px; height: 21.21px; left: 0px; top: 0px; position: absolute">
                        <div
                            style="width: 20.78px; height: 19.76px; left: -0px; top: 0.50px; position: absolute;
	background: #1877F2">
                        </div>
                        <div style="width: 20.78px; height: 19.76px; left: 65.16px; top: 0.50px; position:
	absolute">
                        </div>
                        <div style="width: 26.36px; height: 17.35px; left: 93.54px; top: 2.01px; position:
	absolute">
                            <div
                                style="width: 7.11px; height: 6.95px; left: 10.46px; top: 4.94px; position:
	absolute; background: white">
                            </div>
                            <div
                                style="width: 7.10px; height: 4.10px; left: 10.46px; top: 4.94px; position:
	absolute; background: #E8E0E0">
                            </div>
                            <div
                                style="width: 26.36px; height: 17.35px; left: 0px; top: 0px; position: absolute;
	background: #CD201F">
                            </div>
                        </div>
                        <div style="width: 22.30px; height: 21.21px; left: 132.98px; top: -0px; position: absolute">
                            <div
                                style="width: 22.30px; height: 21.21px; left: 0px; top: 0px; position: absolute; background: linear-gradient(135deg, #2489BE 0%, #0575B3 100%)">
                            </div>
                        </div>
                    </div>
                    <div style="width: 20.78px; height: 19.76px; left: 44.33px; top: 0.50px; position: absolute">
                        <div
                            style="width: 20.78px; height: 19.76px; left: 0px; top: 0px; position: absolute; background: linear-gradient(45deg, #FED576 0%, #F47133 26%, #BC3081 61%, #4C63D2 100%)">
                        </div>
                        <div style="width: 13.54px; height: 12.88px; left: 3.59px; top: 3.42px; position: absolute">
                            <div
                                style="width: 13.54px; height: 12.88px; left: 0px; top: 0px; position: absolute; background: white">
                            </div>
                            <div
                                style="width: 7.05px; height: 6.71px; left: 3.35px; top: 3.18px; position: absolute; background: white">
                            </div>
                            <div
                                style="width: 1.73px; height: 1.64px; left: 9.61px; top: 2.22px; position: absolute; background: white">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

    <!-- bootstrap -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- end js include path -->
    <!-- notifications -->
    <script src="/assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
    <script src="/assets/plugins/jquery-toast/dist/toast.js"></script>
    <!-- start js include path -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>

</body>

</html>
