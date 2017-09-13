<template>
  <div class="page">
    <h1 class="title">编辑{{title}}</h1>
    <TitleWithContent :title.sync="formData.title" :content.sync="formData.content"></TitleWithContent>
    <FormButtomGroup />
  </div>
</template>

<script>
import FormButtomGroup from '../../components/FormButtonGroup.vue';
import TitleWithContent from '../../components/TitleWithContent.vue';
import diff from '../../utils/diff';
export default {
  components: { TitleWithContent, FormButtomGroup },
  data () {
    return {
      title: '单页',
      formData: {
        title: '',
        content: ''
      }
    };
  },
  methods: {
    confirm () {
      this.$http.post(`categories/${this.$route.params.id}/page`, diff.diff(this.formData)).then(res => {
        this.$Message.success(`编辑单页成功`);
        this.$router.back();
      });
    }
  },
  mounted () {
    this.$http.get(`categories/${this.$route.params.id}/page`, {
      params: {
        include: 'post_content'
      }
    }).then(res => {
      this.formData.title = res.data.data.title;
      this.formData.content = res.data.data.post_content.data.content;
      this.title = res.data.meta.cate_name;
      diff.save(this.formData);
    });
  }
};
</script>

<style lang="less" scoped>
.page{
  .title {
    font-weight: 400;
    line-height: 32px;
    font-size: 20px;
    margin-bottom: 25px;
  }
  .submit_btn_group{
    margin-left: 0;
  }
}
</style>
