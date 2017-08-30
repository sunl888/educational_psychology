<template>
  <Button-group class="submit_btn_group">
    <Button @click="submit" type="success">确认提交</Button>
    <Button @click="$router.back()">取消</Button>
  </Button-group>
</template>
<script>
export default {
  name: 'FormButtonGroup',
  methods: {
    submit () {
      let parent = this.$parent;
      while (parent !== undefined && typeof parent.confirm !== 'function') {
        parent = parent.$parent;
      }
      console.log(parent);
      parent.confirm();
    }
  }
};
</script>

<style lang="less" scoped>
.submit_btn_group{
  margin-top: 20px;
  margin-left: 80px;
}
</style>
