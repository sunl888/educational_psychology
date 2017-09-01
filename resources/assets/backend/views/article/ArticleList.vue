<template>
  <div class="article_list">
    <ListWrapper ref="list" title="文章列表" :queryName="'posts?include=user&category_id=' + categoryId">
      <span slot="option"><Button @click="$router.push({name: 'addArticle'})" icon="plus-round" type="primary">添加</Button></span>
      <template scope="props">
        <CategorySelectPanel @change="cid => categoryId = cid" />
        <ArticleItem @edit="id => $router.push({name: 'editArticle', params: { id }})" @del="del" :key="article.id" v-for="article in props.data" :article="article"></ArticleItem>
      </template>
    </ListWrapper>
  </div>
</template>
<script>
import ArticleItem from '../../components/ArticleItem.vue';
import ListWrapper from '../../components/ListWrapper.vue';
import CategorySelectPanel from '../../components/CategorySelectPanel.vue';
import recycleBin from '../../mixins/recycleBin';
export default {
  components: { ArticleItem, ListWrapper, CategorySelectPanel },
  mixins: [ recycleBin ],
  data () {
    return {
      categoryId: null,
      colums: [
        {
          title: '标题',
          key: 'title'
        },
        {
          title: '作者信息',
          key: 'author_info'
        },
        {
          title: '描述',
          key: 'excerpt'
        },
      ]
    };
  }
};
</script>

