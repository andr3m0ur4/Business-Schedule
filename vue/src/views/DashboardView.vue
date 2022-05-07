<template>
   <div class="content-page">
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
               <div class="iq-search-bar d-flex flex-wrap align-items-center search-device mb-4 pr-3">
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
                     <h2 class="mb-2 mt-3 text-primary">42+</h2>
                     <h4>Awards</h4>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="event-content card card-block card-stretch card-height">
                  <div id="event1" class="tab-pane fade active show">
                     <div class="card-header">
                        <div class="header-title">
                           <h4 class="card-title">Professional Skills</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <ul class="list-inline p-0 mb-0">
                           <li>
                              <div class="d-flex align-items-center justify-content-between mb-4 row">
                                 <div class="col-lg-4">
                                    <p class="mb-0 font-size-16">Photoshop</p>
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
                                    <p class="mb-0 font-size-16">Illustrator</p>
                                 </div>
                                 <div class="col-lg-8">
                                    <div class="iq-progress-bar bg-warning-light mt-2">
                                       <span class="bg-warning iq-progress progress-1" data-percent="65">
                                          <span class="progress-text-one bg-warning">65%</span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="d-flex align-items-center justify-content-between mb-4 row">
                                 <div class="col-lg-4">
                                    <p class="mb-0 font-size-16">Adobe XD</p>
                                 </div>
                                 <div class="col-lg-8">
                                    <div class="iq-progress-bar bg-success-light mt-2">
                                       <span class="bg-success iq-progress progress-1" data-percent="55">
                                          <span class="progress-text-one bg-success">55%</span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="d-flex align-items-center justify-content-between row">
                                 <div class="col-lg-4">
                                    <p class="mb-0 font-size-16">Figma</p>
                                 </div>
                                 <div class="col-lg-8">
                                    <div class="iq-progress-bar bg-info-light mt-2">
                                       <span class="bg-info iq-progress progress-1" data-percent="60">
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

            <div class="col-lg-3 col-md-6 col-sm-6">
               <div class="card card-block card-stretch card-height">
                  <div class="card-body text-center">
                     <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M35.3676 11.2517C34.8398 11.2372 34.3256 11.3198 33.8438 11.4898V7.03125C33.8438 4.70503 31.9512 2.8125 29.625 2.8125C29.0759 2.8125 28.5517 2.91909 28.0701 3.11072C27.5821 1.32047 25.9428 0 24 0C22.0572 0 20.4179 1.32047 19.9299 3.11072C19.4483 2.91909 18.9241 2.8125 18.375 2.8125C16.0488 2.8125 14.1562 4.70503 14.1562 7.03125V11.4895C13.6747 11.3198 13.1607 11.2372 12.6324 11.2517C10.3711 11.3136 8.53125 13.2316 8.53125 15.5272V48H36.6562V41.2395L38.5637 36.4704C39.1643 34.9689 39.4688 33.3877 39.4688 31.7705V15.5272C39.4688 13.2316 37.6289 11.3136 35.3676 11.2517V11.2517ZM11.3438 45.1875V42.375H33.8438V45.1875H11.3438ZM36.6562 31.7705C36.6562 33.0283 36.4194 34.2581 35.9523 35.4261L34.2979 39.5625H11.3438V15.5272C11.3438 14.7405 11.9564 14.0837 12.7095 14.0631C13.0926 14.0504 13.4561 14.1937 13.7305 14.4607C14.0051 14.7278 14.1563 15.0858 14.1563 15.4687V21.9843H16.9688V7.03125C16.9688 6.25584 17.5997 5.625 18.3751 5.625C19.1505 5.625 19.7813 6.25584 19.7813 7.03125V21.9844H22.5938V4.21875C22.5938 3.44334 23.2247 2.8125 24.0001 2.8125C24.7755 2.8125 25.4063 3.44334 25.4063 4.21875V21.9844H28.2188V7.03125C28.2188 6.25584 28.8497 5.625 29.6251 5.625C30.4005 5.625 31.0313 6.25584 31.0313 7.03125V24.1714C24.712 24.8732 19.7812 30.2467 19.7812 36.75H22.5938C22.5938 31.3222 27.0097 26.9062 32.4375 26.9062H33.8438V15.4688C33.8438 15.0859 33.995 14.7278 34.2696 14.4608C34.544 14.1938 34.9067 14.0508 35.2906 14.0632C36.0436 14.0838 36.6562 14.7406 36.6562 15.5273V31.7705Z"
                           fill="#f4a965" />
                     </svg>
                     <h2 class="mb-2 mt-3 text-warning">424+</h2>
                     <h4>Participated</h4>
                  </div>
               </div>
            </div>

            <div class="col-lg-5 col-md-6">
               <div class="card card-block card-stretch card-height">
                  <div class="card-header">
                     <div class="header-title">
                        <h4 class="card-title">Education Traning</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <ul class="list-inline p-0 m-0">
                        <li class="d-flex align-items-center mb-3">
                           <div class="profile-icon iq-icon-box rounded-small bg-danger-light svg-danger text-center">
                              <svg width="24" height="20" viewBox="0 0 24 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <g clip-path="url(#clip0)">
                                    <path
                                       d="M23.3379 5.745L12.8777 2.53125C12.3077 2.35612 11.6927 2.35612 11.1231 2.53125L0.662429 5.745C-0.220321 6.01612 -0.220321 7.18349 0.662429 7.45462L2.48605 8.01487C2.08593 8.50949 1.83993 9.11287 1.81555 9.77362C1.45443 9.98062 1.20018 10.3541 1.20018 10.8C1.20018 11.2042 1.41318 11.5444 1.71993 11.7619L0.762554 16.0699C0.679304 16.4445 0.964304 16.8 1.34793 16.8H3.45205C3.83605 16.8 4.12105 16.4445 4.0378 16.0699L3.08043 11.7619C3.38718 11.5444 3.60018 11.2042 3.60018 10.8C3.60018 10.3661 3.35755 10.0031 3.01293 9.79237C3.04143 9.22912 3.32943 8.73112 3.7888 8.41537L11.1227 10.6687C11.4624 10.773 12.1142 10.9031 12.8773 10.6687L23.3379 7.45499C24.2211 7.1835 24.2211 6.0165 23.3379 5.745V5.745ZM13.2298 11.8159C12.1599 12.1444 11.2483 11.9629 10.7702 11.8159L5.33193 10.1452L4.80018 14.4C4.80018 15.7256 8.02368 16.8 12.0002 16.8C15.9767 16.8 19.2002 15.7256 19.2002 14.4L18.6684 10.1449L13.2298 11.8159V11.8159Z"
                                       fill="#ea643f" />
                                 </g>
                                 <defs>
                                    <clipPath id="clip0">
                                       <rect width="24" height="19.2" fill="white" />
                                    </clipPath>
                                 </defs>
                              </svg>
                           </div>
                           <div class="pl-3">
                              <h5>South Kellergrove Junior</h5>
                              <p class="mb-0">Junior High School | Class of 2008</p>
                           </div>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                           <div class="profile-icon iq-icon-box rounded-small bg-primary-light svg-primary text-center">
                              <svg width="24" height="28" viewBox="0 0 24 28" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M17.1107 17.1746L12 22.2853L6.88929 17.1746C3.05893 17.3406 0 20.4746 0 24.3424V24.8567C0 26.2764 1.15179 27.4281 2.57143 27.4281H21.4286C22.8482 27.4281 24 26.2764 24 24.8567V24.3424C24 20.4746 20.9411 17.3406 17.1107 17.1746ZM0.728571 4.27457L1.07143 4.35493V7.4835C0.696429 7.7085 0.428571 8.09957 0.428571 8.571C0.428571 9.021 0.675 9.396 1.02321 9.62636L0.1875 12.9639C0.0964286 13.3335 0.3 13.7139 0.594643 13.7139H2.83393C3.12857 13.7139 3.33214 13.3335 3.24107 12.9639L2.40536 9.62636C2.75357 9.396 3 9.021 3 8.571C3 8.09957 2.73214 7.7085 2.35714 7.4835V4.66564L5.89286 5.51743C5.43214 6.43886 5.14286 7.46743 5.14286 8.571C5.14286 12.3585 8.2125 15.4281 12 15.4281C15.7875 15.4281 18.8571 12.3585 18.8571 8.571C18.8571 7.46743 18.5732 6.43886 18.1071 5.51743L23.2661 4.27457C24.2411 4.03886 24.2411 2.82278 23.2661 2.58707L13.0661 0.122784C12.3696 -0.0432879 11.6357 -0.0432879 10.9393 0.122784L0.728571 2.58171C-0.241071 2.81743 -0.241071 4.03886 0.728571 4.27457Z"
                                    fill="#465af7" />
                              </svg>
                           </div>
                           <div class="pl-3">
                              <h5>Milchuer College</h5>
                              <p class="mb-0">Master of Science in Computer Science | 2015</p>
                           </div>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                           <div class="profile-icon iq-icon-box rounded-small bg-warning-light svg-warning text-center">
                              <svg width="24" height="26" viewBox="0 0 24 26" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M23.25 6.46152V7.26922C23.25 7.37632 23.2105 7.47904 23.1402 7.55478C23.0698 7.63051 22.9745 7.67306 22.875 7.67306H21.75V8.27883C21.75 8.61337 21.4981 8.8846 21.1875 8.8846H2.8125C2.50186 8.8846 2.25 8.61337 2.25 8.27883V7.67306H1.125C1.02554 7.67306 0.930161 7.63051 0.859835 7.55478C0.789509 7.47904 0.75 7.37632 0.75 7.26922V6.46152C0.750001 6.38163 0.772007 6.30353 0.813234 6.2371C0.854462 6.17068 0.913058 6.11892 0.981609 6.08837L11.8566 1.64606C11.9484 1.60512 12.0516 1.60512 12.1434 1.64606L23.0184 6.08837C23.0869 6.11892 23.1455 6.17068 23.1868 6.2371C23.228 6.30353 23.25 6.38163 23.25 6.46152V6.46152ZM22.125 21.8077H1.875C1.25367 21.8077 0.75 22.3501 0.75 23.0192V23.8269C0.75 23.934 0.789509 24.0367 0.859835 24.1125C0.930161 24.1882 1.02554 24.2308 1.125 24.2308H22.875C22.9745 24.2308 23.0698 24.1882 23.1402 24.1125C23.2105 24.0367 23.25 23.934 23.25 23.8269V23.0192C23.25 22.3501 22.7463 21.8077 22.125 21.8077ZM4.5 9.69229V19.3846H2.8125C2.50186 19.3846 2.25 19.6558 2.25 19.9904V21H21.75V19.9904C21.75 19.6558 21.4981 19.3846 21.1875 19.3846H19.5V9.69229H16.5V19.3846H13.5V9.69229H10.5V19.3846H7.5V9.69229H4.5Z"
                                    fill="#f4a965" />
                              </svg>
                           </div>
                           <div class="pl-3">
                              <h5>Beechtown University</h5>
                              <p class="mb-0">Bachelor of Science in Computer Science | 2013</p>
                           </div>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                           <div class="profile-icon iq-icon-box rounded-small bg-success-light svg-success text-center">
                              <svg width="24" height="20" viewBox="0 0 24 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
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
                              <h5>South Kellergrove High</h5>
                              <p class="mb-0">Senior High School | 2010</p>
                           </div>
                        </li>
                        <li class="d-flex align-items-center">
                           <div class="profile-icon iq-icon-box rounded-small bg-info-light svg-info text-center">
                              <svg width="24" height="20" viewBox="0 0 24 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
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
                              <h5>South Kellergrove Junior</h5>
                              <p class="mb-0">Junior High School | Class of 2008</p>
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
                           <h1 class="text-success">15</h1>
                           <h5 class="text-success">Jan</h5>
                        </div>
                        <div class="d-flex align-items-center list-action">
                           <a class="badge mr-3" data-toggle="tooltip" data-placement="top" title=""
                              data-original-title="Edit" href="#"><i class="ri-edit-box-line"></i></a>
                           <a class="badge" data-toggle="tooltip" data-placement="top" title=""
                              data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                        </div>
                     </div>
                     <h4 class="my-2">Exploring Timezone Detection</h4>
                     <p class="mb-3 card-description">An internal team meeting to brief on a feature where the meeting
                        will be seen in viewer’s time zone with automatic timezone detection in Calendify. </p>
                     <p class="mb-2 text-success"><i class="las la-clock mr-3"></i>10 Pm - 10:30 Pm</p>
                     <p class="mb-0 text-success"><i class="las la-map-marker mr-3"></i>1 Circle Street Leominster, Ma
                        01453</p>
                  </div>
               </div>
            </div>

            <div class="card col-lg-3 col-md-6 col-sm-6">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Labels</h4>
                  </div>
               </div>
               <div class="card-body">
                  <p>Add labels to your progress bars by placing text within the <code>.progress-bar</code>.</p>
                  <div class="progress mb-3">
                     <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">25%</div>
                  </div>
                  <div class="progress mb-3">
                     <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100">50%</div>
                  </div>
                  <div class="progress mb-3">
                     <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100">75%</div>
                  </div>
                  <div class="progress">
                     <div class="progress-bar" role="progressbar" style="width: 99%;" aria-valuenow="99"
                        aria-valuemin="0" aria-valuemax="100">99%</div>
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
   </div>
</template>

<script>
export default {
   name: 'DashboardView'
}
</script>

<style scoped>
</style>
