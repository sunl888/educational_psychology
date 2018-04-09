<template>
 <main class="article_wrapper">
    <div class="title_input_wrapper">
      <TitleInput :value="title" @input="val => void $emit('update:title', val)"/>
      <Alert v-if="titleError" type="error">{{titleError}}</Alert>
    </div>
    <div id="ueditor_container"></div>
    <Alert v-if="contentError" type="error">{{contentError}}</Alert>
    <Upload
        class="upload"
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
import tHttp from '../utils/tHttp';
import { getCsrfToken } from '../utils/utils';
export default {
  name: 'titleWithContent',
  props: {
    title: String,
    content: {
      type: String,
      default: ''
    },
    attachment_ids: Array,
    attachments: Array,
    titleError: String,
    contentError: String,
  },
  components: { TitleInput },
  watch: {
    'attachments' (newVal) {
      this.defaultFileList = newVal.map(item => {
        return {name: item.title};
      });
    }
  },
  data () {
    return {
      action: tHttp.config.baseURL + 'attachments',
      defaultFileList: [],
      editor: null
    };
  },
  methods: {
    initEditor () {
      let token = getCsrfToken();

      this.editor = window.UE.getEditor('ueditor_container', {
        initialFrameHeight: 300,
        toolbars: [
          [
            'fullscreen',
            'source',
            '|',
            'undo',
            'redo',
            '|',
            'bold',
            'italic',
            'underline',
            'fontborder',
            'strikethrough',
            'superscript',
            'subscript',
            'removeformat',
            'formatmatch',
            'autotypeset',
            'blockquote',
            'pasteplain',
            '|',
            'forecolor',
            'backcolor',
            'insertorderedlist',
            'insertunorderedlist',
            'selectall',
            'cleardoc',
            '|',
            'rowspacingtop',
            'rowspacingbottom',
            'lineheight',
            '|',
          ],
          [
            'customstyle',
            'paragraph',
            'fontfamily',
            'fontsize',
            '|',
            'directionalityltr',
            'directionalityrtl',
            'indent',
            '|',
            'justifyleft',
            'justifycenter',
            'justifyright',
            'justifyjustify',
            '|',
            // 'touppercase',
            // 'tolowercase',
            // '|',
            'link',
            'unlink',
            'anchor',
            '|',
            'imagenone',
            'imageleft',
            'imageright',
            'imagecenter',
            '|',
            'simpleupload',
            'insertimage',
            'emotion',
            'scrawl',
          ],
          [
            'insertvideo',
            // 'music',
            'attachment',
            'map',
            // 'gmap',
            'insertframe',
            // 'webapp',
            'pagebreak',
            'template',
            'background',
            '|',
            // 'insertcode',
            'horizontal',
            'date',
            'time',
            'spechars',
            'snapscreen',
            'wordimage',
            '|',
            'inserttable',
            'deletetable',
            'insertparagraphbeforetable',
            'insertrow',
            'deleterow',
            'insertcol',
            'deletecol',
            'mergecells',
            'mergeright',
            'mergedown',
            'splittocells',
            'splittorows',
            'splittocols',
            'charts',
            '|',
            'print',
            'preview',
            'searchreplace',
            // 'drafts',
            // 'help'
          ]
        ]
      });
      this.editor.ready(() => {
        this.editor.execCommand('serverparam', '_token', token);
        this.editor.addListener('selectionchange', () => {
          this.$emit('update:content', this.editor.getContent());
        });
        if (this.content) {
          this.editor.setContent(this.content);
        } else {
          let unwatch = this.$watch('content', (newVal, oldVal) => {
            this.editor.setContent(newVal);
            if (newVal) {
              unwatch();
            }
          });
        }
      });
    },
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
  },
  beforeDestroy () {
    try {
      this.editor.destroy();
    } catch (e) {
    } finally {
      this.editor = null;
    }
  },
  mounted () {
    this.initEditor();
  }
};
</script>

<style lang="less">
.edui-editor{
  z-index: 999!important;
}

.article_wrapper {
  background-color: #fff;
  padding: 20px!important;
  padding-bottom: 20px!important;
  margin-bottom: 30px;
  .title_input_wrapper {
    margin-bottom: 30px;
  }
  .upload{
    margin-top: 10px;
  }
}
</style>
