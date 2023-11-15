<template>
  <section class="locations">
    <div class="container">
      <div class="row">
        <div class="col-12 mb-5">
          <b-tabs content-class="mt-3" class="custom-tabs">
            <b-tab v-for="branch in branchesList?.list" :key="branch.id" :title="branch.name">
              <div class="row">
                <div class="col-lg-4 col-12 mb-4">
                  <div class="loaction-contain">
                    <a :href="`tel:${branch.phone_number}`" target="_blank" class="box">
                      <img src="@/assets/img/mobile.svg" alt="" />

                      <h4>
                        {{ $t('common.phone_number') }}
                      </h4>

                      <div class="d-flex justify-content-center">
                        <a href="#" class="link">
                          {{ branch.phone_number }}
                        </a>
                      </div>
                    </a>

                    <a :href="`mailto:${branch.email}`" target="_blank" class="box">
                      <img src="@/assets/img/sms.svg" alt="" />

                      <h4>
                        {{ $t('common.email_address') }}
                      </h4>

                      <p class="link">
                        {{ branch.email }}
                      </p>
                    </a>

                    <div class="box">
                      <img src="@/assets/img/location.svg" alt="" />

                      <h4>
                        {{ $t('common.geo_location') }}
                      </h4>

                      <p class="link">
                        {{ branch.location_text }}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-8 col-12">
                  <div class="map-contain">
                    <iframe style="border:0;" allowfullscreen="true" loading="lazy" :src="branch.location_link">
                    </iframe>
                  </div>
                </div>
              </div>
            </b-tab>
          </b-tabs>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup async>
import NewsBox from '../core/news-box.vue';
import Loader from '../shared/loader.vue';
import { useArticles } from '~/stores/content/articles';
import { useBranches } from '~/stores/content/branches';

const localePath = useLocalePath();

const loading = ref(false);
const branches = useBranches();

const branchesList = await (await useAsyncData("home-news", () => branches.fetchBranches()
  .finally(() => loading.value = false))).data.value;
</script>

<style lang="scss">
.locations {
  width: 100%;
  padding: 90px 0px 80px 0px;
  background-color: var(--light);

  .custom-tabs .nav.nav-tabs .nav-link {
    min-width: 160px !important;
    width: 160px !important;
  }

  .loaction-contain {
    width: 100%;
    padding: 50px 31px;
    background-color: rgba($color: #14A1D5, $alpha: 0.03);
    border: 1px solid rgba($color: #14A1D5, $alpha: 0.06);
    border-radius: 6px;

    .box {
      width: 100%;
      display: flex;
      align-content: center;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      margin-bottom: 20px;
      transition: all .3s linear;

      &:last-child {
        margin: 0px;
      }

      img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        filter: invert(56%) sepia(60%) saturate(4501%) hue-rotate(164deg) brightness(98%) contrast(84%);
      }

      h4 {
        color: var(--dark);
        font-size: 16px;
        font-weight: 900;
        line-height: 42px;
        margin: 5px 0px;
      }

      .link {
        color: #000000;
        font-size: 16px;
        font-weight: 500;
        line-height: 42px;
        margin: 0px !important;

        &.dash-link {
          padding-inline-start: 5px;
          position: relative;
          margin-inline-start: 5px;
          display: flex;

          &::before {
            content: '-';
            color: #000000;
            font-size: 16px;
            font-weight: 500;
            line-height: 42px;
            margin-inline-end: 5px;
            display: inline-block;
          }
        }
      }

      &:hover {
        transform: translateY(-10px);

        img {
          animation: rotation .2s linear 2;
        }
      }
    }
  }

  .activeTab {
    animation: fadeInLeft .4s linear;
  }

  .map-contain {
    width: 100%;
    height: 544px;
    border-radius: 6px;
    overflow: hidden;

    iframe {
      width: 100% !important;
      height: 100% !important;
    }
  }
}
</style>