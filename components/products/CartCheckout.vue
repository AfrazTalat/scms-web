<template>
  <section class="all-products">
    <div class="container">
      <SharedLoader :loading="loading"></SharedLoader>
      <template v-if="cart.instance && Object.values(cart.instance.items).length > 0">
        <BCard v-if="createdOrder" class="mb-2 text-center">
          <div class="py-3">
            <h4 class="text-success">{{ $t('ecommerce.order_success_title') }}</h4>
            <p>{{ $t('ecommerce.order_success_message') }}</p>
            <p>{{ $t('ecommerce.order_track_id') }}: <span class="fw-bold"> {{ createdOrder?.uuid }}</span></p>
          </div>
        </BCard>
        <div v-else class="row g-3">
          <div class="col-lg-8">
            <BCard class="mb-3">
              <h4 class="mb-3">{{ $t('ecommerce.invoice_details') }}</h4>

              <div class="row g-3">
                <div class="col-6">
                  <label class="form-label" for="checkout-first_name">{{ $t('common.first_name') }} <span
                      class="text-danger">*</span></label>
                  <input v-model="formData.first_name" type="text" class="form-control" id="checkout-first_name"
                    name="checkout-first_name">
                </div>
                <div class="col-6">
                  <label class="form-label" for="checkout-last_name">{{ $t('common.last_name') }} <span
                      class="text-danger">*</span></label>
                  <input v-model="formData.last_name" type="text" class="form-control" id="checkout-last_name"
                    name="checkout-last_name">
                </div>
                <div class="col-12">
                  <label class="form-label" for="checkout-company_name">{{ $t('common.company_name') }} <span
                      class="text-muted small">({{ $t('common.optional') }})</span></label>
                  <input v-model="formData.company_name" type="text" class="form-control" id="checkout-company_name"
                    name="checkout-company_name">
                </div>
                <div class="col-6">
                  <label class="form-label" for="checkout-country_code">{{ $t('common.country') }} <span
                      class="text-danger">*</span></label>
                  <select v-model="formData.country_code" class="form-select" id="checkout-country_code"
                    name="checkout-country_code">
                    <option value="SA">Saudi Arabia</option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label" for="checkout-city">{{ $t('common.city') }} <span
                      class="text-danger">*</span></label>
                  <input v-model="formData.city" type="text" class="form-control" id="checkout-city" name="checkout-city">
                </div>
                <div class="col-6">
                  <label class="form-label" for="checkout-area">{{ $t('common.area') }} <span
                      class="text-danger">*</span></label>
                  <input v-model="formData.area" type="text" class="form-control" id="checkout-area" name="checkout-area">
                </div>
                <div class="col-6">
                  <label class="form-label" for="checkout-zip_code">{{ $t('common.zip_code') }} <span
                      class="text-danger">*</span></label>
                  <input v-model="formData.zip_code" type="text" class="form-control" id="checkout-zip_code"
                    name="checkout-zip_code">
                </div>
                <div class="col-12">
                  <label class="form-label" for="checkout-address">{{ $t('common.address') }} <span
                      class="text-danger">*</span></label>
                  <input v-model="formData.address" type="text" class="form-control" id="checkout-address"
                    name="checkout-address">
                </div>
                <div class="col-12">
                  <label class="form-label" for="checkout-address2">{{ $t('common.address2') }} <span
                      class="text-muted small">({{ $t('common.optional') }})</span></label>
                  <input v-model="formData.address2" type="text" class="form-control" id="checkout-address2"
                    name="checkout-address2">
                </div>
                <div class="col-6">
                  <label class="form-label" for="checkout-phone_number">{{ $t('common.phone_number') }} <span
                      class="text-danger">*</span></label>
                  <input v-model="formData.phone_number" type="text" class="form-control" id="checkout-phone_number"
                    name="checkout-phone_number">
                </div>
                <div class="col-6">
                  <label class="form-label" for="checkout-email">{{ $t('common.email') }} <span
                      class="text-danger">*</span></label>
                  <input v-model="formData.email" type="text" class="form-control" id="checkout-email"
                    name="checkout-email">
                </div>
                <div class="col-12">
                  <label class="form-label" for="checkout-notes">{{ $t('common.notes') }} <span
                      class="text-muted small">({{
                        $t('common.optional') }})</span></label>
                  <textarea v-model.trim="formData.notes" class="form-control" id="checkout-notes" name="checkout-notes"
                    rows="5"> </textarea>
                </div>
              </div>
            </BCard>
          </div>

          <div class="col-lg-4">
            <BCard class="mb-3">
              <BCard v-for="item in cart.instance.items" class="mb-2" :key="item.id">
                <div class="d-flex align-items-center justify-content-between">
                  <h6 class="fw-bold">{{ item.name }} ({{ item.quantity }})</h6>
                  <p class="text-muted m-0">{{ item.price * item.quantity }}</p>
                </div>
              </BCard>

              <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
                <h5 class="mb-0">{{ $t('ecommerce.total') }}</h5>
                <h3 class="mb-0">{{ cart.instance.total }}</h3>
              </div>
              <button type="button" class="btn btn-success btn-sm w-100" @click="createOrder">
                {{ $t('ecommerce.confirm_order') }}
              </button>
            </BCard>
          </div>
        </div>
      </template>
      <template v-else>
        <ClientOnly>
          <BCard v-if="!loading" class="mb-2 text-center">
            <div class="py-3">
              <h4 class="text-danger">{{ $t('ecommerce.cart_empty_title') }}</h4>
              <p class="mb-0">{{ $t('ecommerce.cart_empty_checkout_message') }}</p>
            </div>
          </BCard>
        </ClientOnly>
      </template>
    </div>
  </section>
</template>


<script lang="ts" setup>
import { useCart } from '~/stores/ecommerce/cart';

const cart = useCart();

const loading = ref(true);
const createdOrder = ref();

const formDataOriginal = {
  first_name: '',
  last_name: '',
  company_name: '',
  country_code: 'SA',
  address: '',
  address2: '',
  city: '',
  area: '',
  zip_code: '',
  phone_number: '',
  email: '',
  notes: '',
}
const formData = ref(useCloneDeep(formDataOriginal))


const loadCart = () => {
  loading.value = true;
  cart.fetchCart().finally(() => loading.value = false)
}

const createOrder = () => {
  cart.transformToOrder(formData.value)
    .then((order) => {
      createdOrder.value = order;
    });
}

onMounted(() => {
  loadCart();
})
</script>

<style lang="scss">
.all-products {
  width: 100%;
  padding: 90px 0px;
  background-color: var(--light);

  .activeTab {
    animation: fadeInLeft 0.4s linear;
  }
}
</style>