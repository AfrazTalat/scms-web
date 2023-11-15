<template>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-12 mb-4">
          <div class="content">
            <SharedAppLogo class="logo" />

            <p>{{ $t("footer.company_description") }}</p>
            <!-- <social-media /> -->

            <div class="socail-contain">
              <CoreSocialMedia />
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-12 mb-4 border-shape">
          <div class="content">
            <h4 class="title padding-title">{{ $t("footer.company_sections") }}</h4>

            <div class="flex-contain">
              <ul class="data">
                <li>
                  <NuxtLink :to="localePath(`/`)" class="link">{{ $t("site_links.home") }}</NuxtLink>
                </li>

                <li>
                  <NuxtLink :to="localePath(`/about`)" class="link">{{ $t("site_links.about") }}</NuxtLink>
                </li>

                <li>
                  <NuxtLink :to="localePath(`/trademarks`)" class="link">{{ $t("site_links.brands") }}</NuxtLink>
                </li>

                <li>
                  <NuxtLink :to="localePath(`/products`)" class="link">{{ $t("site_links.products") }}</NuxtLink>
                </li>

                <li>
                  <NuxtLink :to="localePath(`/services`)" class="link">{{ $t("site_links.services") }}</NuxtLink>
                </li>
                <!-- <li v-if="policyPage">
                  <NuxtLink :to="localePath(`/pages/${policyPage.value}`)" class="link">
                    {{ $t("site_links.privacy_policy") }}
                  </NuxtLink>
                </li>
                <li v-if="termsPage">
                  <NuxtLink :to="localePath(`/pages/${termsPage.value}`)" class="link">
                    {{ $t("site_links.terms") }}
                  </NuxtLink>
                </li> -->
              </ul>

              <ul class="data">
                <li>
                  <NuxtLink :to="localePath(`/news`)" class="link">{{ $t("site_links.news") }}</NuxtLink>
                </li>

                <li>
                  <NuxtLink :to="localePath(`/contact`)" class="link">{{ $t("site_links.contact") }}</NuxtLink>
                </li>

                <li>
                  <NuxtLink :to="localePath(`/locations`)" class="link">{{ $t("site_links.branches") }}</NuxtLink>
                </li>
                <li>
                  <NuxtLink :to="localePath('/#partners')" class="link">{{ $t("site_links.partners") }}</NuxtLink>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- <div class="col-lg-4 col-12 mb-4">
          <div class="content">
            <h4 class="title">{{ $t("contact.contact_us") }}</h4>

            <div class="box">
              <img src="@/assets/img/footer_phone.svg" alt="" />

              <div class="content">
                <h4>{{ $t("common.phone_number") }}</h4>
                <a href="#" class="link" v-if="settings.contact_phone">
                  {{ settings.contact_phone.value }}
                </a>
              </div>
            </div>

            <a href="mailto:info@ecoclean-sa.com" class="box">
              <img src="@/assets/img/footer_message.svg" alt="" />

              <div class="content">
                <h4>{{ $t("common.email_address") }}</h4>
                <p class="link" v-if="settings.contact_email">
                  {{ settings.contact_email.value }}
                </p>
              </div>
            </a>

            <a href="#" class="box">
              <img src="@/assets/img/footer_location.svg" alt="" />

              <div class="content">
                <h4>{{ $t("common.geo_locations") }}</h4>
                <p class="link" v-if="settings.contact_email">
                  {{ settings.contact_location.value }}
                </p>
              </div>
            </a>
          </div>
        </div> -->
      </div>
    </div>

    <div class="copyrights">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-12">
            <p>
              {{ $t("footer.copyrights_reserved") }}
              <span>{{ $t("common.app_name") }}</span>
              @ 2022
            </p>
          </div>

          <div class="col-lg-6 col-12">
            <div class="image-content">
              <a href="https://spiderbees.com/" target="_blank">
                <img src="@/assets/img/spider.svg" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script lang="ts" setup>
const localePath = useLocalePath()

</script>

<style lang="scss">
footer {
  width: 100%;
  padding: 70px 0px 13px;
  background-color: #004e77;
  z-index: 9;
  position: relative;

  &::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: url("/assets/img/footer_pattern.png") center / cover no-repeat;
    top: 0;
    left: 0;
    z-index: -1;
  }

  .border-shape {
    position: relative;

    &::after,
    &::before {
      content: "";
      position: absolute;
      width: 1px;
      height: 50%;
      top: 25%;
      background-color: rgba($color: #ffffff, $alpha: 0.1);
    }

    &::after {
      left: 20px;
    }

    &::before {
      right: 20px;
    }
  }

  .content {
    width: 100%;

    .logo {
      width: 82px;
      height: 91px;
      object-fit: contain;
    }

    p {
      color: var(--light);
      font-size: 16px;
      font-weight: 500;
      line-height: 25px;
      margin: 33px 0px 32px 0px;
    }

    .title {
      font-size: 20px;
      font-weight: 900;
      line-height: 25px;
      color: var(--primary-color);
      margin-bottom: 31px;

      &.padding-title {
        padding-inline-start: 51px;
      }
    }

    .flex-contain {
      width: 100%;
      display: flex;
      justify-content: center;

      .data {
        &:first-child {
          margin-inline-end: 41px;
        }

        li {
          margin-bottom: 4px;

          &:last-child {
            margin: 0px;
          }

          .link {
            color: var(--light);
            font-weight: 500;
            font-size: 16px;
            line-height: 37px;
            display: block;
            transition: transform 0.2s linear;

            &:hover {
              color: var(--primary-color);
              transform: translateX(-7px);
            }
          }
        }
      }
    }

    .box {
      width: 100%;
      display: flex;
      transition: all 0.4s linear;
      margin-bottom: 20px;

      &:last-child {
        margin: 0px !important;
      }

      img {
        width: 24px;
        height: 24px;
        object-fit: contain;
        margin-inline-end: 5px;
      }

      .content {
        h4 {
          color: #fff;
          font-weight: 900;
          font-size: 16px;
          font-weight: 42px;
        }

        .link {
          color: rgba($color: #fff, $alpha: 0.7);
          font-size: 16px;
          font-weight: 500;
          line-height: 42px;
          margin: 0px !important;

          &.dash-link {
            padding-inline-start: 5px;
            position: relative;
            margin-inline-start: 5px;

            &::before {
              content: "-";
              color: rgba($color: #fff, $alpha: 0.7);
              font-size: 16px;
              font-weight: 500;
              line-height: 42px;
              display: inline-block;
            }
          }
        }
      }

      &:hover {
        transform: translateY(-10px);

        .link {
          color: #fff !important;
        }
      }
    }
  }

  .copyrights {
    width: 100%;
    padding-top: 12px;
    border-top: 1px solid rgba($color: #ffffff, $alpha: 0.1);
    margin-top: 70px;

    p {
      color: #fff;
      margin: 0px;
      font-size: 16px;
      font-weight: 500;
      line-height: 37px;

      span {
        color: var(--primary-color);
        font-size: 16px;
        font-weight: 500;
        line-height: 37px;
      }
    }

    .image-content {
      width: 100%;
      display: flex;
      justify-content: flex-end;
      align-items: center;

      img {
        width: 150px;
        height: 20px;
        object-fit: contain;
      }
    }
  }
}

@media (max-width: 999px) {
  footer {
    .border-shape {

      &::after,
      &::before {
        width: 100%;
        height: 1px;
        left: 0px !important;
        right: 0px !important;
      }

      &::after {
        top: -15px !important;
      }

      &::before {
        top: unset !important;
        bottom: 0px !important;
      }
    }

    .title.padding-title {
      padding: 0px !important;
    }

    .flex-contain {
      justify-content: flex-start !important;
    }

    .copyrights {
      p {
        text-align: center;
      }

      .image-content {
        justify-content: center !important;
      }
    }
  }
}
</style>