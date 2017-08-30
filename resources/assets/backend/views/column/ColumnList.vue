<template>
  <div class="column_list">
    <ListWrapper ref="list" title="栏目列表" :queryName="$options.base.url">
      <span slot="option"><Button @click="$router.push({name: 'addColumn'})" icon="plus-round" type="primary">添加</Button></span>
      <template scope="props">
        <TTable :columns="userCol" :data="props.data" />
      </template>
    </ListWrapper>
  </div>
</template>

<script>
import TTable from '../../components/t-table';
import ListWrapper from '../../components/ListWrapper.vue';
export default {
  base: {
    title: '栏目',
    url: 'categories'
  },
  components: { TTable, ListWrapper }
};
</script>

<style scoped lang="less">

</style>
