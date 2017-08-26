<template>
  <div class="simditor_wrapper">
    <textarea ref="editor" :placeholder="placeholder"></textarea>
  </div>
</template>

<script>
import Simditor from 'simditor';
export default {
  props: {
    placeholder: {
      type: String,
      default: 'Balabala'
    },
    value: String
  },
  data () {
    return {
      currentValue: this.value
    };
  },
  watch: {
    value (curVal) {
      this.currentValue = curVal;
    },
    currentValue (curVal, oldVal) {
      this.$emit('input', curVal);
    }
  },
  mounted () {
    new Simditor({
      textarea: this.$refs['editor']
    });
  }
};
</script>

<style lang="less">
.simditor_wrapper{
  .simditor{
    border: 0;
    .simditor-toolbar{
      border-bottom: 0;
      border-top: 1px solid #eee;
      >ul{
        padding-left: 0;
      }
    }
  }
}
</style>
