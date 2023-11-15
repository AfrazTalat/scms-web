<template>
  <section class="about-us">
    <div class="container">
      <div class="general-heading">
        <h1>
          {{ $t('about.app_name_1') }}
          <span>{{ $t('about.app_name_2') }}</span>
        </h1>

        <p>{{ $t('about.learn_about_us') }}</p>

        <img src="@/assets/img/head_icon.svg" />
      </div>

      <div class="row">
        <div class="col-lg-6 col-12 mb-4">
          <div class="about-contain">
            <p>{{ $t('about.about_us_description') }}</p>

            <div class="buttons-contain">
              <!-- <NuxtLink :to="localePath('/')" class="btn btn-success">
                <img src="@/assets/img/document.svg" class="standard-img"  />

                <span>{{ $t('common.company_profile') }}</span>

                <img src="@/assets/img/document.svg" class="hover-img"  />
              </NuxtLink> -->

              <NuxtLink :to="localePath('/about')" class="rounded-button-contain">
                <div class="image-contain">
                  <img src="@/assets/img/arrow_left.svg" />
                </div>

                <span>{{ $t('common.view_more') }}</span>
              </NuxtLink>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-12 mb-4">
          <div class="row">
            <div class="col-lg-4 col-12">
              <ul class="nav-tabs-data">
                <li class="tab-contain" @click="activeTab = 'vision'" :class="[activeTab === 'vision' ? 'active' : '']">
                  <img src="@/assets/img/vision.svg" />

                  <span>{{ $t('about.our_vision') }}</span>
                </li>

                <li class="tab-contain" @click="activeTab = 'message'" :class="[activeTab === 'message' ? 'active' : '']">
                  <img src="@/assets/img/message.svg" />

                  <span>{{ $t('about.our_message') }}</span>
                </li>

                <li class="tab-contain" @click="activeTab = 'job'" :class="[activeTab === 'job' ? 'active' : '']">
                  <img src="@/assets/img/job.svg" />

                  <span>{{ $t('about.our_mission') }}</span>
                </li>
              </ul>
            </div>

            <div class="col-lg-8 col-12 p-0">
              <div class="tab-content" v-if="activeTab === 'vision'"
                :class="[activeTab === `vision` ? 'activeTab vision' : '']">
                <p>
                  {{ $t('about.our_vision_description') }}
                </p>

                <div class="image-content">
                  <SharedAppLogo class="brand-name" />
                  <!-- <img src="@/assets/img/your-logo.png" class="brand-name" /> -->
                </div>
              </div>

              <div class="tab-content" v-if="activeTab === 'message'"
                :class="[activeTab === `message` ? 'activeTab message' : '']">
                <p>
                  {{ $t('about.our_message_description') }}
                </p>

                <div class="image-content">
                  <SharedAppLogo class="brand-name" />
                  <!-- <img src="@/assets/img/your-logo.png" class="brand-name" /> -->
                </div>
              </div>

              <div class="tab-content" v-if="activeTab === 'job'" :class="[activeTab === `job` ? 'activeTab job' : '']">
                <p>
                  {{ $t('about.our_mission_description') }}
                </p>

                <div class="image-content">
                  <SharedAppLogo class="brand-name" />
                  <!-- <img src="@/assets/img/your-logo.png" class="brand-name" /> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
const activeTab = ref('vision');

const localePath = useLocalePath();
</script>

<style lang="scss">
.about-us {
  width: 100%;
  padding: 90px 0px 66px 0px;
  background-color: #fff;

  .about-contain {
    width: 100%;
    border-radius: 6px;
    background-color: rgba($color: #14a1d5, $alpha: 0.03);
    border: 1px solid rgba($color: #14a1d5, $alpha: 0.06);
    padding: 40px;

    p {
      color: var(--dark);
      font-size: 16px;
      font-weight: 500;
      line-height: 25px;
      margin-bottom: 40px;
    }

    .buttons-contain {
      .btn {
        width: 180px !important;
      }

      .rounded-button-contain {
        width: 180px;
        display: flex;
        align-content: center;
        align-items: center;
        justify-content: flex-start;
        position: relative;
        z-index: 9;
        margin-inline-start: 10px !important;

        &::after,
        &::before {
          content: "";
          position: absolute;
          width: 50px;
          height: 50px;
          background-color: var(--primary-color);
          top: 0px;
          border-radius: 25px;
          z-index: -1;
          transition: all 0.3s linear;
        }

        &::before {
          animation: pulsecust 2s linear infinite;
          background-color: #004e77;
        }

        .image-contain {
          width: 50px;
          height: 50px;
          display: flex;
          align-items: center;
          align-content: center;
          justify-content: center;
          margin-inline-end: 10px;
          position: relative;
          z-index: 9;

          img {
            width: 24px;
            height: 24px;
            object-fit: contain;
            transition: all 0.3s linear;
          }
        }

        span {
          color: var(--primary-color);
          font-size: 16px;
          font-weight: 500;
          line-height: 19px;
        }

        &:hover {
          &::after {
            width: 100%;
          }

          &::before {
            animation: none !important;
            opacity: 0;
          }

          span {
            color: var(--light);
          }

          img {
            transform: translateX(-10px);
          }
        }
      }
    }
  }

  .nav-tabs-data {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: 5px 24px;
    background-color: var(--primary-color);
    border-radius: 6px;

    .tab-contain {
      padding: 35px 0px;
      border-bottom: 1px solid rgba($color: #fff, $alpha: 0.1);
      display: flex;
      align-content: center;
      align-items: center;
      cursor: pointer;

      img {
        width: 30px;
        height: 30px;
        object-fit: contain;
        margin-inline-end: 15px;
        opacity: 0.7;
      }

      span {
        color: rgba($color: #fff, $alpha: 0.7);
        font-size: 20px;
        font-weight: 500;
        line-height: 24px;
      }

      &:last-child {
        border: 0px !important;
      }

      &.active {
        img {
          opacity: 1 !important;
        }

        span {
          color: rgba($color: #fff, $alpha: 1) !important;
        }
      }
    }
  }

  .tab-content {
    width: 100%;
    padding: 40px;
    background-color: rgba($color: #14a1d5, $alpha: 0.03);
    border: 1px solid rgba($color: #14a1d5, $alpha: 0.06);
    border-radius: 6px;
    position: relative;
    z-index: 9;

    p {
      color: var(--dark);
      font-size: 16px;
      font-weight: 500;
      line-height: 25px;
      margin-bottom: 30px;
    }

    .image-content {
      width: 100%;
      display: flex;
      justify-content: flex-end !important;

      img {
        width: 67px;
        height: 74px;
        object-fit: contain;
      }
    }

    &::after {
      content: "";
      position: absolute;
      width: 23px;
      height: 13px;
      background: url("/assets/img/triangle.png") left center / contain no-repeat;
      z-index: -1;
      right: -23px;
      transition: all 0.5s linear;
    }

    &.activeTab {
      &::after {
        transition: all 0.5s linear;
      }
    }

    &.vision::after {
      top: 45px;
      transition: all 0.5s linear;
    }

    &.message::after {
      top: calc(50% - 6.5px);
      transition: all 0.5s linear;
    }

    &.job::after {
      top: calc(80% - 6.5px);
      transition: all 0.5s linear;
    }
  }
}

@media (max-width: 999px) {
  .about-us {

    .about-contain,
    .tab-content {
      padding: 20px 10px !important;
    }

    .rounded-button-contain span {
      font-size: 14px !important;
    }

    .tab-content {
      &::after {
        top: -19px !important;
        right: calc(50% - 12px) !important;
        transform: rotate(-90deg) !important;
      }
    }

    .nav-tabs-data {
      flex-direction: row !important;
      justify-content: center;
      padding: 20px 24px !important;

      .tab-contain {
        padding: 0px 30px !important;
        border-bottom: 0px !important;
        border-inline-end: 1px solid rgba($color: #fff, $alpha: 0.1);
        flex-direction: column;
        justify-content: center;

        img {
          margin: 0px 0px 5px 0px;
          margin-inline-end: 0px !important;
        }
      }
    }
  }
}
</style>