<?php

if( $pa == $plugin_page )
{
	if( $tr == '' || $tr == 1 )
	{
		$plugin_content = <<< EOF
			<div id="plugin" class="contact_form">
				<form method="post" action="?">
					<div class="field">
						<label>お名前</label>
						<input name="name" type="text" value="${post__name}">
					</div>
					<div class="field">
						<label>メールアドレス</label>
						<input name="email" type="email" value="${post__email}">
					</div>
					<div class="field">
						<label>タイトル</label>
						<input name="title" type="text" value="${post__title}">
					</div>
					<div class="field">
						<label>お問い合わせ内容</label>
						<textareea name="message">${post__message}</textarea>
					</div>
					<div class="submit">
					<input type="reset" value="リセット">
						<input type="submit" value="送信内容確認">
					</div>
				</form>
			</div><!--// #plugin -->
		EOF;
	}
}

?>