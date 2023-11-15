<template>
  <section class="partner" id="partners">
    <div class="container">
      <div class="general-heading">
        <h1>{{ $t('partners.our_partners') }}</h1>

        <p>{{ $t('partners.our_partners_subtitle') }}</p>

        <img src="@/assets/img/head_icon.svg" />
      </div>

      <Loader :loading="loading"></Loader>
      <div class="row" v-if="!loading">
        <div class="col-lg-2 col-md-3 col-6 mb-3" v-for="(partner, i) in partnersList?.list" :key="i">
          <div class="partner-img mb-2" v-if="partner.logo">
            <img :src="partner.logo.preview" :alt="partner.logo.name" />
          </div>
          <div class="text-center" v-if="partner.logo">
            {{ partner.name }}
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
import { usePartners } from "~/stores/content/partners";
import Loader from "../shared/loader.vue";

const localePath = useLocalePath();

const loading = ref(false);
const partners = usePartners();

const partnersList = (await useAsyncData("home-partners", () => partners.fetchPartners()
  .finally(() => loading.value = false))).data.value;
</script>

<style lang="scss">
.partner {
  width: 100%;
  padding: 90px 0px 70px 0px;
  background-color: #fff;

  .partner-img {
    width: 100%;
    height: 100px;

    img {
      width: 100%;
      height: 100px;
      object-fit: contain;
      object-position: center;
      opacity: 0.5;
      transition: opacity .4s ease-in-out;


      &:hover {
        opacity: 1;
      }
    }
  }
}
</style>