<template>

  <Form :model="formItem" :label-width="80">
        <Form-item label="输入框">
            <Input v-model="input" placeholder="请输入"></Input>
        </Form-item>
  </Form-item>
</template>
<<script>
export default {
  data () {
    return {
      input: ''
    };
  }
};
</script>
<style lang="less" scoped>
</style>
