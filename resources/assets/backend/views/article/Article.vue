<template>
  <div class="article">
    <h1 class="title">{{title}}</h1>
    <main class="article_wrapper">
      <div class="cover_wrapper"></div>
      <div class="title_input_wrapper">
        <TitleInput v-model="content" />
      </div>
      <VueSimditor />
    </main>
    <div class="option">
      <div class="left">
        <CategorySelectPanel class="type_panel"></CategorySelectPanel>
        <Panel title="封面" full size="small" class="cover">
          <UploadPicture></UploadPicture>
        </Panel>
      </div>
      <Panel title="发布" full size="small" width="300px">
        <Form :model="formRight" label-position="top">
          <Form-item label="发布时间">
              <Date-picker type="date" placeholder="选择发布时间" v-model="content"></Date-picker>
          </Form-item>
          <Form-item label="正文模板">
            <Select v-model="content" placeholder="请选择正文模板">
              <Option value="beijing">北京市</Option>
              <Option value="shanghai">上海市</Option>
              <Option value="shenzhen">深圳市</Option>
            </Select>
          </Form-item>
          <Form-item label="浏览次数">
            <Input-number :max="10" :min="1" v-model="content"></Input-number>
          </Form-item>
          <Form-item label="置顶开关">
            <i-switch size="large">
              <span slot="open">ON</span>
              <span slot="close">OFF</span>
            </i-switch>
          </Form-item>
          <ButtonGroup>
              <Button type="success">编辑</Button>
              <Button type="primary">保存为草稿</Button>
              <Button>取消</Button>
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
    url: 'posts'
  },
  mixins: [ fromMixin ],
  components: { TitleInput, VueSimditor, Panel, UploadPicture, CategorySelectPanel },
  data () {
    return {
      formData: {},
      content: '',
      type: 1
    };
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
