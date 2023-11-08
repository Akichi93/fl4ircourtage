<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid pb-0">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>
                Détails du contrat <em>{{ infos.nom_branche }} </em> -
                <em>{{ infos.numero_police }} </em> -
                <em>{{ infos.nom_client }} </em>
              </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Contrats
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="card tab-box mt-3">
          <div class="row user-tabs">
            <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
              <ul class="nav nav-tabs nav-tabs-bottom pt-3 pb-2">
                <li class="nav-item">
                  <a
                    href="#emp_profile"
                    data-bs-toggle="tab"
                    class="nav-link active"
                    >Information générale</a
                  >
                </li>
                <li class="nav-item">
                  <a href="#emp_projects" data-bs-toggle="tab" class="nav-link"
                    >Primes et commisons</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    href="#bank_statutory"
                    data-bs-toggle="tab"
                    class="nav-link"
                    >Avenants</a
                  >
                </li>
                <li
                  v-if="
                    infos.nom_branche == 'AUTOMOBILE' ||
                    infos.nom_branche == 'MOTO'
                  "
                  class="nav-item"
                >
                  <a href="#vehicule_info" data-bs-toggle="tab" class="nav-link"
                    >Listes des véhicules</a
                  >
                </li>
                <li v-if="count > 0" class="nav-item">
                  <a href="#sinistre_info" data-bs-toggle="tab" class="nav-link"
                    >Sinistres</a
                  >
                </li>
                <li class="nav-item">
                  <a href="#file_info" data-bs-toggle="tab" class="nav-link"
                    >Fichier</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="tab-content">
          <div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">Information générale</h3>
                    <ul class="personal-info">
                      <li>
                        <div class="title">No de police</div>
                        <div class="text" v-text="infos.numero_police"></div>
                      </li>
                      <li>
                        <div class="title">Branche</div>
                        <div class="text" v-text="infos.nom_branche"></div>
                      </li>
                      <li>
                        <div class="title">Client</div>
                        <div class="text" v-text="infos.nom_client"></div>
                      </li>
                      <li>
                        <div class="title">Compagnie</div>
                        <div class="text" v-text="infos.nom_compagnie"></div>
                      </li>
                      <li>
                        <div class="title">Apporteur</div>
                        <div class="text" v-text="infos.nom_apporteur"></div>
                      </li>
                      <li>
                        <div class="title">Date d'émission</div>
                        <div class="text" v-text="infos.souscrit_le"></div>
                      </li>
                      <li>
                        <div class="title">A</div>
                        <div class="text" v-text="infos.heure_police"></div>
                      </li>
                      <li>
                        <div class="title">Expire le</div>
                        <div class="text" v-text="infos.expire_le"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="emp_projects">
            <div class="row">
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">Primes</h3>
                    <ul class="personal-info">
                      <li>
                        <div class="title">Prime nette</div>
                        <div class="text" v-text="contrats.primes"></div>
                      </li>
                      <li>
                        <div class="title">Accessoires</div>
                        <div class="text">{{ contrats.accessoire }}</div>
                      </li>
                      <li>
                        <div class="title">Frais courtier</div>
                        <div class="text" v-text="contrats.frais"></div>
                      </li>
                      <li>
                        <div class="title">Taxes totales</div>
                        <div class="text" v-text="contrats.taxes"></div>
                      </li>
                      <li>
                        <div class="title">Prime TTC</div>
                        <div class="text" v-text="contrats.prime"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">Commission</h3>
                    <ul class="personal-info">
                      <li>
                        <div class="title">Commission courtier:</div>
                        <div class="text" v-text="contrats.commission"></div>
                      </li>
                      <li>
                        <div class="title">Gestion</div>
                        <div class="text" v-if="gestion == null">0</div>
                        <div
                          class="text"
                          v-else
                          v-text="contrats.gestion"
                        ></div>
                      </li>
                      <li>
                        <div class="title">Commission apporteur:</div>
                        <div
                          class="text"
                          v-text="contrats.commission_apporteur"
                        ></div>
                      </li>
                      <li>
                        <div class="title">Apporteur</div>
                        <div class="text" v-text="contrats.nom_apporteur"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="bank_statutory">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Avenants</h3>

                <table class="table table-striped custom-table mb-0">
                  <thead>
                    <tr>
                      <th>Annee</th>
                      <th>Mois</th>
                      <th>Type</th>
                      <th>Prime TTC</th>

                      <th>Date d'emission</th>
                      <th>Date de debut</th>
                      <th>Date de fin</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template
                      v-for="avenant in avenants"
                      :key="avenant.id_avenant"
                    >
                      <tr>
                        <td>{{ avenant.annee }}</td>
                        <td>{{ avenant.mois }}</td>
                        <td>{{ avenant.type }}</td>
                        <td>{{ avenant.prime_ttc }}</td>

                        <td>{{ avenant.date_emission }}</td>
                        <td>{{ avenant.date_debut }}</td>
                        <td>{{ avenant.date_fin }}</td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="vehicule_info">
            <div class="row filter-row">
              <div class="col-md-8"></div>
              <div class="col-md-4">
                <div class="add-emp-section">
                  <a
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#create_project"
                    class="btn btn-success btn-add-emp"
                    style="width: auto"
                    ><i class="fas fa-plus"></i> Ajouter un véhicule
                  </a>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Listes des véhicules</h3>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Immatriculation</th>
                        <th>Identification proprietaire</th>
                        <th>Date de la circulation</th>
                        <th>Adresse proprietaire</th>
                        <th>Marque</th>
                        <th>Energie</th>
                        <th>Couleur</th>
                        <th>Carosserie</th>
                        <th>Categorie</th>
                        <th>Genre</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <template
                        v-for="automobile in automobiles"
                        :key="automobile.id8contrat"
                      >
                        <tr>
                          <td>{{ automobile.numero_immatriculation }}</td>
                          <td>{{ automobile.identification_proprietaire }}</td>
                          <td>{{ automobile.date_circulation }}</td>
                          <td>{{ automobile.adresse_proprietaire }}</td>
                          <td>{{ automobile.marque }}</td>
                          <td>{{ automobile.energie }}</td>
                          <td>{{ automobile.couleur }}</td>
                          <td>{{ automobile.carosserie }}</td>
                          <td>{{ automobile.categorie }}</td>
                          <td>{{ automobile.genre }}</td>
                          <td
                            class="text-end ico-sec d-flex justify-content-end"
                          >
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#add_garantie"
                              title="Ajouter garantie"
                              ><i class="fas fa-plus"></i>
                            </a>

                            <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#edit_auto" title="Modifier">
                          <i class="fas fa-pen"></i>
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete_auto" title="Supprimer">
                          <i class="fas fa-trash-alt"></i>
                        </a> -->
                          </td>
                        </tr>
                      </template>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="sinistre_info">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Listes des sinistres</h3>
                <table class="table table-striped custom-table mb-0">
                  <thead>
                    <tr>
                      <th>Date de survenance</th>
                      <th>Référence</th>
                      <th>Numéro du sinistre</th>
                      <th>Gestion</th>
                      <th>Date de declaration</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template
                      v-for="sinistre in sinistres"
                      :key="sinistre.id_sinistre"
                    >
                      <tr>
                        <td>
                          {{ sinistre.date_survenance }}
                        </td>
                        <td>{{ sinistre.reference_compagnie }}</td>
                        <td>{{ sinistre.numero_sinistre }}</td>
                        <td>{{ sinistre.gestion_compagnie }}</td>
                        <td>{{ sinistre.date_declaration }}</td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="file_info">
            <div class="project-task">
              <ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    href="#all_tasks"
                    data-bs-toggle="tab"
                    aria-expanded="true"
                    >Contrats</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="#pending_tasks"
                    data-bs-toggle="tab"
                    aria-expanded="false"
                    >Sinistres</a
                  >
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane show active" id="all_tasks">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title m-b-20">Contrats</h5>
                      <ul class="files-list">
                        <template
                          v-for="file in filecontrats"
                          :key="file.id_contrat"
                        >
                          <li>
                            <div class="files-cont">
                              <div class="file-type">
                                <span class="files-icon"
                                  ><i class="far fa-file-pdf"></i
                                ></span>
                              </div>
                              <div class="files-info">
                                <span class="file-name text-ellipsis">
                                  {{ file.titre }}
                                </span>
                                <span class="file-author"
                                  ><a
                                    :href="
                                      '/images/piece_avenant/' + file.nom_file
                                    "
                                    download
                                    >{{ file.nom_file }}</a
                                  ></span
                                >
                              </div>
                            </div>
                          </li>
                        </template>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="pending_tasks">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title m-b-20">Sinistres</h5>
                      <ul class="files-list">
                        <template
                          v-for="file in filesinistres"
                          :key="file.id_contrat"
                        >
                          <li>
                            <div class="files-cont">
                              <div class="file-type">
                                <span class="files-icon"
                                  ><i class="far fa-file-pdf"></i
                                ></span>
                              </div>
                              <div class="files-info">
                                <span class="file-name text-ellipsis">
                                  {{ file.titre }}
                                </span>
                                <span class="file-author"
                                  ><a
                                    :href="
                                      '/images/piece_sinistres/' +
                                      file.nom_fichier
                                    "
                                    download
                                    >{{ file.nom_fichier }}</a
                                  ></span
                                >
                              </div>
                            </div>
                          </li>
                        </template>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div
            id="create_project"
            class="modal custom-modal fade"
            role="dialog"
          >
            <div
              class="modal-dialog modal-dialog-centered modal-xl"
              role="document"
            >
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Ajouter véhicule</h5>
                  <button
                    type="button"
                    class="close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                            <form action="#">
                              <h4 class="card-title">Carte grise</h4>
                              <input
                                type="hidden"
                                v-model="id_contrat"
                                :modelValue="id_contrat"
                              />
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>N° d'immatriculation</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="numero_immatriculation"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label
                                      >Date de 1ère mise encirculation</label
                                    >
                                    <input
                                      type="date"
                                      class="form-control"
                                      v-model="date_circulation"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label
                                      >Identification du proprietaire</label
                                    >
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="identification_proprietaire"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label class="d-block"
                                      >Adresse du propriétaire:</label
                                    >
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="adresse_proprietaire"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label class="d-block"
                                      >Type technique ou commercial:</label
                                    >
                                    <Multiselect
                                      v-model="type"
                                      :options="types"
                                      placeholder="Choisir un type"
                                      :searchable="true"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label class="d-block">Couleur:</label>
                                    <Multiselect
                                      v-model="couleur_id"
                                      :options="couleurs"
                                      :custom-label="
                                        ({ id_couleur, couleur }) =>
                                          `${id_couleur} - [${couleur}]`
                                      "
                                      valueProp="couleur"
                                      placeholder="Selectionnez une couleur"
                                      label="couleur"
                                      track-by="couleur"
                                      :searchable="true"
                                    >
                                    </Multiselect>
                                  </div>
                                  <div class="form-group">
                                    <label class="d-block"
                                      >Places assises:</label
                                    >
                                    <input
                                      type="number"
                                      class="form-control"
                                      v-model="place"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label class="d-block"
                                      >Charge utile(kg):</label
                                    >
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="charge"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label class="d-block"
                                      >Valeur vénale:</label
                                    >
                                    <input
                                      type="number"
                                      class="form-control"
                                      v-model="valeur_venale"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label class="d-block"
                                      >Ancienneté du permis:</label
                                    >
                                    <input
                                      type="number"
                                      class="form-control"
                                      v-model="permis"
                                    />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Zone de circulation</label>
                                    <Multiselect
                                      v-model="zone"
                                      :options="localisations"
                                      :custom-label="
                                        ({ id_localisation, nom_ville }) =>
                                          `${id_localisation} - [${nom_ville}]`
                                      "
                                      valueProp="nom_ville"
                                      placeholder="Selectionnez zone"
                                      label="nom_ville"
                                      track-by="nom_ville"
                                      :searchable="true"
                                    >
                                    </Multiselect>
                                  </div>
                                  <div class="form-group">
                                    <label>Catégorie d'usage</label>
                                    <Multiselect
                                      v-model="categorie_id"
                                      :options="categories"
                                      :custom-label="
                                        ({ id_categorie, categorie }) =>
                                          `${id_categorie} - [${categorie}]`
                                      "
                                      valueProp="categorie"
                                      placeholder="Selectionnez une catégorie"
                                      label="categorie"
                                      track-by="categorie"
                                      :searchable="true"
                                    >
                                    </Multiselect>
                                  </div>
                                  <div class="form-group">
                                    <label>Marque</label>
                                    <Multiselect
                                      v-model="marque_id"
                                      :options="marques"
                                      :custom-label="
                                        ({ id_marque, marque }) =>
                                          `${id_marque} - [${marque}]`
                                      "
                                      valueProp="marque"
                                      placeholder="Selectionnez une marque"
                                      label="marque"
                                      track-by="marque"
                                      :searchable="true"
                                    >
                                    </Multiselect>
                                  </div>
                                  <div class="form-group">
                                    <label>Carrosserie</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="carosserie"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label>Genre</label>
                                    <Multiselect
                                      v-model="genre_id"
                                      :options="genres"
                                      :custom-label="
                                        ({ id_genre, genre }) =>
                                          `${id_genre} - [${genre}]`
                                      "
                                      valueProp="genre"
                                      placeholder="Selectionnez un genre"
                                      label="genre"
                                      track-by="genre"
                                      :searchable="true"
                                    >
                                    </Multiselect>
                                  </div>
                                  <div class="form-group">
                                    <label>Energie</label>
                                    <Multiselect
                                      v-model="energie_id"
                                      :options="energies"
                                      :custom-label="
                                        ({ id_energie, energie }) =>
                                          `${id_energie} - [${energie}]`
                                      "
                                      valueProp="energie"
                                      placeholder="Selectionnez une energie"
                                      label="energie"
                                      track-by="energie"
                                      :searchable="true"
                                    >
                                    </Multiselect>
                                  </div>
                                  <div class="form-group">
                                    <label>Puissance fiscale</label>
                                    <input
                                      type="number"
                                      class="form-control"
                                      v-model="puissance"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label>Valeur à neuf</label>
                                    <input
                                      type="number"
                                      class="form-control"
                                      v-model="valeur_neuf"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label
                                      >Catégorie socio-professionelle</label
                                    >
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="categorie_socio_pro"
                                    />
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title mb-0">Garantie</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-3 col-md-6">
                                <div>
                                  <div class="form-check">
                                    <input
                                      class="form-check-input"
                                      type="radio"
                                      name="flexRadioDefault"
                                      id="flexRadioDefault1"
                                      v-model="tierce"
                                      value="Tierce simple"
                                    />
                                    <label
                                      class="form-check-label"
                                      for="flexRadioDefault1"
                                    >
                                      Tierce simple
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <!--end col-->
                              <div class="col-lg-3 col-md-6">
                                <div class="mt-4 mt-md-0">
                                  <div>
                                    <div class="form-check">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        name="flexRadioDefault"
                                        id="flexRadioDefault2"
                                        v-model="tierce"
                                        value="Tierce complete"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="flexRadioDefault2"
                                      >
                                        Tierce complete
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--end col-->

                              <div class="col-lg-3 col-md-6">
                                <div class="mt-4 mt-md-0">
                                  <div>
                                    <div class="form-check">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        name="flexRadioDefault"
                                        id="flexRadioDefault3"
                                        v-model="tierce"
                                        value="Tierce collision"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="flexRadioDefault3"
                                      >
                                        Tierce collision
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--end col-->

                              <div class="col-lg-3 col-md-6">
                                <div class="mt-4 mt-md-0">
                                  <div>
                                    <div class="form-check">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        name="flexRadioDefault"
                                        id="flexRadioDefault4"
                                        v-model="tierce"
                                        value="dommage"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="flexRadioDefault4"
                                      >
                                        Dommage
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--end col-->
                              <div class="card-body">
                                <div class="live-preview">
                                  <div class="row">
                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie1"
                                    >
                                      <div>
                                        <div
                                          class="form-check form-check-right"
                                        >
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=" Responsabilité civile"
                                            v-model="typegarantie"
                                            id="checkbox1"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="checkbox1"
                                          >
                                            Responsabilité civile
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                    <!--end col-->

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie2"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Défense et recours"
                                              v-model="typegarantie"
                                              id="checkbox2"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox2"
                                            >
                                              Défense et recours
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!--end col-->

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie3"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Avance sur recours"
                                              id="checkbox3"
                                              v-model="typegarantie"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox3"
                                            >
                                              Avance sur recours
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!--end col-->

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie4"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Dommage tous accident"
                                              v-model="typegarantie"
                                              id="checkbox4"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox4"
                                            >
                                              Dommage tous accident
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Dommage tierce collision"
                                              v-model="typegarantie"
                                              id="checkbox5"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox5"
                                            >
                                              Dommage tierce collision
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie6"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Vol des acccessoires"
                                              v-model="typegarantie"
                                              id="checkbox6"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox6"
                                            >
                                              Vol des acccessoires
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie7"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Vol simple"
                                              v-model="typegarantie"
                                              id="checkbox7"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox7"
                                            >
                                              Vol simple
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie8"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Vol par agression"
                                              v-model="typegarantie"
                                              id="checkbox8"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox8"
                                            >
                                              Vol par agression
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie9"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              name="checked[]"
                                              value="Incendie"
                                              v-model="typegarantie"
                                              id="checkbox9"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox9"
                                            >
                                              Incendie
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie10"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              name="checked[]"
                                              value="Personnes transportees"
                                              v-model="typegarantie"
                                              id="checkbox10"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox10"
                                            >
                                              Personnes transportees
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--end row-->
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="submit-section">
                      <button
                        class="btn btn-primary cancel-btn"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      >
                        Annuler
                      </button>
                      <button
                        type="button"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        class="btn btn-primary submit-btn"
                        @click="storeAutomobile"
                      >
                        Enregistrer
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div id="add_garantie" class="modal custom-modal fade" role="dialog">
            <div
              class="modal-dialog modal-dialog-centered modal-lg"
              role="document"
            >
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Ajouter une garantie</h5>
                  <button
                    type="button"
                    class="close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title mb-0">Garantie</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <input
                                type="hidden"
                                v-model="id_contrat"
                                :modelValue="id_contrat"
                              />
                              <div class="col-lg-3 col-md-6">
                                <div>
                                  <div class="form-check">
                                    <input
                                      class="form-check-input"
                                      type="radio"
                                      name="flexRadioDefault"
                                      id="flexRadioDefault1"
                                      v-model="tierce"
                                      value="Tierce simple"
                                    />
                                    <label
                                      class="form-check-label"
                                      for="flexRadioDefault1"
                                    >
                                      Tierce simple
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <!--end col-->
                              <div class="col-lg-3 col-md-6">
                                <div class="mt-4 mt-md-0">
                                  <div>
                                    <div class="form-check">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        name="flexRadioDefault"
                                        id="flexRadioDefault2"
                                        v-model="tierce"
                                        value="Tierce complete"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="flexRadioDefault2"
                                      >
                                        Tierce complete
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--end col-->

                              <div class="col-lg-3 col-md-6">
                                <div class="mt-4 mt-md-0">
                                  <div>
                                    <div class="form-check">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        name="flexRadioDefault"
                                        id="flexRadioDefault3"
                                        v-model="tierce"
                                        value="Tierce collision"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="flexRadioDefault3"
                                      >
                                        Tierce collision
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--end col-->

                              <div class="col-lg-3 col-md-6">
                                <div class="mt-4 mt-md-0">
                                  <div>
                                    <div class="form-check">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        name="flexRadioDefault"
                                        id="flexRadioDefault4"
                                        v-model="tierce"
                                        value="dommage"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="flexRadioDefault4"
                                      >
                                        Dommage
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--end col-->
                              <div class="card-body">
                                <div class="live-preview">
                                  <div class="row">
                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie1"
                                    >
                                      <div>
                                        <div
                                          class="form-check form-check-right"
                                        >
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=" Responsabilité civile"
                                            v-model="typegarantie"
                                            id="checkbox1"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="checkbox1"
                                          >
                                            Responsabilité civile
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                    <!--end col-->

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie2"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Défense et recours"
                                              v-model="typegarantie"
                                              id="checkbox2"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox2"
                                            >
                                              Défense et recours
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!--end col-->

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie3"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Avance sur recours"
                                              id="checkbox3"
                                              v-model="typegarantie"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox3"
                                            >
                                              Avance sur recours
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!--end col-->

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie4"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Dommage tous accident"
                                              v-model="typegarantie"
                                              id="checkbox4"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox4"
                                            >
                                              Dommage tous accident
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Dommage tierce collision"
                                              v-model="typegarantie"
                                              id="checkbox5"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox5"
                                            >
                                              Dommage tierce collision
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie6"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Vol des acccessoires"
                                              v-model="typegarantie"
                                              id="checkbox6"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox6"
                                            >
                                              Vol des acccessoires
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie7"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Vol simple"
                                              v-model="typegarantie"
                                              id="checkbox7"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox7"
                                            >
                                              Vol simple
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie8"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              value="Vol par agression"
                                              v-model="typegarantie"
                                              id="checkbox8"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox8"
                                            >
                                              Vol par agression
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie9"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              name="checked[]"
                                              value="Incendie"
                                              v-model="typegarantie"
                                              id="checkbox9"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox9"
                                            >
                                              Incendie
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      class="col-lg-3 col-md-6"
                                      id="garantie10"
                                    >
                                      <div class="mt-4 mt-md-0">
                                        <div>
                                          <div
                                            class="form-check form-check-right"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="checkbox"
                                              name="checked[]"
                                              value="Personnes transportees"
                                              v-model="typegarantie"
                                              id="checkbox10"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="checkbox10"
                                            >
                                              Personnes transportees
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--end row-->
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="submit-section">
                      <button
                        class="btn btn-primary cancel-btn"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      >
                        Annuler
                      </button>
                      <button
                        type="button"
                        class="btn btn-primary submit-btn"
                        @click="storeGarantie"
                      >
                        Ajouter
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
  </div>
</template>
  <script>
import Sidebar from "../../layout/Sidebar.vue";
import Header from "../../layout/Header.vue";
export default {
  components: {
    Header,
    Sidebar,
  },
  data() {
    return {
      result: "",
      avenants: {},
      contrats: {},
      infos: {},
      sinistres: {},
      filecontrats: {},
      filesinistres: {},
      automobiles: {},
      count: "",
      id_contrat: "",
      value: null,
      typegarantie: [],
      localisations: {},
    };
  },
  created() {
    this.fetchData();
  },

  methods: {



    fetchData() {
      var that = this;
      axios
        .all([
          axios.get("getAvenantContrat?contrat=" + myParam),
          axios.get("getInfoAvenantContrat?contrat=" + myParam),
          axios.get("getInfoContrat?contrat=" + myParam),
          axios.get("getCountsinistre?contrat=" + myParam),
          axios.get("getInfosinistres?contrat=" + myParam),
          axios.get("getInfoFileContrat?contrat=" + myParam),
          axios.get("getInfoFileSinistre?contrat=" + myParam),
          axios.get("getInfoVehicules?contrat=" + myParam),
        ])
        .then(
          axios.spread(function (
            avenants,
            contrats,
            infos,
            count,
            sinistres,
            filecontrats,
            filesinistres,
            automobiles
          ) {
            that.avenants = avenants.data;
            that.contrats = contrats.data;
            that.infos = infos.data;
            that.count = count.data;
            that.sinistres = sinistres.data;
            that.filecontrats = filecontrats.data;
            that.filesinistres = filesinistres.data;
            that.automobiles = automobiles.data;
          })
        );
    },

 

    storeAutomobile() {
      axios
        .post("/postAutomobile", {
          //Automobile
          numero_immatriculation: this.numero_immatriculation,
          date_circulation: this.date_circulation,
          identification_proprietaire: this.identification_proprietaire,
          adresse_proprietaire: this.adresse_proprietaire,
          zone: this.zone,
          categorie_id: this.categorie_id,
          marque_id: this.marque_id,
          genre_id: this.genre_id,
          type: this.type,
          carosserie: this.carosserie,
          couleur_id: this.couleur_id,
          energie_id: this.energie_id,
          place: this.place,
          puissance: this.puissance,
          charge: this.charge,
          valeur_neuf: this.valeur_neuf,
          valeur_venale: this.valeur_venale,
          categorie_socio_pro: this.categorie_socio_pro,
          permis: this.permis,
          option: this.option_garantie,
          entree: this.entree_le,
          garantie: this.typegarantie,
          tierce: this.tierce,
          id_contrat: this.id_contrat,
        })
        .then((response) => {
          this.fetchData();
          if (response.status === 200) {
            toaster.success(`Véhicule ajouté avec succès`, {
              position: "top-right",
            });
            this.clients = response.data;
          }
          console.log(response.data);
        })
        .catch((error) => {
          // console.log(error.response.headers);

          if (error.response.status === 422) {
            toaster.error(`Veuillez remplir les champs indiqués`, {
              position: "top-right",
            });
            this.errors = error.response.data.errors;
            // console.log("Message non enregisté")
          } else if (error.request) {
            // The request was made but no response was received
            console.log(error.request);
          } else {
            // Something happened in setting up the request that triggered an Error
            console.log("Error", error.message);
          }
        });
    },

    storeGarantie() {
      axios
        .post("/postGarantie", {
          //Automobile
          garantie: this.typegarantie,
          tierce: this.tierce,
          id_contrat: this.id_contrat,
        })
        .then((response) => {
          if (response.status === 200) {
            toaster.success(`Garantie ajouté avec succès`, {
              position: "top-right",
            });
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            toaster.error(`Veuillez remplir les champs indiqués`, {
              position: "top-right",
            });
            this.errors = error.response.data.errors;
            // console.log("Message non enregisté")
          } else if (error.request) {
            // The request was made but no response was received
            console.log(error.request);
          } else {
            // Something happened in setting up the request that triggered an Error
            console.log("Error", error.message);
          }
        });
    },
  },
};
</script>
  