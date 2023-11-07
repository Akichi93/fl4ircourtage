<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Contrats</h3>
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

        <div class="row">
          <div class="col-md-12">
            <div class="card mb-0">
              <div class="card-header">
                <h4 class="card-title mb-0">Information personnelle</h4>
              </div>
              <div class="card-body">
                <form action="#">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>N° de la police</label>
                            <input type="text" class="form-control" v-model="numero_police"
                              placeholder="Entrez le numéro de police" required />
                            <p style="color: red" class="text-red" v-if="errors.numero_police"
                              v-text="errors.numero_police[0]"></p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Branche</label>
                            <select class="form-select mb-3" name="type" @change="onChange($event)" id="type"
                              v-model="branche_id">
                              <option v-for="branche in branches" :value="branche" :key="branche.id_branche">
                                {{ branche.nom_branche }}
                              </option>
                            </select>
                            <p style="color: red" class="text-red" v-if="errors.branche_id" v-text="errors.id_branche[0]">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6" v-if="branche_id != 0">
                          <div class="form-group">
                            <label>Compagnie:</label>
                            <compagniecomponent :placeholder="'selectionnez la compagnie'" @select="optionSelected"
                              v-model="compagnie_id"></compagniecomponent>

                            <p style="color: red" class="text-red" v-if="errors.id_compagnie"
                              v-text="errors.id_compagnie[0]"></p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Date d'émission:</label>
                            <input type="date" class="form-control" v-model="souscrit_le" />
                            <p style="color: red" class="text-red" v-if="errors.souscrit_le"
                              v-text="errors.souscrit_le[0]"></p>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>A:</label>
                            <input type="time" class="form-control" v-model="heure_police" />
                            <p style="color: red" class="text-red" v-if="errors.heure_police"
                              v-text="errors.heure_police[0]"></p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Expire le:</label>
                            <input type="date" class="form-control" v-model="expire_le" />
                            <p style="color: red" class="text-red" v-if="errors.expire_le" v-text="errors.expire_le[0]">
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Client:</label>
                            <clientcomponent :placeholder="'selectionnez un client'" v-model="client_id">
                            </clientcomponent>
                            <p style="color: red" class="text-red" v-if="errors.id_compagnie"
                              v-text="errors.id_client[0]"></p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#add_client" style="margin-top: 25px">
                              Ajouter client
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6" v-if="branche_id != 0">
                          <div class="form-group">
                            <label>Apporteur:</label>
                            <apporteurcomponent :placeholder="'selectionnez un apporteur'" @select="optionSelect"
                              v-model="apporteur_id"></apporteurcomponent>
                            <p style="color: red" class="text-red" v-if="errors.id_apporteur"
                              v-text="errors.id_apporteur[0]"></p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Effet de police</label>
                            <input type="date" class="form-control" v-model="effet_police" />
                            <p style="color: red" class="text-red" v-if="errors.effet_police"
                              v-text="errors.effet_police[0]"></p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Reconduction</label>
                            <Multiselect v-model="reconduction" :options="reconducts"
                              placeholder="Choisir la reconduction" :searchable="false" />
                            <p style="color: red" class="text-red" v-if="errors.reconduction"
                              v-text="errors.reconduction[0]"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="card tab-box mt-3" v-if="branche_id.nom_branche == 'AUTOMOBILE' ||
          branche_id.nom_branche == 'MOTO' ||
          branche_id.nom_branche == 'AUTOMOBILE HORS TPV' ||
          branche_id.nom_branche == 'AUTOMOBILE TPV'
          ">
          <div class="row user-tabs">
            <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
              <ul class="nav nav-tabs nav-tabs-bottom pt-3 pb-2">
                <li class="nav-item">
                  <a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Carte grise</a>
                </li>
                <li class="nav-item">
                  <a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Garantie</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="tab-content">
          <div id="emp_profile" class="pro-overview tab-pane fade show active" v-if="branche_id.nom_branche == 'AUTOMOBILE' ||
            branche_id.nom_branche == 'MOTO' ||
            branche_id.nom_branche == 'AUTOMOBILE HORS TPV' ||
            branche_id.nom_branche == 'AUTOMOBILE TPV'
            ">
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-0">
                  <div class="card-header">
                    <h4 class="card-title mb-0">Carte grise</h4>
                  </div>
                  <div class="card-body">
                    <form action="#">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>N° d'immatriculation:</label>
                            <input type="text" class="form-control" v-model="numero_immatriculation" />
                          </div>
                          <div class="form-group">
                            <label>Date de 1ère mise en circulation:</label>
                            <input type="date" class="form-control" v-model="date_circulation" />
                          </div>
                          <div class="form-group">
                            <label>Identification du proprietaire:</label>
                            <input type="text" class="form-control" v-model="identification_proprietaire" />
                          </div>
                          <div class="form-group">
                            <label>Adresse du propriétaire:</label>
                            <input type="text" class="form-control" v-model="adresse_proprietaire" />
                          </div>
                          <div class="row">
                            <div class="col-md-9">
                              <div class="form-group">
                                <label>Zone de circulation:</label>
                                <adressecomponent :placeholder="'selectionnez l\'adresse'" v-model="zone">
                                </adressecomponent>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#addProspect" style="margin-top: 25px">
                                  Ajouter
                                </button>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-9">
                              <div class="form-group">
                                <label>Catégorie d'usage:</label>
                                <categorieusagecomponent :placeholder="'selectionnez une catégorie'"
                                  v-model="categorie_id"></categorieusagecomponent>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#addCategorie" style="margin-top: 25px">
                                  Ajouter
                                </button>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-9">
                              <div class="form-group">
                                <label>Marque:</label>
                                <marquecomponent :placeholder="'selectionnez une marque'" v-model="marque_id">
                                </marquecomponent>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#addMarque" style="margin-top: 25px">
                                  Ajouter
                                </button>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-9">
                              <div class="form-group">
                                <label>Genre:</label>
                                <genrecomponent :placeholder="'selectionnez yn genre'" v-model="genre_id">
                                </genrecomponent>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#addGenre" style="margin-top: 25px">
                                  Ajouter
                                </button>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Type technique ou commercial:</label>
                            <typecomponent :placeholder="'Choisir un type'" v-model="type">
                            </typecomponent>
                          </div>
                          <div class="form-group">
                            <label>Carrosserie:</label>
                            <input type="text" class="form-control" v-model="carosserie" />
                          </div>
                          <div class="row">
                            <div class="col-md-9">
                              <div class="form-group">
                                <label>Couleur:</label>
                                <couleurcomponent :placeholder="'selectionnez une couleur'" v-model="couleur_id">
                                </couleurcomponent>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#addCouleur" style="margin-top: 25px">
                                  Ajouter
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Energie:</label>
                                <couleurcomponent :placeholder="'selectionnez une energie'" v-model="energie_id">
                                </couleurcomponent>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#addEnergie" style="margin-top: 25px">
                                  Ajouter
                                </button>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Places assises:</label>
                                <input type="text" class="form-control" v-model="place" />
                              </div>
                              <div class="form-group">
                                <label>Puissance fiscale:</label>
                                <input type="text" class="form-control" v-model="puissance" />
                              </div>

                              <div class="form-group">
                                <label>Charge utile(kg):</label>
                                <input type="text" class="form-control" v-model="charge" />
                              </div>

                              <div class="form-group">
                                <label>Valeur à neuf:</label>
                                <input type="number" class="form-control" v-model="valeur_neuf" />
                              </div>

                              <div class="form-group">
                                <label>Valeur vénale:</label>
                                <input type="number" class="form-control" v-model="valeur_venale" />
                              </div>
                              <div class="card">
                                <div class="card-header">
                                  <h4 class="card-title mb-0">
                                    Information sur le conducteur
                                  </h4>
                                </div>
                                <div class="card-body">
                                  <form action="#">
                                    <div class="form-group">
                                      <label>Catégorie socio-professionelle</label>
                                      <input type="text" class="form-control" v-model="categorie_socio_pro" />
                                    </div>

                                    <div class="form-group">
                                      <label>Ancienneté du permis</label>
                                      <input type="number" class="form-control" v-model="permis" />
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="emp_projects" v-if="branche_id.nom_branche == 'AUTOMOBILE' ||
            branche_id.nom_branche == 'MOTO' ||
            branche_id.nom_branche == 'AUTOMOBILE HORS TPV' ||
            branche_id.nom_branche == 'AUTOMOBILE TPV'
            ">
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
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                              v-model="tierce" value="Tierce simple" />
                            <label class="form-check-label" for="flexRadioDefault1">
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
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                v-model="tierce" value="Tierce complete" />
                              <label class="form-check-label" for="flexRadioDefault2">
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
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3"
                                v-model="tierce" value="Tierce collision" />
                              <label class="form-check-label" for="flexRadioDefault3">
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
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4"
                                v-model="tierce" value="dommage" />
                              <label class="form-check-label" for="flexRadioDefault4">
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
                            <div class="col-lg-3 col-md-6" id="garantie1">
                              <div>
                                <div class="form-check form-check-right">
                                  <input class="form-check-input" type="checkbox" value=" Responsabilité civile"
                                    v-model="typegarantie" id="checkbox1" />
                                  <label class="form-check-label" for="checkbox1">
                                    Responsabilité civile
                                  </label>
                                </div>
                              </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-3 col-md-6" id="garantie2">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" value="Défense et recours"
                                      v-model="typegarantie" id="checkbox2" />
                                    <label class="form-check-label" for="checkbox2">
                                      Défense et recours
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-3 col-md-6" id="garantie3">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" value="Avance sur recours"
                                      id="checkbox3" v-model="typegarantie" />
                                    <label class="form-check-label" for="checkbox3">
                                      Avance sur recours
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-3 col-md-6" id="garantie4">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" value="Dommage tous accident"
                                      v-model="typegarantie" id="checkbox4" />
                                    <label class="form-check-label" for="checkbox4">
                                      Dommage tous accident
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" value="Dommage tierce collision"
                                      v-model="typegarantie" id="checkbox5" />
                                    <label class="form-check-label" for="checkbox5">
                                      Dommage tierce collision
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-3 col-md-6" id="garantie6">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" value="Vol des acccessoires"
                                      v-model="typegarantie" id="checkbox6" />
                                    <label class="form-check-label" for="checkbox6">
                                      Vol des acccessoires
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-3 col-md-6" id="garantie7">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" value="Vol simple"
                                      v-model="typegarantie" id="checkbox7" />
                                    <label class="form-check-label" for="checkbox7">
                                      Vol simple
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-3 col-md-6" id="garantie8">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" value="Vol par agression"
                                      v-model="typegarantie" id="checkbox8" />
                                    <label class="form-check-label" for="checkbox8">
                                      Vol par agression
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-3 col-md-6" id="garantie9">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" name="checked[]" value="Incendie"
                                      v-model="typegarantie" id="checkbox9" />
                                    <label class="form-check-label" for="checkbox9">
                                      Incendie
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-3 col-md-6" id="garantie10">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" name="checked[]"
                                      value="Personnes transportees" v-model="typegarantie" id="checkbox10" />
                                    <label class="form-check-label" for="checkbox10">
                                      Personnes transportees
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-3 col-md-6" id="garantie10">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" name="checked[]"
                                      value="Bris de glaces" v-model="typegarantie" id="checkbox10" />
                                    <label class="form-check-label" for="checkbox10">
                                      Bris de glaces
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-3 col-md-6" id="garantie10">
                              <div class="mt-4 mt-md-0">
                                <div>
                                  <div class="form-check form-check-right">
                                    <input class="form-check-input" type="checkbox" name="checked[]" value="Assistance"
                                      v-model="typegarantie" id="checkbox10" />
                                    <label class="form-check-label" for="checkbox10">
                                      Assistance
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
          </div>
        </div>

        <div class="row" style="margin-top: 15px">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title mb-0">Primes</h4>
              </div>
              <div class="card-body">
                <form action="#">
                  <div class="form-group">
                    <label>Prime nette</label>
                    <input type="number" class="form-control" v-model="primes_nette" />
                  </div>
                  <div class="form-group">
                    <label>Accessoires</label>
                    <input type="number" class="form-control" v-model="accessoires" />
                  </div>
                  <div class="form-group">
                    <label>Frais courtier</label>
                    <input type="number" class="form-control" v-model="frais_courtier" />
                  </div>
                  <div class="form-group" v-if="branche_id.nom_branche == 'AUTOMOBILE' ||
                    branche_id.nom_branche == 'MOTO'
                    ">
                    <label>FGA</label>
                    <input type="number" class="form-control" v-model="cfga" />
                  </div>
                  <div class="form-group">
                    <label>Taxes totales</label>
                    <input type="number" class="form-control" v-model="taxes_totales" />
                  </div>
                  <div class="form-group">
                    <label>Prime TTC</label>
                    <div>
                      {{
                        primes_nette +
                        accessoires +
                        frais_courtier +
                        cfga +
                        taxes_totales
                      }}
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title mb-0">Commission</h4>
              </div>
              <div class="card-body">
                <form action="#">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Commission courtier:</label>
                            <input type="text" class="form-control" v-model="tauxcomp.tauxcomp" disabled />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            {{
                              (primes_nette * tauxcomp.tauxcomp * 0.01).toFixed(
                                2
                              )
                            }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Gestion</label>
                    <input type="text" class="form-control" v-model="gestion" />
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Commission apporteur:</label>
                            <input type="text" class="form-control" v-model="taux.taux" disabled />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            {{
                              (
                                primes_nette *
                                tauxcomp.tauxcomp *
                                0.01 *
                                taux.taux *
                                0.01
                              ).toFixed(2)
                            }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="submit-section">
          <button class="btn btn-primary submit-btn" @click="storeContrat">
            Enregistrer
          </button>
        </div>



        <addadresse></addadresse>
        <addcategorie></addcategorie>
        <addenergie></addenergie>
        <addcouleur></addcouleur>
        <addgenre></addgenre>
        <addmarque></addmarque>
        <addclient></addclient>






      </div>
    </div>
  </div>
</template>
<script>
import Multiselect from "@vueform/multiselect";
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import compagniecomponent from "../../components/select/compagniecomponent.vue";
import apporteurcomponent from "../../components/select/apporteurcomponent.vue";
import clientcomponent from "../../components/select/clientcomponent.vue";
import branchecomponent from "../../components/select/branchecomponent.vue";
import adressecomponent from "../../components/select/adressecomponent.vue";
import genrecomponent from "../../components/select/genrecomponent.vue";
import energiecomponent from "../../components/select/energiecomponent.vue";
import marquecomponent from "../../components/select/marquecomponent.vue";
import couleurcomponent from "../../components/select/couleurcomponent.vue";
import categorieusagecomponent from "../../components/select/categorieusagecomponent.vue";
import typecomponent from "../../components/select/typecomponent.vue";
import addadresse from '../../pages/form/addadresse.vue';
import addcategorie from '../../pages/form/addcategorie.vue';
import addenergie from '../../pages/form/addenergie.vue';
import addgenre from '../../pages/form/addgenre.vue';
import addcouleur from '../../pages/form/addcouleur.vue';
import addmarque from '../../pages/form/addmarque.vue';
import addclient from '../../pages/clients/addclient.vue'


import { getBrancheList } from "../../services/formservice";
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
  /* options */
});
export default {
  name: "addcontrat",
  components: {
    Multiselect,
    Header,
    Sidebar,
    compagniecomponent,
    apporteurcomponent,
    clientcomponent,
    branchecomponent,
    addadresse,
    addcategorie,
    addenergie,
    addgenre,
    addcouleur,
    addmarque,
    adressecomponent,
    genrecomponent,
    energiecomponent,
    marquecomponent,
    couleurcomponent,
    categorieusagecomponent,
    typecomponent,
    addclient
  },
  data() {
    return {
      customer: {
        civilite: "",
        nom_client: "",
        prenom_client: "",
        postal_client: "",
        adresse_client: "",
        tel_client: "",
        profession_client: "",
        fax_client: "",
        email_client: "",
      },
      value: null,
      errors: [],
      typegarantie: [],
      branches: [],

      // Contrat form
      compagnie_id: "",
      apporteur_id: "",
      branche_id: "",
      client_id: "",
      numero_police: "",
      souscrit_le: "",
      effet_police: "",
      heure_police: "",
      expire_le: "",
      reconduction: "",
      //Automobile
      numero_immatriculation: "",
      date_circulation: "",
      identification_proprietaire: "",
      adresse_proprietaire: "",
      zone: "",
      categorie_id: "",
      marque_id: "",
      genre_id: "",
      type: "",
      carosserie: "",
      couleur_id: "",
      energie_id: "",
      place: "",
      puissance: "",
      charge: "",
      valeur_neuf: "",
      valeur_venale: "",
      categorie_socio_pro: "",
      permis: "",
      option_garantie: "",
      entree_le: "",
      tierce: "",
      primes_nette: 0,
      frais_courtier: 0,
      accessoires: 0,
      cfga: 0,
      taxes_totales: 0,
      prime_ttc: 0,
      commission: "",
      gestion: "",
      commission_apporteur: "",
      taux_courtier: "",
      taux_apporteur: "",
      tauxcomp: "",
      taux: "",

      reconducts: ["Oui", "Non"],

    };
  },
  created() {
    this.getBranche();
  },
  methods: {
    getBranche: function () {
      getBrancheList().then((result) => {
        this.branches = result;
      });
    },


    onChange(event) {
      // console.log(event.target.value);
      // alert(event.target.value)
    },

    optionSelected(option) {
      axios
        .get(
          "api/auth/getTauxBrancheCompagnie?branche=" +
          this.branche_id.id_branche +
          "&compagnie=" +
          option
        )
        .then((response) => {
          this.tauxcomp = response.data;
        })

        .catch((error) => console.log(error));
    },

    optionSelect(optional) {
      axios
        .get(
          "/api/auth/getTauxBrancheApporteur?branche=" +
          this.branche_id.id_branche +
          "&apport=" +
          optional
        )
        .then((response) => {
          this.taux = response.data;
        })

        .catch((error) => console.log(error));
    },

    storeContrat() {
      const userId = localStorage.getItem("id");
      const entrepriseId = localStorage.getItem("entreprise");

      axios
        .post("/api/auth/postContrat", {
          //Contrat
          id: userId,
          id_entreprise: entrepriseId,
          id_branche: this.branche_id.id_branche,
          branche: this.branche_id.nom_branche,
          id_client: this.client_id,
          id_compagnie: this.compagnie_id,
          id_apporteur: this.apporteur_id,
          numero_police: this.numero_police,
          effet_police: this.effet_police,
          heure_police: this.heure_police,
          expire_le: this.expire_le,
          souscrit_le: this.souscrit_le,
          reconduction: this.reconduction,
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
          prime_nette: this.primes_nette,
          accessoires: this.accessoires,
          frais_courtier: this.frais_courtier,
          cfga: this.cfga,
          taxes_totales: this.taxes_totales,
          commission_courtier:
            this.primes_nette * this.tauxcomp.tauxcomp * 0.01,
          commission_apporteur:
            this.primes_nette *
            this.taux.taux *
            0.01 *
            this.tauxcomp.tauxcomp *
            0.01,
          gestion: this.gestion,
          primes_ttc:
            this.primes_nette +
            this.frais_courtier +
            this.accessoires +
            this.cfga +
            this.taxes_totales,
        })
        .then((response) => {
          if (response.status === 200) {
            toaster.success(`Contrat ajouté avec succès`, {
              position: "top-right",
            });
            this.contrats = response.data;
          }
          window.location.href = "/contrat";
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



    calculttc: function (event) {
      alert(this.event.target.value);
    },
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
