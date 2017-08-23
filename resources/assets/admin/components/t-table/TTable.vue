<template>
  <div class="table-wrapper">
    <table border="0" cellspacing="0" cellpadding="0" class="ttable">
      <thead>
        <tr>
          <th v-for="col in columns">{{col.title}}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data">
          <td v-for="col in columns">
            <template v-if="!col.render">
              {{item[col.key]}}
            </template>
            <TableRenderItem v-else :render="col.render" :params="item"></TableRenderItem>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  import TableRenderItem from './TableRenderItem.vue';
  export default {
    name: 'TTable',
    components: { TableRenderItem },
    props: {
      data: Array,
      columns: Array
    },
    mounted () {
    }
  };
</script>

<style scoped lang="less">
.table-wrapper{
  width: 100%;
  height: 100%;
  background: #fff;
  border-radius: 4px;
  box-shadow: 1px 1px 2px #dfe5ed;
  .ttable{
    width: 100%;
    td, th {
      text-align: center;
      height: 40px;
      padding: 0 10px;
      border-bottom: 1px solid #efefef;
    }
    >thead {
      font-size: 14px;
      color: #222;
      >tr{
        &:hover{
          background-color: #fff;
        }
        >th{
          text-align: center;
        }
      }
    }
    >tbody {
      font-size: 14px;
      color: #666;
      >tr {
        height: 40px;
      }
    }
    tr {
      height: 60px;
      &:hover{
        background-color: #f8f9fb;
        transition: background-color .2s;
      }
    }
  }
}
</style>
