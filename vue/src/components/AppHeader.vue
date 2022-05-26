<template>
  <header class="iq-top-navbar">
    <div class="container">
      <div class="iq-navbar-custom">
        <div class="d-flex align-items-center justify-content-between">
          <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
            <i class="ri-menu-line wrapper-menu"></i>
            <router-link to="/" class="header-logo">
              <img src="../assets/images/bs-icon-high.png" class="img-fluid rounded-normal light-logo" alt="logo">
              <span class="title">Business Schedule</span>
            </router-link>
          </div>
          <div class="iq-menu-horizontal">
            <nav class="iq-sidebar-menu">
              <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                <router-link to="/" class="header-logo">
                  <img src="../assets/images/bs-icon-high.png" class="img-fluid rounded-normal" alt="logo">
                  <span class="title">Business Schedule</span>
                </router-link>
                <div class="iq-menu-bt-sidebar">
                  <i class="las la-bars wrapper-menu"></i>
                </div>
              </div>
              <ul id="iq-sidebar-toggle" class="iq-menu d-flex">
                <li class="">
                  <router-link to="/" class="">
                    <span>Home</span>
                  </router-link>
                </li>
                <li class="">
                  <router-link to="/my-schedule" class="">
                    <span>Minha Escala</span>
                  </router-link>
                </li>
                <li class="">
                  <a href="#pages" class="collapsed" data-toggle="collapse" aria-expanded="false">
                    <span>Gerenciamento</span>
                    <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                  </a>
                  <ul id="pages" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                    <li class="">
                      <router-link to="/funcionarios">
                        <span>Funcionários</span>
                      </router-link>
                    </li>
                    <li class="">
                      <router-link to="/funcoes">
                        <span>Funções</span>
                      </router-link>
                    </li>
                    <li class="">
                      <router-link to="/estudios">
                        <span>Estúdios</span>
                      </router-link>
                    </li>
                    <li class="">
                      <router-link to="/programas">
                        <span>Programas</span>
                      </router-link>
                    </li>
                    <li class="">
                      <router-link to="/switcher">
                        <span>Switchers</span>
                      </router-link>
                    </li>
                    <!-- <li class="">
                      <a href="#timeline" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <span>Timeline</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                      </a>
                        <ul id="timeline" class="iq-submenu iq-submenu-data collapse" data-parent="#pages">
                          <li class="">
                            <a href="../backend/timeline.html">
                              <span>Timeline 1</span>
                            </a>
                          </li>
                          <li class="">
                            <a href="../backend/timeline-1.html">
                              <span>Timeline 2</span>
                            </a>
                          </li>
                          <li class="">
                            <a href="../backend/timeline-2.html">
                              <span>Timeline 3</span>
                            </a>
                          </li>
                          <li class="">
                            <a href="../backend/timeline-3.html">
                              <span>Timeline 4</span>
                            </a>
                          </li>
                        </ul>
                    </li>
                    <li class="">
                      <a href="#pricing" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <span>Pricing</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                      </a>
                      <ul id="pricing" class="iq-submenu iq-submenu-data collapse" data-parent="#pages">
                        <li class="">
                          <a href="../backend/pricing.html">
                            <span>Pricing 1</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/pricing-1.html">
                            <span>Pricing 2</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/pricing-2.html">
                            <span>Pricing 3</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/pricing-3.html">
                            <span>Pricing 4</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="">
                      <a href="#pages-error" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <span>Error</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                      </a>
                      <ul id="pages-error" class="iq-submenu iq-submenu-data collapse" data-parent="#pages">
                        <li class="">
                          <a href="../backend/pages-error.html">
                            <span>Error 404</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/pages-error-500.html">
                            <span>Error 500</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="">
                      <a href="#others" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <span>Others</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                      </a>
                      <ul id="others" class="iq-submenu iq-submenu-data collapse" data-parent="#pages">
                        <li class="">
                          <a href="../backend/pages-invoice.html">
                            <span>Invoice</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/pages-subscribers.html">
                            <span>Subscribers</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/pages-faq.html">
                            <span>Faq</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/pages-blank-page.html">
                            <span>Blank Page</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/pages-maintenance.html">
                            <span>Maintenance</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/pages-comingsoon.html">
                            <span>Coming Soon</span>
                          </a>
                        </li>
                      </ul>
                    </li> -->
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
          <nav class="navbar navbar-expand-lg navbar-light p-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto navbar-list align-items-center">
                <li class="nav-item nav-icon dropdown ml-3">
                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                    <i class="las la-envelope"></i>
                    <span class="badge badge-primary count-mail rounded-circle">2</span>
                    <span class="bg-primary"></span>
                  </a>
                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <div class="card shadow-none m-0">
                      <div class="card-body p-0 ">
                        <div class="cust-title p-3">
                          <h5 class="mb-0">Todas as mensagens</h5>
                        </div>
                        <div class="p-2">
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-1.jpg" alt="01">
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">Rodrigo Ramos</h6>
                                <small class="mb-0">Preciso trocar meu horário</small>
                              </div>
                            </div>
                          </a>
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-2.jpg" alt="02">
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">Igor Santos</h6>
                                <small class="mb-0">Obrigado por me atender</small>
                              </div>
                            </div>
                          </a>
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-3.jpg" alt="03">
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">André Moura</h6>
                                <small class="mb-0">Bom dia, Referente a troca...</small>
                              </div>
                            </div>
                          </a>
                        </div>
                        <router-link to="/mensagens" class="right-ic btn-block position-relative p-3 border-top text-center" role="button">Ver tudo</router-link>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item nav-icon dropdown">
                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="las la-bell"></i>
                      <span class="badge badge-primary count-mail rounded-circle">2</span>
                      <span class="bg-primary"></span>
                  </a>
                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div class="card shadow-none m-0">
                      <div class="card-body p-0 ">
                        <div class="cust-title p-3">
                            <h5 class="mb-0">Notificações</h5>
                        </div>
                        <div class="p-2">
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-1.jpg" alt="01">
                              </div>
                              <div class="media-body ml-3">
                                <div class="d-flex align-items-center justify-content-between">
                                  <h6 class="mb-0">Igor Santos</h6>
                                  <small class="mb-0">12 min atrás</small>
                                </div>
                                <small class="mb-0">Cinegráfista</small>
                              </div>
                            </div>
                          </a>
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-2.jpg" alt="02">
                              </div>
                              <div class="media-body ml-3">
                                <div class="d-flex align-items-center justify-content-between">
                                  <h6 class="mb-0">Rodrigo Ramos</h6>
                                  <small class="mb-0">25 min atrás</small>
                                </div>
                                <small class="mb-0">Animador 2D/3D</small>
                              </div>
                            </div>
                          </a>
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-3.jpg" alt="03">
                              </div>
                              <div class="media-body ml-3">
                                <div class="d-flex align-items-center justify-content-between">
                                  <h6 class="mb-0">André Moura</h6>
                                  <small class="mb-0">30 min atrás</small>
                                </div>
                                <small class="mb-0">Operador de Audio</small>
                              </div>
                            </div>
                          </a>
                        </div>
                        <a class="right-ic btn-block position-relative p-3 border-top text-center" href="#" role="button">
                          Ver tudo
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="caption-content">
                  <a href="#" class="search-toggle dropdown-toggle d-flex align-items-center" id="dropdownMenuButton3" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                    <img src="../assets/images/user/01.jpg" class="avatar-40 img-fluid rounded" alt="user">
                    <div class="caption ml-3">
                        <h6 class="mb-0 line-height">{{ user.name }}<i class="las la-angle-down ml-3"></i></h6>
                    </div>
                  </a>
                  <div class="iq-sub-dropdown dropdown-menu user-dropdown" aria-labelledby="dropdownMenuButton3">
                    <div class="card m-0">
                      <div class="card-body p-0">
                        <div class="py-3">
                          <router-link to="/conta" class="iq-sub-card">
                            <div class="media align-items-center">
                              <i class="ri-user-line mr-3"></i>
                              <h6>Configurações da conta</h6>
                            </div>
                          </router-link>
                        </div>
                        <a @click="logout()" class="right-ic p-3 border-top btn-block position-relative text-center" role="button">
                          Logout
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'

export default {
  name: 'AppHeader',
  setup() {
    const store = useStore()

    return {
      user: computed(() => store.state.user.data)
    }
  },
  methods: {
    logout() {
      this.$store.dispatch('logout')
        .then(() => {
          this.$router.push({
            name: 'sign-in'
          });
        })
        .catch(error => {
          this.$store.commit('logout');
          this.$router.push({
            name: 'sign-in'
          });
        });
    }
  }
}
</script>

<style scoped>
.iq-navbar-logo a .title {
  font-size: 16px;
  color: #1B2734;
}
.iq-sidebar-logo a .title {
  font-size: 16px;
  line-height: 24px;
  color: #1B2734;
}
.fixed-top-navbar .iq-sidebar-menu .iq-menu li > a.active {
    color: #465af7;
}
@media (max-width: 1299px) {
  .sidebar-main .fixed-top-navbar .iq-sidebar-menu {
    margin: 0;
  }
  .sidebar-main .fixed-top-navbar .iq-menu-bt-sidebar .wrapper-menu {
    margin: 0;
  }
  .sidebar-main .fixed-top-navbar .iq-menu-horizontal .iq-sidebar-menu .iq-menu li a {
    padding: 15px 19px 15px 15px;
  }
}
</style>
