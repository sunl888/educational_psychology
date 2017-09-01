export default{
  methods: {
    del (id) {
      this.$Modal.confirm({
        title: '提示',
        content: this.showTrashed ? `在回收站中删除该${this.$options.base.title}将无法恢复你确定要删除？` : `你确定要将该${this.$options.base.title}移入回收站?`,
        onOk: () => {
          this.$http.delete(`${this.$options.base.url}/${id}/${this.showTrashed ? 'real' : ''}`).then(res => {
            this.$Message.success(this.showTrashed ? '已删除' : '已移入回收站');
            this.$refs['list'].refresh();
          });
        }
      });
    },
    restore (id) {
      this.$http.post(`${this.$options.base.url}/${id}/restore`).then(res => {
        this.$Message.success('已恢复');
        this.$refs['list'].refresh();
      });
    }
  }
};
