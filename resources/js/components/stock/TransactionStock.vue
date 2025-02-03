<template>
  <div>
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
          <div class="row">
            <div class="col-md-12">
              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-exchange font-blue-hoki"></i>
                    <span class="caption-subject font-blue-hoki bold uppercase">Transactions Stock</span>
                  </div>
                </div>
                <div class="portlet-body">
                  <!-- Filtres -->
                  <div class="row mb-3">
                    <div class="col-md-3">
                      <select v-model="sourceFilter" class="form-control">
                        <option value="">Toutes les sources</option>
                        <option value="stock">Stock</option>
                        <option value="commande">Commande</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <select v-model="typeFilter" class="form-control">
                        <option value="">Tous les types</option>
                        <option value="materiel">Matériel</option>
                        <option value="consommable">Consommable</option>
                      </select>
                    </div>
                  </div>

                  <!-- Tableau des transactions -->
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Type</th>
                          <th>Libellé</th>
                          <th>Quantité</th>
                          <th>Source</th>
                          <th>Département</th>
                          <th>Utilisateur</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="transaction in filteredTransactions" :key="transaction.id">
                          <td>{{ formatDate(transaction.date_entree) }}</td>
                          <td>{{ transaction.type }}</td>
                          <td>{{ transaction.libelle }}</td>
                          <td>{{ transaction.quantite }}</td>
                          <td>{{ transaction.source }}</td>
                          <td>{{ transaction.departement?.nom_departement }}</td>
                          <td>{{ transaction.user?.nom }} {{ transaction.user?.prenom }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <!-- Pagination -->
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <nav>
                        <ul class="pagination">
                          <li :class="{'disabled': currentPage === 1}">
                            <a href="#" @click.prevent="changePage(currentPage - 1)">Précédent</a>
                          </li>
                          <li v-for="page in totalPages" :key="page" :class="{'active': currentPage === page}">
                            <a href="#" @click.prevent="changePage(page)">{{ page }}</a>
                          </li>
                          <li :class="{'disabled': currentPage === totalPages}">
                            <a href="#" @click.prevent="changePage(currentPage + 1)">Suivant</a>
                          </li>
                        </ul>
                      </nav>
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
import appheader from "../layouts/appheader.vue";
import appnavbar from "../layouts/appnavbar.vue";
import axios from "axios";
import moment from "moment";

export default {
  components: {
    appheader,
    appnavbar,
  },
  data() {
    return {
      transactions: [],
      sourceFilter: "",
      typeFilter: "",
      currentPage: 1,
      perPage: 10,
      total: 0
    };
  },
  computed: {
    token() {
      return localStorage.getItem("token");
    },
    userNom() {
      return this.$store.state.userNom;
    },
    userPrenom() {
      return this.$store.state.userPrenom;
    },
    userIdrole() {
      return this.$store.state.userIdrole;
    },
    userPhoto() {
      return this.$store.state.userPhoto;
    },
    userRole() {
      return this.$store.state.userRole;
    },
    filteredTransactions() {
      return this.transactions.filter(transaction => {
        if (this.sourceFilter && transaction.source !== this.sourceFilter) return false;
        if (this.typeFilter && transaction.type !== this.typeFilter) return false;
        return true;
      });
    },
    totalPages() {
      return Math.ceil(this.total / this.perPage);
    }
  },
  methods: {
    formatDate(date) {
      return moment(date).format('DD/MM/YYYY HH:mm');
    },
    async fetchTransactions() {
      try {
        const response = await axios.get(`/api/stock/transactions`, {
          headers: { Authorization: `Bearer ${this.token}` },
          params: {
            page: this.currentPage,
            per_page: this.perPage,
            source: this.sourceFilter,
            type: this.typeFilter
          }
        });
        this.transactions = response.data.data;
        this.total = response.data.total;
      } catch (error) {
        console.error('Erreur lors de la récupération des transactions:', error);
      }
    },
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
        this.fetchTransactions();
      }
    }
  },
  created() {
    this.fetchTransactions();
  },
  watch: {
    sourceFilter() {
      this.currentPage = 1;
      this.fetchTransactions();
    },
    typeFilter() {
      this.currentPage = 1;
      this.fetchTransactions();
    }
  }
};
</script>

<style scoped>
.mb-3 {
  margin-bottom: 1rem;
}
.pagination {
  display: inline-flex;
  padding-left: 0;
  margin: 20px 0;
  border-radius: 4px;
}
.pagination > li {
  display: inline;
}
.pagination > li > a {
  position: relative;
  float: left;
  padding: 6px 12px;
  margin-left: -1px;
  line-height: 1.42857143;
  color: #337ab7;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #ddd;
}
.pagination > .active > a {
  z-index: 3;
  color: #fff;
  cursor: default;
  background-color: #337ab7;
  border-color: #337ab7;
}
.pagination > .disabled > a {
  color: #777;
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd;
}
</style>
