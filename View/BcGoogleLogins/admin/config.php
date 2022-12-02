<?php
/**
 * [BcGoogleLogin] View
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcGoogleLogin
 * @license			MIT
 */
?>
<section class="bca-section" data-bca-section-type='form-group'>

<?php echo $this->BcForm->create('BcGoogleLoginConfig', ['type' => 'file']) ?>

	<?php echo $this->BcFormTable->dispatchBefore() ?>

	<table id="FormTable" class="form-table bca-form-table">
		<tr>
			<th class="col-head bca-form-table__label">
				<?php echo $this->BcForm->label('BcGoogleLoginConfig.client_id', __d('baser', 'クライアントID')) ?>
				&nbsp;<span class="required bca-label" data-bca-label-type="required"><?php echo __d('baser', '必須') ?></span>
			</th>
			<td class="col-input bca-form-table__input">
				<?php
					echo $this->BcForm->input(
						'BcGoogleLoginConfig.client_id',
						[
							'type' => 'text',
							'size' => 100,
							'maxlength' => 255,
							'autofocus' => true,
							'class' => 'bca-textbox__input',
							'placeholder' => '例： hogehoge.apps.googleusercontent.com',
						]
					);
				?>
				<?php echo $this->BcForm->error('BcGoogleLoginConfig.client_id') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head bca-form-table__label">
				<?php echo $this->BcForm->label('BcGoogleLoginConfig.client_secret', __d('baser', 'クライアントシークレット')) ?>
				&nbsp;<span class="required bca-label" data-bca-label-type="required"><?php echo __d('baser', '必須') ?></span>
			</th>
			<td class="col-input bca-form-table__input">
				<?php
					echo $this->BcForm->input(
						'BcGoogleLoginConfig.client_secret',
						[
							'type' => 'text',
							'size' => 100,
							'maxlength' => 255,
							'autofocus' => true,
							'class' => 'bca-textbox__input',
							'placeholder' => '例： GHOGE-hogehoge-fugafuga',
						]
					);
				?>
				<?php echo $this->BcForm->error('BcGoogleLoginConfig.client_secret') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head bca-form-table__label">
				<?php echo $this->BcForm->label('BcGoogleLoginConfig.calback_url', __d('baser', 'ブラウザからのリクエスト')) ?>
			</th>
			<td class="col-input bca-form-table__input">
				<?php
					echo $siteUrl;
				?>
				<p class="info">
					上記URLを「承認済みの JavaScript 生成元」に登録してください。
				</p>
			</td>
		</tr>
		<tr>
			<th class="col-head bca-form-table__label">
				<?php echo $this->BcForm->label('BcGoogleLoginConfig.calback_url', __d('baser', 'ウェブサーバーからのリクエスト')) ?>
			</th>
			<td class="col-input bca-form-table__input">
				<?php
					echo $siteUrlCallback;
				?>
				<p class="info">
					上記URLを「承認済みのリダイレクト URI」に登録してください。
				</p>
			</td>
		</tr>
		<?php echo $this->BcForm->dispatchAfterForm('option') ?>
	</table>

	<p class="info">
		<ol>
			<li><a href="https://console.cloud.google.com/apis/credentials?hl=ja" target="_blank">Google Cloud Console</a> にアクセスして、認証情報を設定します。</li>
			<li>「認証情報を作成」から「OAuth 2.0 クライアント ID」を選択してウェブアプリケーションの「クライアントID」「クライアントシークレット」を取得します。</li>
			<li>上記画面に表示されている各URLを<a href="https://console.cloud.google.com/apis/credentials?hl=ja" target="_blank">Google Cloud Console</a> の「承認済みの JavaScript 生成元」「承認済みのリダイレクト URI」に登録します。</li>
			<li>上記画面「クライアントID」「クライアントシークレット」をセットして保存します。</li>
		</ol>
		<p>※ Google Cloud Consoleへ登録後、少し時間がかかりますのでログインで認証エラーになる場合は、しばらく待ってから再度ご確認ください。</p>
	</p>

	<?php echo $this->BcFormTable->dispatchAfter() ?>

	<section class="bca-actions">
		<div class="bca-actions__main">
			<?php echo $this->BcForm->submit(
				__d('baser', '保存'),
				[
					'id' => 'BtnSave',
					'div' => false,
					'class' => 'button bca-btn bca-actions__item',
					'data-bca-btn-type' => 'save',
					'data-bca-btn-size' => 'lg',
					'data-bca-btn-width' => 'lg',
				]
			) ?>
		</div>
	</section>

<?php echo $this->BcForm->end() ?>

</section>

<script>
$(function(){
});
</script>

<style>
</style>
