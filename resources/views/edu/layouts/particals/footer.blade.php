<div class="footer_nav">
    <div class="content">
        @widget('link', ['type' => 'friendship_links'])
        <div class="footer_text">
            <img src="{!! cdn('edu/images/footer_nav_text.png') !!}" alt="">
        </div>
        <ul class="right_info">
            <li>地址：{{ setting('address') }}</li>
            <li>邮编：{{ setting('zip_code') }}</li>
            <li>联系电话：{{ setting('phone') }}</li>
            <li>版权所有 © {{ setting('copyright') }}</li>
        </ul>
    </div>
    <div class="mask"></div>
</div>
<div class="mast_footer">
    <span>技术支持：{{ setting('support') }}</span>
    <span>您是第 {{\App\Models\Visitor::sum('views')}} 个访问者</span>
</div>