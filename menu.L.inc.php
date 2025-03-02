<?php
if (!defined('_GNUBOARD_')) exit;

/* *************************************
	:: 좌측 메뉴 스타일 ::
-----------------------------------------
	좌측메뉴로 설정했을 경우 출력되는 영역입니다.

	- Menu Link 에서 class="change-link" 를 적용하는 경우
	- 메뉴가 유지되며 링크가 이동됩니다.
************************************* */
add_stylesheet('<link rel="stylesheet" href="'.$menu_skin_url.'/css/style.L.css">', 0);

?>

<style>

.material-symbols-outlined {
    font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24
}


.freebak-menu {width:<?=$m_w?>px; <?=$background?>}
.freebak-menu a {<?=$menu_default?>}
.freebak-menu a:hover {<?=$menu_over?>}
.freebak-menu .line {<?=$link_color?>}

.freebak-menu {
    width: <?=$m_w?>px;
<?=$background?>;
    position: fixed;
    left: -<?=$m_w?>px;
    top: 0;
    height: 100%;
    transition: 0.3s;
}

</style>
<div class="menu-button"> <svg id="icon" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#ffffff"><path d="M370.33-480.67 177.33-674l73.34-73.33 266.66 266.66L250.67-214l-73.34-73.33 193-193.34Zm267 0L444-674l73.33-73.33L784-480.67 517.33-214 444-287.33l193.33-193.34Z"/></svg> </div>
<div class="freebak-menu">
	<div class="mnu">
		<ul>
			<?
				$menu_sql = " select * from {$g5['menu_table']} where me_use = '1' order by me_order*1 asc, me_id asc";
				$menu = sql_query($menu_sql);

				for($i=0; $me = sql_fetch_array($menu); $i++) {
					$target = "";
					if($me['me_target'] == 'self') {
						$me['me_target'] = '';
					}

					if($me['me_name'] == '구분선') {
						echo "<li class='line'></li>";
					} else {
			?>
					<li>
						<a href="<?php echo $me['me_link']?>" <? if($me['me_target']) { ?>target="_<?=$me['me_target']?>"<? } ?>  class="change-link">
							<?=$me['me_name']?>
						</a>
					</li>

			<? }} ?>

			<li class="line"></li>
			<? if(!$is_member) { //멤버가 아닐 경우 ?>
				<li>
					<a href="<?=G5_BBS_URL?>/login.php">
						LOGIN
					</a>
				</li>
				<? if($is_add_register) { //회원가입이 가능한 경우 ?>
					<li>
						<a href="<?=G5_BBS_URL?>/register.php" class="change-link">
							JOIN<
						</a>
					</li>
				<? } ?>
			<? } else { //멤버일 경우 ?>
				<li>
					<a href="<?=G5_BBS_URL?>/logout.php">
						LOGOUT
					</a>
				</li>
				<? if($is_admin) { ?>
				<li>
					<a href="<?=G5_URL?>/adm" target="_blank">
						ADMIN
					</a>
				</li>
				<? } else { ?>
					<li>
						<a href="<?=G5_BBS_URL?>/member_confirm.php?url=register_form.php" class="change-link">
							정보수정
						</a>
					</li>
				<? } ?>
			<? } ?>

			<? if(defined('_INDEX_') && $config['cf_bgm']) { ?>
				<li class="bgm-btn">
					<div id="site_bgm_box">
						<iframe src="./bgm.php?action=play" name="bgm_frame" id="bgm_frame" border="0" frameborder="0" marginheight="0" marginwidth="0" topmargin="0" scrolling="no" allowTransparency="true"></iframe>
					</div>

					<a href="<?=G5_URL?>/bgm.php?action=play" target="bgm_frame" onclick="return fn_control_bgm('play')" class="control-bgm-play" style="display:none;">
						BGM ON
					</a>
					<a href="<?=G5_URL?>/bgm.php" target="bgm_frame" onclick="return fn_control_bgm('stop')" class="control-bgm-stop">
						BGM OFF
					</a>
				</li>
			<? } ?>
		</ul>
	</div>
</div>