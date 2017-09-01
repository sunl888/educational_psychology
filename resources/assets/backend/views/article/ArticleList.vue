<template>
  <div class="article_list">
    <ListWrapper ref="list" :title="title" :queryName="`posts?include=user&category_id=${categoryId}&status=${status}${showTrashed ? '&only_trashed=true' : ''}`">
      <span slot="option"><Button @click="$router.push({name: 'addArticle'})" icon="plus-round" type="primary">添加</Button></span>
      <template scope="props">
        <div class="option_list">
          <RadioGroup v-model="status" type="button">
              <Radio label="all">全部</Radio>
              <Radio label="publish">已发布</Radio>
              <Radio label="draft">草稿</Radio>
          </RadioGroup>
          <Button size="small" @click="showTrashed = !showTrashed" class="trashed_btn" :type="showTrashed ? 'success' : 'warning'">{{showTrashed ? '退出回收站' : '显示回收站'}}</Button>
          <Select v-model="categoryId" style="width:200px">
            <Option :value="0">全部分类文章</Option>
            <Option v-for="item in categories" :value="item.id" :key="item.id">{{item.indent_str}}{{ item.cate_name }}</Option>
          </Select>
        </div>
        <ArticleItem :isTrashed="showTrashed" @restore="restore" @edit="id => $router.push({name: 'editArticle', params: { id }})" @del="del" :key="article.id" v-for="article in props.data" :article="article"></ArticleItem>
        <NoData v-if="props.data.length === 0"></NoData>
      </template>
    </ListWrapper>
  </div>
</template>
<script>
import ArticleItem from '../../components/ArticleItem.vue';
import ListWrapper from '../../components/ListWrapper.vue';
import recycleBin from '../../mixins/recycleBin';
import NoData from '../../components/NoData.vue';
export default {
  base: {
    title: '文章',
    url: 'posts'
  },
  components: { ArticleItem, ListWrapper, NoData },
  mixins: [ recycleBin ],
  mounted () {
    this.$http.get('categories/visual_output', {
      params: {
        type: 'post'
      }
    }).then(res => {
      this.categories = res.data.data;
    });
  },
  computed: {
    title () {
      let prefix = this.showTrashed ? '回收站' : '文章列表';
      let currentCate = this.categories.find(item => item.id === this.categoryId);
      if (currentCate) {
        return `${prefix}(${currentCate.cate_name})`;
      }
      return prefix;
    }
  },
  data () {
    return {
      showTrashed: false,
      status: 'all',
      categories: [],
      categoryId: 0,
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

<style lang="less" scoped>
.article_list{
  .option_list{
    margin-bottom: 15px;
    .trashed_btn{
      margin-left: 10px;
      margin-right: 20px;
    }
  }
}
</style>
