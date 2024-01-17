<template>
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Page profil</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
									:href="'/admin/index'">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" :href="'/utilisateur/index'">Utilisateurs</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Profil Utilisateur</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PROFILE SIDEBAR -->
							<div class="profile-sidebar">
								<div class="card">
									<div class="card-body no-padding height-9"  >
										<div class="row">
											<div class="profile-userpic" >
												<img :src="getImageUrl(this.authphoto)" class="img-responsive" alt=""> </div>
										</div>
										<div class="profile-usertitle">
											<div class="profile-usertitle-name">{{this.authprenom }} {{ this.authnom }}</div>
											<div class="profile-usertitle-job"> {{ this.authrole }} </div>
											<div class="profile-usertitle-job"> {{ this.authmatricule }} </div>
										</div>
										<!-- <ul class="list-group list-group-unbordered">
											<li class="list-group-item">
												<b>Followers</b> <a class="pull-right">1,200</a>
											</li>
											<li class="list-group-item">
												<b>Following</b> <a class="pull-right">750</a>
											</li>
											<li class="list-group-item">
												<b>Friends</b> <a class="pull-right">11,172</a>
											</li>
										</ul> -->
										<!-- END SIDEBAR USER TITLE -->
										<!-- SIDEBAR BUTTONS -->
										<div class="profile-userbuttons">
											<button type="button"
												class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary">Actif</button>
											<button type="button"
												class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-pink">Inactif</button>
										</div>
										<!-- END SIDEBAR BUTTONS -->
									</div>
								</div>
								<div class="card">
									<div class="card-head">
										<header>Informations</header>
									</div>
									<div class="card-body no-padding height-9">
										<div class="profile-desc">
											Hello I am John Deo a Professor in xyz College Surat. I love to work with
											all my college staff and seniour
											professors.
										</div>
										<ul class="list-group list-group-unbordered">
											<li class="list-group-item">
												<b>Genre </b>
												<div class="profile-desc-item pull-right">{{ this.authgenre }}</div>
											</li>
											<li class="list-group-item">
												<b>Operation Done </b>
												<div class="profile-desc-item pull-right">30+</div>
											</li>
											<li class="list-group-item">
												<b>Degree </b>
												<div class="profile-desc-item pull-right">B.A., M.A., P.H.D.</div>
											</li>
											<li class="list-group-item">
												<b>Designation</b>
												<div class="profile-desc-item pull-right">Jr. Professor</div>
											</li>
										</ul>
										<div class="row list-separated profile-stat">
											<div class="col-md-4 col-sm-4 col-6">
												<div class="uppercase profile-stat-title"> 37 </div>
												<div class="uppercase profile-stat-text"> Projects </div>
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="uppercase profile-stat-title"> 51 </div>
												<div class="uppercase profile-stat-text"> Tasks </div>
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="uppercase profile-stat-title"> 61 </div>
												<div class="uppercase profile-stat-text"> Uploads </div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-head">
										<header>Service</header>
									</div>
									<div class="card-body no-padding height-9">
										<div class="row text-center m-t-10">
											<div class="col-md-12">
												  <p>{{this.authservice}}
													<br> <!-- {{this.authservice}} -->  </p> 
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-head">
										<header>Work Expertise</header>
									</div>
									<div class="card-body no-padding height-9">
										<div class="work-monitor work-progress">
											<div class="states">
												<div class="info">
													<div class="desc pull-left">Java</div>
													<div class="percent pull-right">50%</div>
												</div>
												<div class="progress progress-xs">
													<div class="progress-bar progress-bar-danger progress-bar-striped active"
														role="progressbar" aria-valuenow="40" aria-valuemin="0"
														aria-valuemax="100" style="width: 70%">
														<span class="sr-only">50% </span>
													</div>
												</div>
											</div>
											<div class="states">
												<div class="info">
													<div class="desc pull-left">Php</div>
													<div class="percent pull-right">85%</div>
												</div>
												<div class="progress progress-xs">
													<div class="progress-bar progress-bar-success progress-bar-striped active"
														role="progressbar" aria-valuenow="40" aria-valuemin="0"
														aria-valuemax="100" style="width: 45%">
														<span class="sr-only">85% </span>
													</div>
												</div>
											</div>
											<div class="states">
												<div class="info">
													<div class="desc pull-left">Android</div>
													<div class="percent pull-right">20%</div>
												</div>
												<div class="progress progress-xs">
													<div class="progress-bar progress-bar-info progress-bar-striped active"
														role="progressbar" aria-valuenow="40" aria-valuemin="0"
														aria-valuemax="100" style="width: 35%">
														<span class="sr-only">20% </span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END BEGIN PROFILE SIDEBAR -->
							<!-- BEGIN PROFILE CONTENT -->
							<div class="profile-content">
								<div class="row">
									<div class="card">
										<div class="card-topline-aqua">
											<header></header>
										</div>
										<div class="white-box">
											<!-- Nav tabs -->
											<div class="p-rl-20">
												<ul class="nav customtab nav-tabs" role="tablist">
													<li class="nav-item"><a href="#tab1" class="nav-link active"
															data-bs-toggle="tab">Informations</a></li>
													
												</ul>
											</div>
											<!-- Tab panes -->
											<div class="tab-content">
												<div class="tab-pane active fontawesome-demo" id="tab1">
													<div id="biography">
														<div class="row">
															<div class="col-md-3 col-6 b-r"> <strong>Nom Complet</strong>
																<br>
																<p class="text-muted">{{ this.authprenom }} {{ this.authnom }}</p>
															</div>

															<div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
																<br>
																<p class="text-muted">{{ this.authtelephone }}</p>
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Email</strong>
																<br>
																<p class="text-muted">{{ this.authemail }}</p>
															</div>
															<div class="col-md-3 col-6"> <strong>Adresse</strong>
																<br>
																<p class="text-muted">{{ this.authadresse }}</p>
															</div>
														</div>
														<hr>
														<p class="m-t-30">Completed my graduation in Arts from the well
															known and renowned institution of India –
															SARDAR PATEL ARTS COLLEGE, BARODA in 2000-01, which was
															affiliated to M.S. University. I ranker in
															University exams from the same university from 1996-01.</p>
														<p>Worked as Professor and Head of the department at Sarda
															Collage, Rajkot, Gujarat from 2003-2015 </p>
														<p>Lorem Ipsum is simply dummy text of the printing and
															typesetting industry. Lorem Ipsum has been the
															industry's standard dummy text ever since the 1500s, when an
															unknown printer took a galley of type and
															scrambled it to make a type specimen book. It has survived
															not only five centuries, but also the leap
															into electronic typesetting, remaining essentially
															unchanged.</p>
														<br>
														<h4 class="font-bold">Education</h4>
														<hr>
														<ul>
															<li>B.A.,Gujarat University, Ahmedabad,India.</li>
															<li>M.A.,Gujarat University, Ahmedabad, India.</li>
															<li>P.H.D., Shaurashtra University, Rajkot</li>
														</ul>
														<br>
														<h4 class="font-bold">Experience Professionnelle</h4>
														<hr>
														<ul>
															<li>One year experience as Jr. Professor from April-2009 to
																march-2010 at B. J. Arts College, Ahmedabad.</li>
															<li>Three year experience as Jr. Professor at V.S. Arts &
																Commerse Collage from April - 2008 to April -
																2011.</li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
														</ul>
														<br>
														<h4 class="font-bold">Conferences, Cources & Workshop Attended
														</h4>
														<hr>
														<ul>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
															<li>Lorem Ipsum is simply dummy text of the printing and
																typesetting industry. </li>
														</ul>
														<br>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END PROFILE CONTENT -->
						</div>
					</div>
				</div>
				<!-- end page content -->
				<!-- start chat sidebar -->
				<div class="chat-sidebar-container" data-close-on-body-click="false">
					<div class="chat-sidebar">
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a href="#quick_sidebar_tab_1" class="nav-link active tab-icon" data-bs-toggle="tab"> <i
										class="material-icons">chat</i>Chat
									<span class="badge badge-danger">4</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#quick_sidebar_tab_3" class="nav-link tab-icon" data-bs-toggle="tab"> <i
										class="material-icons">settings</i>
									Settings
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<!-- Start User Chat -->
							<div class="tab-pane active chat-sidebar-chat in active show" role="tabpanel"
								id="quick_sidebar_tab_1">
								<div class="chat-sidebar-list">
									<div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd"
										data-wrapper-class="chat-sidebar-list">
										<div class="chat-header">
											<h5 class="list-heading">Online</h5>
										</div>
										<ul class="media-list list-items">
											<li class="media"><img class="media-object"
													src="../assets/img/user/user3.jpg" width="35" height="35" alt="...">
												<i class="online dot"></i>
												<div class="media-body">
													<h5 class="media-heading">John Deo</h5>
													<div class="media-heading-sub">Spine Surgeon</div>
												</div>
											</li>
											<li class="media">
												<div class="media-status">
													<span class="badge badge-success">5</span>
												</div> <img class="media-object" src="../assets/img/user/user1.jpg"
													width="35" height="35" alt="...">
												<i class="busy dot"></i>
												<div class="media-body">
													<h5 class="media-heading">Rajesh</h5>
													<div class="media-heading-sub">Director</div>
												</div>
											</li>
											<li class="media"><img class="media-object"
													src="../assets/img/user/user5.jpg" width="35" height="35" alt="...">
												<i class="away dot"></i>
												<div class="media-body">
													<h5 class="media-heading">Jacob Ryan</h5>
													<div class="media-heading-sub">Ortho Surgeon</div>
												</div>
											</li>
											<li class="media">
												<div class="media-status">
													<span class="badge badge-danger">8</span>
												</div> <img class="media-object" src="../assets/img/user/user4.jpg"
													width="35" height="35" alt="...">
												<i class="online dot"></i>
												<div class="media-body">
													<h5 class="media-heading">Kehn Anderson</h5>
													<div class="media-heading-sub">CEO</div>
												</div>
											</li>
											<li class="media"><img class="media-object"
													src="../assets/img/user/user2.jpg" width="35" height="35" alt="...">
												<i class="busy dot"></i>
												<div class="media-body">
													<h5 class="media-heading">Sarah Smith</h5>
													<div class="media-heading-sub">Anaesthetics</div>
												</div>
											</li>
											<li class="media"><img class="media-object"
													src="../assets/img/user/user7.jpg" width="35" height="35" alt="...">
												<i class="online dot"></i>
												<div class="media-body">
													<h5 class="media-heading">Vlad Cardella</h5>
													<div class="media-heading-sub">Cardiologist</div>
												</div>
											</li>
										</ul>
										<div class="chat-header">
											<h5 class="list-heading">Offline</h5>
										</div>
										<ul class="media-list list-items">
											<li class="media">
												<div class="media-status">
													<span class="badge badge-warning">4</span>
												</div> <img class="media-object" src="../assets/img/user/user6.jpg"
													width="35" height="35" alt="...">
												<i class="offline dot"></i>
												<div class="media-body">
													<h5 class="media-heading">Jennifer Maklen</h5>
													<div class="media-heading-sub">Nurse</div>
													<div class="media-heading-small">Last seen 01:20 AM</div>
												</div>
											</li>
											<li class="media"><img class="media-object"
													src="../assets/img/user/user8.jpg" width="35" height="35" alt="...">
												<i class="offline dot"></i>
												<div class="media-body">
													<h5 class="media-heading">Lina Smith</h5>
													<div class="media-heading-sub">Ortho Surgeon</div>
													<div class="media-heading-small">Last seen 11:14 PM</div>
												</div>
											</li>
											<li class="media">
												<div class="media-status">
													<span class="badge badge-success">9</span>
												</div> <img class="media-object" src="../assets/img/user/user9.jpg"
													width="35" height="35" alt="...">
												<i class="offline dot"></i>
												<div class="media-body">
													<h5 class="media-heading">Jeff Adam</h5>
													<div class="media-heading-sub">Compounder</div>
													<div class="media-heading-small">Last seen 3:31 PM</div>
												</div>
											</li>
											<li class="media"><img class="media-object"
													src="../assets/img/user/user10.jpg" width="35" height="35"
													alt="...">
												<i class="offline dot"></i>
												<div class="media-body">
													<h5 class="media-heading">Anjelina Cardella</h5>
													<div class="media-heading-sub">Physiotherapist</div>
													<div class="media-heading-small">Last seen 7:45 PM</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- End User Chat -->
							<!-- Start Setting Panel -->
							<div class="tab-pane chat-sidebar-settings" role="tabpanel" id="quick_sidebar_tab_3">
								<div class="chat-sidebar-settings-list slimscroll-style">
									<div class="chat-header">
										<h5 class="list-heading">Layout Settings</h5>
									</div>
									<div class="chatpane inner-content ">
										<div class="settings-list">
											<div class="setting-item">
												<div class="setting-text">Sidebar Position</div>
												<div class="setting-set">
													<select
														class="sidebar-pos-option form-control input-inline input-sm input-small ">
														<option value="left" selected='selected'>Left</option>
														<option value="right">Right</option>
													</select>
												</div>
											</div>
											<div class="setting-item">
												<div class="setting-text">Header</div>
												<div class="setting-set">
													<select
														class="page-header-option form-control input-inline input-sm input-small ">
														<option value="fixed" selected="selected">Fixed</option>
														<option value="default">Default</option>
													</select>
												</div>
											</div>
											<div class="setting-item">
												<div class="setting-text">Footer</div>
												<div class="setting-set">
													<select
														class="page-footer-option form-control input-inline input-sm input-small ">
														<option value="fixed">Fixed</option>
														<option value="default" selected="selected">Default</option>
													</select>
												</div>
											</div>
										</div>
										<div class="chat-header">
											<h5 class="list-heading">Account Settings</h5>
										</div>
										<div class="settings-list">
											<div class="setting-item">
												<div class="setting-text">Notifications</div>
												<div class="setting-set">
													<div class="switch">
														<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
															for="switch-1">
															<input type="checkbox" id="switch-1"
																class="mdl-switch__input" checked>
														</label>
													</div>
												</div>
											</div>
											<div class="setting-item">
												<div class="setting-text">Show Online</div>
												<div class="setting-set">
													<div class="switch">
														<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
															for="switch-7">
															<input type="checkbox" id="switch-7"
																class="mdl-switch__input" checked>
														</label>
													</div>
												</div>
											</div>
											<div class="setting-item">
												<div class="setting-text">Status</div>
												<div class="setting-set">
													<div class="switch">
														<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
															for="switch-2">
															<input type="checkbox" id="switch-2"
																class="mdl-switch__input" checked>
														</label>
													</div>
												</div>
											</div>
											<div class="setting-item">
												<div class="setting-text">2 Steps Verification</div>
												<div class="setting-set">
													<div class="switch">
														<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
															for="switch-3">
															<input type="checkbox" id="switch-3"
																class="mdl-switch__input" checked>
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="chat-header">
											<h5 class="list-heading">General Settings</h5>
										</div>
										<div class="settings-list">
											<div class="setting-item">
												<div class="setting-text">Location</div>
												<div class="setting-set">
													<div class="switch">
														<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
															for="switch-4">
															<input type="checkbox" id="switch-4"
																class="mdl-switch__input" checked>
														</label>
													</div>
												</div>
											</div>
											<div class="setting-item">
												<div class="setting-text">Save Histry</div>
												<div class="setting-set">
													<div class="switch">
														<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
															for="switch-5">
															<input type="checkbox" id="switch-5"
																class="mdl-switch__input" checked>
														</label>
													</div>
												</div>
											</div>
											<div class="setting-item">
												<div class="setting-text">Auto Updates</div>
												<div class="setting-set">
													<div class="switch">
														<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
															for="switch-6">
															<input type="checkbox" id="switch-6"
																class="mdl-switch__input" checked>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end chat sidebar -->
			</div>
    
</template>
<script>
export default {
	name:"profileComponent",
	props: [
		'authid',
		'authmatricule',
		'authphoto',
		'authprenom',
		'authnom',
 		'authemail',
		'authadresse',
 		'authtelephone',
 		'authdate_de_naissance',
		'authgenre',
		'authlieu_de_naissance',
 		'authnationalite',
		'authstatus',
		 'authrole',
		'authdepartement',
		'authunite_de_formation',
		
		],
  data() {
    return {
      sidebarPosition: 'left',
      pageHeaderOption: 'fixed',
	  form: new Form({
				'photo':"",
                'nom': "",
                'prenom': "",
                'genre': "",
                'adresse': "",
                'telephone': "",
                'email': "",
                'date_naissance': "",
                'lieu_naissance': "",
                'nationalite': "",
                'id_role': "",
                'id_specialite': "",
                'id_departement': "",
                'id_service': "",
                'type': "",
                'situation_matrimoniale': ""
            }),
			utilisateurs: [],
			userId: null,
      userDetails: null,
	  authservice:[],
    };
  },
  mounted() {
    // Vous pouvez utiliser this.sidebarPosition et this.pageHeaderOption ici
    // pour accéder aux valeurs et les manipuler si nécessaire.
	
		//this.fetchUserDetails();
		console.log("service profil");
		this.getServiceUtilisateurConnecte();
  },
  methods:{
	fetchUserDetails() {
      const userId = this.$route.params.id;

      // Utilisez userId pour récupérer les informations de l'utilisateur depuis votre API
      // Exemple avec axios :
      axios.get(`/user/${userId}`)
        .then(response => {
          this.userDetails = response.data.user;
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des détails de l\'utilisateur', error);
        });
    },

	getServiceUtilisateurConnecte() {
      axios.get('/utilisateur/service')
        .then(response => {
          this.authservice  = response.data.service;
          /* const users = response.data.users;
 */
          
        })
        .catch(error => {
          Swal.fire('Erreur!', 'récupération des utilisateurs', 'error');
        });
    },

	getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : '';
        },
  }
};
</script>
