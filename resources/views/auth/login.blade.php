<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="RedstarHospital" />
    <title>CFPT digital</title>
    {{--  @vite('resources/js/app.js') --}}
    <!-- google font -->
    {{-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" /> --}}
    {{--     <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap" rel="stylesheet">
 --}}
    <!-- icons -->
    <link rel="stylesheet" href="/assets/plugins/iconic/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Jquery Toast css -->
    <link rel="stylesheet" href="/assets/plugins/jquery-toast/dist/jquery.toast.min.css">
    <!-- bootstrap -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="/assets/css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="/assets/css/pages/login.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="/assets/img/logoCFPT--clr" />

    {{-- Icones Flaticon rr --}}
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <style>
        body {
            font-family: 'Poppins';
        }

        /* Styles pour le div après le div du container */
        /* .container>div:last-child {
            position: absolute;
            top: 100px;
        } */
    </style>
</head>

<body>
    {{--  <div id="app"> --}}
    <!-- Sing in  Form -->
    <div class="" style="margin-left: 20%; margin-top: 8%; width: 50vw; height: 50vh;" id="app">
        <div class="border"
            style=" width: 638px; height: 785px; background: rgba(255, 255, 255, 0.80); box-shadow: -2px 5px 22.899999618530273px -2px rgb(89, 83, 83, .4); border-radius: 16px 0 0 16px; backdrop-filter: blur(29.50px)">

            <div class=""
                style=" width: 364px; height: 350px; left: 67px; top: 20%; position: absolute; background:rgba(255, 255, 255, 0.80);">

                <div>
                    <div
                        style="width: 275px; height: 31px; top: 0px; margin-left:50px;  text-align: center; color: #505050; font-size: 20px; font-family: Poppins; font-weight: 
                        400; text-transform: uppercase; letter-spacing: 3.20px; word-wrap: break-word">
                        CONNEXION</div>

                     <user-login></user-login> 

                   {{--  <form action="{{ route('login') }}" method="post" id="login-form">

                        <div class="form-floating mb-2 mt-4" style="margin-left: 9%;">

                            <input name="matricule" type="texte" class="form-control ml-6" id="floatingInput"
                                placeholder="name@example.com"
                                style="width: 88%; background: rgba(255, 255, 255, 0.66); box-shadow: -2px 5px 10.899999618530273px -2px #595353; border-radius: 16px; backdrop-filter: blur(29.50px)">
                            <label for="floatingInput"><i class="fa fa-user"></i> Matricule</label>

                        </div>
                        <div class="form-floating mt-4 " style="margin-left: 9%;">
                            <input name="password" :type="passwordFieldType" class="form-control"
                                id="floatingPassword" placeholder="Password"
                                style="width: 88%; background: rgba(255, 255, 255, 0.66); box-shadow: -2px 5px 10.899999618530273px -2px #59535300; border-radius: 16px; backdrop-filter: blur(29.50px)">
                            <button class=" border-0 position-absolute top-50 end-0 translate-middle-y"
                                @click.prevent="togglePasswordVisibility" type="button" id="togglePassword"
                                style="margin-right: 15%; background-color: white;">
                                <i class="fi"
                                    :class="passwordFieldType === 'password' ? 'fi-rr-eye' : 'fi-rr-eye-crossed'"></i>
                            </button>
                            <label for="floatingPassword"><i class="fa fa-lock"></i> Mot de passe</label>
                        </div>

                        <div style="width: 205px; height: 52px; left: 79px; top: 250px; position: absolute">
                            <div
                                style="width: 205px; height: 52px; left: 0px; top: 0px; position: absolute; background: linear-gradient(9deg, #9181F4 0%, #5038ED 100%); box-shadow: 0px 8px 21px rgb(80, 56, 237, .4); border-radius: 16px">
                            </div>
                            <button type="submit"
                                style="width:100%;text-align:center; text-decoration:none; top: 8px; position: absolute; color: white; font-size: 20px; font-family: Poppins; font-weight: 400; word-wrap: break-word; bac">
                                Se connecter</button>
                        </div>
                    </form> --}}



                </div>
            </div>
            <div
                style="width: 268px; height: 60px; left: 115px; top: 70px; position: absolute; text-align: center; color: #5038ED; font-size: 37px; font-family: Poppins; font-weight: 700; line-height: 18px; letter-spacing: 1.11px; word-wrap: break-word">
                CFPT-Digital</div>
            <div
                style="width: 638px; height: 808px; left: 461px; top: 0px; position: absolute; width: 50vw; height: 50vh;">
                <div class="border-color-none"
                    style=" 
                        box-shadow: -2px 5px 22.899999618530273px -2px #595353;
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
                    style="width: 380px; height: 29px; left: 182px; top: 729px; position: absolute; color: white; font-size: 16px; font-family: Poppins; font-style: italic; font-weight: 700; letter-spacing: 1.28px; word-wrap: break-word">
                    ‘’L'excellence au service de l’industrie’’</div>
            </div>

            <div style="width: 155.28px; height: 21.21px; left: 171px; top: 737px; position: absolute">
                <div style="width: 155.28px; height: 21.21px; left: 0px; top: 0px; position: absolute">
                    <div style="width: 20.78px; height: 19.76px; left: -0px; top: 0.50px; position: absolute;">
                        <img src="/images/facebook.png" alt="">
                    </div>
                </div>
                <div style="width: 20.78px; height: 19.76px; left: 44.33px; top: 0.50px; position: absolute">
                    <div style="width: 20.78px; height: 19.76px; left: -0px; top: 0.50px; position: absolute;">
                        <img src="/images/instagram.png" alt="">
                    </div>
                </div>
                <div style="width: 20.78px; height: 19.76px; left: 92.20px; top: 0.50px; position: absolute">
                    <div style="width: 20.78px; height: 19.76px; left: -0px; top: 0.50px; position: absolute;">
                        <img src="/images/youtube.png" alt="">
                    </div>
                </div>
                <div style="width: 22.30px; height: 21.21px; left: 132.98px; top: -0px; position: absolute">
                    <div style="width: 20.78px; height: 19.76px; left: -0px; top: 0.50px; position: absolute;">
                        <img src="/images/linkedin.png" alt="">
                    </div>
                </div>

                {{-- <div><img src="/images/instagram.png" alt=""></div>

                <div><img src="/images/youtube.png" alt=""></div>

                <div><img src="/images/linkedin.png" alt=""></div> --}}

            </div>
        </div>
    </div>
    </div>
    {{--  </div> --}}

    <!-- start js include path -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- bootstrap -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- end js include path -->
    <!-- notifications -->
    <script src="/assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
    <script src="/assets/plugins/jquery-toast/dist/toast.js"></script>
    {{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login-form');
            const matriculeInput = document.getElementById('matricule');
            const passwordInput = document.getElementById('password');
            const togglePasswordButton = document.getElementById('togglePassword');
        
            function togglePasswordVisibility() {
                const passwordFieldType = passwordInput.getAttribute('type');
                passwordInput.setAttribute('type', passwordFieldType === 'password' ? 'text' : 'password');
            }
        
            function afficherToastInfo(message) {
                // Implémentez votre logique pour afficher le toast ici
            }
        
            async function verification() {
                const matricule = matriculeInput.value;
                const password = passwordInput.value;
        
                if (matricule !== "" && password !== "") {
                    try {
                        const response = await axios.post("/connexion", { matricule, password });
                        const data = response.data;
        
                        if (data.statut !== "Error" && data.token) {
                            window.location.href = data.url;
        
                            localStorage.setItem("token", data.token);
                            localStorage.setItem("userNom", data.user.nom);
                            localStorage.setItem("userPrenom", data.user.prenom);
                            localStorage.setItem("userIdrole", data.user.id_role);
                            localStorage.setItem("userPhoto", data.user.photo);
                            localStorage.setItem("userrole", data.user.role.intitule);
                        } else {
                            if (data.message === "L'utilisateur est bloqué") {
                                afficherToastInfo("Vous avez été bloqué. Rapprochez-vous de votre administrateur pour plus d'informations.");
                            } else {
                                afficherToastInfo("Matricule ou mot de passe incorrect.");
                            }
                        }
                    } catch (error) {
                        console.error(error);
                    }
                } else {
                    afficherToastInfo("Tous les champs sont obligatoires.");
                }
            }
        
            // Ajoutez les gestionnaires d'événements
            togglePasswordButton.addEventListener('click', togglePasswordVisibility);
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                verification();
            });
        });
        </script>
        
        
    @endsection --}}
</body>

</html>
