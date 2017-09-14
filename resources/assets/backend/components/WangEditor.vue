<template>
  <div>
    <div id="editorElem" style="text-align:left"></div>
  </div>
</template>

<script>
  import E from 'wangeditor';
  export default {
    name: 'editor',
    props: {
      content: String
    },
    data () {
      return {
        editor: null
      };
    },
    watch: {
      content (newContent) {
        if (this.editor) {
          this.editor.txt.html(newContent);
        }
      }
    },
    mounted () {
      this.editor = new E('#editorElem');
      this.editor.customConfig.onchange = (html) => {
        this.$emit('change', html);
      };
      this.editor.customConfig.zIndex = 8;
      this.editor.customConfig.customAlert = (info) => {};
      this.editor.customConfig.uploadFileName = 'image';
      this.editor.customConfig.uploadImgParams = {};
      this.editor.customConfig.uploadImgHooks = {
        fail: (xhr, editor, result) => {
          this.$Notice.error({
            title: '错误',
            desc: result.error
          });
        }
      };
      this.editor.customConfig.uploadImgServer = '/api/backend/wang_editor_upload_image';
      let token = document.head.querySelector('meta[name="csrf-token"]');
      if (token) {
        this.editor.customConfig.uploadImgHeaders = {
          'X-CSRF-TOKEN': token
        };
      }
      this.editor.create();
      this.editor.txt.html(this.content);
    }
  };
</script>

<style scoped lang="less">
#editorElem{
  font-size: initial;
}
</style>