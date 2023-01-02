<template>
<span ref="blinkyText"><slot></slot></span>
</template>

<script>
export default {
  name: "blink",
  mounted() {
    setInterval(() => {
      this.$refs.blinkyText.classList.toggle("onoff");
    }, 500);
  }
};
</script>

<style>
.onoff {
  visibility: hidden;
}
</style>