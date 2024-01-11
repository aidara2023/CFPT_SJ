<template>
    <!--  <div class="liste ">
        <div class="table-container">
            <div class="rechercheOnglet onglets grand_ecran_seulement" style="margin-top: 0px;">
                <div data-fenetre="actif"><a href="#" @click="goToStep(1)">Formateur</a></div>
                <div data-fenetre=""><a href="#" @click="goToStep(2)">Personnel Administratif</a></div>
                <div data-fenetre=""><a href="#" @click="goToStep(3)">Personnel d'appui</a></div>
               
            </div>
            <br>

            <table>
                <thead>
                    <th>Image</th>
                    <th>Matricule</th>
                    <th>Nom Complet</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Fonction</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </thead>
                <tbody>

                    <tr v-for="(utilisateur, index) in utilisateurs" :key="index">
                        <template v-if="this.activePhase === 1 && utilisateur.role.id === 2">
                            <td><span><img :src="getImageUrl(utilisateur.photo)" alt="Etu"
                                        style="width: 30px; height: 30px;"></span> </td>
                                        <td><span> {{ utilisateur.matricule }}</span></td>
                            <td> <span>{{ utilisateur.prenom }} {{ utilisateur.nom }}</span></td>
                            <td><span> {{ utilisateur.telephone }}</span></td>
                            <td><span>{{ utilisateur.email }} </span></td>
                            <td><span>{{ utilisateur.role.intitule }} </span></td>
                            <td><span>{{ utilisateur.status }} </span></td>
                            <td>
                                <div class="boutons_actions">
                                    <i class="fi fi-rr-edit modifier mdl" @click="openModal(utilisateur)"
                                        title="Modifier"></i>
                                    <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                    <i :class="utilisateur.status === 1 ? 'fi fi-rr-comment-alt-dots details mdl' : 'fi fi-rr-comment-alt-dots details mdl'"
                                        title="Toggle Statut" @click="toggleUserStatus(utilisateur)">
                                    </i>

                                </div>
                            </td>
                        </template>
                        <template
                            v-if="activePhase === 2 && utilisateur.role.categorie_personnel === 'Personnel Administratif'">
                            <td> <img :src="getImageUrl(utilisateur.photo)" alt="Etu" style="width: 30px; height: 30px;">
                            </td>
                            <td><span> {{ utilisateur.matricule }}</span></td>
                            <td> <span>{{ utilisateur.prenom }} {{ utilisateur.nom }}</span></td>
                            <td><span>{{ utilisateur.telephone }}</span></td>
                            <td><span>{{ utilisateur.email }} </span></td>
                            <td><span>{{ utilisateur.role.intitule }} </span></td>
                            <td><span>{{ utilisateur.status }} </span></td>
                            <td>
                                <div class="boutons_actions">
                                    <i class="fi fi-rr-edit modifier mdl" @click="openModal(utilisateur)"
                                        title="Modifier"></i>
                                    <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                    <i :class="utilisateur.status === 1 ? 'fi fi-rr-comment-alt-dots details mdl' : 'fi fi-rr-comment-alt-dots details mdl'"
                                        title="Toggle Statut" @click="toggleUserStatus(utilisateur)">
                                    </i>

                                </div>
                            </td>
                        </template>
                        <template v-if="activePhase === 3 && utilisateur.role.categorie_personnel === 'Personnel Appui'">
                            <td> <img :src="getImageUrl(utilisateur.photo)" alt="Etu" style="width: 30px; height: 30px;">
                            </td>
                            <td><span> {{ utilisateur.matricule }}</span></td>
                            <td> <span>{{ utilisateur.prenom }} {{ utilisateur.nom }}</span></td>
                            <td><span> {{ utilisateur.telephone }}</span></td>
                            <td><span>{{ utilisateur.email }} </span></td>
                            <td><span>{{ utilisateur.role.intitule }} </span></td>
                            <td><span>{{ utilisateur.status }} </span></td>
                            <td>
                                <div class="boutons_actions">
                                    <i class="fi fi-rr-edit modifier mdl" @click="openModal(utilisateur)"
                                        title="Modifier"></i>
                                    <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                    <i :class="utilisateur.status === 1 ? 'fi fi-rr-comment-alt-dots details mdl' : 'fi fi-rr-comment-alt-dots details mdl'"
                                        title="Toggle Statut" @click="toggleUserStatus(utilisateur)">
                                    </i>

                                </div>
                            </td>
                        </template>
                    </tr>

                </tbody>
            </table>
        </div>


    </div>
 -->
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Liste utilisateur</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" :href="'/admin/index'">Accueil</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" :href="'/utilisateur/index'">Utilisateur</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Liste utilisateur</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line">
                    <!-- <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab1" data-bs-toggle="tab"> List View </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-bs-toggle="tab"> Grid View </a>
                                </li>
                            </ul> -->
                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Formateurs</a>
                        </li>
                        <li class="nav-item"><a href="#tab2" class="nav-link" data-bs-toggle="tab">Personnel
                                Administratif</a></li>
                        <li class="nav-item"><a href="#tab3" class="nav-link" data-bs-toggle="tab">Personnel d'appui</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Tous les formateurs</header>
                                            <div class="tools">
                                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a :href="'/utilisateur/create'" id="addRow"
                                                            class="btn btn-primary">
                                                            Ajouter <i class="fa fa-plus"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                            <table
                                                class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                id="example4">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th> Matricule </th>
                                                        <th> Prénom </th>
                                                        <th> Nom </th>
                                                        <th> Email </th>
                                                        <th> Téléphone </th>
                                                        <th> Unité de formation </th>
                                                        <th> Département </th>

                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX" v-for="(utilisateur, index) in utilisateurs"
                                                        :key="index">
                                                        <template v-if="utilisateur.role.id === 2">
                                                            <td class="patient-img">
                                                                <img :src="getImageUrl(utilisateur.photo)" alt="">
                                                            </td>
                                                            <td>{{ utilisateur.matricule }}</td>
                                                            <td class="left">{{ utilisateur.prenom }}</td>
                                                            <td class="left">{{ utilisateur.nom }}</td>
                                                            <td><a :href="utilisateur.email">
                                                                    {{ utilisateur.email }} </a></td>
                                                            <td><a :href="utilisateur.telephone">
                                                                    {{ utilisateur.telephone }}</a></td>

                                                            <td class="left" v-for="ele in utilisateur.formateur">{{
                                                                ele.unite_de_formation.nom_unite_formation }}</td>
                                                            <td class="left" v-for="eles in utilisateur.formateur">{{
                                                                eles.unite_de_formation.departement.nom_departement }}</td>

                                                            <td>
                                                                <a class="tblEditBtn" @click="openModal(utilisateur)">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <a class="tblDelBtn" @click="toggleUserStatus(utilisateur)">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </a>
                                                            </td>



                                                        </template>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane  fontawesome-demo" id="tab2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Tout le personnel administratif</header>
                                            <div class="tools">
                                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a :href="'/utilisateur/create'" id="addRow"
                                                            class="btn btn-primary">
                                                            Ajouter <i class="fa fa-plus"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                            <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th> Matricule </th>
                                                            <th> Prénom </th>
                                                            <th> Nom </th>
                                                            <th> Email </th>
                                                            <th> Téléphone </th>
                                                            <th> Fonction </th>
                                                            <th> Direction </th>
                                                            <th> Service </th>
                                    
                    
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="odd gradeX" v-for="(utilisateur, index) in utilisateurs" :key="index">
                                                            <template v-if=" utilisateur.role.categorie_personnel === 'Personnel Administratif'">
                                                            <td class="patient-img">
                                                                <img :src="getImageUrl(utilisateur.photo)"  alt="">
                                                            </td>
                                                            <td>{{ utilisateur.matricule }}</td>
                                                            <td class="left">{{ utilisateur.prenom }}</td>
                                                            <td class="left">{{ utilisateur.nom }}</td>
                                                            <td><a :href= "utilisateur.email">
                                                                {{ utilisateur.email }} </a></td>
                                                            <td><a :href="utilisateur.telephone ">
                                                                {{ utilisateur.telephone }}</a></td>
                                                           
                                                                    <td class="left">{{ utilisateur.role.intitule }}</td>
                                                                    <td class="left">{{ utilisateur.direction.nom_direction }}</td>
                                                                    <td class="left">{{ utilisateur.service.nom_service }}</td>
                                                                   
                                                         
                                                            <td>
                                                                <a  class="tblEditBtn" @click="openModal(utilisateur)">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <a class="tblDelBtn"  @click="toggleUserStatus(utilisateur)">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </a>
                                                            </td>

                                                          
                       
                                                            </template>
                                                        </tr>

                                                       
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user10.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Pooja Patel </div>
                                                    <div class="name-center"> Mathematics </div>
                                                </div>
                                                <p>A-103, shyam gokul flats, Mahatma Road <br />Mumbai</p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user1.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Rajesh </div>
                                                    <div class="name-center"> Science </div>
                                                </div>
                                                <p>45, Krishna Tower, Near Bus Stop, Satellite, <br />Mumbai
                                                </p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user2.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Sarah Smith </div>
                                                    <div class="name-center"> Computer </div>
                                                </div>
                                                <p>456, Estern evenue, Courtage area, <br />New York</p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user3.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">John Deo </div>
                                                    <div class="name-center"> Engineering </div>
                                                </div>
                                                <p>A-103, shyam gokul flats, Mahatma Road <br />Mumbai</p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user4.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Jay Soni </div>
                                                    <div class="name-center"> Music </div>
                                                </div>
                                                <p>45, Krishna Tower, Near Bus Stop, Satellite, <br />Mumbai
                                                </p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user5.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Jacob Ryan </div>
                                                    <div class="name-center"> Commerce </div>
                                                </div>
                                                <p>456, Estern evenue, Courtage area, <br />New York</p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user6.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Megha Trivedi </div>
                                                    <div class="name-center"> Mechanical </div>
                                                </div>
                                                <p>A-103, shyam gokul flats, Mahatma Road <br />Mumbai</p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user1.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Rajesh </div>
                                                    <div class="name-center"> Science </div>
                                                </div>
                                                <p>45, Krishna Tower, Near Bus Stop, Satellite, <br />Mumbai
                                                </p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user2.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Sarah Smith </div>
                                                    <div class="name-center"> Computer </div>
                                                </div>
                                                <p>456, Estern evenue, Courtage area, <br />New York</p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user10.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Pooja Patel </div>
                                                    <div class="name-center"> Mathematics </div>
                                                </div>
                                                <p>A-103, shyam gokul flats, Mahatma Road <br />Mumbai</p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user1.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">Rajesh </div>
                                                    <div class="name-center"> Science </div>
                                                </div>
                                                <p>45, Krishna Tower, Near Bus Stop, Satellite, <br />Mumbai
                                                </p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">
                                            <div class="doctor-profile">
                                                <img src="../assets/img/user/user3.jpg" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">John Deo </div>
                                                    <div class="name-center"> Engineering </div>
                                                </div>
                                                <p>A-103, shyam gokul flats, Mahatma Road <br />Mumbai</p>
                                                <div>
                                                    <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            (123)456-7890</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
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
        </div>
    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';



export default {
    name: "listeUserCompenent",
    data() {
        return {
            form: new Form({
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
            idUser: "",
            editModal: false,
            activePhase: 1,
            idUser: "",


        }
    },
    mounted() {
        this.get_utilisateur();
        bus.on('utilisateurAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_utilisateur(); // Mettre à jour la liste des utilisateurs
        });
    },

    methods: {
        get_utilisateur() {
            axios.get('/user/getPersonnel')
                .then(response => {
                    this.utilisateurs = response.data.user
                    console.log(this.utilisateurs);


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recupération des utilisateurs', 'error')
                });
        },
        async toggleUserStatus(user) {
            try {
                const response = await axios.put(`/user/toggle-status/${user.id}`);

                if (response.data.status === 200) {
                    // Succès, mettez à jour la liste des utilisateurs ou affichez un message
                    this.get_utilisateur();
                    console.log(response.data.message);
                } else {
                    // Échec, affichez un message d'erreur
                    console.error(response.data.message);
                }
            } catch (error) {
                // Gestion des erreurs
                console.error(error);
            }
        },


        changement(event) {
            this.interesser = event;
        },

        goToStep: function (step) {
            this.activePhase = step;
        },

        async deleteUtilisateur(user) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Cette action sera irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/user/disable/${user.id}`).then(resp => {
                        this.get_utilisateur();

                        var confirmation = document.querySelector('[data-modal-confirmation-sup]');

                        confirmation.style.backgroundColor = 'white';
                        confirmation.style.color = 'var(--clr)';

                        confirmation.showModal();
                        confirmation.classList.add("actif");
                        setTimeout(function () {
                            confirmation.close();

                            setTimeout(function () {
                                confirmation.classList.remove("actif");
                            }, 100);

                        }, 2000);
                    }).catch(function (error) {
                        console.log(error);
                    })
                }
            });
        },

        openModal(utilisateur) {

            this.idUser = utilisateur.id;

            this.editModal = true;

            // Créez un objet avec les données à envoyer
            const eventData = {
                idUser: this.idUser,
                nom: utilisateur.nom,
                prenom: utilisateur.prenom,
                genre: utilisateur.genre,
                adresse: utilisateur.adresse,
                telephone: utilisateur.telephone,
                email: utilisateur.email,
                date_naissance: utilisateur.date_naissance,
                lieu_naissance: utilisateur.lieu_naissance,
                nationalite: utilisateur.nationalite,
                type: utilisateur.type,
                situation_matrimonial: utilisateur.situation_matrimonial,
                id_role: utilisateur.id_role,
                /* id_specialite: utilisateur.id_specialite,
                id_departement: utilisateur.id_departement, */
                /*      id_service: utilisateur.id_service, */

                editModal: this.editModal,
                // Ajoutez d'autres propriétés si nécessaire
            };

            bus.emit('utilisateurModifier', eventData);
            console.log(eventData)

            /*  var fond = document.querySelector('.fond');
             var flou = document.querySelectorAll('.flou');
             var modification = document.querySelector("[data-modal-ajout]");
 
             flou.forEach(item => {
                 item.classList.add("actif");
             });
 
             fond.classList.add("actif");
             modification.showModal();
             modification.classList.add("actif"); */
            //window.location.href = '/utilisateur/create';


        },

        getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : '';
        },



    }
}
</script>
