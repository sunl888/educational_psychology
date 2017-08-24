<template>
  <div class="panel" :style="{'width': width}" :class="size">
    <header>
      <h1>{{title}}</h1>
    </header>
    <main class="body_wrapper">
      <div class="body">
        <slot></slot>
      </div>
    </main>
    </el-row>
  </div>
</template>

<script>
export default{
  name: 'panel',
  props: {
    title: {
      type: String,
      required: true
    },
    width: {
      type: String,
      default: 'auto'
    },
    size: {
      type: String,
      default: 'large'
    }
  }
};
</script>
<style scoped lang="less">
  .panel{
    margin-bottom: 20px;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    height: 100%;
    background-color: #fff;
    &.small{
      header{
        h1{
          height: 45px;
          font-size: 16px;
          line-height: 24px;
        }
      } 
    }
    header{
      position: relative;
      border-bottom: 1px solid #eee;
      >h1{
        padding: 20px;
        font-weight: 700;
        font-size: 18px;
      }
      >.header_right{
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translate(0,-50%);
      }
    }
    .body_wrapper{
      border: 1px solid transparent;
      .body{
        width: 500px;
        padding: 40px 15px;
        float: inherit;
        margin: 0 auto;
      }
    }
  }
</style>
