<template>
<span class="txt">
  {{txt}}<template v-if="txt!=null"><template v-if="tempC">&nbsp;&#8451;</template></template>
</span>
</template>

<script>
export default {
  props: ["txt","tempC"],
  mounted() {
      
  }
};
</script>

<style scoped>

</style>
