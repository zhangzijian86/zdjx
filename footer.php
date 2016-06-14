</div>
<!--content end -->
</div>
<!-- Wrapper end -->
<!--footer start -->
<div id="Footer">
	<div class="line"></div>
	<div class="blank15"></div>
	<ul class="footpage">
         	  <li class="nb"><a href="<?php bloginfo('url');?>/">首页</a></li>
              <?php wp_list_pages('title_li=&sort_column=post_date&sort_order=ASC&depth=1&exclude=')?>
         </ul>
	<div class="clearfix"></div>
		<p>Copyright © <?php echo date('Y'); ?> All Rights Reserved.<a href="<?php bloginfo('url');?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> 版权所有 学校地址:聊城市聊阳路中段市车管所院内 鲁ICP备11019038号-1</p>
	<p>电子邮箱:test.cn@163.com 报名电话:0635-8553*** 报考处电话：0635-8554378 0635-8553808 教务处电话：0635-8553744 站长QQ：286959750 <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F7aa34fe43290c4be0f8ff0c0c6cb0ddd' type='text/javascript'%3E%3C/script%3E"));
</script>
</p>

</div>
<!--footer end-->
<?php wp_footer(); ?>
</body>
</html>