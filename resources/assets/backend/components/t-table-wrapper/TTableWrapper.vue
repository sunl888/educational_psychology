<template>
  <div class="t_table_wrapper">
    <header>
      <h1 class="title">{{title}}<span class="total">{{total}}</span></h1>
      <div class="option">
        <slot name="option"></slot>
      </div>
    </header>
    <main>
      <slot :data="list"></slot>
    </main>
    <footer>
      <Page @on-page-size-change="(pageSize) => {perPage = pageSize}" :page-size="perPage" @on-change="change" :current.sync="currentPage" class="page" size="small" :total="total" show-sizer></Page>
    </footer>
  </div>
</template>

<script>
import listMixin from '../../mixins/list';
export default {
  name: 'TTableWrapper',
  mixins: [ listMixin ]
};
</script>

<style lang="less" scoped>
.t_table_wrapper{
  >header{
    margin-bottom: 25px;
    overflow: hidden;
    >.title{
      font-weight: 400;
      line-height: 32px;
      font-size: 20px;
      float: left;
      >.total{
        font-size: 14px;
        color: #888;
        margin-left: 5px;
      }
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


