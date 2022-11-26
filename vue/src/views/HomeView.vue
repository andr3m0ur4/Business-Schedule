<template>
  <main class="content-page">
    <div class="content-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-3">
            <div class="d-flex align-items-center justify-content-between">
              <div class="navbar-breadcrumb">
                <h1 class="mb-1">Minha Escala de Trabalho</h1>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-4 tab-extra" id="view-event">
            <div class="float-md-right mb-4"><a href="#event1" class="btn view-btn">View Event</a></div>
          </div>
        </div>
        <div class="tab-extra active" id="search-with-button">
          <div class="iq-search-bar d-flex flex-wrap align-items-center search-device mb-4">
            <input class="form-control bg-white border text search-input" type="text" placeholder="Search...">
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-block card-stretch card-height">
            <div class="card-body text-center">
              <svg width="36" height="48" viewBox="0 0 36 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M9.10495 33.9964C8.29026 33.1817 8.71495 33.4114 6.74995 32.8855C5.85838 32.6464 5.07463 32.1871 4.36588 31.6367L0.112441 42.0655C-0.299122 43.0752 0.469629 44.1721 1.559 44.1308L6.4987 43.9424L9.8962 47.5311C10.6462 48.3224 11.9624 48.0758 12.374 47.0661L17.2537 35.1017C16.2375 35.668 15.1096 35.9999 13.9434 35.9999C12.1153 35.9999 10.3978 35.2883 9.10495 33.9964V33.9964ZM35.8875 42.0655L31.634 31.6367C30.9253 32.188 30.1415 32.6464 29.25 32.8855C27.2746 33.4142 27.7078 33.1836 26.895 33.9964C25.6021 35.2883 23.8837 35.9999 22.0556 35.9999C20.8893 35.9999 19.7615 35.6671 18.7453 35.1017L23.625 47.0661C24.0365 48.0758 25.3537 48.3224 26.1028 47.5311L29.5012 43.9424L34.4409 44.1308C35.5303 44.1721 36.299 43.0742 35.8875 42.0655V42.0655ZM24.6562 31.8749C26.0887 30.4171 26.2528 30.5427 28.2928 29.9867C29.595 29.6314 30.6131 28.5955 30.9618 27.2699C31.6631 24.6074 31.4812 24.9289 33.3946 22.9808C34.3481 22.0105 34.7203 20.5958 34.3715 19.2702C33.6712 16.6096 33.6703 16.9808 34.3715 14.3174C34.7203 12.9917 34.3481 11.5771 33.3946 10.6067C31.4812 8.65862 31.6631 8.97925 30.9618 6.31768C30.6131 4.99206 29.595 3.95612 28.2928 3.60081C25.679 2.88737 25.994 3.07393 24.0787 1.12487C23.1253 0.154558 21.735 -0.225129 20.4328 0.130183C17.82 0.842683 18.1846 0.843621 15.5671 0.130183C14.2649 -0.225129 12.8746 0.153621 11.9212 1.12487C10.0078 3.073 10.3228 2.88737 7.70807 3.60081C6.40588 3.95612 5.38776 4.99206 5.03901 6.31768C4.33869 8.97925 4.51963 8.65862 2.60619 10.6067C1.65275 11.5771 1.27963 12.9917 1.62932 14.3174C2.32963 16.9761 2.33057 16.6049 1.62932 19.2692C1.28057 20.5949 1.65275 22.0096 2.60619 22.9808C4.51963 24.9289 4.33776 24.6074 5.03901 27.2699C5.38776 28.5955 6.40588 29.6314 7.70807 29.9867C9.8062 30.5586 9.96276 30.4686 11.3437 31.8749C12.584 33.1377 14.5162 33.3636 16.0068 32.4205C16.6029 32.0421 17.2944 31.8411 18.0004 31.8411C18.7065 31.8411 19.3979 32.0421 19.994 32.4205C21.4837 33.3636 23.4159 33.1377 24.6562 31.8749ZM9.15557 16.4961C9.15557 11.5246 13.1156 7.49425 18 7.49425C22.8843 7.49425 26.8443 11.5246 26.8443 16.4961C26.8443 21.4677 22.8843 25.498 18 25.498C13.1156 25.498 9.15557 21.4677 9.15557 16.4961V16.4961Z"
                  fill="#465af7" />
              </svg>
              <h2 class="mb-2 mt-3 text-primary">100+</h2>
              <h4>Escalas</h4>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="event-content card card-block card-stretch card-height">
            <div id="event1" class="tab-pane fade active show">
              <div class="card-header">
                <div class="header-title">
                  <h4 class="card-title">Horas extra</h4>
                </div>
              </div>
              <div class="card-body">
                <ul class="list-inline p-0 mb-0">
                  <li>
                    <div class="d-flex align-items-center justify-content-between mb-4 row">
                      <div class="col-lg-4">
                        <p class="mb-0 font-size-16">Cinegrafista</p>
                      </div>
                      <div class="col-lg-8">
                        <div class="iq-progress-bar bg-primary-light mt-2">
                          <span class="bg-primary iq-progress progress-1" data-percent="85">
                            <span class="progress-text-one bg-primary">85%</span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex align-items-center justify-content-between mb-4 row">
                      <div class="col-lg-4">
                        <p class="mb-0 font-size-16">Operador de aúdio</p>
                      </div>
                      <div class="col-lg-8">
                        <div class="iq-progress-bar bg-warning-light mt-2">
                          <span class="bg-warning iq-progress progress-2" data-percent="65">
                            <span class="progress-text-one bg-warning">65%</span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex align-items-center justify-content-between mb-4 row">
                      <div class="col-lg-4">
                        <p class="mb-0 font-size-16">Roteirista</p>
                      </div>
                      <div class="col-lg-8">
                        <div class="iq-progress-bar bg-success-light mt-2">
                          <span class="bg-success iq-progress progress-3" data-percent="55">
                            <span class="progress-text-one bg-success">55%</span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex align-items-center justify-content-between row">
                      <div class="col-lg-4">
                        <p class="mb-0 font-size-16">Animador 2D/3D</p>
                      </div>
                      <div class="col-lg-8">
                        <div class="iq-progress-bar bg-info-light mt-2">
                          <span class="bg-info iq-progress progress-4" data-percent="60">
                            <span class="progress-text-one bg-info">60%</span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-">
          <div class="card card-block card-stretch card-height">
            <div class="card-body text-center">
              <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M35.3676 11.2517C34.8398 11.2372 34.3256 11.3198 33.8438 11.4898V7.03125C33.8438 4.70503 31.9512 2.8125 29.625 2.8125C29.0759 2.8125 28.5517 2.91909 28.0701 3.11072C27.5821 1.32047 25.9428 0 24 0C22.0572 0 20.4179 1.32047 19.9299 3.11072C19.4483 2.91909 18.9241 2.8125 18.375 2.8125C16.0488 2.8125 14.1562 4.70503 14.1562 7.03125V11.4895C13.6747 11.3198 13.1607 11.2372 12.6324 11.2517C10.3711 11.3136 8.53125 13.2316 8.53125 15.5272V48H36.6562V41.2395L38.5637 36.4704C39.1643 34.9689 39.4688 33.3877 39.4688 31.7705V15.5272C39.4688 13.2316 37.6289 11.3136 35.3676 11.2517V11.2517ZM11.3438 45.1875V42.375H33.8438V45.1875H11.3438ZM36.6562 31.7705C36.6562 33.0283 36.4194 34.2581 35.9523 35.4261L34.2979 39.5625H11.3438V15.5272C11.3438 14.7405 11.9564 14.0837 12.7095 14.0631C13.0926 14.0504 13.4561 14.1937 13.7305 14.4607C14.0051 14.7278 14.1563 15.0858 14.1563 15.4687V21.9843H16.9688V7.03125C16.9688 6.25584 17.5997 5.625 18.3751 5.625C19.1505 5.625 19.7813 6.25584 19.7813 7.03125V21.9844H22.5938V4.21875C22.5938 3.44334 23.2247 2.8125 24.0001 2.8125C24.7755 2.8125 25.4063 3.44334 25.4063 4.21875V21.9844H28.2188V7.03125C28.2188 6.25584 28.8497 5.625 29.6251 5.625C30.4005 5.625 31.0313 6.25584 31.0313 7.03125V24.1714C24.712 24.8732 19.7812 30.2467 19.7812 36.75H22.5938C22.5938 31.3222 27.0097 26.9062 32.4375 26.9062H33.8438V15.4688C33.8438 15.0859 33.995 14.7278 34.2696 14.4608C34.544 14.1938 34.9067 14.0508 35.2906 14.0632C36.0436 14.0838 36.6562 14.7406 36.6562 15.5273V31.7705Z"
                  fill="#f4a965" />
              </svg>
              <h2 class="mb-2 mt-3 text-warning">24</h2>
              <h4>Quantidade de trocas de horário</h4>
            </div>
          </div>
        </div>

        <div class="col-lg-5 col-md-6">
          <div class="card card-block card-stretch card-height">
            <div class="card-header">
              <div class="header-title">
                <h4 class="card-title">Solicitações de troca de horário</h4>
              </div>
            </div>
            <div class="card-body">
              <ul class="list-inline p-0 m-0">
                <li class="d-flex align-items-center mb-3">
                  <div class="profile-icon iq-icon-box rounded-small bg-success-light svg-warning text-center">
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0)">
                        <path
                          d="M0 8.39995V18.5999C0 18.9314 0.2685 19.1999 0.6 19.1999H3.6V7.19994H1.2C0.537375 7.19994 0 7.73732 0 8.39995ZM13.5 6.59994H12.6V5.09994C12.6 4.93419 12.4658 4.79994 12.3 4.79994H11.7C11.5343 4.79994 11.4 4.93419 11.4 5.09994V7.49994C11.4 7.66569 11.5343 7.79995 11.7 7.79995H13.5C13.6658 7.79995 13.8 7.66569 13.8 7.49994V6.89994C13.8 6.73419 13.6658 6.59994 13.5 6.59994ZM18.6656 4.20144L12.6656 0.201317C12.4685 0.0700041 12.2369 -6.10352e-05 12 -6.10352e-05C11.7631 -6.10352e-05 11.5315 0.0700041 11.3344 0.201317L5.33438 4.20144C5.17003 4.31101 5.03527 4.45945 4.94206 4.63358C4.84884 4.80772 4.80004 5.00218 4.8 5.19969V19.1999H9.6V13.7999C9.6 13.4684 9.8685 13.1999 10.2 13.1999H13.8C14.1315 13.1999 14.4 13.4684 14.4 13.7999V19.1999H19.2V5.20007C19.2 4.79882 18.9994 4.42382 18.6656 4.20144ZM12 9.59995C10.3433 9.59995 9 8.2567 9 6.59994C9 4.94319 10.3433 3.59994 12 3.59994C13.6568 3.59994 15 4.94319 15 6.59994C15 8.2567 13.6568 9.59995 12 9.59995ZM22.8 7.19994H20.4V19.1999H23.4C23.7315 19.1999 24 18.9314 24 18.5999V8.39995C24 7.73732 23.4626 7.19994 22.8 7.19994Z"
                          fill="#1B2764" />
                      </g>
                      <defs>
                        <clipPath id="clip1">
                          <rect width="24" height="19.2" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="pl-3">
                    <h5>Caio Assis - José Geraldo</h5>
                    <p class="mb-0">Dia 12/05/2022</p>
                  </div>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <div class="profile-icon iq-icon-box rounded-small bg-warning-light svg-warning text-center">
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0)">
                        <path
                          d="M0 8.39995V18.5999C0 18.9314 0.2685 19.1999 0.6 19.1999H3.6V7.19994H1.2C0.537375 7.19994 0 7.73732 0 8.39995ZM13.5 6.59994H12.6V5.09994C12.6 4.93419 12.4658 4.79994 12.3 4.79994H11.7C11.5343 4.79994 11.4 4.93419 11.4 5.09994V7.49994C11.4 7.66569 11.5343 7.79995 11.7 7.79995H13.5C13.6658 7.79995 13.8 7.66569 13.8 7.49994V6.89994C13.8 6.73419 13.6658 6.59994 13.5 6.59994ZM18.6656 4.20144L12.6656 0.201317C12.4685 0.0700041 12.2369 -6.10352e-05 12 -6.10352e-05C11.7631 -6.10352e-05 11.5315 0.0700041 11.3344 0.201317L5.33438 4.20144C5.17003 4.31101 5.03527 4.45945 4.94206 4.63358C4.84884 4.80772 4.80004 5.00218 4.8 5.19969V19.1999H9.6V13.7999C9.6 13.4684 9.8685 13.1999 10.2 13.1999H13.8C14.1315 13.1999 14.4 13.4684 14.4 13.7999V19.1999H19.2V5.20007C19.2 4.79882 18.9994 4.42382 18.6656 4.20144ZM12 9.59995C10.3433 9.59995 9 8.2567 9 6.59994C9 4.94319 10.3433 3.59994 12 3.59994C13.6568 3.59994 15 4.94319 15 6.59994C15 8.2567 13.6568 9.59995 12 9.59995ZM22.8 7.19994H20.4V19.1999H23.4C23.7315 19.1999 24 18.9314 24 18.5999V8.39995C24 7.73732 23.4626 7.19994 22.8 7.19994Z"
                          fill="#1B2734" />
                      </g>
                      <defs>
                        <clipPath id="clip1">
                          <rect width="24" height="19.2" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="pl-3">
                    <h5>Igor Marcondes - André Moura</h5>
                    <p class="mb-0">Dia 07/05/2022</p>
                  </div>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <div class="profile-icon iq-icon-box rounded-small bg-success-light svg-success text-center">
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0)">
                        <path
                          d="M0 8.39995V18.5999C0 18.9314 0.2685 19.1999 0.6 19.1999H3.6V7.19994H1.2C0.537375 7.19994 0 7.73732 0 8.39995ZM13.5 6.59994H12.6V5.09994C12.6 4.93419 12.4658 4.79994 12.3 4.79994H11.7C11.5343 4.79994 11.4 4.93419 11.4 5.09994V7.49994C11.4 7.66569 11.5343 7.79995 11.7 7.79995H13.5C13.6658 7.79995 13.8 7.66569 13.8 7.49994V6.89994C13.8 6.73419 13.6658 6.59994 13.5 6.59994ZM18.6656 4.20144L12.6656 0.201317C12.4685 0.0700041 12.2369 -6.10352e-05 12 -6.10352e-05C11.7631 -6.10352e-05 11.5315 0.0700041 11.3344 0.201317L5.33438 4.20144C5.17003 4.31101 5.03527 4.45945 4.94206 4.63358C4.84884 4.80772 4.80004 5.00218 4.8 5.19969V19.1999H9.6V13.7999C9.6 13.4684 9.8685 13.1999 10.2 13.1999H13.8C14.1315 13.1999 14.4 13.4684 14.4 13.7999V19.1999H19.2V5.20007C19.2 4.79882 18.9994 4.42382 18.6656 4.20144ZM12 9.59995C10.3433 9.59995 9 8.2567 9 6.59994C9 4.94319 10.3433 3.59994 12 3.59994C13.6568 3.59994 15 4.94319 15 6.59994C15 8.2567 13.6568 9.59995 12 9.59995ZM22.8 7.19994H20.4V19.1999H23.4C23.7315 19.1999 24 18.9314 24 18.5999V8.39995C24 7.73732 23.4626 7.19994 22.8 7.19994Z"
                          fill="#5baa73" />
                      </g>
                      <defs>
                        <clipPath id="clip1">
                          <rect width="24" height="19.2" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="pl-3">
                    <h5>André Moura - Rodrigo Ramos</h5>
                    <p class="mb-0">Dia 08/05/2022</p>
                  </div>
                </li>
                <li class="d-flex align-items-center">
                  <div class="profile-icon iq-icon-box rounded-small bg-info-light svg-info text-center">
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0)">
                        <path
                          d="M0 8.39995V18.5999C0 18.9314 0.2685 19.1999 0.6 19.1999H3.6V7.19994H1.2C0.537375 7.19994 0 7.73732 0 8.39995ZM13.5 6.59994H12.6V5.09994C12.6 4.93419 12.4658 4.79994 12.3 4.79994H11.7C11.5343 4.79994 11.4 4.93419 11.4 5.09994V7.49994C11.4 7.66569 11.5343 7.79995 11.7 7.79995H13.5C13.6658 7.79995 13.8 7.66569 13.8 7.49994V6.89994C13.8 6.73419 13.6658 6.59994 13.5 6.59994ZM18.6656 4.20144L12.6656 0.201317C12.4685 0.0700041 12.2369 -6.10352e-05 12 -6.10352e-05C11.7631 -6.10352e-05 11.5315 0.0700041 11.3344 0.201317L5.33438 4.20144C5.17003 4.31101 5.03527 4.45945 4.94206 4.63358C4.84884 4.80772 4.80004 5.00218 4.8 5.19969V19.1999H9.6V13.7999C9.6 13.4684 9.8685 13.1999 10.2 13.1999H13.8C14.1315 13.1999 14.4 13.4684 14.4 13.7999V19.1999H19.2V5.20007C19.2 4.79882 18.9994 4.42382 18.6656 4.20144ZM12 9.59995C10.3433 9.59995 9 8.2567 9 6.59994C9 4.94319 10.3433 3.59994 12 3.59994C13.6568 3.59994 15 4.94319 15 6.59994C15 8.2567 13.6568 9.59995 12 9.59995ZM22.8 7.19994H20.4V19.1999H23.4C23.7315 19.1999 24 18.9314 24 18.5999V8.39995C24 7.73732 23.4626 7.19994 22.8 7.19994Z"
                          fill="#7858d7" />
                      </g>
                      <defs>
                        <clipPath id="clip2">
                          <rect width="24" height="19.2" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="pl-3">
                    <h5>Igor Marcondes - Rodrigo Ramos</h5>
                    <p class="mb-0">Dia 10/05/2022</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card card-block card-stretch card-height">
            <div class="card-body rounded event-detail event-detail3">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                  <h1 class="text-success">10</h1>
                  <h5 class="text-success">Maio</h5>
                </div>
                <div class="d-flex align-items-center list-action">
                  <a class="badge mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                    href="#"><i class="ri-edit-box-line"></i></a>
                  <a class="badge" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                    href="#"><i class="ri-delete-bin-line"></i></a>
                </div>
              </div>
              <h4 class="my-2">Prévia 03 do Trabalho de Graduação</h4>
              <p class="mb-3 card-description">A apresentação tem como objetivo demosntrar as funcionalidades
                desenvolvidas no software. </p>
              <p class="mb-2 text-success"><i class="las la-clock mr-3"></i>19:00 - 22:30</p>
              <p class="mb-0 text-success"><i class="las la-map-marker mr-3"></i>Fatec Guaratinguetá</p>
            </div>
          </div>
        </div>
        <div class="card col-lg-3 col-md-6 col-sm-6">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Trocas de horário por mês</h4>
            </div>
          </div>
          <div class="card-body">
            <p>Jan</p>
            <div class="progress mb-3">
              <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100">25%</div>
            </div>
            <p>Fev</p>
            <div class="progress mb-3">
              <div class="progress-bar" role="progressbar" style="width: 35%;" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100">35%</div>
            </div>
            <p>Mar</p>
            <div class="progress mb-3">
              <div class="progress-bar" role="progressbar" style="width: 13%;" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100">13%</div>
            </div>
            <p>Abr</p>
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 27%;" aria-valuenow="99" aria-valuemin="0"
                aria-valuemax="100">27%</div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade create-workform" id="create-event" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="popup text-left">
              <h4 class="mb-3">Create a Workflow</h4>
              <div class="mb-3">
                <h5>When this happens</h5>
                <div class="content">
                  <div class="form-group mb-0">
                    <select name="type" class="selectpicker form-control" data-style="py-0">
                      <option>Select..</option>
                      <option>New event is scheduled</option>
                      <option>Before event starts</option>
                      <option>Event starts</option>
                      <option>Event ends</option>
                      <option>Event is canceled</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <h5 class="mb-3">Do this</h5>
                <div class="form-group  mb-0">
                  <select name="type" class="selectpicker form-control" data-style="py-0">
                    <option>Select..</option>
                    <option>Send email to invitee</option>
                    <option>Send email to host</option>
                    <option>Send text to invitee</option>
                    <option>Send text to host</option>
                  </select>
                </div>
              </div>
              <div class="mt-3">
                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                  <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                  <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'HomeView'
})
</script>

<style scoped>

</style>
