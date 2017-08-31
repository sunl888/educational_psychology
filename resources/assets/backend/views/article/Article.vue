<template>
  <div class="article">
    <h1 class="title">{{title}}</h1>
    <main class="article_wrapper">
      <div class="cover_wrapper"></div>
      <div class="title_input_wrapper">
        <TitleInput v-model="formData.title" />
      </div>
      <VueSimditor v-model="formData.content"/>
    </main>
    <div class="option">
      <div class="left">
        <CategorySelectPanel @change="cid => formData.category_id = cid" class="type_panel"></CategorySelectPanel>
        <Panel title="封面" full size="small" class="cover">
          <UploadPicture :url="formData.cover_url" @on-success="(cover) => formData.cover = cover"></UploadPicture>
        </Panel>
      </div>
      <Panel title="发布" full size="small" width="300px">
        <Form :model="formData" label-position="top">
          <Form-item label="发布时间">
              <Date-picker type="date" placeholder="选择发布时间" v-model="formData.published_at"></Date-picker>
          </Form-item>
          <Form-item label="正文模板">
            <Select v-model="formData.template" placeholder="请选择正文模板">
              <Option v-for="item in contentTemplates" :key="item.file_name" :value="item.file_name">{{item.title}}</Option>
            </Select>
          </Form-item>
          <Form-item label="浏览次数">
            <Input-number :min="0" v-model="formData.views_count"></Input-number>
          </Form-item>
          <Form-item label="置顶开关">
            <i-switch  v-model="formData.top" size="large">
              <span slot="open">ON</span>
              <span slot="close">OFF</span>
            </i-switch>
          </Form-item>
          <ButtonGroup>
            <Button @click="submit('publish')" type="success">{{this.id ? '提交修改' : '发布'}}</Button>
            <Button @click="submit('draft')" type="primary">保存为草稿</Button>
            <Button @click="$router.back()">取消</Button>
          </ButtonGroup>
        </Form>
      </Panel>
    </div>
  </div>
</template>
<script>
import TitleInput from '../../components/TitleInput.vue';
import VueSimditor from '../../components/vue-simditor';
import 'simditor/styles/simditor.css';
import Panel from '../../components/Panel.vue';
import UploadPicture from '../../components/UploadPicture.vue';
import fromMixin from '../../mixins/form';
import CategorySelectPanel from '../../components/CategorySelectPanel.vue';
export default {
  base: {
    title: '文章',
    url: 'posts',
    query: {
      include: 'post_content'
    }
  },
  mixins: [ fromMixin ],
  components: { TitleInput, VueSimditor, Panel, UploadPicture, CategorySelectPanel },
  methods: {
    submit (status) {
      this.formData.status = status;
      this.confirm();
    }
  },
  data () {
    return {
      formData: {
        'title': null,
        'slug': null,
        'excerpt': null,
        'content': null,
        'cover': null,
        'status': null,
        'type': null,
        'views_count': 0,
        'top': false,
        'order': 0,
        'template': null,
        'category_id': null,
        'published_at': null
      },
      contentTemplates: []
    };
  },
  mounted () {
    this.formData.published_at = new Date();
    this.$on('on-data', formData => {
      this.formData.content = formData.post_content.data.content;
    });
    this.$on('on-success', formData => {
      this.$router.push({name: 'articleList'});
    });
    this.$http.get('templates').then(res => {
      this.contentTemplates = res.data.content_templates;
    });
  }
};
</script>

<style lang="less" scoped>
.article{
  .title{
    font-weight: 400;
    line-height: 32px;
    font-size: 20px;
    margin-bottom: 25px;
  }
  >main{
    background-color: #fff;
    padding: 40px;
    margin-bottom: 30px;
    .title_input_wrapper{
      padding-bottom: 20px;
    }
  }
  .option{
    display: flex;
    flex-direction: row;
    >.left{
      flex-grow: 1;
      margin-right: 30px;
      .type_panel, .cover{
        height: auto;
        max-width: 650px;
        margin-bottom: 30px;
      }
    }
  }
}
</style>
