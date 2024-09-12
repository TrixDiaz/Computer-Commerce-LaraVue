<script>
import { defineComponent } from "vue";
import { Carousel, Navigation, Slide } from "vue3-carousel";
import "vue3-carousel/dist/carousel.css";

export default defineComponent({
  name: "vueCarousel",
  props: {
    products: {
      type: Array,
      required: true,
    },
    itemsToShow: {
      type: Number,
      default: 5,
    },
  },
  components: {
    Carousel,
    Slide,
    Navigation,
  },
  data() {
    return {
      settings: {
        itemsToShow: 1,
        snapAlign: "center",
      },
      breakpoints: {
        700: {
          itemsToShow: 3.5,
          snapAlign: "center",
        },
        1024: {
          itemsToShow: this.itemsToShow,
          snapAlign: "center",
        },
      },
    };
  },
});
</script>

<template>
  <Carousel v-bind="settings" :breakpoints="breakpoints">
    <Slide v-for="product in products" :key="product.id">
      <div class="carousel__item">
        <slot :product="product"></slot>
      </div>
    </Slide>

    <template #addons>
      <Navigation />
    </template>
  </Carousel>
</template>

<style>
.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  background-color: #6b7280;
  border-radius: 100%;
  padding-block: 0.5rem;
  width: 2.5rem;
  margin-inline: 0px;
  color: #ffffff;
  opacity: 50%;
}

.carousel__prev {
  border-top-left-radius: 5%;
  border-bottom-left-radius: 5%;
}

.carousel__next {
  border-top-right-radius: 5%;
  border-bottom-right-radius: 5%;
}
</style>
