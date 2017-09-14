<template>
 <main class="article_wrapper">
    <div class="title_input_wrapper">
      <TitleInput :value="title" @input="val => void $emit('update:title', val)"/>
    </div>
    <WangEditor :content="content" @change="html => void $emit('update:content', html)"></WangEditor>
  </main>
</template>

<script>
import TitleInput from './TitleInput.vue';
import WangEditor from './WangEditor.vue';
export default {
  name: 'titleWithContent',
  props: {
    title: String,
    content: String
  },
  components: { TitleInput, WangEditor },
  data () {
    return {};
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
    margin-bottom: 30px;
  }
}
</style>
