<template>
  <div class="t_table_wrapper">
    <header>
      <h1 class="title">{{title}}</h1>
      <div class="option">
        <slot name="option"></slot>
      </div>
    </header>
    <main>
      <slot></slot>
    </main>
    <footer>
      <Page class="page" size="small" :total="100" show-sizer></Page>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'TTableWrapper',
  props: {
    title: String
  }
};
</script>

<style lang="less" scoped>
.t_table_wrapper{
  >header{
    margin-bottom: 25px;
    overflow: hidden;
    >.title{
      font-weight: 400;
      line-height: 1;
      font-size: 20px;
      float: left;
    }
    >.option{
      float: right;
      margin-right: 10px;
    }
  }
  >footer{
    margin-top: 20px;
    >.page{
      float: right;
    }
  }
}
</style>


