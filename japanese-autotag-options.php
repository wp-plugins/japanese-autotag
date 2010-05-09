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
<tr><td valign="top"><p>Plugin Status:</p></td><td>
<p>
<input type="radio" name="enabled" value="on" <?php if( $enabled == 'on' ) { echo 'checked'; } ?>> Enabled<br>
<input type="radio" name="enabled" value="off" <?php if( $enabled == 'off' ) { echo 'checked'; } ?>> Disabled
</p>
</tr>
<tr>
<tr><td valign="top"><p>Application Key:</p></td><td>
<p>Enter your Yahoo! Japan Application ID. You can get the ID from <a href="http://e.developer.yahoo.co.jp/webservices/register_application">Yahoo! Japan's website</a>.</p>
<p><input type="text" style="width:600px;" name="appkey" value="<?php echo $appkey; ?>"></p>
</td>
</tr>
<tr><td valign="top"><p>Key Phrase Tagging:</p></td><td>
<p>
Japanese AutoTag will tag based on key phrases instead of words. When Key Phrase Tagging is enabled, Scope option will be ignored.
</p>
<p>
<input type="checkbox" name="keyphrase_enabled" value="on" <?php if( $keyphrase_enabled === 'on' ) { echo 'checked'; } ?>> Enabled
</p>
</td>
</tr>
<tr><td valign="top"><p>Scope:</p></td><td>
<p>
The plugin parses only post title for tagging in a default setting, and typically it's enough. If you want to parse post content as well, check the following: 
</p>
<p>
<input type="checkbox" name="parse_body" value="on" <?php if( $parse_body === 'on' ) { echo 'checked'; } ?>> Include post content
</p>
</td></tr>
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
<tr><td valign="top"><p>Word Class:</p></td><td>
<p>
Select word classes for tagging. If you uncheck all, all classes can be used.
</p>
<table>
<tr>
<td><input type="checkbox" name="wc1" value="on" <?php if( $wc1 === 'on' ){ echo 'checked'; } ?>> Adjective (形容詞)</td>
<td><input type="checkbox" name="wc2" value="on" <?php if( $wc2 === 'on' ){ echo 'checked'; } ?>> Adjective verb (形容動詞)</td>
<td><input type="checkbox" name="wc3" value="on" <?php if( $wc3 === 'on' ){ echo 'checked'; } ?>> Exclamation (感動詞)</td>
<td><input type="checkbox" name="wc4" value="on" <?php if( $wc4 === 'on' ){ echo 'checked'; } ?>> Adverb (副詞)</td>
</tr>
<tr>
<td><input type="checkbox" name="wc5" value="on" <?php if( $wc5 === 'on' ){ echo 'checked'; } ?>> Adnominal (連体詞)</td>
<td><input type="checkbox" name="wc6" value="on" <?php if( $wc6 === 'on' ){ echo 'checked'; } ?>> Conjunction (接続詞)</td>
<td><input type="checkbox" name="wc7" value="on" <?php if( $wc7 === 'on' ){ echo 'checked'; } ?>> Prefix (接頭辞)</td>
<td><input type="checkbox" name="wc8" value="on" <?php if( $wc8 === 'on' ){ echo 'checked'; } ?>> Suffix (接尾辞)</td>
</tr>
<tr>
<td><input type="checkbox" name="wc9" value="on" <?php if( $wc9 === 'on' ){ echo 'checked'; } ?>> Noun (名詞)</td>
<td><input type="checkbox" name="wc10" value="on" <?php if( $wc10 === 'on' ){ echo 'checked'; } ?>> Verb (動詞)</td>
<td><input type="checkbox" name="wc11" value="on" <?php if( $wc11 === 'on' ){ echo 'checked'; } ?>> Particle (助詞)</td>
<td><input type="checkbox" name="wc12" value="on" <?php if( $wc12 === 'on' ){ echo 'checked'; } ?>> Verbal auxiliary (助動詞)</td>
</tr>
<tr>
<td><input type="checkbox" name="wc13" value="on" <?php if( $wc13 === 'on' ){ echo 'checked'; } ?>> Other (特殊、その他)</td>
</tr>
</table>


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