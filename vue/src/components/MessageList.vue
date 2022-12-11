<template>
  <div class="card shadow-none m-0">
    <div class="card-body p-0 ">
      <div class="cust-title p-3">
        <h5 class="mb-0">Todas as mensagens</h5>
      </div>
      <div class="p-2">
        <div v-if = "recent_messages.length === 0" class="container"><h6>Caixa de mensagens vazia</h6></div>
        <div v-if="loaded">
          <div v-for="recent_message in recent_messages" :key="recent_message.id">
          <a href="#" class="iq-sub-card" @click="openModal(recent_message.id)" >
            <div class="media align-items-center cust-card p-2">
              <div class="">
                <img class="avatar-40 rounded-small" src="../assets/images/user/avatar_profile.png" alt="01">
              </div>
              <div class="media-body ml-3">
                <h6 class="mb-0">{{recent_message.name}}</h6>
                <small class="mb-0">{{recent_message.message}}</small>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <router-link to="/mensagens" class="right-ic btn-block position-relative p-3 border-top text-center" role="button">Ver tudo</router-link>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed } from "@vue/runtime-core"
import { useStore } from "../store";
import { GET_RECENT_MESSAGES } from "../store/action-types";

export default defineComponent({
  name: 'MessageList',
  data() {
    return {
      recent_messages: [],
      recent_message: {},
      count_messages: 0,
      loaded: false
    }
  },
  setup() {

    const store = useStore();
    const user = computed(() => store.getters.getUser);

    return {
      store,
      user
    }
  },
  created() {
      this.getRecentMessages();
  },
  methods: {
    getRecentMessages() {

      this.store.dispatch(GET_RECENT_MESSAGES, this.user.id)
      .then((response) => {
        this.recent_messages = this.recent_messages.concat(response)
        console.log(this.recent_messages)
      });

      this.loaded = true;
    },
    getCountMessages() {},
    openModal(id) {
      
      this.$router.push({
        name: 'messages',
        query: {
          userIdTo: id
        }
      }) 

      this.$route.params.userIdTo
    }
  }
})
</script>

<style scoped>

</style>