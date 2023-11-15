<template>
  <section class="all-products">
    <div class="container">
      <SharedLoader :loading="loading"></SharedLoader>

      <template v-if="cart.instance && Object.values(cart.instance.items).length > 0">
        <div class="row g-3">
          <div class="col-lg-8">
            <BCard v-for="item in cart.instance.items" class="mb-3" :key="item.id">
              <h5 class="fw-bold">{{ item.name }} ({{ item.quantity }})</h5>
              <p class="text-muted">{{ item.price * item.quantity }}</p>
              <button type="button" class="btn btn-danger btn-sm" @click="deleteItem(item.id)">{{ $t('common.delete')
              }}</button>
            </BCard>
          </div>

          <div class="col-lg-4">
            <BCard class="mb-3">
              <h5>{{ $t('ecommerce.total') }}</h5>
              <h3>{{ cart.instance.total }}</h3>
              <NuxtLink :to="localePath('/ec/checkout')" type="button" class="btn btn-success btn-sm w-100">{{
                $t('ecommerce.proceed_to_checkout')
              }}</NuxtLink>
            </BCard>
          </div>
        </div>

      </template>
      <template v-else>
        <ClientOnly>
          <BCard v-if="!loading" class="mb-2 text-center">
            <div class="py-3">
              <h4 class="text-danger">{{ $t('ecommerce.cart_empty_title') }}</h4>
              <p class="mb-0">{{ $t('ecommerce.cart_empty_message') }}</p>
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

const localePath = useLocalePath();

const loading = ref(true);


const deleteItem = (itemId: number) => {
  cart.deleteItem(itemId);
  loadCart();
}

const loadCart = () => {
  loading.value = true;
  cart.fetchCart()
    .finally(() => loading.value = false)
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