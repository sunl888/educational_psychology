<template>
  <div>
    <ArticleItem :key="n"" v-for="n in 10"></ArticleItem>
  </div>
</template>
<script>
import ArticleItem from '../../components/ArticleItem.vue';
export default {
  components: { ArticleItem }
};
</script>

