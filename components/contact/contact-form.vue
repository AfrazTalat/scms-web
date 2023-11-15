<template>
  <section class="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-12 mb-4">
          <div class="loaction-contain">
            <div class="box">
              <img src="@/assets/img/mobile.svg" alt="" />

              <h4>
                {{ $t('common.phone_number') }}
              </h4>

              <div class="d-flex justify-content-center">
                <a href="#" class="link">
                  {{ $setting('contact_phone').value }}
                </a>
              </div>
            </div>

            <a href="mailto:info@ecoclean-sa.com" class="box">
              <img src="@/assets/img/sms.svg" alt="" />

              <h4>
                {{ $t('common.email_address') }}
              </h4>

              <p class="link">
                {{ $setting('contact_email').value }}
              </p>
            </a>

            <a href="#" class="box">
              <img src="@/assets/img/location.svg" alt="" />

              <h4>
                {{ $t('common.geo_location') }}
              </h4>

              <p class="link">
                {{ $setting('contact_location').value }}
              </p>
            </a>
          </div>
        </div>

        <div class="col-lg-8 col-12">
          <div class="contact-form">
            <h1>
              {{ $t('contact.form_title') }}
            </h1>

            <p>
              {{ $t('contact.form_subtitle') }}
            </p>

            <div class="alert alert-success" v-if="sent">
              {{ $t('contact.contact_message_was_sent') }}
            </div>

            <form class="form-data" @submit.prevent="submit">
              <div class="form-group">
                <div class="form-icon">
                  <img src="@/assets/img/user.svg" alt="" />
                </div>
                <input v-model="formData.name" type="text" required class="form-control"
                  :placeholder="$t('common.name').toString()" />
              </div>

              <div class="form-group">
                <div class="form-icon">
                  <img src="@/assets/img/sms.svg" alt="" />
                </div>

                <input v-model="formData.email" type="email" required class="form-control"
                  :placeholder="$t('common.email_address').toString()" />
              </div>

              <div class="form-group">
                <div class="form-icon">
                  <img src="@/assets/img/mobile.svg" alt="" />
                </div>

                <input v-model="formData.phone" type="text" required class="form-control"
                  :placeholder="$t('common.phone_number').toString()" />
              </div>

              <div class="form-group">
                <div class="form-icon">
                  <img src="@/assets/img/location.svg" alt="" />
                </div>

                <input v-model="formData.address" type="text" class="form-control"
                  :placeholder="$t('common.address').toString()" />
              </div>

              <div class="form-group text-area">
                <div class="form-icon">
                  <img src="@/assets/img/pen.svg" alt="" />
                </div>

                <textarea v-model="formData.message" class="form-control" required
                  :placeholder="$t('contact.write_your_message').toString()" cols="30" rows="10"></textarea>
              </div>

              <div class="buttons-contain">
                <button class="btn btn-success" type="submit" :disabled="loading || sent">
                  <span>
                    {{ $t('contact.send_message') }}
                  </span>

                  <img src="@/assets/img/footer_location.svg" class="hover-img" alt="" />
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>

const loading = ref(false)
const sent = ref(false)
const formData = ref({
  name: '',
  email: '',
  phone: '',
  address: '',
  message: ''
})
const reset = () => {
  formData.value = {
    name: '',
    email: '',
    phone: '',
    address: '',
    message: ''
  };
}

const submit = () => {
  if (loading.value) return;
  loading.value = true;
  sent.value = false;
  useApi('commons/contact').post('', { data: formData.value })
    .then(() => {
      sent.value = true;
    })
    .finally(() => loading.value = false)
}
</script>


<style lang="scss">
.contact {
  width: 100%;
  padding: 90px 0px 80px 0px;
  background-color: var(--light);

  .loaction-contain {
    width: 100%;
    padding: 50px 31px;
    background-color: rgba($color: #058702, $alpha: 0.02);
    border: 1px solid rgba($color: #058702, $alpha: 0.06);
    border-radius: 6px;

    .box {
      width: 100%;
      display: flex;
      align-content: center;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      margin-top: 28px;
      padding-bottom: 28px;
      border-bottom: 1px solid rgba($color: #14A1D5, $alpha: 0.10);
      transition: all .3s linear;

      &:last-child {
        border: 0px !important;
        padding: 0px !important;
      }

      &:first-child {
        margin-top: 0px !important;
      }

      img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        filter: invert(31%) sepia(50%) saturate(4740%) hue-rotate(86deg) brightness(94%) contrast(108%);
      }

      h4 {
        color: var(--dark);
        font-size: 16px;
        font-weight: 900;
        line-height: 42px;
      }

      .link {
        color: #000000;
        font-size: 16px;
        font-weight: 500;
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

  .contact-form {
    width: 100%;
    background-color: #fff;
    border-radius: 6px;
    border: 1px solid rgba($color: #058702, $alpha: 0.10);
    padding: 50px 96px;

    h1 {
      font-size: 25px;
      font-weight: 900;
      line-height: 40px;
      text-align: center;
      margin-bottom: 10px;
    }

    p {
      color: #989898;
      font-size: 16px;
      font-weight: 500;
      line-height: 20px;
      text-align: center;
      margin-bottom: 50px;
    }

    .form-data {
      .form-group {
        width: 100%;
        height: 50px;
        position: relative;
        margin-bottom: 10px;

        &.text-area {
          height: 100px;
          margin-bottom: 20px;
        }

        .form-icon {
          width: 24px;
          height: 24px;
          position: absolute;
          top: 13px;
          right: 20px !important;
          z-index: 9;

          img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: invert(31%) sepia(50%) saturate(4740%) hue-rotate(86deg) brightness(94%) contrast(108%);
          }
        }

        .form-control {
          width: 100%;
          height: 100%;
          padding: 0px 54px;
          background-color: rgba($color: #058702, $alpha: 0.02);
          border: 1px solid rgba($color: #058702, $alpha: 0.06);
          border-radius: 25px;
          transition: all .3s linear;
          color: var(--dark);
          font-size: 16px;
          font-weight: 500;

          &::placeholder {
            color: #989898;
            font-size: 16px;
            font-weight: 500;
            line-height: 20px;
          }

          &:focus,
          &:hover {
            outline: none !important;
            box-shadow: 0px 0px 0px rgba($color: #000000, $alpha: 0.0) !important;
            border-color: rgba($color: #058702, $alpha: 0.5) !important;
          }
        }

        textarea {
          padding-top: 13px !important;
          resize: none;
        }

        &:hover,
        &:focus {
          .form-icon img {
            animation: translateX 1s linear infinite;
          }
        }
      }
    }

    .btn {
      width: 100% !important;
      outline: none !important;
      border: 0px !important;
    }
  }
}

@media (max-width: 999px) {
  .contact {
    .contact-form {
      padding: 30px 10px !important;
    }
  }
}
</style>