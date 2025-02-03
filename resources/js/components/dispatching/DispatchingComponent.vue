<template>
  <div class="page-wrapper">
    <div class="page-header navbar navbar-fixed-top">
      <div class="page-header-inner">
        <appheader
          :userPhoto="userPhoto"
          :userNom="userNom"
          :userPrenom="userPrenom"
        />
      </div>
    </div>
    <div class="page-container">
      <appnavbar
        :userNom="userNom"
        :userPrenom="userPrenom"
        :userPhoto="userPhoto"
        :userIdrole="userIdrole"
        :userRole="userRole"
      />
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class="pull-left">
                <div class="page-title">Gestion des Dispatchings</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                <li class="active">Dispatchings</li>
              </ol>
            </div>
          </div>

          <!-- Filtres -->
          <div class="row mb-4">
            <div class="col-md-12">
              <div class="card">
                <div class="card-head">
                  <header>Filtres</header>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Type d'article</label>
                        <select v-model="filters.type" class="form-control">
                          <option value="">Tous</option>
                          <option value="materiel">Matériel</option>
                          <option value="consommable">Consommable</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Département</label>
                        <select v-model="filters.departement" class="form-control">
                          <option value="">Tous</option>
                          <option v-for="dept in departements" 
                                  :key="dept.id" 
                                  :value="dept.id">
                            {{ dept.nom_departement }}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Date de (début)</label>
                        <input type="date" 
                               v-model="filters.dateDebut" 
                               class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Date à (fin)</label>
                        <input type="date" 
                               v-model="filters.dateFin" 
                               class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Section 1: Articles à dispatcher -->
          <div class="row mb-4">
            <div class="col-md-12">
              <div class="card">
                <div class="card-head">
                  <header>Articles à dispatcher</header>
                  <div class="tools">
                    <span class="badge badge-info">{{ filteredDispatchings.length }} article(s)</span>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped custom-table">
                      <thead>
                        <tr>
                          <th>Article</th>
                          <th>Type</th>
                          <th>Quantité</th>
                          <th>Demandeur</th>
                          <th>Département</th>
                          <th>Date de réception</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="dispatching in filteredDispatchings" :key="dispatching.id">
                          <td>
                            {{ dispatching.materiel?.nom || dispatching.consommable?.nom }}
                            <br>
                            <small class="text-muted">
                              Réf: {{ dispatching.materiel?.reference || dispatching.consommable?.reference }}
                            </small>
                          </td>
                          <td>
                            <span :class="['badge', dispatching.materiel ? 'badge-info' : 'badge-warning']">
                              {{ dispatching.materiel ? 'Matériel' : 'Consommable' }}
                            </span>
                          </td>
                          <td>{{ dispatching.quantite }}</td>
                          <td>
                            {{ dispatching.user?.nom }} {{ dispatching.user?.prenom }}
                          </td>
                          <td>{{ dispatching.user?.departement?.nom_departement }}</td>
                          <td>{{ formatDate(dispatching.created_at) }}</td>
                          <td>
                            <button 
                              class="btn btn-primary btn-sm"
                              @click="openAffectationModal(dispatching)"
                            >
                              <i class="fa fa-location-arrow"></i> Affecter
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Section 2: Historique des affectations -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-head">
                  <header>Historique des affectations</header>
                  <div class="tools">
                    <span class="badge badge-success">{{ filteredHistorique.length }} affectation(s)</span>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped custom-table">
                      <thead>
                        <tr>
                          <th>Article</th>
                          <th>Type</th>
                          <th>Quantité</th>
                          <th>Localisation</th>
                          <th>Demandeur</th>
                          <th>Date d'affectation</th>
                          <th>Observations</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="historique in filteredHistorique" :key="historique.id">
                          <td>
                            {{ historique.materiel?.nom || historique.consommable?.nom }}
                            <br>
                            <small class="text-muted">
                              Réf: {{ historique.materiel?.reference || historique.consommable?.reference }}
                            </small>
                          </td>
                          <td>
                            <span :class="['badge', historique.materiel ? 'badge-info' : 'badge-warning']">
                              {{ historique.materiel ? 'Matériel' : 'Consommable' }}
                            </span>
                          </td>
                          <td>{{ historique.quantite }}</td>
                          <td>
                            {{ historique.batiment?.nom_batiment }} - {{ historique.salle?.nom_salle }}
                          </td>
                          <td>
                            {{ historique.user?.nom }} {{ historique.user?.prenom }}
                            <br>
                            <small class="text-muted">{{ historique.user?.departement?.nom_departement }}</small>
                          </td>
                          <td>{{ formatDate(historique.date_affectation) }}</td>
                          <td>
                            <span class="text-muted">{{ historique.observations || '-' }}</span>
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
      </div>
    </div>

    <!-- Modal d'affectation -->
    <div class="modal fade" id="affectationModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Affecter le dispatching</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submitAffectation">
              <div class="form-group">
                <label>Bâtiment</label>
                <select 
                  v-model="affectationForm.id_batiment" 
                  class="form-control"
                  @change="loadSalles"
                >
                  <option value="">Sélectionner un bâtiment</option>
                  <option 
                    v-for="batiment in batiments" 
                    :key="batiment.id"
                    :value="batiment.id"
                  >
                    {{ batiment.nom }}
                  </option>
                </select>
              </div>

              <div class="form-group">
                <label>Salle</label>
                <select 
                  v-model="affectationForm.id_salle" 
                  class="form-control"
                  :disabled="!affectationForm.id_batiment"
                >
                  <option value="">Sélectionner une salle</option>
                  <option 
                    v-for="salle in salles" 
                    :key="salle.id"
                    :value="salle.id"
                  >
                    {{ salle.nom }}
                  </option>
                </select>
              </div>

              <div class="form-group">
                <label>Quantité</label>
                <input 
                  type="number" 
                  v-model="affectationForm.quantite"
                  class="form-control"
                  :max="selectedDispatching ? selectedDispatching.quantite : 0"
                  min="1"
                />
              </div>

              <div class="form-group">
                <label>Observations</label>
                <textarea 
                  v-model="affectationForm.observations"
                  class="form-control"
                  rows="3"
                ></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button 
              type="button" 
              class="btn btn-primary"
              @click="submitAffectation"
              :disabled="!isFormValid || isSubmitting"
            >
              Affecter
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import appheader from "../layout/header.vue";
import appnavbar from "../layout/navbar.vue";
import axios from "@/axios";
import Swal from 'sweetalert2';
import moment from 'moment';
import 'moment/locale/fr';

export default {
  name: "DispatchingComponent",
  components: {
    appheader,
    appnavbar
  },
  data() {
    return {
      dispatchings: [],
      historique: [],
      departements: [],
      batiments: [],
      salles: [],
      filters: {
        type: '',
        departement: '',
        dateDebut: '',
        dateFin: ''
      },
      selectedDispatching: null,
      affectationForm: {
        id_batiment: '',
        id_salle: '',
        quantite: '',
        observations: ''
      },
      isSubmitting: false,
      loading: false
    };
  },
  computed: {
    filteredDispatchings() {
      return this.dispatchings.filter(item => {
        const matchType = !this.filters.type || 
          (this.filters.type === 'materiel' && item.materiel) ||
          (this.filters.type === 'consommable' && item.consommable);

        const matchDepartement = !this.filters.departement || 
          item.user?.departement?.id === parseInt(this.filters.departement);

        const date = moment(item.created_at);
        const matchDateDebut = !this.filters.dateDebut || 
          date.isSameOrAfter(this.filters.dateDebut, 'day');
        const matchDateFin = !this.filters.dateFin || 
          date.isSameOrBefore(this.filters.dateFin, 'day');

        return matchType && matchDepartement && matchDateDebut && matchDateFin;
      });
    },
    filteredHistorique() {
      return this.historique.filter(item => {
        const matchType = !this.filters.type || 
          (this.filters.type === 'materiel' && item.materiel) ||
          (this.filters.type === 'consommable' && item.consommable);

        const matchDepartement = !this.filters.departement || 
          item.user?.departement?.id === parseInt(this.filters.departement);

        const date = moment(item.date_affectation);
        const matchDateDebut = !this.filters.dateDebut || 
          date.isSameOrAfter(this.filters.dateDebut, 'day');
        const matchDateFin = !this.filters.dateFin || 
          date.isSameOrBefore(this.filters.dateFin, 'day');

        return matchType && matchDepartement && matchDateDebut && matchDateFin;
      });
    }
  },
  methods: {
    formatDate(date) {
      return moment(date).locale('fr').format('DD/MM/YYYY HH:mm');
    },

    async fetchData() {
      this.loading = true;
      try {
        await Promise.all([
          this.fetchDispatchings(),
          this.fetchHistorique(),
          this.fetchDepartements(),
          this.fetchBatiments(),
          this.fetchSalles()
        ]);
      } catch (error) {
        console.error('Erreur lors du chargement des données:', error);
        Swal.fire('Erreur', 'Impossible de charger les données', 'error');
      } finally {
        this.loading = false;
      }
    },

    async fetchDispatchings() {
      try {
        const response = await axios.get('/api/dispatchings/commandes-a-dispatcher');
        if (response.data.statut === 200) {
          this.dispatchings = response.data.commandes;
        }
      } catch (error) {
        console.error('Erreur lors de la récupération des dispatchings:', error);
        Swal.fire('Erreur', 'Impossible de récupérer les dispatchings', 'error');
      }
    },

    async fetchHistorique() {
      const response = await axios.get('/dispatchings/historique');
      if (response.data.statut === 200) {
        this.historique = response.data.historique;
      }
    },

    async fetchDepartements() {
      const response = await axios.get('/departements');
      if (response.data.statut === 200) {
        this.departements = response.data.departements;
      }
    },

    async fetchBatiments() {
      const response = await axios.get('/batiments');
      if (response.data.statut === 200) {
        this.batiments = response.data.batiments;
      }
    },

    async fetchSalles() {
      const response = await axios.get('/salles');
      if (response.data.statut === 200) {
        this.salles = response.data.salles;
      }
    },

    async submitAffectation() {
      if (!this.selectedDispatching) return;

      this.isSubmitting = true;
      try {
        const response = await axios.put(`/dispatchings/${this.selectedDispatching.id}/affecter`, {
          id_batiment: this.affectationForm.id_batiment,
          id_salle: this.affectationForm.id_salle,
          quantite: this.affectationForm.quantite,
          observations: this.affectationForm.observations
        });

        if (response.data.statut === 200) {
          $('#affectationModal').modal('hide');
          await Swal.fire('Succès', 'Article affecté avec succès', 'success');
          this.fetchData();
        }
      } catch (error) {
        console.error('Erreur lors de l\'affectation:', error);
        Swal.fire('Erreur', error.response?.data?.message || 'Impossible d\'affecter l\'article', 'error');
      } finally {
        this.isSubmitting = false;
      }
    },

    async loadSalles() {
      if (!this.affectationForm.id_batiment) {
        this.salles = []
        return
      }
      try {
        const response = await axios.get(`/batiments/${this.affectationForm.id_batiment}/salles`)
        this.salles = response.data.salles
      } catch (error) {
        console.error('Erreur lors du chargement des salles:', error)
        this.error = 'Impossible de charger les salles'
      }
    },

    async fetchReferences() {
      try {
        const response = await axios.get('/api/dispatchings/references', {
          headers: { Authorization: `Bearer ${this.token}` }
        });
        
        if (response.data.statut === 200) {
          this.references = response.data.references;
        }
      } catch (error) {
        console.error('Erreur:', error);
        Swal.fire('Erreur', 'Impossible de charger les références', 'error');
      }
    },

    openAffectationModal(dispatching) {
      this.selectedDispatching = dispatching
      this.affectationForm.quantite = dispatching.quantite
      this.affectationForm.observations = ''
      this.affectationForm.id_batiment = ''
      this.affectationForm.id_salle = ''
      $('#affectationModal').modal('show')
    }
  },
  mounted() {
    this.fetchData()
  }
}
</script>

<style scoped>
/* Variables CSS personnalisées */
:root {
  --primary-color: #4a90e2;
  --secondary-color: #f5f6fa;
  --success-color: #2ecc71;
  --warning-color: #f1c40f;
  --danger-color: #e74c3c;
  --text-color: #2c3e50;
  --border-color: #dcdde1;
  --shadow-color: rgba(0, 0, 0, 0.1);
}

/* Styles généraux */
.page-wrapper {
  background-color: var(--secondary-color);
  min-height: 100vh;
}

.page-content {
  padding: 20px;
}

/* En-tête et navigation */
.page-header {
  background-color: white;
  box-shadow: 0 2px 4px var(--shadow-color);
}

.page-title {
  color: var(--text-color);
  font-size: 1.5rem;
  font-weight: 600;
}

.breadcrumb {
  background: transparent;
  padding: 0;
}

/* Carte principale */
.card {
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px var(--shadow-color);
  margin-bottom: 20px;
  border: none;
}

.card-head {
  padding: 1.25rem;
  border-bottom: 1px solid var(--border-color);
}

.card-head header {
  color: var(--text-color);
  font-size: 1.25rem;
  font-weight: 600;
}

/* Tableau personnalisé */
.custom-table {
  width: 100%;
  margin-bottom: 0;
}

.custom-table th {
  background-color: var(--secondary-color);
  color: var(--text-color);
  font-weight: 600;
  padding: 12px;
  border-bottom: 2px solid var(--border-color);
}

.custom-table td {
  padding: 12px;
  vertical-align: middle;
  border-bottom: 1px solid var(--border-color);
}

/* Badges */
.badge {
  padding: 6px 12px;
  border-radius: 4px;
  font-weight: 500;
  font-size: 0.875rem;
}

.badge-info {
  background-color: var(--primary-color);
  color: white;
}

.badge-warning {
  background-color: var(--warning-color);
  color: white;
}

/* Modal */
.modal-content {
  border-radius: 8px;
  border: none;
  box-shadow: 0 4px 12px var(--shadow-color);
}

.modal-header {
  background-color: var(--secondary-color);
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  padding: 1rem 1.5rem;
}

.modal-title {
  color: var(--text-color);
  font-weight: 600;
}

.modal-body {
  padding: 1.5rem;
}

/* Formulaires */
.form-group {
  margin-bottom: 1.25rem;
}

.form-group label {
  color: var(--text-color);
  font-weight: 500;
  margin-bottom: 0.5rem;
  display: block;
}

.form-control {
  border-radius: 6px;
  border: 1px solid var(--border-color);
  padding: 0.625rem;
  transition: all 0.2s ease;
}

.form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
}

/* Boutons */
.btn {
  padding: 0.625rem 1.25rem;
  border-radius: 6px;
  font-weight: 500;
  transition: all 0.2s ease;
}

.btn-primary {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
}

.btn-primary:hover {
  background-color: darken(var(--primary-color), 10%);
  border-color: darken(var(--primary-color), 10%);
}

.btn-secondary {
  background-color: var(--secondary-color);
  border-color: var(--border-color);
  color: var(--text-color);
}

.btn-sm {
  padding: 0.375rem 0.75rem;
  font-size: 0.875rem;
}

/* Animations */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Responsive */
@media (max-width: 768px) {
  .page-content {
    padding: 10px;
  }

  .card-head {
    padding: 1rem;
  }

  .custom-table {
    font-size: 0.875rem;
  }

  .modal-body {
    padding: 1rem;
  }
}
</style>
