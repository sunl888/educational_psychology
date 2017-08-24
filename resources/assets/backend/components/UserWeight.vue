<template>
  <div class="m-info">
    <a href="#" target="_blank">
      <i class="user-pic" style="background-image: url(http://static.hdslb.com/images/member/noface.gif)"></i>
      <span class="user-name">{{name}}</span>
    </a>
  </div>
</template>

<script>
export default{
  name: 'UserWeight',
  props: {
    name: String
  }
};
</script>

<style scoped lang="less">
  .m-info {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 200px;
    float: left;
    >a{
      display: block;
    }
    .user-pic {
      display: inline-block;
      width: 30px;
      height: 30px;
      border-radius: 100%;
      vertical-align: middle;
      background-size: 100% 100%;
      margin-right: 8px;
    }
    .user-name {
      display: inline-block;
      line-height: 30px;
      height: 30px;
      color: #222;
    }
  }
</style>
