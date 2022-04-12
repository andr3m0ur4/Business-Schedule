<template>
  <header class="iq-top-navbar">
    <div class="container">
      <div class="iq-navbar-custom">
        <div class="d-flex align-items-center justify-content-between">
          <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
            <i class="ri-menu-line wrapper-menu"></i>
            <router-link to="/" class="header-logo">
              <img src="../assets/images/logo.png" class="img-fluid rounded-normal light-logo" alt="logo">
            </router-link>
          </div>
          <div class="iq-menu-horizontal">
            <nav class="iq-sidebar-menu">
              <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                <router-link to="/" class="header-logo">
                  <img src="../assets/images/logo.png" class="img-fluid rounded-normal" alt="logo">
                </router-link>
                <div class="iq-menu-bt-sidebar">
                  <i class="las la-bars wrapper-menu"></i>
                </div>
              </div>
              <ul id="iq-sidebar-toggle" class="iq-menu d-flex">
                <li class="">
                  <router-link to="/" class="">
                    <span>Dashboard</span>
                  </router-link>
                </li>
                <li class="">
                  <router-link to="/my-schedule" class="">
                    <span>My Schedule</span>
                  </router-link>
                </li>
                <li class="">
                  <a href="../backend/main-integration.html" class="">
                    <span>Integration</span>
                  </a>
                </li>
                <li class="">
                  <a href="#pages" class="collapsed" data-toggle="collapse" aria-expanded="false">
                    <span>Extra Pages</span>
                    <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                  </a>
                  <ul id="pages" class="iq-submenu sub-scrll collapse" data-parent="#iq-sidebar-toggle">
                    <li class="">
                      <a href="#ui" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <span>UI Elements</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                      </a>
                      <ul id="ui" class="iq-submenu iq-submenu-data collapse" data-parent="#pages">
                        <li class="">
                          <a href="../backend/ui-avatars.html">
                            <span>Avatars</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-alerts.html">
                            <span>Alerts</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-badges.html">
                            <span>Badges</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-breadcrumb.html">
                            <span>Breadcrumb</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-buttons.html">
                            <span>Buttons</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-buttons-group.html">
                            <span>Buttons Group</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-boxshadow.html">
                            <span>Box Shadow</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-colors.html">
                            <span>Colors</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-cards.html">
                            <span>Cards</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-carousel.html">
                            <span>Carousel</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-grid.html">
                            <span>Grid</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-helper-classes.html">
                            <span>Helper classes</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-images.html">
                            <span>Images</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-list-group.html">
                            <span>list Group</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-media-object.html">
                            <span>Media</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-modal.html">
                            <span>Modal</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-notifications.html">
                            <span>Notifications</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-pagination.html">
                            <span>Pagination</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-popovers.html">
                            <span>Popovers</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-progressbars.html">
                            <span>Progressbars</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-typography.html">
                            <span>Typography</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-tabs.html">
                            <span>Tabs</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-tooltips.html">
                            <span>Tooltips</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/ui-embed-video.html">
                            <span>Video</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="">
                      <a href="#auth" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <span>Authentication</span>
                          <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                      </a>
                      <ul id="auth" class="iq-submenu iq-submenu-data collapse" data-parent="#pages">
                        <li class="">
                          <a href="../backend/auth-sign-in.html">
                            <span>Login</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/auth-sign-up.html">
                            <span>Register</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/auth-recoverpw.html">
                            <span>Recover Password</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/auth-confirm-mail.html">
                            <span>Confirm Mail</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/auth-lock-screen.html">
                            <span>Lock Screen</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="">
                      <a href="#contact" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <span>Contact</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                      </a>
                      <ul id="contact" class="iq-submenu iq-submenu-data collapse" data-parent="#pages">
                        <li class="">
                          <a href="../backend/contact-list.html">
                            <span>Contact List</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="../backend/contact-detail.html">
                            <span>Contact Details</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="">
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
                    </li>
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
                          <h5 class="mb-0">All Messages</h5>
                        </div>
                        <div class="p-2">
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-1.jpg" alt="01">
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">Barry Emma Watson</h6>
                                <small class="mb-0">We Want to see you On..</small>
                              </div>
                            </div>
                          </a>
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-2.jpg" alt="02">
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">Lorem Ipsum Watson</h6>
                                <small class="mb-0">Can we have a Call?</small>
                              </div>
                            </div>
                          </a>
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-3.jpg" alt="03">
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="mb-0">Why do we use it?</h6>
                                <small class="mb-0">Thank You but now we Don't...</small>
                              </div>
                            </div>
                          </a>
                        </div>
                        <a class="right-ic btn-block position-relative p-3 border-top text-center" href="#" role="button">
                            View All
                        </a>
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
                            <h5 class="mb-0">Notifications</h5>
                        </div>
                        <div class="p-2">
                          <a href="#" class="iq-sub-card">
                            <div class="media align-items-center cust-card p-2">
                              <div class="">
                                <img class="avatar-40 rounded-small" src="../assets/images/user/u-1.jpg" alt="01">
                              </div>
                              <div class="media-body ml-3">
                                <div class="d-flex align-items-center justify-content-between">
                                  <h6 class="mb-0">Anne Effit</h6>
                                  <small class="mb-0">02 Min Ago</small>
                                </div>
                                <small class="mb-0">Manager</small>
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
                                  <h6 class="mb-0">Eric Shun</h6>
                                  <small class="mb-0">05 Min Ago</small>
                                </div>
                                <small class="mb-0">Manager</small>
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
                                  <h6 class="mb-0">Ken Tucky</h6>
                                  <small class="mb-0">10 Min Ago</small>
                                </div>
                                <small class="mb-0">Employee</small>
                              </div>
                            </div>
                          </a>
                        </div>
                        <a class="right-ic btn-block position-relative p-3 border-top text-center" href="#" role="button">
                          See All Notification
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
                        <h6 class="mb-0 line-height">Rick O'shea<i class="las la-angle-down ml-3"></i></h6>
                    </div>
                  </a>
                  <div class="iq-sub-dropdown dropdown-menu user-dropdown" aria-labelledby="dropdownMenuButton3">
                    <div class="card m-0">
                      <div class="card-body p-0">
                        <div class="py-3">
                          <a href="../app/user-profile.html" class="iq-sub-card">
                            <div class="media align-items-center">
                              <i class="ri-user-line mr-3"></i>
                              <h6>Account Settings</h6>
                            </div>
                          </a>
                          <a href="../backend/page-calendar-connections.html" class="iq-sub-card">
                            <div class="media align-items-center">
                              <i class="ri-calendar-line mr-3"></i>
                              <h6>Calender Connections</h6>
                            </div>
                          </a>
                          <a href="../backend/page-users.html" class="iq-sub-card">
                            <div class="media align-items-center">
                              <i class="ri-group-line mr-3"></i>
                              <h6>Users</h6>
                            </div>
                          </a>
                          <a href="../backend/privacy-policy.html" class="iq-sub-card">
                            <div class="media align-items-center">
                              <i class="ri-lock-line mr-3"></i>
                              <h6>Privacy & Security Settings</h6>
                            </div>
                          </a>
                          <a href="#popup1" data-toggle="modal" data-target="#exampleModalCenter" class="iq-sub-card">
                            <div class="media align-items-center">
                              <i class="ri-links-line mr-3"></i>
                              <h6>Share Your Link</h6>
                            </div>
                          </a>
                        </div>
                        <router-link to="/entrar" class="right-ic p-3 border-top btn-block position-relative text-center" role="button">
                          Logout
                        </router-link>
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
export default {
  name: 'AppHeader'
}
</script>

<style scoped>
.fixed-top-navbar .iq-sidebar-menu .iq-menu li > a.active {
    color: #465af7;
}
</style>