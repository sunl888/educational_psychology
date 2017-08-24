<template>
  <div class="article_item">
    <a href="#" class="cover">
      <img src="https://i2.hdslb.com/bfs/archive/706a7c71b3a274ff4c3038be6b4d200df32b7a6e.png@320w_200h.webp" alt="">
    </a>
    <div class="body">
      <a href="#"><h3>这是一篇文章的标题。</h3></a>
      <p class="describe">欢迎光临  空间，最后的前沿  专栏前几天我有幸被知乎看中，赏脸给了块一亩三分地，可以随便在上面打滚儿胡扯一通，兴奋了好久。欣喜若狂之余犯了难儿，不知道该怎么写专栏…</p>
      <UserWeight name="一家专卖店"></UserWeight>
      <span class="info time">2017-8-24 19:44:16</span>
      <span class="info">阅读：180</span>
    </div>
    <div class="option">
      <Button type="primary" size="large">编辑</Button>
      <Button type="error" size="large" shape="circle" icon="android-delete"></Button>
    </div>
  </div>
</template>

<script>
import UserWeight from './UserWeight.vue';
export default {
  name: 'articleItem',
  components: { UserWeight }
};
</script>
<style lang="less" scoped>
.article_item{
  border-radius: 4px;
  padding: 20px;
  background-color: #fff;
  overflow: hidden;
  box-shadow: rgba(0, 0, 0, 0.05) 0 1px 3px;
  position: relative;
  margin-bottom: 20px;
  .cover{
    float: left;
    >img{
      border-radius: 5px;
      width: 170px;
      display: block;
    }
  }
  .body{
    padding-left: 190px;
    padding-right: 200px;
    h3{
      display: block;
      margin-right: 80px;
      color: #525659;
      font-weight: 700;
      overflow: hidden;
      text-overflow: ellipsis;
      font-weight: normal;
      white-space: nowrap;
      font-size: 18px;
    }
    .describe{
      margin: 5px 0 10px 0; 
      color: #999;
    }
    .info{
      line-height: 30px;
      margin-right: 15px;
      float: right;
      &.time{
        color: #999;
      }
      >.icon{
        font-size: 16px;
        margin-right: 5px;
      }
    }
  }
  .option{
    position: absolute;
    top: 62px;
    right: 30px;
    button:first-child{
      margin-right: 20px;
    }
  }
}
</style>
