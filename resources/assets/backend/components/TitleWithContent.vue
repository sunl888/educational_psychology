<template>
 <main class="article_wrapper">
    <div class="title_input_wrapper">
      <TitleInput :value="title" @input="val => void $emit('update:title', val)"/>
      <Alert v-if="titleError" type="error">{{titleError}}</Alert>
    </div>
    <WangEditor :content="content" @change="html => void $emit('update:content', html)"></WangEditor>
    <Alert v-if="contentError" type="error">{{contentError}}</Alert>
    <Upload
        multiple
        name="attachment"
        :default-file-list="defaultFileList"
        :on-remove="handleRemove"
        :on-error="handleError"
        :on-success="handleSuccess"
        :headers="{'X-Requested-With': 'XMLHttpRequest'}"
        :action="action">
        <Button type="primary" icon="android-upload">上传附件</Button>
    </Upload>
  </main>
</template>

<script>
import TitleInput from './TitleInput.vue';
import WangEditor from './WangEditor.vue';
import thttp from '../utils/thttp';
export default {
  name: 'titleWithContent',
  props: {
    title: String,
    content: String,
    attachment_ids: Array,
    attachments: Array,
    titleError: String,
    contentError: String,
  },
  components: { TitleInput, WangEditor },
  watch: {
    'attachments' (newVal) {
      this.defaultFileList = newVal.map(item => {
        return {name: item.title};
      });
    }
  },
  data () {
    return {
      action: thttp.config.baseURL + 'attachments',
      defaultFileList: []
    };
  },
  methods: {
    handleRemove (file, fileList) {
      this.updateAttachments(fileList);
    },
    handleError (error, file) {
      console.log(error);
      this.$Notice.error({
        title: '出错了',
        desc: file.message
      });
    },
    handleSuccess (response, file, fileList) {
      this.updateAttachments(fileList);
    },
    updateAttachments (fileList) {
      let attachmentIds = fileList.map(item => {
        return item.response.attachment_id;
      });
      this.$emit('update:attachment_ids', attachmentIds);
    }
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
  padding-bottom: 20px!important;
  margin-bottom: 30px;
  .title_input_wrapper {
    margin-bottom: 30px;
  }
}
</style>
