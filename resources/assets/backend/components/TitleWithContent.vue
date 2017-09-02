<template>
 <main class="article_wrapper">
    <div class="title_input_wrapper">
      <TitleInput :value="title" @input="val => void $emit('update:title', val)"/>
    </div>
    <VueSimditor :value="content" @input="val => void $emit('update:content', val)"/>
  </main>
</template>

<script>
import TitleInput from './TitleInput.vue';
import VueSimditor from './vue-simditor';
export default {
  name: 'titleWithContent',
  props: {
    title: String,
    content: String
  },
  components: { TitleInput, VueSimditor }
};
</script>

<style scoped lang="less">
.article_wrapper {
  background-color: #fff;
  padding: 40px;
  margin-bottom: 30px;
  .title_input_wrapper {
    padding-bottom: 20px;
  }
}
</style>
