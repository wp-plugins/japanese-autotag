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
<tr><td valign="top"></td><td>
<p>
<input type="radio" name="enabled" value="on" <?php if( $enabled === 'on' ) { echo 'checked'; } ?>><br>
<input type="radio" name="enabled" value="off" <?php if( $enabled === 'off' ) { echo 'checked'; } ?>><br>
</tr>
<tr>
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
<tr><td valign="top"><p>Add Tags When:</p></td><td>
<p>
Tags will be automatically generated every time you publish posts. If you want to generate tags every time you save your post even if it's a draft, check the following:
</p>
<p>
<input type="checkbox" name="add_on_save_post" value="on" <?php if( $add_on_save_post === 'on' ){ echo 'checked'; } ?>> Save post
</p>

</td></tr>
<tr><td valign="top"><p>Exception Pattern:<br><i>Advanced</i></p></td><td>
<p>
You can specify a Perl-style regular expression pattern to prohibit words matching the pattern from being tagged.  
</p>
<p><input type="text" style="width:300px;" name="expattern" value="<?php echo $expattern; ?>"></p>

<table>
<tr><td colspan="2"><i>Regular Expression Hints</i></td></tr>
<tr><td nowrap="nowrap">Word you want to prohibit</td><td>Pattern</td></tr>
<tr>
	<td nowrap="nowrap">Number only:</td>
	<td nowrap="nowrap"><code>/^[0-9]+$/</code></td>
</tr>
<tr>
	<td nowrap="nowrap">Alphabet only:</td>
	<td nowrap="nowrap"><code>/^[a-zA-Z]+$/</code></td>
</tr>
<tr>
	<td nowrap="nowrap">Number only or alphabet only:</td>
	<td nowrap="nowrap"><code>/^(\d+|[a-zA-Z]+)$/</code></td>
</tr>
</table>

</td></tr>
</table>
<p>
<input class="button-primary" type="submit" name="Submit" value="Save">
</p>
</form>
</div>