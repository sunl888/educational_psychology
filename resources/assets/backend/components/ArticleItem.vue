<template>
  <div class="article_item">
    <a href="#" class="cover" :style="{'background-image': `url(${article.cover_url})`}"></a>
    <div class="body">
      <a href="#"><h3><Tag class="tag" v-if="article.top" color="red">置顶</Tag><Tag class="tag" v-if="article.status === 'draft'" color="green">草稿</Tag>{{article.title}}</h3></a>
      <p class="describe">{{article.excerpt}}</p>
      <UserWeight v-if="article.user.data.length !== 0" :id="article.user.data.id" :avatar_url="article.user.data.avatar_url" :nick_name="article.user.data.nick_name"></UserWeight>
      <span class="info"><HoverableTime :time="article.published_at"></HoverableTime></span>
      <span class="info">阅读：{{article.views_count}}</span>
    </div>
    <div class="option">
      <Button :type="isTrashed ? 'success' : 'primary'" size="large" @click="$emit(isTrashed ? 'restore' : 'edit', article.id)">{{isTrashed ? '还原' : '编辑'}}</Button>
      <Button type="error" size="large" shape="circle" icon="android-delete" @click="$emit('del', article.id)"></Button>
    </div>
  </div>
</template>

<script>
import UserWeight from './UserWeight.vue';
import HoverableTime from './HoverableTime.vue';
export default {
  name: 'articleItem',
  props: {
    isTrashed: Boolean,
    article: Object
  },
  components: { UserWeight, HoverableTime }
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
    border-radius: 5px;
    width: 170px;
    height: 110px;
    background-size: cover;
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
      >.tag:last-child{
        margin-right: 10px;
      }
    }
    .describe{
      margin: 5px 0 3px 0;
      color: #999;
      height: 39px;
      overflow: hidden;
    }
    .info{
      line-height: 30px;
      margin-right: 15px;
      float: right;
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
