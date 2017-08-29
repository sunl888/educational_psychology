<template>
  <div class="article_list">
    <ListWrapper ref="list" title="文章列表" :queryName="'posts?include=user&category_id=' + categoryId">
      <template scope="props">
        <CategorySelectPanel @change="cid => categoryId = cid" />
        <ArticleItem :key="article.id" v-for="article in props.data" :article="article"></ArticleItem>
      </template>
    </ListWrapper>
  </div>
</template>
<script>
import ArticleItem from '../../components/ArticleItem.vue';
import ListWrapper from '../../components/ListWrapper.vue';
import CategorySelectPanel from '../../components/CategorySelectPanel.vue';
export default {
  components: { ArticleItem, ListWrapper, CategorySelectPanel },
  data () {
    return {
      categoryId: null
    };
  }
};
</script>

