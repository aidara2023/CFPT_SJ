<template>
    <!-- start widget -->
    <div class="state-overview">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-b-green">
                    <span class="info-box-icon push-bottom"
                        ><i data-feather="grid"></i
                    ></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Départements</span>
                        <span class="info-box-number">{{ this.countDep }}</span>
                        <div class="progress">
                            <div
                                class="progress-bar"
                                :style="{ width: countDep + '%' }"
                            ></div>
                        </div>
                        <span class="progress-description"> Disponible </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-b-yellow">
                    <span class="info-box-icon push-bottom"
                        ><i data-feather="user-check"></i
                    ></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Etudiants</span>
                        <span class="info-box-number">{{ countElev }}</span>
                        <div class="progress">
                            <div
                                class="progress-bar"
                                :style="{ width: countElev + '%' }"
                            ></div>
                        </div>
                        <span class="progress-description"> Disponible </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-b-blue">
                    <span class="info-box-icon push-bottom"
                        ><i data-feather="user-plus"></i
                    ></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Formateurs</span>
                        <span class="info-box-number">{{
                            countFormateur
                        }}</span>
                        <div class="progress">
                            <div
                                class="progress-bar"
                                :style="{ width: countFormateur + '%' }"
                            ></div>
                        </div>
                        <span class="progress-description"> Disponible </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-b-pink">
                    <span class="info-box-icon push-bottom"
                        ><i data-feather="layers"></i
                    ></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Unité de formation</span>
                        <span class="info-box-number">{{ countFiliere }}</span
                        ><span></span>
                        <div class="progress">
                            <div
                                class="progress-bar"
                                :style="{ width: countFiliere + '%' }"
                            ></div>
                        </div>
                        <span class="progress-description"> Disponible </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- end widget -->
    <!-- chart start -->
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-box">
                <div class="card-head">
                    <header>Recouvrement des étudiants</header>
                    <div class="tools">
                        <a
                            class="fa fa-repeat btn-color box-refresh"
                            href="javascript:;"
                        ></a>
                        <a
                            class="t-collapse btn-color fa fa-chevron-down"
                            href="javascript:;"
                        ></a>
                        <a
                            class="t-close btn-color fa fa-times"
                            href="javascript:;"
                        ></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="recent-report__chart">
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card card-box">
                <div class="card-head">
                    <header>Recouvrement des séminaires</header>
                    <div class="tools">
                        <a
                            class="fa fa-repeat btn-color box-refresh"
                            href="javascript:;"
                        ></a>
                        <a
                            class="t-collapse btn-color fa fa-chevron-down"
                            href="javascript:;"
                        ></a>
                        <a
                            class="t-close btn-color fa fa-times"
                            href="javascript:;"
                        ></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="recent-report__chart">
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart end -->
    <div class="row">
        <div class="col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card-box">
                <div class="card-head">
                    <header>Derniers utilisateurs enregistrés</header>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>

                                    <th>Fonction</th>
                                    <th>Statut</th>
                                    <th>Notation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(utilisateur, index) in utilisateurs"
                                    :key="index"
                                >
                                    <td class="patient-img">
                                        <img
                                            :src="
                                                getImageUrl(utilisateur.photo)
                                            "
                                            alt=""
                                        />
                                    </td>
                                    <td>{{ utilisateur.nom }}</td>
                                    <td>{{ utilisateur.prenom }}</td>
                                    <td>{{ utilisateur.email }}</td>

                                    <td>{{ utilisateur.role.intitule }}</td>
                                    <td>
                                        {{
                                            utilisateur.status === 1
                                                ? "Inactif"
                                                : "Actif"
                                        }}
                                    </td>
                                    <td>
                                        <i class="fas fa-star col-orange"></i>
                                        <i class="fas fa-star col-orange"></i>
                                        <i class="fas fa-star col-orange"></i>
                                        <i class="fas fa-star col-orange"></i>
                                        <i class="far fa-star col-orange"></i>
                                    </td>
                                    <td>
                                        <a
                                            href="javascript:void(0)"
                                            class="tblEditBtn"
                                        >
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a
                                            href="javascript:void(0)"
                                            class="tblDelBtn"
                                        >
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="box-title">
                        <small class="pull-right small-lbl-green"
                            ><i class="far fa-arrow-alt-circle-up"></i>
                            Excellent</small
                        >
                        Performance Etudiants
                    </div>
                    <div class="mt-3">
                        <div class="stat-item">
                            <div class="h6">Croissance globale</div>
                            <b>35.80%</b>
                        </div>
                        <div class="stat-item">
                            <div class="h6">Mois</div>
                            <b>45.20%</b>
                        </div>
                        <div class="stat-item">
                            <div class="h6">Jour</div>
                            <b>5.50%</b>
                        </div>
                    </div>
                    <div id="schart1"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card-box">
                <div class="card-head">
                    <header>Fonctions</header>
                    <button
                        id="panel-button5"
                        class="mdl-button mdl-js-button mdl-button--icon pull-right"
                        data-upgraded=",MaterialButton"
                    >
                        <i class="material-icons">more_vert</i>
                    </button>
                    <ul
                        class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        data-mdl-for="panel-button5"
                    >
                        <li class="mdl-menu__item">
                            <i class="material-icons">assistant_photo</i>Action
                        </li>
                        <li class="mdl-menu__item">
                            <i class="material-icons">print</i>Another action
                        </li>
                        <li class="mdl-menu__item">
                            <i class="material-icons">favorite</i>Something else
                            here
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="table table-striped custom-table table-hover"
                        >
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nom fonction</th>
                                    <!--  <th>Graph</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(
                                        count, role, index
                                    ) in countRoleOccurrences()"
                                    :key="role"
                                >
                                    <td>{{ count }}</td>
                                    <td>{{ role }}</td>
                                    <!--   <td>
                                        <div :id="'sparkline' + index"></div>
                                    </td> -->
                                    <td>
                                        <a
                                            href="javascript:void(0)"
                                            class="tblEditBtn"
                                        >
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a
                                            href="javascript:void(0)"
                                            class="tblDelBtn"
                                        >
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card-box">
                <div class="card-head">
                    <header>Dernières Transactions</header>
                    <!--      <button id="panel-button8" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                        data-upgraded=",MaterialButton">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        data-mdl-for="panel-button8">
                        <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                            here</li>
                    </ul> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" style="width: 100%">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Status</th>
                                    <th>Montant</th>
                                    <th>Classe</th>
                                    <th>Edit</th>
                                </tr>
                                <tr v-for="paiement in paiements">
                                    <td class="patient-img">
                                        <img
                                            :src="
                                                this.getImageUrl(paiement.photo)
                                            "
                                            alt=""
                                        />
                                    </td>
                                    <td>{{ paiement.matricule }}</td>
                                    <td>
                                        {{ paiement.eleve_nom }}
                                        {{ paiement.eleve_prenom }}
                                    </td>
                                    <td
                                        v-if="
                                            paiement.type_formation ===
                                                'BTS ' &&
                                            paiement.montant >= 70000
                                        "
                                    >
                                        <i
                                            class="fas fa-circle col-green me-2"
                                        ></i>
                                    </td>
                                    <td
                                        v-if="
                                            paiement.type_formation ===
                                                'BTS ' &&
                                            paiement.montant < 70000
                                        "
                                    >
                                        <i
                                            class="fas fa-circle col-red me-2"
                                        ></i>
                                    </td>
                                    <td
                                        v-if="
                                            paiement.type_formation === 'BTI' &&
                                            paiement.montant < 50000
                                        "
                                    >
                                        <i
                                            class="fas fa-circle col-red me-2"
                                        ></i>
                                    </td>
                                    <td
                                        v-if="
                                            paiement.type_formation === 'BTI' &&
                                            paiement.montant >= 50000
                                        "
                                    >
                                        <i
                                            class="fas fa-circle col-green me-2"
                                        ></i>
                                    </td>
                                    <td>{{ paiement.montant }} F CFA</td>
                                    <td>
                                        {{ paiement.classe }}
                                        {{ paiement.niveau }}
                                        {{ paiement.type_classe }}
                                    </td>
                                    <td>
                                        <a
                                            data-toggle="tooltip"
                                            title=""
                                            data-bs-original-title="Edit"
                                            aria-label="Edit"
                                            ><i class="fas fa-pencil-alt"></i
                                        ></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Quick Mail start -->
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="inbox">
                <div class="card">
                    <div class="card-body no-padding height-9">
                        <div class="inbox-body">
                            <div class="mail-list">
                                <div class="compose-mail">
                                    <form method="post">
                                        <div class="email-form">
                                            <label for="to" class="">A:</label>
                                            <input
                                                type="text"
                                                tabindex="1"
                                                id="to"
                                                class="form-control itemField"
                                            />
                                            <div class="compose-options">
                                                <a
                                                    onclick="$(this).hide(); $('#cc').parent().removeClass('hidden'); $('#cc').focus();"
                                                    href="javascript:;"
                                                    >Cc</a
                                                >
                                                <a
                                                    onclick="$(this).hide(); $('#bcc').parent().removeClass('hidden'); $('#bcc').focus();"
                                                    href="javascript:;"
                                                    >Bcc</a
                                                >
                                            </div>
                                        </div>
                                        <div class="email-form hidden">
                                            <label for="cc" class="">Cc:</label>
                                            <input
                                                type="text"
                                                tabindex="2"
                                                id="cc"
                                                class="form-control itemField"
                                            />
                                        </div>
                                        <div class="email-form hidden">
                                            <label for="bcc" class=""
                                                >Bcc:</label
                                            >
                                            <input
                                                type="text"
                                                tabindex="2"
                                                id="bcc"
                                                class="form-control itemField"
                                            />
                                        </div>
                                        <div class="email-form">
                                            <label for="subject" class=""
                                                >Sujet:</label
                                            >
                                            <input
                                                type="text"
                                                tabindex="1"
                                                id="subject"
                                                class="form-control itemField"
                                            />
                                        </div>
                                        <div class="mt-4">
                                            <div id="summernote"></div>
                                            <input
                                                type="file"
                                                class="default"
                                                multiple
                                            />
                                        </div>
                                        <div class="box-footer clearfix">
                                            <button
                                                type="button"
                                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-primary pull-right"
                                            >
                                                Envoyer
                                                <i
                                                    class="fa fa-paper-plane-o"
                                                ></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick Mail end -->
        <!-- Activity feed start -->
        <!--  <div class="col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card-box">
                <div class="card-head">
                    <header>Activity Feed</header>
                    <button id="feedMenu" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                        data-upgraded=",MaterialButton">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" data-mdl-for="feedMenu">
                        <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                            here</li>
                    </ul>
                </div>
                <div class="card-body ">
                    <ul class="feedBody docListWindow small-slimscroll-style">
                        <li class="active-feed">
                            <div class="feed-user-img">
                                <img src="/assets/img/user/user1.jpg" class="img-radius " alt="User-Profile-Image">
                            </div>
                            <h6>
                                <span class="feedLblStyle lblFileStyle">File</span> Sarah
                                Smith <small class="text-muted">6 hours ago</small>
                            </h6>
                            <p class="m-b-15 m-t-15">
                                hii John, I have upload doc related to task.
                            </p>
                        </li>
                        <li class="diactive-feed">
                            <div class="feed-user-img">
                                <img src="/assets/img/user/user2.jpg" class="img-radius " alt="User-Profile-Image">
                            </div>
                            <h6>
                                <span class="feedLblStyle lblTaskStyle">Task </span> Jalpa
                                Joshi<small class="text-muted">5 hours
                                    ago</small>
                            </h6>
                            <p class="m-b-15 m-t-15">
                                Please do as specify. Let me know if you have any query.
                            </p>
                        </li>
                        <li class="diactive-feed">
                            <div class="feed-user-img">
                                <img src="/assets/img/user/user3.jpg" class="img-radius " alt="User-Profile-Image">
                            </div>
                            <h6>
                                <span class="feedLblStyle lblCommentStyle">comment</span> Lina
                                Smith<small class="text-muted">6 hours ago</small>
                            </h6>
                            <p class="m-b-15 m-t-15">
                                Hey, How are you??
                            </p>
                        </li>
                        <li class="active-feed">
                            <div class="feed-user-img">
                                <img src="/assets/img/user/user4.jpg" class="img-radius " alt="User-Profile-Image">
                            </div>
                            <h6>
                                <span class="feedLblStyle lblReplyStyle">Reply</span> Jacob
                                Ryan
                                <small class="text-muted">7 hours ago</small>
                            </h6>
                            <p class="m-b-15 m-t-15">
                                I am fine. You??
                            </p>
                        </li>
                        <li class="active-feed">
                            <div class="feed-user-img">
                                <img src="/assets/img/user/user5.jpg" class="img-radius " alt="User-Profile-Image">
                            </div>
                            <h6>
                                <span class="feedLblStyle lblFileStyle">File</span> Sarah
                                Smith <small class="text-muted">6 hours ago</small>
                            </h6>
                            <p class="m-b-15 m-t-15">
                                hii John, I have upload doc related to task.
                            </p>
                        </li>
                        <li class="diactive-feed">
                            <div class="feed-user-img">
                                <img src="/assets/img/user/user6.jpg" class="img-radius " alt="User-Profile-Image">
                            </div>
                            <h6>
                                <span class="feedLblStyle lblTaskStyle">Task </span> Jalpa
                                Joshi<small class="text-muted">5 hours
                                    ago</small>
                            </h6>
                            <p class="m-b-15 m-t-15">
                                Please do as specify. Let me know if you have any query.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->
        <!-- Activity feed end -->
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Audits</header>
                </div>
                <div class="card-body">
                    <div class="row">
                        <ul class="docListWindow small-slimscroll-style">
                            <li v-for="audit in audits">
                                <div class="prog-avatar">
                                    <img
                                        :src="
                                            this.getImageUrl(audit.user.photo)
                                        "
                                        alt=""
                                        width="40"
                                        height="40"
                                    />
                                </div>
                                <div class="details">
                                    <div class="title">
                                        <a href="#"
                                            >{{ audit.user.nom }}
                                            {{ audit.user.prenom }}</a
                                        >
                                        -{{ formatTime(audit.created_at) }}
                                    </div>
                                    <div v-show="audit.action == 'Suppression'">
                                        <span
                                            class="feedLblStyle lblFileStyle"
                                            >{{ audit.action }}</span
                                        >
                                        {{ audit.details }}
                                        <small class="text-muted">{{
                                            formatDateTime(audit.created_at)
                                        }}</small>
                                    </div>
                                    <div v-show="audit.action == 'Creation'">
                                        <span
                                            class="feedLblStyle lblTaskStyle"
                                            >{{ audit.action }}</span
                                        >
                                        {{ audit.details }}
                                        <small class="text-muted">{{
                                            formatDateTime(audit.created_at)
                                        }}</small>
                                    </div>
                                    <div
                                        v-show="audit.action == 'Modification'"
                                    >
                                        <span
                                            class="feedLblStyle lblCommentStyle"
                                            >{{ audit.action }}</span
                                        >
                                        {{ audit.details }}
                                        <small class="text-muted">{{
                                            formatDateTime(audit.created_at)
                                        }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- <div class="full-width text-center p-t-10">
                            <a href="#" class="btn purple btn-outline btn-circle margin-0">View All</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- start new student list -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Liste Etudiant inscrit</header>
                    <div class="tools">
                        <a
                            class="fa fa-repeat btn-color box-refresh"
                            href="javascript:;"
                        ></a>
                        <a
                            class="t-collapse btn-color fa fa-chevron-down"
                            href="javascript:;"
                        ></a>
                        <a
                            class="t-close btn-color fa fa-times"
                            href="javascript:;"
                        ></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table
                                class="table display product-overview mb-30"
                                id="support_table"
                            >
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Classe</th>
                                        <th>Montant</th>
                                        <th>Année Académique</th>
                                        <th>Date</th>
                                        <th>Etat paiement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd gradeX"
                                        v-for="(
                                            inscription, index
                                        ) in inscriptions"
                                    >
                                        <td class="patient-img">
                                            <img
                                                :src="
                                                    getImageUrl(
                                                        inscription.photo
                                                    )
                                                "
                                                alt="Etu"
                                            />
                                        </td>
                                        <td>{{ inscription.matricule }}</td>
                                        <td class="left">
                                            {{ inscription.nom }}
                                        </td>
                                        <td class="left">
                                            {{ inscription.prenom }}
                                        </td>
                                        <td class="left">
                                            {{ inscription.classe }}
                                        </td>
                                        <td class="left">
                                            {{ inscription.montant }} F
                                        </td>
                                        <td class="left">
                                            {{ inscription.annee_academique }}
                                        </td>
                                        <td class="left">
                                            {{ formatDateTime(inscription.date) }}
                                        </td>
                                        <td>
                                            <span class="label label-sm label-success">Soldé</span>
                                        </td>
                                        <td>
                                            <a
                                                class="tblEditBtn"
                                                @click="openModal(inscription)"
                                            >
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a
                                                href="javascript:void(0)"
                                                class="tblDelBtn"
                                                @click="
                                                    deleteInscription(
                                                        inscription
                                                    )
                                                "
                                            >
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end new student list -->
</template>
<script>
import bus from "../../eventBus";
import axios from "axios";
import Form from "vform";
import * as sparklineData from "/public/assets/js/pages/sparkline/sparkline-data.js";

export default {
    data() {
        return {
            form: new Form({
                nom: "",
                prenom: "",
                genre: "",
                adresse: "",
                telephone: "",
                email: "",
                date_naissance: "",
                lieu_naissance: "",
                nationalite: "",
                id_role: "",
                id_specialite: "",
                id_departement: "",
                id_service: "",
                type: "",
                situation_matrimoniale: "",
            }),
            utilisateurs: [],
            inscriptions: [],
            paiements: [],
            roles: [],
            audits: [],
            countDep: null,
            countElev: null,
            countFormateur: null,
            countFiliere: null,
        };
    },
    mounted() {
        sparklineData.initSparklines();

        this.fetchUtilisateurs();
        this.get_audit();
        this.get_departement();
        this.get_eleve();
        this.get_formateur();
        this.get_filiere();
        this.get_paiement();
        this.getInscription();
        // this.fetchRoles().then(() => {
        // ... (autres actions au montage)
        //});
    },

    methods: {
        get_paiement() {
            axios
                .get("/paiement/get_last")
                .then((response) => {
                    const allpaiement = response.data.paiement;

                    const formattedPaiement = allpaiement.map((paie) => {
                        return {
                            id: paie.id,
                            id_eleve: paie.eleve.user.id,
                            matricule: paie.eleve.user.matricule,
                            photo: paie.eleve.user.photo,
                            eleve_prenom: paie.eleve.user.prenom,
                            eleve_nom: paie.eleve.user.nom,
                            date_naissance: paie.eleve.user.date_naissance,
                            adresse: paie.eleve.user.adresse,
                            matricule: paie.eleve.user.matricule,

                            type_recouvrement: paie.type_recouvrement,
                            mode_paiement: paie.mode_paiement,
                            reference: paie.reference,
                            classe: paie.eleve.inscription
                                .map((p) => p.classe.nom_classe)
                                .join(", "),
                            niveau: paie.eleve.inscription
                                .map((p) => p.classe.niveau)
                                .join(", "),
                            type_classe: paie.eleve.inscription
                                .map((p) => p.classe.type_classe)
                                .join(", "),
                            type_formation: paie.eleve.inscription
                                .map((p) => p.classe.type_formation.intitule)
                                .join(", "),
                            annee: paie.concerner
                                .map((p) => p.annee_academique.intitule)
                                .join(", "),
                            mois: paie.concerner
                                .map((p) => p.mois.intitule)
                                .join(", "),
                            id_annee: paie.concerner
                                .map((p) => p.annee_academique.id)
                                .join(", "),
                            id_mois: paie.concerner
                                .map((p) => p.mois.id)
                                .join(", "),
                            montant: paie.montant,
                            editModal: true,
                        };
                    });
                    this.paiements = formattedPaiement;
                    console.log(this.paiements);
                    /*  this.initDataTable(); */
                })
                .catch((error) => {
                    Swal.fire(
                        "Erreur!",
                        "Une erreur est survenue lors de la recuperation des paiements",
                        "error"
                    );
                });
        },
        formatDateTime(dateTime) {
            // Utilisez une fonction pour formater la date
            return this.formatDate(new Date(dateTime));
        },
        formatDate(date) {
            const day = date.getDate();
            const monthNumber = date.getMonth() + 1;
            const year = date.getFullYear();

            // Tableau des trois premières lettres des mois en français
            const monthAbbreviations = [
                "Jan",
                "Fév",
                "Mar",
                "Avr",
                "Mai",
                "Juin",
                "Juil",
                "Aoû",
                "Sep",
                "Oct",
                "Nov",
                "Déc",
            ];

            // Obtenez les trois premières lettres du mois correspondant au numéro du mois
            const month = monthAbbreviations[monthNumber - 1];

            return `${day} ${month} ${year}`;
        },
        formatTime(timerecup) {
            return this.getTime(new Date(timerecup));
        },

        getTime(date) {
            const hours = date.getHours();
            const minutes = date.getMinutes();

            // Ajoutez un zéro devant les heures ou les minutes si elles sont inférieures à 10
            const formattedHours = hours < 10 ? `0${hours}` : hours;
            const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;

            return `${formattedHours}:${formattedMinutes}`;
        },

        getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : "";
        },
        fetchUtilisateurs() {
            // Exemple : remplacez cela par votre logique de récupération de données
            // et assurez-vous que les données sont correctement assignées à utilisateurs
            axios
                .get("/user/index")
                .then((response) => {
                    this.utilisateurs = response.data.user.slice(0, 7);
                    console.log(this.utilisateurs);
                })
                .catch((error) => {
                    console.error(
                        "Erreur lors de la récupération des utilisateurs",
                        error
                    );
                });
        },
        getInscription() {
            // Exemple : remplacez cela par votre logique de récupération de données
            // et assurez-vous que les données sont correctement assignées à utilisateurs
            axios
                .get("/inscription/last")
                .then((response) => {
                    const allInscriptions = response.data.inscription;

                    const inscriptionVal = allInscriptions.filter(
                        (inscription) => {
                            return inscription.statut == 1;
                        }
                    );

                    const formattedInscriptionVal = inscriptionVal.map(
                        (inscrit) => {
                            return {
                                id: inscrit.id,
                                photo: inscrit.eleve.user.photo,
                                matricule: inscrit.eleve.user.matricule,
                                nom: inscrit.eleve.user.nom,
                               
                                prenom: inscrit.eleve.user.prenom,
                               
                              
                               
                                classe:
                                    inscrit.classe.type_formation.intitule +
                                    " " +
                                    inscrit.classe.nom_classe +
                                    " " +
                                    inscrit.classe.niveau +
                                    " " +
                                    inscrit.classe.type_classe,
                                annee_academique:
                                    inscrit.annee_academique.intitule,
                                
                                statut: inscrit.statut,
                               
                                date: inscrit.created_at,
                                montant: inscrit.montant,
                               
                               
                                nom_departement:
                                    inscrit.classe.unite_de_formation
                                        .departement.nom_departement,
                                nom_filiere:
                                    inscrit.classe.unite_de_formation
                                        .nom_unite_formation,
                            };
                        }
                    );
                    this.inscriptions = formattedInscriptionVal;
                })
                .catch((error) => {
                    console.error(
                        "Erreur lors de la récupération des etudiants inscrit",
                        error
                    );
                });
        },
        get_departement() {
            axios
                .get("/departement/all")
                .then((response) => {
                    this.countDep = response.data.departement.length;
                })
                .catch((error) => {
                    Swal.fire(
                        "Erreur!",
                        "Une erreur est survenue lors de la recupération du nombre de département",
                        "error"
                    );
                });
        },
        get_filiere() {
            axios
                .get("/unite_de_formation/all")
                .then((response) => {
                    this.countFiliere = response.data.unite_de_formation.length;
                })
                .catch((error) => {
                    Swal.fire(
                        "Erreur!",
                        "Une erreur est survenue lors de la recupération du nombre de filiere",
                        "error"
                    );
                });
        },
        get_formateur() {
            axios
                .get("/formateur/index")
                .then((response) => {
                    this.countFormateur = response.data.formateur.length;
                })
                .catch((error) => {
                    Swal.fire(
                        "Erreur!",
                        "Une erreur est survenue lors de la recupération des audit",
                        "error"
                    );
                });
        },
        get_eleve() {
            axios
                .get("/eleve/index")
                .then((response) => {
                    this.countElev = response.data.eleve.length;
                })
                .catch((error) => {
                    Swal.fire(
                        "Erreur!",
                        "Une erreur est survenue lors de la recupération du nombre des étudiants",
                        "error"
                    );
                });
        },
        get_audit() {
            axios
                .get("/audit/all")
                .then((response) => {
                    this.audits = response.data.audit;
                })
                .catch((error) => {
                    Swal.fire(
                        "Erreur!",
                        "Une erreur est survenue lors de la recupération des audit",
                        "error"
                    );
                });
        },

        countRoleOccurrences() {
            const roleOccurrences = {};

            this.utilisateurs.forEach((user) => {
                const roleIntitule = user.role
                    ? user.role.intitule
                    : "Non défini";

                if (!roleOccurrences[roleIntitule]) {
                    roleOccurrences[roleIntitule] = 1;
                } else {
                    roleOccurrences[roleIntitule]++;
                }
            });

            return roleOccurrences;
        }, //audit/all
    },
};
</script>
