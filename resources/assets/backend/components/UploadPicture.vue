<template>
  <div class="upload_picture">
    <Upload
      ref="uploader"
      v-show="status !== 'uploading'"
      :class="{'finished': status === 'finished'}"
      class="uploader"
      :show-upload-list="false"
      :on-success="handleSuccess"
      :on-progress="handleProgress"
      :format="['jpg','jpeg','png']"
      :max-size="2048"
      :on-format-error="handleFormatError"
      :on-exceeded-size="handleMaxSize"
      :on-error="handleError"
      :before-upload="handleBeforeUpload"
      type="drag"
      action="//jsonplaceholder.typicode.com/posts/">
      <div class="icon">
          <Icon type="camera" size="40"></Icon>
      </div>
    </Upload>
    <template v-if="status === 'uploading'">
      <Progress class="progress" :percent="percentage" hide-info></Progress>
    </template>
    <div class="upload_img" v-if="status === 'finished'">
      <img :src="picUrl">
      <div class="upload_img_option">
        <div class="icon_wrapper">
          <Icon title="替换" type="ios-camera-outline" @click.native="handleReplace"></Icon>
          <Icon title="移除" type="ios-trash-outline" @click.native="handleRemove"></Icon>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'uploadPicture',
  data () {
    return {
      status: 'normal',
      percentage: 1,
      picUrl: '',
      inputDom: null
    };
  },
  methods: {
    handleBeforeUpload () {
      this.status = 'uploading';
      this.percentage = 1;
      this.picUrl = '';
    },
    handleSuccess (res, file) {
      // 因为上传过程为实例，这里模拟添加 url
      this.picUrl = 'https://o5wwk8baw.qnssl.com/7eb99afb9d5f317c912f08b5212fd69a/avatar';
      this.status = 'finished';
    },
    handleError (error, file) {
      console.log(error);
      this.handleSuccess();
    },
    handleFormatError (file) {
      this.$Notice.warning({
        title: '文件格式不正确',
        desc: `文件${file.name}格式不正确，请上传 jpg 或 png 格式的图片。`
      });
    },
    handleMaxSize (file) {
      this.$Notice.warning({
        title: '超出文件大小限制',
        desc: `文件 '${file.name}太大，不能超过 2M。`
      });
    },
    handleProgress (event, file) {
      this.percentage = event.percent;
    },
    handleRemove () {
      this.status = 'normal';
      this.picUrl = '';
    },
    handleReplace () {
      if (this.inputDom === null) {
        this.inputDom = this.$refs['uploader'].$el.querySelector('.ivu-upload-input');
      }
      this.inputDom.click();
    }
  }
};
</script>

<style lang="less">
.upload_picture{
  line-height: 250px;
  background-color: hsla(0,0%,95%,.9);
  border: 2px dashed hsla(0,0%,40%,.2);
  position: relative;
  .icon .ivu-icon{
    color: #aaa!important;
    transition: color .2s ease;
    position: relative;
    top: 11px;
  }
  &:hover{
    .icon .ivu-icon{
      color: #444!important;
    }
    border-color: #999;
  }
  .uploader{
    text-align: center;
    height: 250px;
    transition: border-color .2s ease;
    >.ivu-upload{
      height: 100%;
      border: 0;
      background-color: transparent;
    }
    .icon{
      line-height: 250px;
    }
    &.finished{
      position: absolute;
      right: 45px;
      height: 40px;
      width: 44px;
      bottom: -1px;
    }
  }
  .progress{
    padding: 0 75px;
  }
  .upload_img{
    height: 100%;
    >img{
      width: 100%;
      display: block;
    }
    .upload_img_option{
      position: absolute;
      bottom: -1px;
      right: -1px;
      background: rgba(0, 0, 0, .75);
      border-radius: 4px 0 0 0;
      >.icon_wrapper{
        width: 90px;
        height: 40px;
        position: relative;
        i:first-child, i:last-child{
          color: #fff;
          font-size: 32px;
          cursor: pointer;
          position: absolute;
          top: 0;
          width: 50%;
          text-align: center;
          line-height: 40px;
          &:hover{
            background-color: #000;
          }
        }
        i:first-child{
          left: 0;
        }
        i:last-child{
          right: 0;
        }
      }
    }
  }
}
</style>

