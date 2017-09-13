<template>
 <main class="article_wrapper">
    <div class="title_input_wrapper">
      <TitleInput :value="title" @input="val => void $emit('update:title', val)"/>
    </div>
    <quill-editor :options="editorOption" :content="content" @change="({ html }) => void $emit('update:content', html)">
    </quill-editor>
  </main>
</template>

<script>
import TitleInput from './TitleInput.vue';
import { quillEditor } from 'vue-quill-editor';
export default {
  name: 'titleWithContent',
  props: {
    title: String,
    content: String
  },
  components: { TitleInput, quillEditor },
  data () {
    return {
      editorOption: {
        placeholder: '请输入正文'
      }
    };
  }
};
</script>

<style lang="less">
.ql-toolbar.ql-snow, .ql-container.ql-snow{
  border: none;
}
.ql-container .ql-editor {
  min-height: 320px;
  padding-bottom: 1em;
}
.article_wrapper {
  background-color: #fff;
  padding: 35px!important;
  margin-bottom: 30px;
  .title_input_wrapper {
    margin: 0 13px 30px 13px;
  }
}
</style>
