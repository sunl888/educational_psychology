<template>
  <Button-group class="submit_btn_group">
    <Button @click="$parent.$parent.confirm()" type="success">确认提交</Button>
    <Button @click="$router.back()">取消</Button>
  </Button-group>
</template>
<script>
export default {
  name: 'FormButtonGroup'
};
</script>

<style lang="less" scoped>
.submit_btn_group{
  margin-top: 20px;
  margin-left: 80px;
}
</style>
