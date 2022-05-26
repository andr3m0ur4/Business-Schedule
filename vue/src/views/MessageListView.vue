<template>
    <div class="wrapper">
        <div class="container-top">
            <div class="row justify-content-center align-items-center height-self-center">
                <div class="col-md-12 col-sm-12 col-12 align-self-center">
                    <div class="content-page">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="py-3 border-bottom">
                                        <div class="form-title text-center">
                                            <h3>Mensagens</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-block card-stretch calender-account user-list" >
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="media flex-wrap align-items-center">
                                            <div class="mr-3">
                                                <img class="avatar-50 rounded" src="../assets/images/user/02.jpg"
                                                    alt="01">
                                            </div>
                                            <div>
                                                <div class="media align-items-top user-detail mb-1">
                                                    <h6>Kusti Franti</h6>
                                                    <div class="badge badge-color ml-3 mt-0">Owner</div>
                                                </div>
                                                <p class="mb-0">kustifranti1234@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="date">
                                            <p class="mb-0">03 December, 2020</p>
                                        </div>
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChat">Enviar mensagem</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-block card-stretch calender-account user-list">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="media flex-wrap align-items-center">
                                            <div class="mr-3">
                                                <img class="avatar-50 rounded" src="../assets/images/user/03.jpg"
                                                    alt="01">
                                            </div>
                                            <div>
                                                <div class="media align-items-top user-detail mb-1">
                                                    <h6>Rick O'shea</h6>
                                                    <div class="badge badge-color ml-3 mt-0">Owner</div>
                                                </div>
                                                <p class="mb-0">rickoshea1234@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="date">
                                            <p class="mb-0">07 December, 2020</p>
                                        </div>
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChat">Enviar mensagem</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-block card-stretch calender-account user-list">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="media flex-wrap align-items-center">
                                            <div class="mr-3">
                                                <img class="avatar-50 rounded" src="../assets/images/user/04.jpg"
                                                    alt="01">
                                            </div>
                                            <div>
                                                <div class="media align-items-top user-detail mb-1">
                                                    <h6>Alindro Smith</h6>
                                                    <div class="badge badge-color ml-3 mt-0">Owner</div>
                                                </div>
                                                <p class="mb-0">alindrosmith1234@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="date">
                                            <p class="mb-0">12 December, 2020</p>
                                        </div>
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChat">Enviar mensagem</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ChatModal id-modal="addMessage" title="Nova mensagen"/>
    </div>
</template>

<script>
import ChatModal from '@/components/ChatModal.vue'

export default {
  components: {
    ChatModal
  }
}
</script>