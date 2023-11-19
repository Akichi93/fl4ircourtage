<template>
        <div class="main-wrapper">

<Header />

<Sidebar />

<div class="page-wrapper">
  <div class="content container-fluid pb-0">
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-box">
          <h3>upload des bases</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/home">Tableau de bord</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Upload</li>
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
              <a href="#client_tab" data-bs-toggle="tab" class="nav-link active"
                >Clients</a
              >
            </li>

            <li class="nav-item">
              <a href="#emp_profile" data-bs-toggle="tab" class="nav-link"
                >Prospects</a
              >
            </li>

            <li class="nav-item">
              <a href="#branche_tab" data-bs-toggle="tab" class="nav-link"
                >Branches</a
              >
            </li>

            <li class="nav-item">
              <a href="#apporteurs" data-bs-toggle="tab" class="nav-link"
                >Apporteurs</a
              >
            </li>

            <li class="nav-item">
              <a href="#taux_apporteurs" data-bs-toggle="tab" class="nav-link"
                >Taux apporteurs</a
              >
            </li>

            <li class="nav-item">
              <a href="#bank_statutory" data-bs-toggle="tab" class="nav-link"
                >Compagnies</a
              >
            </li>

            <li class="nav-item">
              <a href="#taux_compagnies" data-bs-toggle="tab" class="nav-link"
                >Taux compagnies</a
              >
            </li>

            <li class="nav-item">
              <a href="#contrats_tab" data-bs-toggle="tab" class="nav-link"
                >Contrats</a
              >
            </li>

            <li class="nav-item">
              <a href="#sinistres_tab" data-bs-toggle="tab" class="nav-link"
                >Sinistres</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="tab-content">
      <div id="client_tab" class="pro-overview tab-pane fade show active">
        <div class="row">
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">
                  Clients
                  <a
                    href="{{ asset('BDclient.xlsx') }}"
                    download
                    class="edit-icon"
                    ><i
                      class="fas fa-download"
                      title="Télécharger le model"
                    ></i>
                  </a>
                </h3>
               

                <form
                  action=""
                  method="POST"
                  enctype="multipart/form-data"
                >
                  <div class="form-group">
                    <label>Téléverser fichier</label>
                    <input
                      class="form-control"
                      type="file"
                      name="import_client"
                      accept=".csv"
                      required
                    />
                  </div>
                  <div class="submit-section">
                    <button type="submit" class="btn btn-primary submit-btn">
                      Importer la base de donnée
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="emp_profile" class="pro-overview tab-pane fade show">
        <div class="row">
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">
                  Prospects
                  <a
                    href=""
                    download
                    class="edit-icon"
                    ><i
                      class="fas fa-download"
                      title="Télécharger le model"
                    ></i>
                  </a>
                </h3>
           

                <form
                  action=""
                  method="POST"
                  enctype="multipart/form-data"
                >
                
                  <div class="form-group">
                    <label>Téléverser fichier</label>
                    <input
                      class="form-control"
                      type="file"
                      name="import_prospect"
                      accept=".csv"
                      required
                    />
                  </div>
                  <div class="submit-section">
                    <button type="submit" class="btn btn-primary submit-btn">
                      Importer la base de donnée
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="branche_tab" class="pro-overview tab-pane fade show">
        <div class="row">
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">
                  Branches
                  <a
                    href=""
                    download
                    class="edit-icon"
                    ><i
                      class="fas fa-download"
                      title="Télécharger le model"
                    ></i>
                  </a>
                </h3>

              

                <form
                  action=""
                  method="POST"
                  enctype="multipart/form-data"
                >
                  <div class="form-group">
                    <label>Téléverser fichier</label>
                    <input
                      class="form-control"
                      type="file"
                      name="import_branche"
                      accept=".csv"
                      required
                    />
                  </div>
                  <div class="submit-section">
                    <button type="submit" class="btn btn-primary submit-btn">
                      Importer la base de donnée
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="apporteurs">
        <div class="row">
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">
                  Apporteurs
                  <a
                    href=""
                    download
                    class="edit-icon"
                    ><i
                      class="fas fa-download"
                      title="Télécharger le model"
                    ></i>
                  </a>
                </h3>
              
                <form
                  action=""
                  method="POST"
                  enctype="multipart/form-data"
                >
                  <div class="form-group">
                    <label>Téléverser fichier</label>
                    <input
                      class="form-control"
                      type="file"
                      name="import_apporteur"
                      accept=".csv"
                      required
                    />
                  </div>
                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn">
                      Importer la base de donnée
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="taux_apporteurs">
        <div class="row">
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">
                  Taux Apporteurs
                  <a
                    href=""
                    download
                    class="edit-icon"
                    ><i
                      class="fas fa-download"
                      title="Télécharger le model"
                    ></i>
                  </a>
                </h3>
               
                <form
                  action=""
                  method="POST"
                  enctype="multipart/form-data"
                >
                  <div class="form-group">
                    <label>Téléverser fichier</label>
                    <input
                      class="form-control"
                      type="file"
                      name="import_tauxapporteur"
                      accept=".csv"
                      required
                    />
                  </div>
                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn tauxapporteur">
                      Importer la base de donnée
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="bank_statutory">
        <div class="row">
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">
                  Compagnies
                  <a
                    href=""
                    download
                    class="edit-icon"
                    ><i
                      class="fas fa-download"
                      title="Télécharger le model"
                    ></i>
                  </a>
                </h3>
              
                <form
                  action="{{ route('importcompagnie') }}"
                  method="POST"
                  enctype="multipart/form-data"
                >
                  @csrf
                  <div class="form-group">
                    <label>Téléverser fichier</label>
                    <input
                      class="form-control"
                      type="file"
                      name="import_compagnie"
                      accept=".csv"
                      required
                    />
                  </div>
                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn">
                      Importer la base de donnée
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="taux_compagnies">
        <div class="row">
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">
                  Taux Compagnies
                  <a
                    href=""
                    download
                    class="edit-icon"
                    ><i
                      class="fas fa-download"
                      title="Télécharger le model"
                    ></i>
                  </a>
                </h3>
               
                <form
                  action=""
                  method="POST"
                  enctype="multipart/form-data"
                >
                  <div class="form-group">
                    <label>Téléverser fichier</label>
                    <input
                      class="form-control"
                      type="file"
                      name="import_tauxcompagnie"
                      accept=".csv"
                      required
                    />
                  </div>
                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn">
                      Importer la base de donnée
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="contrats_tab">
        <div class="row">
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">
                  Contrats
                  <a
                    href=""
                    download
                    class="edit-icon"
                    ><i
                      class="fas fa-download"
                      title="Télécharger le model"
                    ></i>
                  </a>
                </h3>

                <form
                  action=""
                  method="POST"
                  enctype="multipart/form-data"
                >
            
                  <div class="form-group">
                    <label>Téléverser fichier</label>
                    <input
                      class="form-control"
                      type="file"
                      name="import_contrat"
                      accept=".csv"
                      required
                    />
                  </div>
                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn">
                      Importer la base de donnée
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
  </div>
</template>
<script>
import Header from "../../layout/Header.vue"
import Sidebar from "../../layout/Sidebar.vue";
export default{
    name: "upload",
    components: { Header, Sidebar },
}
</script>