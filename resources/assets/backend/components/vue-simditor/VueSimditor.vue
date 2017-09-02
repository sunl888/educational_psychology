<template>
  <div class="simditor_wrapper">
    <textarea ref="editor"></textarea>
  </div>
</template>

<script>
import 'simditor/styles/simditor.css';
import Simditor from 'simditor';
export default {
  name: 'vueSimditor',
  props: {
    toolbar: {
      type: Array,
      default: () => ['title', 'bold', 'italic', 'underline', 'fontScale', 'color', 'ol', 'ul', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment']
    },
    value: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      editor: null,
      currentValue: this.value
    };
  },
  mounted () {
    this.editor = new Simditor({
      textarea: this.$refs.editor,
      placeholder: this.placeholder,
      toolbar: this.toolbar,
      pasteImage: true,
      toolbarFloat: false
    });
    this.editor.on('decorate', (e, src) => {
      this.currentValue = this.editor.getValue();
    });
    let simditorBody = this.$el.parentNode.querySelector('.simditor-body');
    if (simditorBody !== undefined) {
      simditorBody.oninput = () => {
        this.currentValue = this.editor.getValue();
      };
    }
    this.editor.setValue(this.value);
  },
  watch: {
    'value' (val) {
      if (this.currentValue !== val) {
        this.currentValue = val;
        this.editor.setValue(val);
      }
    },
    'currentValue' (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.$emit('input', newVal);
      }
    }
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
