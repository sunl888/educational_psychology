<template>
  <div class="overview">
    <div class="head_stat">
      <div class="item">
        <Icon style="color: #37c8f7;" class="icon" type="document"></Icon>
        <div class="inline">
          <div class="num">0</div>
          <div class="text">文章</div>
        </div>
      </div>
      <div class="item">
        <Icon style="color: #ff7e9c;" class="icon" type="arrow-graph-up-right"></Icon>
        <div class="inline">
          <div class="num">0</div>
          <div class="text">今日UV</div>
        </div>
      </div>
      <div class="item">
        <Icon class="icon" style="color: #fcba2c;" type="stats-bars"></Icon>
        <div class="inline">
          <div class="num">0</div>
          <div class="text">今日PV</div>
        </div>
      </div>
      <div class="item">
        <Icon class="icon" style="color: #bc67db;" type="person"></Icon>
        <div class="inline">
          <div class="num">0</div>
          <div class="text">用户</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
};
</script>

<style scoped lang="less">
  .head_stat{
    height: 160px;
    border-radius: 4px;
    background-color: #fff;
    margin-bottom: 20px;
    padding: 30px 0;
    text-align: center;
    box-shadow: 1px 1px 2px #dfe5ed;
    .item{
      width: 25%;
      height: 100px;
      border-right: 1px solid #e5e9ef;
      float: left;
      &:last-child{
        border-right: none;
      }
      .icon{
        margin-right: 15px;
        font-size: 60px;
        position: relative;
        top: -3px;
      }
      .inline{
        display: inline-block;
        position: relative;
        top: 20px;
        .num{
          font-size: 36px;
          font-family: Arial;
          text-align: left;
          color: #6d757a;
        }
        .text{
          font-size: 16px;
          text-align: left;
          color: #99a2aa;
        }
      }
    }
  }
</style>
