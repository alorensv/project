<template>
  <div v-if="loader" class="loader">
  </div>
</template>

<script>
export default {
  props: {
    loader: {
      type: Boolean,
      required: true,
    },
  },
};
</script>
