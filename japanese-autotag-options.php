<div class="wrap">
<h2>Japanese AutoTag</h2>
<p>
by <strong><a href="http://keicode.com/">Keisuke Oyama</a></strong>
</p>
<form action="<?php echo $action_url; ?>" method="post">
<input type="hidden" name="_submitted" value="1">
<?php wp_nonce_field('japanese-autotag-nonce'); ?>
<h3>Options</h3>
<table>
<tr><td valign="top"><p>Application Key:</p></td><td>
<p>Enter your Yahoo! Japan Application ID. You can get the ID from <a href="http://e.developer.yahoo.co.jp/webservices/register_application">Yahoo! Japan's website</a>.</p>
<p><input type="text" style="width:600px;" name="appkey" value="<?php echo $appkey; ?>"></p>
</td>
</tr>
<tr><td valign="top"><p>Exception Words:</p></td><td>
<p>
Enter words you don't want to add as tag. If you want to enter multiple words, separate each word by '|' sign. (ex. 春|夏|秋)
</p>
<p><input type="text" style="width:500px;" name="noiselist" value="<?php echo $noiselist; ?>"></p>
</td></tr>
</table>
<p>
<input class="button-primary" type="submit" name="Submit" value="Save">
</p>
</form>
</div>